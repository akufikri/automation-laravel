<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'taxi_id','amount', 'payment_methode', 'transaction_time'
    ];
    protected $table = 'transactions';
    use HasFactory;

    public function taxi()
    {
        return $this->belongsTo(Taxi::class, 'taxi_id');
    }

}