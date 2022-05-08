<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpaceBooking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $hostsCount = User::hostsCount();
        $usersCount = User::usersCount();

        $bookings = SpaceBooking::all();
        $total_bookings = $bookings->count();
        $total_transaction = $bookings->pluck('amount')->toArray();
        $total_transaction = array_sum($total_transaction);
        
        return view('dashboard.index', compact('hostsCount','usersCount','total_bookings', 'total_transaction') );
    }
}
