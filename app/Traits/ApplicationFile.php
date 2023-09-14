<?php

namespace App\Traits;

use Illuminate\Http\Request;

use App\Models\CredentialClassification;

trait ApplicationFile {

  public function unsetData($request)
  {
    unset($request['_token']);
    unset($request['_method']);
    unset($request['application_type']);
    unset($request['profession_id']);
    unset($request['country_id']);
    unset($request['credential_id']);
    unset($request['application_id']);
    unset($request['detail_id']);
  }

  public function allFiles($files,$application_serial,$credential_id)
  {
      $file_data = null;
      $keys = [];
      $count = 0;
      foreach ($files as $key => $file) {
        $count++;
        $file_name = "file".$count."_".$credential_id.date('YmdHis').".".$file->getClientOriginalExtension();
        $this->saveFile($file,$file_name,$application_serial,$credential_id);
        $file_data['data'][$key] = $file_name;
        array_push($keys,$key);
      }
      $file_data['key'] = $keys;
      return $file_data;
  }

  public function checkFiles($request,$form_fields,$application_detail)
  {
    $file_data = null;
    $keys = [];
    foreach ($form_fields as $key => $form_field) {
      $field = str_replace(" ", "_",$form_field->field_label);
      $file_name = $application_detail->form_data[$field];
      if($request[$field] != null){
        $this->saveFile($request[$field],$file_name,$application_detail->application->application_serial,$request->credential_id);
      }
      $file_data['data'][$field] = $file_name;
      array_push($keys,$field);
    }
    $file_data['key'] = $keys;
    return $file_data;
  }

  public function saveFile($file,$file_name,$application_serial,$credential_id){
    $credential = CredentialClassification::find($credential_id);
    $path = public_path('attachments/applications')."/".$application_serial."/".$credential->credential_type;
    $file->move($path, $file_name);
  }

  public function requestFormat($request,$files_data)
  {
    $this->unsetData($request);
    $data = $request->except($files_data['key']);
    $data = array_merge($data,$files_data['data']);
    return $data;
  }
}
