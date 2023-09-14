<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropdownOption extends Model
{
    use HasFactory;

    protected $casts = [
        'option_value' => 'array',
    ];

    public function formField(){
          return $this->belongsTo(FormField::class);
    }
}
