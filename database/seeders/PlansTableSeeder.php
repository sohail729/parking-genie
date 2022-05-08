<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'type' => 'free',
                'title' => 'Genie Host',
                'sub' => 'up to 2 spaces',
                'period' => null,
                'stripe_prod_id' => 'prod_LO1PpUHTJelg4o',
                'stripe_price_id' => 'price_1KhFMDFXS6lUqYoRXeZ9s6rY',
                'amount' => 0
            ],
            [
                'type' => 'super',
                'title' => 'Super Genie Host',
                'sub' => 'up to 4 spaces',
                'period' => 'monthly',
                'stripe_prod_id' => 'prod_LO1Q5TDNhngPAK',
                'stripe_price_id' => 'price_1KhFNHFXS6lUqYoRtdkDrEHU',
                'amount' => 3.99
            ],
            [
                'type' => 'super',
                'title' => 'Super Genie Host',
                'sub' => 'up to 4 spaces',
                'period' => 'yearly',
                'stripe_prod_id' => 'prod_LO1QnGdV0hb9d1',
                'stripe_price_id' => 'price_1KhFNeFXS6lUqYoRoVwtF5iE',
                'amount' => 29.99
            ],
            [
                'type' => 'commercial',
                'title' => 'Commercial Genie Host',
                'sub' => 'unlimited spaces',
                'period' => 'yearly',
                'stripe_prod_id' => 'prod_LO1RIGRAnNO0kY',
                'stripe_price_id' => 'price_1KhFOXFXS6lUqYoR1clyEOXf',
                'amount' => 69.99
            ]          
        ];

        foreach($plans as $plan) {
            Plan::create($plan);
          }
    }
}
