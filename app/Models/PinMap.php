<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinMap extends Model
{
    protected $fillable = [
        'id',
        'pin',
        'country_id',
        'city_id',
        'place_name',
        'place_address'
    ];
    protected $table = 'pin_maps';

    use HasFactory;

     public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
}