<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;



class Application extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'process_id',
        'status_id',
        'profession_id', 
        'issueKey',
        'step_id',
        'country_id',
        'application_name',
    ];

    protected $appends = ['invoice_pdf','application_type', 'loa_pdf'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['status.application_status']);
        // Chain fluent methods for configuration options
    }

    public function getApplicationTypeAttribute()
    {
       if($this->type == 1)
          return "New Application";
       else
          return "Renew Application";
    }

    public function applicationDetails(){
          return $this->hasMany(ApplicationDetail::class);
    }

    public function profession()
    {
      return $this->belongsTo(Profession::class);
    }

    public function country()
    {
      return $this->belongsTo(Country::class);
    }

    public function status()
    {
      return $this->belongsTo(ApplicationStatus::class,'status_id');
    }

    public function processStatus()
    {
      return $this->belongsTo(ApplicationProcessStatus::class,'process_id');
    }

    public function credential()
    {
      return $this->belongsToMany(CredentialClassification::class, 'application_details', 'application_id', 'credential_id')->distinct();
    }

    public function invoice()
    {
      return $this->hasOne(Invoice::class);
    }

    public function applicationActivity()
    {
      return $this->morphMany('Spatie\Activitylog\Models\Activity','subject');
    }


    public function getInvoicePdfAttribute(){
      $path = '/attachments/applications/'.$this->application_serial.'/invoice.pdf';
      return url('/').$path;
    }

    public function getLoaPdfAttribute(){
      $pathLOA = '/attachments/applications/'.$this->application_serial.'/loa/LetterOfAuthorization.pdf';
      $fullPublicPath = public_path($pathLOA);
      if(File::exists($fullPublicPath) == 1){
        return url('/').$pathLOA;
      }else{
          return null;
      }
      
    }
}