<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\CredentialClassification;
use App\Models\FormField;
use App\Models\CredentialFormField;
use App\Models\FieldRule;
use App\Models\CredentialFormFieldRule;
use Redirect;

class CredentialClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $application = Application::where('status_id', 1)->get();
          $currentOpenApplicationsCount = $application->count();  
          $credentials = CredentialClassification::withTrashed()->get();
          return view('admin.credential.index', compact('credentials', 'currentOpenApplicationsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('admin.credential.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          // store
          $credential = new CredentialClassification;
          $credential->credential_type = $request->credential;
          $credential->credential_cost = $request->credential_cost;
          $credential->save();
          // redirect
          //Session::flash('message', 'Successfully created profession!');
          return Redirect::route('credentials.index')->with(['success' => 'data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $credential = CredentialClassification::findorFail($id);
       $form_field_ids = CredentialFormField::where('credential_id',$id)->pluck('form_field_id');
       $formFields = FormField::whereNotIn('id',$form_field_ids)->get();
       $credentialFormFields = CredentialFormField::with('credential', 'formField')->where('credential_id', $id)->get();
       return view('admin.credential.show', compact('credential', 'formFields', 'credentialFormFields'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $credential = CredentialClassification::findorFail($id);
          return view('admin.credential.edit', compact('credential'));
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
          $credential = CredentialClassification::find($id);
          $credential->credential_type = $request->credential;
          $credential->credential_cost = $request->credential_cost;
          $credential->save();
          return Redirect::route('credentials.index')->with(['success' => 'data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      CredentialClassification::findorFail($id)->update(['activation'=>0]);
      CredentialClassification::findorFail($id)->delete();
      return Redirect::back()->with(['success' => 'data deleted successfully']);
    }


    public function credentialRestore($id)
    {
      CredentialClassification::withTrashed()->find($id)->restore();
      CredentialClassification::findorFail($id)->update(['activation'=>1]);
        return Redirect::back()->with(['success' => 'data restored successfully']);
    }  

    function credentialActivation($id, $status)
    {
        CredentialClassification::findorFail($id)->update(['activation'=>$status]);
        return Redirect::back()->with(['success' => 'data updated successfully']);
    }

}
