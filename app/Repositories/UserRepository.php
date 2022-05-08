<?php

namespace App\Repositories;

use App\Models\User;
use App\Contracts\UserContract;
use App\Models\Subscription;
use Carbon\Carbon;

class UserRepository implements UserContract
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }  

    public function userSignup($data)
    { 
        $response = $this->model->create($data);
        $response->assignRole($response->type);
        if(!empty($data['plan']) && (!empty($data['ptype']) && $data['ptype'] != 'free')){
            $response->subscriber()->create([
                'stripe_cus_id' => $data['stripe_cus_id'],
                'card_last_four' => substr($data['card_last_four'], -4)                
            ]);
        }
        return $response->id;
    }

    public function createSubscription($data, $userId, $invoice) : bool
    { 
       $subscriptions = Subscription::create([
            'host_id' => $userId,
            'stripe_cus_id' => $data['customer'],
            'stripe_prod_id' => $data['plan']['product'],
            'stripe_subs_id' => $data['id'],
            'status' => 'subscribed',
            'next_billing' => Carbon::parse($data['current_period_end'])->format('Y-m-d H:i:s'),
            'receipt' => $invoice['hosted_invoice_url']
       ]);
       return  $subscriptions->id;
    }
    
    public function getSingle($userId)
    { 
        $response = $this->model->find($userId);
        return $response;
    }

    public function update($data, $userId)
    { 
        $response = $this->model->find($userId)->update($data);
        return $response;
    }

    public function destroy($userId) : bool
    { 
        $response = $this->model->find($userId)->delete();
        return $response;
    }
}
