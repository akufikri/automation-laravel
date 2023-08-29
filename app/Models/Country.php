<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'id',
        'country_name'
    ];
    protected $table = 'countries';
    use HasFactory;
     public function fencing(){
        return $this->hasMany(Fencing::class);
    }
    public function pin(){
        return $this->hasMany(PinMap::class);
    }
}