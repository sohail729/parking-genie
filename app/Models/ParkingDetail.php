<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingDetail extends Model
{
    use HasFactory;

    protected $guarded = [
        'space_category', 'vehicle_category', 'images'
    ];

    public function spaceHost()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function spaceImages()
    {
        return $this->hasMany(ParkingImage::class, 'parking_id');
    }

    public function blockedDates()
    {
        return $this->hasMany(ParkingBlockDate::class, 'parking_id');
    }

    public function availableSlots()
    {
        return $this->hasMany(SpaceAvailabilty::class, 'parking_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'parking_categories', 'parking_id', 'category_id');
    }

    public function getBookedHoursAttribute()
    {
        return SpaceBooking::where('parking_id', $this->id)->pluck('hours')->toArray();
    }

    public function getSpaceTypeAttribute()
    {
        return $this->categories()->where('type', 'space')->first();
    }

    public function getVehicleTypeAttribute()
    {
        return $this->categories()->where('type', 'vehicle')->first();
    }


    public function getSpaceMainImageAttribute()
    {
        return $this->spaceImages()->first();
    }

    public static function boot() {
        parent::boot();    
        self::creating(function ($model) {    
            $model->host_id = auth()->id();    
        });    
    }
}
