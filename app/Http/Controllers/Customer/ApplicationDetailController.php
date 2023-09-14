<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApplicationFile;

use App\Models\Profession;
use App\Models\SubProfession;
use App\Models\Country;
use App\Models\CredentialFormField;
use App\Models\Application;
use App\Models\ApplicationDetail;
use App\Models\FormField;

class ApplicationDetailController extends Controller
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
        //return $request;
        if($request->credential_id == 1){
          Application::find($request->application_id)->update(['profession_id',$request->profession]);
        }
        $application = Application::find($request->application_id);
        $credential_id = $request->credential_id;
        $files_data = $this->allFiles($request->files, $application->application_serial, $credential_id);
        $data = $this->requestFormat($request, $files_data);
        $details = new ApplicationDetail();
        $details->application_id = $application->id;
        $details->credential_id = $credential_id;
        $details->form_data = $data;
        $details->save();

        return redirect()->route('applicationCredential',['id'=>$application->id]);
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
        $professions = Profession::all();
        $subProfessions = SubProfession::all();
        $countries = Country::all();
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
        //
    }

    public function appBasic($id)
    {
      $application_id = $id;
      $application = Application::findOrFail($id);
      $basic_credential_id = 1;
      $professions = Profession::all();
      $subProfessions = SubProfession::all();
      $countries = Country::all();
      $credentialFormFields = CredentialFormField::where('credential_id',$basic_credential_id)->with('credential', 'formField')->get();
      return view('customer.application.credential.create_basic', compact('application_id','professions', 'subProfessions', 'countries', 'credentialFormFields'));
    }
}
