<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionRule extends Model
{
    use HasFactory;


    public function profession_country(){
          return $this->belongsTo(ProfessionCountry::class);
    }

    public function credential(){
          return $this->belongsTo(CredentialClassification::class);
    }


}
