<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SpaceBookingDetail extends Model
{
    protected $guarded = [];
    
    public function space_booking()
    {
        return $this->belongsTo(SpaceBooking::class);
    }
}
