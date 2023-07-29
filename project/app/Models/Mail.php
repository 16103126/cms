<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $fillable =[
        'driver', 'host', 'port', 'user_name', 'password', 'encryption', 'from_email', 'from_email'
    ];
}
