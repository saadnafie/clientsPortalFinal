<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDetail extends Model
{
    use HasFactory;

    protected $casts = [
        'form_data' => 'array',
        'file_data' => 'array'
    ];

    protected $fillable = [
        'id',
        'application_id',
        'credential_id',
        'form_data',
        'file_data'
    ];

    protected $appends = ['file_path'];

    public function credential()
    {
          return $this->belongsTo(CredentialClassification::class)->with('formFields');
    }

    public function application()
    {
          return $this->belongsTo(Application::class);
    }

    public function getFilePathAttribute()
    {
      return "attachments/applications/".$this->application->application_serial."/".$this->credential->credential_type.'/';
    }
}
