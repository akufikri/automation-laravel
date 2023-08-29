<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fencing extends Model
{
    protected $fillable = [
        'id',
        'geofencing',
        'country_id',
        'city_id',
        'state_id',
        'status'
    ];
    protected $table = 'fencing';

    use HasFactory;

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }
    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }
    
}