<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    protected $fillable = [
        'id',
        'city_name'
    ];
    protected $table = 'cities';

    use HasFactory;
    public function fencing(){
        return $this->hasMany(Fencing::class);
    }
    public function pin(){
        return $this->hasMany(PinMap::class);
    }
}