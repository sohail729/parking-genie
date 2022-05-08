<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "hosting_plans";
    protected $guarded = ['id'];

    public $timestamps = false;

    public static function getPlanPriceId($prodId){
       return self::where('stripe_prod_id',$prodId)->pluck('stripe_price_id')->first();
    }

    // public static function image(){
    //    return self::select('image')->distinct()->get()->pluck('image');
    // }
}
