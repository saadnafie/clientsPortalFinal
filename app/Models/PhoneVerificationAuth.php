<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVerificationAuth extends Model
{
    use HasFactory;
    protected $table = 'phone_verification_auths';
    protected $fillable = [
        'user_ip',
        'type',
        'code',
    ];
}