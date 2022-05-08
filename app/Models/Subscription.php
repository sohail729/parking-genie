<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Stripe\Stripe;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $stripe; 

    public function subscriber(){
        return $this->hasOne(Subscriber::class, 'stripe_cus_id', 'stripe_cus_id');
    }

    public function plan(){
        return $this->hasOne(Plan::class, 'stripe_prod_id', 'stripe_prod_id');
    }

    public function host(){
        return $this->hasOne(User::class, 'id', 'host_id');
    }
    
    public function getSubscriberInfoAttribute(){
        return $this->subscriber->user;
    }
    
    public function getInfoAttribute(){
        $this->stripe = Stripe::make(config('services.stripe.secret'));
        $info = $this->stripe->subscriptions()->find($this->stripe_cus_id, $this->stripe_subs_id);
        $info['invoice'] = $this->stripe->invoices()->find($info['latest_invoice']);
        return json_decode(json_encode($info));
    }
}
