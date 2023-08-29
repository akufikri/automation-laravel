<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riders extends Model
{
    protected $fillable = [
         'user_id', 'taxi_id', 'start_location','end_location', 'status', 'start_time', 'end_time'
    ];
    protected $table = 'riders';

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function taxi(){
        return $this->belongsTo(Taxi::class, 'taxi_id');
    }

    
    use HasFactory;
}