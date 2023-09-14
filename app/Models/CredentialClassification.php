<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CredentialClassification extends Model
{
    use HasFactory;
    use SoftDeletes;

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


    public function formFields()
    {
      return $this->belongsToMany(FormField::class, 'credential_form_fields','credential_id','form_field_id')->with('fieldType','fieldRule');
    }

    public function applicationDetail()
    {
      return $this->hasMany(ApplicationDetail::class, 'credential_id');
    }

    public function rule()
    {
      return $this->hasOne(ProfessionRule::class,'credential_id');
    }

}
