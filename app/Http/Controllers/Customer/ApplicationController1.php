<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Traits\ApplicationFile;
use Barryvdh\DomPDF\Facade\Pdf;
use App;

use App\Models\Profession;
use App\Models\SubProfession;
use App\Models\Country;
use App\Models\CredentialFormField;
use App\Models\Application;
use App\Models\ApplicationDetail;
use App\Models\User;
use App\Models\Invoice;
use App\Models\ProfessionRule;
use App\Models\CredentialClassification;


class ApplicationController1 extends Controller
{
  use ApplicationFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function applicationType()
    {
      return view('customer.application.applicationType');
    }

    public function index()
    {
        $applications = Application::with('applicationDetails','status')->where('user_id',auth()->user()->id)->get();
        return view('customer.dashboard',compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $basic_credential_id = 1;
          $professions = Profession::all();
          $subProfessions = SubProfession::all();
          $countries = Country::all();
          $credentialFormFields = CredentialFormField::where('credential_id',$basic_credential_id)->with('credential', 'formField')->get();
          return view('customer.application.create', compact('professions', 'subProfessions', 'countries', 'credentialFormFields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $serial = date('YmdHis');
        $application = new Application();
        $application->user_id = auth()->user()->id;
        $application->profession_id = $request->profession;
        $application->application_serial = $serial;
        $application->type = $request->application_type;
        $application->status_id = 1;
        $application->save();
        $application->application_serial = "app".$application->id.$serial;
        $application->save();
        $this->saveDetails($request,$application->id,$application->application_serial);
        return Redirect::route('applicationCredential',['id'=>$application->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $application = Application::with('profession')->where('user_id',auth()->user()->id)->findOrFail($id);
        $credentials = CredentialClassification::whereHas('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->with('formFields', function ($query) {
            $query->where('type_id',8);
        })->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->get();
        //$credentials->load(['formFields'=> fn ($query) => $query->where('type_id',8)])->loadMissing('formFields.fieldType');
        //return $credentials;
        return view('customer.application.show',compact('application', 'credentials'));
    }

    public function applicationCredential($id)
    {
      $application = Application::with('applicationDetails')->where('user_id',auth()->user()->id)->findOrFail($id);
      $profession_rule = ProfessionRule::where('profession_id',$application->profession_id)->get();
      $credential_ids = $profession_rule->pluck('credential_id');
      $credentials = CredentialClassification::with('formFields')->whereIn('id',$credential_ids)->with('applicationDetail', function ($query) use($id) {
          $query->where('application_id',$id);
      })->with('rule', function ($query) use($application) {
          $query->where('profession_id',$application->profession_id);
      })->get();
      //return $credentials;
      $countries = Country::all();
      return view('customer.application.credential',compact('application', 'profession_rule', 'credentials', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function saveDetails($request,$application_id,$application_serial)
    {
      $credential_id = $request->credential_id;
      $files_data = $this->allFiles($request->files,$application_serial,$credential_id);
      $data = $this->requestFormat($request,$files_data);
      $details = new ApplicationDetail();
      $details->application_id = $application_id;
      $details->credential_id = $credential_id;
      $details->form_data = $data;
      $details->save();
    }

    public function checkout($id)
    {
        $application = Application::with('profession')->where('user_id',auth()->user()->id)->findOrFail($id);
        $credentials = CredentialClassification::whereHas('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->get();

        return view('customer.application.checkout',compact('application', 'credentials'));
    }


}
