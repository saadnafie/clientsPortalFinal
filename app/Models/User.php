<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'user_details_id',
        'details',
        'name',
        'email',
        'avatar',
        'country_code',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'password',
    ];

    /**
     * 
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userPhoneVerified()
    {
      return ! is_null($this->phone_verified_at);
    }

    public function isAdmin()
    {
        if ($this->role_id == 1)
        {
            return true;
        }
        return false;
    }

    public function isCompany()
    {
        if ($this->role_id == 2)
        {
            return true;
        }
        return false;
    }

    public function isIndividual()
    {
        if ($this->role_id == 3)
        {
            return true;
        }
        return false;
    }

    public function isAgent()
    {
        if ($this->role_id == 4)
        {
            return true;
        }
        return false;
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id', 'id');
    }

    public function phoneVerifications()
    {
        return $this->hasMany(PhoneVerification::class, 'user_id', 'id');
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function activities()
    {
        return $this->hasMany('Spatie\Activitylog\Models\Activity', 'causer_id');
    }

}