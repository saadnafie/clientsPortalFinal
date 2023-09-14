<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialFormField extends Model
{
    use HasFactory;


    public function getMandatoryValueAttribute($value)
    {
        $value = "Required";
        if($this->mandatory == 0)
        {
            $value = "Not Required";
        }
        return $value;
    }

    public function formField()
    {
          return $this->belongsTo(FormField::class)->with('fieldType','fieldOption');
    }

    public function credential()
    {
          return $this->belongsTo(CredentialClassification::class);
    }
}
