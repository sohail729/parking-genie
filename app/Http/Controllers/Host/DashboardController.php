<?php

namespace App\Http\Controllers\Host;

use App\Contracts\ParkingDetailContract;
use App\Contracts\ParkingImageContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParkingDetailRequest;
use App\Models\Category;
use App\Models\ParkingBlockDate;
use App\Models\ParkingImage;
use App\Models\Plan;
use App\Models\SpaceAvailabilty;
use App\Models\SpaceBooking;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct(
        ParkingDetailContract $parkingDetailRepo,
        ParkingImageContract $parkingImageRepo) {
        $this->parkingDetailRepo = $parkingDetailRepo;
        $this->parkingImageRepo = $parkingImageRepo;
    }

    public function index()
    {
        $plans = Plan::all()->groupBy('title');
        return view('host.index', compact('plans'));
    }

    public function dashboard()
    {
        $host = User::find(auth()->user()->id);
        $host_booking = $host->space_bookings_host;

        $total_bookings = $host_booking->count();
        $total_transaction = $host_booking->pluck('amount')->toArray();
        $total_transaction = array_sum($total_transaction);

        return view('dashboard.index',  compact('total_bookings', 'total_transaction'));
    }

    public function spaceCreate(Request $request)
    {
        // dd(auth()->user()->subscription);
        
        $vehicle_cats = Category::vehicles();
        $space_cats = Category::space();
        if(isset(auth()->user()->subscription->plan)){
            if(auth()->user()->subscription->plan->type == 'free' && auth()->user()->space_parkings->count() >= 2){
                $request->session()->flash('alert-warning', 'You are not allowed to register more than 2 parking spaces.');
            }elseif(auth()->user()->subscription->plan->type == 'super' && auth()->user()->space_parkings->count() >= 4){
                $request->session()->flash('alert-warning', 'You are not allowed to register more than 4 parking spaces.');
            }
        }     
        return view('host.space.form', compact('space_cats', 'vehicle_cats'));
    }

    public function spaceEdit($id)
    {
        $space = $this->parkingDetailRepo->getSingle(decrypt($id));
        $blockedDates = $space->blockedDates->pluck('date')->toArray();

        $vehicle_cats = Category::vehicles();
        $space_cats = Category::space();
        return view('host.space.form', compact('space', 'blockedDates', 'space_cats', 'vehicle_cats'));
    }

    public function spaceList()
    {
        $user = User::find(auth()->user()->id);
        return view('host.space.index', compact('user'));
    }
    
    public function spaceBookings()
    {
        $bookings = SpaceBooking::where('host_id', auth()->user()->id);

        $bookings =$bookings->whereRelation('space', 'price_type', '=' ,'hourly')->get();
        $html = view('common.space.hourly', compact('bookings'))->render();

        return view('host.booking.index', compact('html', 'bookings'));
    }

    public function spaceByType(Request $request)
    {
        $bookings = SpaceBooking::where('host_id', auth()->user()->id);

        if($request->t == 'hourly'){
            $bookings = $bookings->whereRelation('space', 'price_type', '=' ,'hourly')->get();
            return view('common.space.hourly', compact('bookings'))->render();
        }elseif($request->t == 'daily'){
            $bookings = $bookings->whereRelation('space', 'price_type', '=' ,'daily')->get();
            return view('common.space.daily', compact('bookings'))->render();
        }elseif($request->t == 'weekly'){
            $bookings = $bookings->whereRelation('space', 'price_type', '=' ,'weekly')->get();
            return view('common.space.weekly', compact('bookings'))->render();
        }  
    }


    public function update(Request $request, $id)
    {
        $space = $this->parkingDetailRepo->getSingle($id);
        if($space){
            $response = $this->parkingDetailRepo->update($space, $request->all());
            if(isset($request->images) & !empty($request->images)){
            $this->parkingImageRepo->store($request->images, $space->id);
            }
            if(isset($request->blocked_dates) & !empty($request->blocked_dates)){
                $blocked_dates = json_decode($request->blocked_dates);
                $space->blockedDates()->delete();    
                foreach($blocked_dates as $key => $date){
                    ParkingBlockDate::create([
                        'parking_id' => $id,                  
                        'date' => Carbon::parse($date)->addDay(1)->format('Y-m-d')                
                    ]);
                }
            }
            if($response){
                $request->session()->flash('alert-success', 'Space updated successfull!');
                return redirect()->route('host.space.index');
            }
        }

        $request->session()->flash('alert-danger', 'Something went wrong');
        return redirect()->route('host.space.index');
    }


    
    public function store(Request $request)
    {
        if(isset(auth()->user()->subscription)){            
            if(auth()->user()->subscription->plan->type == 'free' && auth()->user()->space_parkings->count() >= 2){
                $request->session()->flash('alert-warning', 'You are not allowed to register more than 2 parking spaces.');
                return redirect()->back()->withInput();
            }elseif(auth()->user()->subscription->plan->type == 'super' && auth()->user()->space_parkings->count() >= 4){
                $request->session()->flash('alert-warning', 'You are not allowed to register more than 4 parking spaces.');
                return redirect()->back()->withInput();
            }   
        }
            
        $detailId = $this->parkingDetailRepo->store($request->all());
        $period = new CarbonPeriod ($request->earliest_reservation, '1 hour', $request->lastest_reservation); 
        foreach($period as $item){
            SpaceAvailabilty::create([
                'parking_id' => $detailId,
                'arrival_time' => $item->format("H:i"),
                'departure_time' => $item->addHour(1)->format("H:i")
            ]);
        }

        $response = $this->parkingImageRepo->store($request->images, $detailId);
        if(isset($request->blocked_dates) & !empty($request->blocked_dates)){
            $blocked_dates = json_decode($request->blocked_dates);

            foreach($blocked_dates as $key => $date){
                ParkingBlockDate::create([
                    'parking_id' => $detailId,                  
                    'date' => Carbon::parse($date)->addDay(1)->format('Y-m-d'),                  
                ]);
            }
        }

        if($response){
            $request->session()->flash('alert-success', 'Space registered successfull!');
            return redirect()->route('host.space.index');
        }
        $request->session()->flash('alert-danger', 'Something went wrong');
        return redirect()->route('host.space.create');
    }

    public function deleteImage(Request $request)
    {
        $response = ParkingImage::whereId($request->i)->whereParkingId($request->s)->delete();
        if($response){
            return response()->json(['status'=> true, 'message' => 'Image deleted from the database.']);
        }
        return response()->json(['status'=> false, 'message' => 'Something wend wrong!']);
    }
}
