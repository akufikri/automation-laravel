<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    protected $fillable = [
        'driver_name', 'license_plate', 'status'
    ];
    protected $table = 'taxis';
    use HasFactory;

    public function riders(){
        return $this->hasMany(Riders::class); 
    }
        public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}