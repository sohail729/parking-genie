<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SpaceBooking extends Model
{

    protected $guarded = [];

    public function detail()
    {
        return $this->hasOne(SpaceBookingDetail::class, 'booking_id');
    }

    public function space()
    {
        return $this->belongsTo(ParkingDetail::class, 'parking_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function blockDate()
    {
        return $this->hasOne(ParkingBlockDate::class, 'parking_id', 'parking_id');
    }

}
