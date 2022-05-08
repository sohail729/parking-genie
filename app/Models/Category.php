<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeVehicles(){
        return static::where('type', 'vehicle')->get();
    }

    public function scopeSpace(){
        return static::where('type', 'space')->get();
    }
}
