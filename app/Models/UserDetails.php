<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $table = 'user_details';
    protected $fillable = [
        'user_id',
        'First_Name',
        'Middle_Name',
        'Last_Name',
        'Passport',
        'DateOfBirth',
        'Residency'
    ];

}