<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormField;
use App\Models\FieldType;
use App\Models\DropdownOption;
use Redirect;

class FormFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $formFields = FormField::with('fieldType')->get();
      return view('admin.formField.index', compact('formFields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fieldTypes = FieldType::all();
        return view('admin.formField.create', compact('fieldTypes'));
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
        $formField = new FormField;
        $formField->field_label = $request->field_label;
        $formField->type_id = $request->type_id;
        $formField->save();


        $optionVal = new DropdownOption;
        $optionVal->form_field_id = $formField->id;
        $optionVal->option_value = $request->optionsVal;
        $optionVal->save();


        return Redirect::route('formFields.index')->with(['success' => 'data saved successfully']);
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
        $formField = FormField::with('fieldType', 'fieldOption')->findorFail($id);
        $fieldTypes = FieldType::all();
        return view('admin.formField.edit', compact('fieldTypes', 'formField'));
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
        $formField = FormField::findorFail($id);
        $formField->field_label = $request->field_label;
        //$formField->type_id = $request->type_id;
        $formField->save();

        $optionVal = DropdownOption::where('form_field_id', $id)->first();
        $optionVal->option_value = $request->optionsVal;
        $optionVal->save();

        return Redirect::route('formFields.index')->with(['success' => 'Data Updated Successfully']);
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
