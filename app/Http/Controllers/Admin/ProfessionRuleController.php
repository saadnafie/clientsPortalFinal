<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CredentialClassification;
use App\Models\Profession;
use App\Models\ProfessionRule;
use App\Models\Country;
use Redirect;

class ProfessionRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $professionRules = ProfessionRule::with('profession_country', 'credential')->get();
          $professionRules->load('profession_country.profession', 'profession_country.country');
          //return $professionRules;
          return view('admin.professionRule.index', compact('professionRules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $professions = Profession::all();
        $credentials = CredentialClassification::all();
        $countries = Country::all();
        return view('admin.professionRule.create', compact('professions', 'credentials', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $profession_country = ProfessionCountry::where('profession_id', $request->profession_id)->where('country_id', $request->country_id)->first();
      $professionRule = new ProfessionRule;
      $professionRule->profession_country_id = $profession_country->id;
      $professionRule->credential_id = $request->credential;
      $professionRule->certificates_number = $request->certificates_number;
      $professionRule->save();
      // redirect
      //Session::flash('message', 'Successfully created profession!');
      return Redirect::route('professionRules.index');
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
      $professions = Profession::all();
      $credentials = CredentialClassification::all();
      $countries = Country::all();
      $professionRule = ProfessionRule::find($id);
      return view('admin.professionRule.edit', compact('professions', 'credentials', 'professionRule', 'countries'));
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
      $profession_country = ProfessionCountry::where('profession_id', $request->profession_id)->where('country_id', $request->country_id)->first();
      $professionRule = ProfessionRule::find($id);
      $professionRule->profession_country_id = $profession_country->id;
      $professionRule->credential_id = $request->credential;
      $professionRule->certificates_number = $request->certificates_number;
      $professionRule->save();
      return Redirect::route('professionRules.index');
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
