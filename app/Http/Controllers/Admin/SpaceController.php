<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Models\ParkingDetail;
use App\Models\SpaceBooking;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class SpaceController extends Controller
{
    // public function __construct(
    //     UserContract $userRepository) {
    //     $this->userRepository       =   $userRepository;
    // }

    public function index()
    {
        $spaces = ParkingDetail::all();
        return view('admin.space.index', compact('spaces'));
    }
    public function show(ParkingDetail $space)
    {
        return view('admin.space.show', compact('space'));
    }

    public function spaceBookings()
    {
        $bookings = SpaceBooking::query();

        $bookings =$bookings->whereRelation('space', 'price_type', '=' ,'hourly')->get();
        $html = view('common.space.hourly', compact('bookings'))->render();

        return view('admin.booking.index', compact('html', 'bookings'));
    }

    public function spaceByType(Request $request)
    {
        $bookings = SpaceBooking::query();

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
