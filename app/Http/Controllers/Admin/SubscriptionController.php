<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\PlanContract;
use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct() {
        $this->stripe = Stripe::make(config('services.stripe.secret'));
    }

    public function index()
    {
        $subscriptions = Subscription::all();
        return view('admin.subscription.index', compact('subscriptions'));
    }  

    public function show(Subscription $subscription)
    {
        return  view('admin.subscription.modal.view', compact('subscription'))->render();
    }  
}
