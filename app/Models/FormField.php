<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $appends = ['lable_name'];

    public function fieldType(){
          return $this->belongsTo(FieldType::class, 'type_id');
    }

    public function fieldOption(){
          return $this->hasOne(DropdownOption::class,'form_field_id');
    }

    public function fieldRule()
    {
      return $this->hasManyThrough(CredentialFormFieldRule::class, CredentialFormField::class,'form_field_id','credential_form_field_id','id','id')->with('rule');
    }


    public function formFieldsRules()
    {
      return $this->hasManyThrough(CredentialFormFieldRule::class, CredentialFormField::class,'credential_id' ,'rule_id','id','id');
    }

    public function getLableNameAttribute()
    {
      return str_replace(" ","_",$this->field_label);
    }
}
