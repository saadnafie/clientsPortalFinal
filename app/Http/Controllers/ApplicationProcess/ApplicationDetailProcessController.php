<?php

namespace App\Http\Controllers\ApplicationProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApplicationFile;


use App\Models\Profession;
use App\Models\SubProfession;
use App\Models\Country;
use App\Models\ProfessionCountry;
use App\Models\CredentialFormField;
use App\Models\Application;
use App\Models\ApplicationDetail;
use App\Models\FormField;

class ApplicationDetailProcessController extends Controller
{
  use ApplicationFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $applicationLog = Application::find($request->application_id);
        $applicationLog->disableLogging();
        if($request->credential_id == 1 && $request->detail_id == 0){
          $applicationName = $request->First_Name.' '.$request->Last_Name.' - (PNN. '. $request->Passport_Number.')';
          $applicationLog->update(['application_name'=>$applicationName, 'profession_id'=>$request->profession_id, 'country_id'=>$request->country_id,'step_id'=> 2]);
        }elseif($request->credential_id == 1){
          $applicationName = $request->First_Name.' '.$request->Last_Name.' - (PNN. '. $request->Passport_Number.')';
          $applicationLog->update(['application_name'=>$applicationName]);
        }

        $application = Application::find($request->application_id);
        $credential_id = $request->credential_id;
        $detail_id = $request->detail_id;
        $this->unsetData($request);
        $data = $request->all();

        $details = ApplicationDetail::firstOrCreate(['id' => $detail_id],
                ['application_id'=> $application->id , 'credential_id' => $credential_id , 'form_data' =>$data ]);
        $details->form_data = $data;
        $details->save();

        return response()->json(['detail_id' => $details->id ,'message' => 'success', 'code' => '200']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application_detail = ApplicationDetail::findOrFail($id);
        $basic_credential_id = 1;
        $professions = Profession::where('activation', 1)->get();
        $subProfessions = SubProfession::all();
        $countries = Country::where('activation', 1)->get();
        $credentialFormFields = CredentialFormField::where('credential_id',$basic_credential_id)->with('credential', 'formField')->get();
        return view('customer.application.credential.edit',compact('application_detail','professions','subProfessions','countries','credentialFormFields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $application_detail = ApplicationDetail::with('credential','application')->findOrFail($id);
      $credential_fields = CredentialFormField::where('credential_id',$request->credential_id)->get()->pluck('form_field_id');
      $file_fields = FormField::where('type_id', 8)->whereIn('id',$credential_fields)->get();
      $files_data = $this->checkFiles($request,$file_fields,$application_detail);
      $data = $this->requestFormat($request,$files_data);
      $application_detail->form_data = $data;
      $application_detail->save();
      return redirect()->route('applicationCredential',['id'=>$application_detail->application_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ApplicationDetail::findOrFail($id)->delete();
        return response()->json(['message' => 'delete success', 'code' => '200']);
    }

    public function deleteCredential(Request $request)
    {
        return "fff";
        //ApplicationDetail::find($id)->delete();
        //return response()->json(['data' => $data ,'message' => 'success', 'code' => '200']);
    }

    public function appBasic($id)
    {
      $application_id = $id;
      $application = Application::findOrFail($id);
      $basic_credential_id = 1;
      $professions = Profession::where('activation', 1)->get();
      $subProfessions = SubProfession::all();
      $countries = Country::where('activation', 1)->get();
      $credentialFormFields = CredentialFormField::where('credential_id',$basic_credential_id)->with('credential', 'formField')->get();
      return view('customer.application.credential.create_basic', compact('application_id','professions', 'subProfessions', 'countries', 'credentialFormFields'));
    }

    public function saveDocument(Request $request)
    {
      $detail = ApplicationDetail::find($request->app_id);
      $application = Application::find($detail->application_id);
      $condition = 1;
      if($detail->file_data == null)
        $condition = 0;
      $files_data = $this->allFiles($request->files, $application->application_serial, $detail->credential_id);
      $this->unsetData($request);
      unset($request['app_id']);
      $data = $files_data['data'];
      $detail->update(['file_data' => $data]);
      return response()->json(['condition' => $condition ,'data' => $data ,'message' => 'success', 'code' => '200']);
    }

}
