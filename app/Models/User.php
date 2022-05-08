<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'password_confirmation'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){

        $this->attributes['password'] = bcrypt($value);
    }

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    public function subscriber(){
        return $this->hasOne(Subscriber::class, 'user_id');
    }

    public function subscription(){
        return $this->hasOne(Subscription::class, 'host_id');
    }

    public function space_bookings_user(){
        return $this->hasMany(SpaceBooking::class, 'customer_id');
    }

    public function space_bookings_host(){
        return $this->hasMany(SpaceBooking::class, 'host_id');
    }

    public function space_parkings(){
        return $this->hasMany(ParkingDetail::class, 'host_id');
    }

    public static function hostsCount()
    {
        return static::where('type', 'host')->count();
    }

    public static function usersCount()
    {
        return static::where('type', 'user')->count();
    }

    // public function getUserSpacesBy()
    // {
    //     return $this->space_bookings_user()->where();
    // }
}
