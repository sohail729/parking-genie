<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ParkingDetail;
use App\Models\SpaceBooking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        dd('user dashboard');
        // $user = User::find(auth()->user()->id);
        // $bookings = $user->space_bookings_user;
        // $total_bookings = $bookings->count();
        // $total_transaction = $bookings->map(function ($booking){
        //     return $booking->detail;
        // })->pluck('amount')->toArray();
        // $total_transaction = array_sum($total_transaction);
        // return view('dashboard.index',  compact('total_bookings', 'total_transaction'));
    }

    public function spaceList()
    {
        $bookings = SpaceBooking::where('customer_id', auth()->user()->id);

        $total_bookings = $bookings->count();
        $total_transaction = $bookings->pluck('amount')->toArray();
        $total_transaction = array_sum($total_transaction);
        $bookings =$bookings->whereRelation('space', 'price_type', '=' ,'hourly')->get();

        $html = view('common.space.hourly', compact('bookings'))->render();

        return view('user.space.index', compact('html', 'total_bookings', 'total_transaction'));
    }

    public function spaceByType(Request $request)
    {
        $bookings = SpaceBooking::where('customer_id', auth()->user()->id);

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
}
