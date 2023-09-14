<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CredentialFormFieldRule extends Model
{
    use HasFactory;

    public function rule()
    {
      return $this->belongsTo(FieldRule::class);
    }

    public function credentialFormField()
    {
      return $this->belongsTo(CredentialFormField::class);
    }
}
