<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLogin extends Model
{

    protected $fillable = [
        'name',
        'email',
        'role'
    ];

    protected $table = 'history_logins';

    use HasFactory;
    
}