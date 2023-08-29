<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'id',
        'state_name'
    ];
    protected $table = 'states';

    use HasFactory;
     public function fencing(){
        return $this->hasMany(Fencing::class);
    }
}