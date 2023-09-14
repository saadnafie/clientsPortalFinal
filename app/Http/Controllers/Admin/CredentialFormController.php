<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CredentialClassification;
use App\Models\FormField;
use App\Models\CredentialFormField;
use Redirect;

class CredentialFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $credentialFormFields = CredentialFormField::with('credential', 'formField')->get();
      //return $credentialFormFields;
      return view('admin.credentialForm.index', compact('credentialFormFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $credentials = CredentialClassification::all();
      $formFields = FormField::all();
      return view('admin.credentialForm.create', compact('credentials', 'formFields'));
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
      $credentialFormField = new CredentialFormField;
      $credentialFormField->credential_id = $request->credential_id;
      $credentialFormField->form_field_id = $request->field_id;
      $credentialFormField->mandatory = 1;
      $credentialFormField->order_number = $request->field_order;
      $credentialFormField->save();
      // redirect
      //Session::flash('message', 'Successfully created profession!');
      //return Redirect::route('credentialFormFields.index');
      return redirect()->back()->with(['success' => 'data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
      $credentialFormField = CredentialFormField::findorFail($id);
      $credentialFormField->mandatory = 1;
      $credentialFormField->order_number = $request->field_order;
      $credentialFormField->save();
      return redirect()->back()->with(['success' => 'data saved successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      CredentialFormField::findorFail($id)->delete();
      return redirect()->back()->with(['success' => 'data deleted successfully']);
    }
}
