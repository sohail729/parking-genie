<?php

namespace App\Http\Controllers\User;

use App\Contracts\ParkingDetailContract;
use App\Contracts\ParkingImageContract;
use App\Helpers\PaginationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Mail\AdminMail;
use App\Mail\ContactUsMail;
use App\Models\ParkingBlockDate;
use App\Models\ParkingDetail;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{

    public function __construct(
        ParkingDetailContract $parkingDetailRepo,
        ParkingImageContract $parkingImageRepo) {
        $this->parkingDetailRepo = $parkingDetailRepo;
        $this->parkingImageRepo = $parkingImageRepo;
    }

    public function getHelpPage()
    {
        return view('front.contact-us');
    }

    public function getTermsPage()
    {
        return view('front.terms-conditions');
    }
    public function spacedetail($id)
    {
        $space = $this->parkingDetailRepo->getSingle(decrypt($id));
        $blockedDates = $space->blockedDates->pluck('date')->toArray();                     
        return view('front.space-detail', compact('space', 'blockedDates'));
    }

    public function getPrivacyPage()
    {
        return view('front.privacy-policy');
    }
    
    public function getSpaceListingPage(Request $request)
    {
        $spaces = ParkingDetail::all();

         // Sort by price range
          if(isset($request->price_min) && isset($request->price_max)){
            $spaces = $spaces->filter(function ($space) use ($request) {
                if(($request->price_min <= $space->base_price) && ($request->price_max >= $space->base_price)){
                    return $space;                
                }
            });
        }

        // Sort by space type
        if(isset($request->type)){
            $space_type = explode(',', $request->type);
            $spaces = $spaces->filter(function ($space) use ($space_type) {
                if(in_array(strtolower($space->vehicle_type->title), $space_type)){
                    return $space;                
                }
            });
        }

        $page_limit = $request->show ?: 10;
        $currentPage = Paginator::resolveCurrentPage() ?: 1;
        $itemsForCurrentPage = $spaces->forPage($currentPage, $page_limit);
        $spaces = new LengthAwarePaginator($itemsForCurrentPage, $spaces->count(), $page_limit , $currentPage, ['path' => Paginator::resolveCurrentPath()]);

        return view('front.space-listing', compact('spaces'));
    }
    
    public function searchSpace(Request $request)
    {
        
        if(isset($request->arrival) || isset($request->departure) || (isset($request->lng) && isset($request->lat))){
            $spaces = ParkingDetail::all();

            if(isset($request->lng) && isset($request->lat)){

                // earth radius in miles 3963
                $spaces = ParkingDetail::select("parking_details.*",
                \DB::raw("3963 * acos(cos(radians(" . $request->lat . "))
                * cos(radians(parking_details.latitude)) 
                * cos(radians(parking_details.longitude) - radians(" . $request->lng . ")) 
                + sin(radians(" .$request->lat. ")) 
                * sin(radians(parking_details.latitude))) AS distance"))
                ->having('distance', '<', 5)  // nearest in 5 miles radius
                ->get();
            }

            if(isset($request->arrival) && isset($request->departure)){
                $arrival = Carbon::parse($request->arrival)->format('Y-m');
                $departure = Carbon::parse($request->departure)->format('Y-m');
                
                $spaces = $spaces->map(function ($space){
                    $space->session_start = Carbon::parse(Carbon::createFromDate(null, $space->session_start))->format('Y-m');
                    $space->session_end = Carbon::parse(Carbon::createFromDate(null, $space->session_end))->format('Y-m');
                    return $space;
                });
                
                $spaces = $spaces->filter(function ($space) use ($arrival, $departure) {
                    if(($arrival <= $space->session_start) && ($departure >= $space->session_end)){
                        return $space;                
                    }
                });
            }

            // Sort by price range
            if(isset($request->price_min) && isset($request->price_max)){
                $spaces = $spaces->filter(function ($space) use ($request) {
                    if(($request->price_min <= $space->base_price) && ($request->price_max >= $space->base_price)){
                        return $space;                
                    }
                });
            }

            // Sort by space type
            if(isset($request->type)){
                $space_type = explode(',', $request->type);
                $spaces = $spaces->filter(function ($space) use ($space_type) {
                    if(in_array(strtolower($space->vehicle_type->title), $space_type)){
                        return $space;                
                    }
                });
            }

        $spaces = PaginationHelper::paginate($spaces, $request->show ?: 10);

        }else{
            $spaces = ParkingDetail::all();

            // Sort by price range
            if(isset($request->price_min) && isset($request->price_max)){
                $spaces = $spaces->filter(function ($space) use ($request) {
                    if(($request->price_min <= $space->base_price) && ($request->price_max >= $space->base_price)){
                        return $space;                
                    }
                });
            }

            // Sort by space type
            if(isset($request->type)){
                $space_type = explode(',', $request->type);
                $spaces = $spaces->filter(function ($space) use ($space_type) {
                    if(in_array(strtolower($space->vehicle_type->title), $space_type)){
                        return $space;                
                    }
                });
            }

            $page_limit = $request->show ?: 10;
            $currentPage = Paginator::resolveCurrentPage() ?: 1;
            $itemsForCurrentPage = $spaces->forPage($currentPage, $page_limit);
            $spaces = new LengthAwarePaginator($itemsForCurrentPage, $spaces->count(), $page_limit , $currentPage, ['path' => Paginator::resolveCurrentPath()]);
        }

        return view('front.space-listing', compact('spaces'));
    }


    public function findSpace(Request $request)
    {
        

    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email:rfc,dns',
            'subject' => 'required',
        ]);

        try{            
            //Send mail to admin
            $data['to'] = 'info@parkinggenie.com';
            $data['from'] = 'no-reply@parkinggenie.com';
            $data['from_user'] = $request->email;
            $data['subject'] = $request->subject;
            $data['body'] = $request->message ?? '';
            Mail::to($data['to'])->send(new AdminMail($data));

            // Send mail to the person
            Mail::to($request->email)->send(new ContactUsMail);
              return response()->json(['status'=> true, 'message' => 'Thank you for getting in touch!']);
        }
        catch(\Exception $e){
            return response()->json(['status'=> false, 'message' =>  'Something wrong with the server! Please try again.']);
        }
    }
}
