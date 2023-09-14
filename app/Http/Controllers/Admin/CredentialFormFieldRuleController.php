<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormField;
use App\Models\CredentialFormField;
use App\Models\FieldRule;
use App\Models\CredentialFormFieldRule;
use Redirect;

class CredentialFormFieldRuleController extends Controller
{
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
        //
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
        $credentialFormFieldRule = new CredentialFormFieldRule;
        $credentialFormFieldRule->credential_form_field_id = $request->credential_formField_ID;
        $credentialFormFieldRule->rule_id = $request->rule_id;
        $credentialFormFieldRule->rule_value = html_entity_decode($request->rule_value);
        $credentialFormFieldRule->rule_message = $request->rule_message;
        $credentialFormFieldRule->save();
        // redirect
        //Session::flash('message', 'Successfully created profession!');
        return Redirect::back()->with(['success' => 'data saved successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            $credentialFormField = CredentialFormField::with('formField')->findorFail($id);
            $fieldsRules = CredentialFormFieldRule::with('rule')->where('credential_form_field_id', $id)->get();
            //$fieldsRules->load('credentialFormField.formField');
            //return $fieldsRules;
            $currentRulesID = $fieldsRules->pluck('rule_id');
            $rulesList = FieldRule::whereNotIn('id', $currentRulesID)->get();
            //$credentialFormFieldID = $id;
            return view('admin.credential.field-rule', compact('fieldsRules', 'rulesList', 'credentialFormField'));
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
}
