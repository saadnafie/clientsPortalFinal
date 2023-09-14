<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionCountry extends Model
{
    use HasFactory;

    public function profession()
    {
      return $this->belongsTo(Profession::class);
    }

    public function country()
    {
      return $this->belongsTo(Country::class);
    }

    public function professionRule()
    {
      return $this->hasMany(ProfessionRule::class);
    }
}
