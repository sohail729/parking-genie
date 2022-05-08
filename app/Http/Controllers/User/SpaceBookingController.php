<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingDetail;
use App\Models\SpaceAvailabilty;
use App\Models\SpaceBookedSlot;
use App\Models\SpaceBooking;
use App\Models\SpaceBookingDetail;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Exception\InvalidRequestException;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Exception\MissingParameterException;

class SpaceBookingController extends Controller
{

    protected  $userRepository;
    protected  $stripe;
    public function __construct() {
        $this->stripe = Stripe::make(config('services.stripe.secret'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            $input['expiry'] = explode("/", $input['exp']);
            $token = $this->stripe->tokens()->create([
                'card' => [
                    'number'    => $input['number'],
                    'exp_month' => trim(current( $input['expiry'])),
                    'cvc'       => $input['cvc'],
                    'exp_year'  => trim(end( $input['expiry'])),
                ],
            ]);    
        } catch (CardErrorException $e) {
            $message = $e->getMessage();
            $request->session()->flash('alert-danger', $message);
            return redirect()->back()->withInput($input);                
        } 

        $parking_space = ParkingDetail::find($input['space_id']);
                
        // $availableHours = Carbon::parse($parking_space->lastest_reservation)
        // ->diffInHours($parking_space->earliest_reservation);

        $base_price = $parking_space->base_price;  
        if($parking_space->price_type == 'hourly'){
             $bookingHours = 0;
            $available_slots =  SpaceAvailabilty::whereIn('id', $request->available_slots)->get();
            foreach ($available_slots as $slot) {
                $hourDiff = Carbon::parse($slot->departure_time)->diffInHours($slot->arrival_time);
                $bookingHours += $hourDiff;
            }
            $timeSlots = $available_slots->toArray();
            if (count($timeSlots) > 0) {
                $input['arrival_time'] = $timeSlots[0]["arrival_time"];
                $last_index = (count($timeSlots) - 1);
                $input['departure_time'] = $timeSlots[$last_index]["departure_time"];
            }
            $amount = $base_price  * $bookingHours;
        }elseif($parking_space->price_type == 'daily'){
            $daysDiff = Carbon::parse($input['from_date'])->diffInDays($input['to_date'], false);
            $amount = $base_price * ($daysDiff + 1);
        }elseif($parking_space->price_type == 'weekly'){
            $amount = $base_price * $input['no_of_weeks'];
        }     
        $space_host = $parking_space->spaceHost();
        $host_connect_id = $space_host->pluck('stripe_connect_id')->first();
        $host_id = $space_host->pluck('id')->first();
        
        try {
            $charge = $this->stripe->charges()->create([
                'amount' => $amount,
                'currency' => 'usd',
                'source' => $token['id'],
                'description' => 'Pay out balance',
              ]);

            $transfer =  $this->stripe->transfers()->create([
                'amount'    => $amount,
                'currency'  => 'USD',
                "source_transaction" => $charge['id'],
                'destination' => $host_connect_id
            ]);
    
        } catch (MissingParameterException $e) {
            $message = $e->getMessage();
            $request->session()->flash('alert-danger', $message);
            return redirect()->back()->withInput($input);                
        }

        $booking = new SpaceBooking();
        $booking->host_id = $host_id;
        $booking->customer_id = auth()->user()->id;
        $booking->parking_id = $parking_space->id;
        $booking->amount =  $amount;
        $booking->transfer_id = $transfer['id'];
        $booking->destination_account = $transfer['destination'];

        if($parking_space->price_type == 'hourly'){
            $booking->date = Carbon::parse($input['selected_date'])->format('Y-m-d');
            $booking->hours = $bookingHours;
            $booking->arrival_time = $input['arrival_time'];
            $booking->departure_time = $input['departure_time'];
        }
        elseif($parking_space->price_type == 'daily'){
            $booking->from_date = Carbon::parse($input['from_date'])->format('Y-m-d');
            $booking->to_date = Carbon::parse($input['to_date'])->format('Y-m-d');
        }
        elseif($parking_space->price_type == 'weekly'){
            $booking->weeks = $input['no_of_weeks'];
            $booking->from_date = Carbon::parse($input['from_date'])->format('Y-m-d');
            $booking->to_date = Carbon::parse($input['from_date'])->addWeeks($input['no_of_weeks'])->format('Y-m-d');
        }

        $booking->save();

        if(!empty($request->available_slots)){
            foreach ($request->available_slots as $slot) {
                $slotsBooked = SpaceBookedSlot::create([
                    'parking_id' => $parking_space->id,
                    'booking_id' => $booking->id,
                    'date' => Carbon::parse($input['selected_date'])->format('Y-m-d'),
                    'availabilty_id' => $slot        
                ]);
            }
        }


        // $booked_hours = array_sum($parking_space->booked_hours);
        // $availableHours = $availableHours - $booked_hours;

        //To block booked date from available dates
        if($parking_space->price_type == 'hourly'){
            $booked = SpaceBookedSlot::where('parking_id',  $parking_space->id)->count();
            $available = SpaceAvailabilty::where('parking_id',  $parking_space->id)->count();
            if( $booked === $available){
                $booking->blockDate()->create(['date' => Carbon::parse($input['selected_date'])->format('Y-m-d')]);
            }
        }

        if($parking_space->price_type == 'daily'){
            $period = new CarbonPeriod(Carbon::parse($input['from_date']), '1 day', Carbon::parse($input['to_date']));
            foreach($period as $item){
                $booking->blockDate()->create(['date' => $item->format('Y-m-d')]);
            }
        }
        if($parking_space->price_type == 'weekly'){
            $period = CarbonPeriod::between(Carbon::parse($input['from_date']), Carbon::parse($input['from_date'])->addWeeks($input['no_of_weeks']));
            foreach($period as $item){
                $booking->blockDate()->create(['date' => $item->format('Y-m-d')]);
            }
        }

        return redirect()
        ->route('front.home')
        ->with('toastr.success','Space Booked!');

    }

    public function getTimeSlots(Request $request)
    {

        $slots = [];
        $index = 0;
        $available_slots =  SpaceAvailabilty::where('parking_id', $request->s)->get();
        $available_slots = $available_slots->filter(function($slot) use ($request){
            return (SpaceBookedSlot::where([
                    'availabilty_id' => $slot->id,
                    'parking_id' => $request->s,
                    'date' => Carbon::parse($request->d)->format('Y-m-d')
                ])->doesntExist());
        });       
        foreach ($available_slots as  $value) {
            $slots[$index]['key'] = $value->id;
            $slots[$index]['slot'] = Carbon::parse($value->arrival_time)->format("h:i A").' - '.Carbon::parse($value->departure_time)->format("h:i A");
            $index++;
        }
        return response()->json(['status'=> true, 'available_slots' => $slots]);

    }

    public function calPrice(Request $request)
    {
        $space =  ParkingDetail::whereId($request->s)->first();
        $data = json_decode($request->d, true);
        if($space->price_type === 'hourly'){
            $available_slots =  SpaceAvailabilty::whereParkingId($space->id)->whereIn('id', $data['available_slots'])->get();
            $bookingHours = 0;
            foreach ($available_slots as $slot) {
                $hourDiff = Carbon::parse($slot->departure_time)->diffInHours($slot->arrival_time);
                $bookingHours += $hourDiff;
            }
            $amount = $space->base_price * $bookingHours;
            return response()->json(['status'=> true, 'amount' => $amount]);
        }

        if($space->price_type === 'daily'){
            $daysDiff = Carbon::parse($data['from_date'])->diffInDays($data['to_date'], false);
            $amount = $space->base_price * ($daysDiff + 1);
            return response()->json(['status'=> true, 'amount' => $amount]);
        }

        if($space->price_type === 'weekly'){
            $amount = $space->base_price * $data['no_of_weeks'];
            return response()->json(['status'=> true, 'amount' => $amount]);
        } 
    }
}
