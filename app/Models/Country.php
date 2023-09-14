<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    use HasFactory;


    protected $fillable = [
        'activation',
    ];

    protected $casts = [
        'activation' => 'boolean',
    ];

    protected $appends = ['activation_status'];

    public function getActivationStatusAttribute(){
        if($this->activation)
            return 'Active';
        else
            return 'Not Active';
    }

}
