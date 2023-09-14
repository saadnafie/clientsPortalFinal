<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\Country;
use App\Models\ProfessionCountry;
use App\Models\PackageType;
use App\Models\CredentialClassification;
use App\Models\ProfessionRule;
use Redirect;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $professions = Profession::withTrashed()->get();
          return view('admin.profession.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('admin.profession.create');
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
            $profession = new Profession;
            $profession->profession = $request->profession;
            $profession->save();
            $countries = Country::all();
            $packages = PackageType::all();
            $credentialClassifications = CredentialClassification::where('id','!=', 1)->get();

            foreach($countries as $country)
            {
                foreach($packages as $package)
                {
                    $professionCountry = new ProfessionCountry;
                    $professionCountry->profession_id = $profession->id;
                    $professionCountry->country_id  = $country->id;
                    $professionCountry->package_type_id  = $package->id ;
                    $professionCountry->base_cost = $package->package_price;
                    $professionCountry->save();

                    if($package->id == 1){
                        foreach($credentialClassifications as $credentialClassification){
                            $professionRule = new ProfessionRule;
                            $professionRule->profession_country_id = $professionCountry->id;
                            $professionRule->credential_id = $credentialClassification->id;
                            $professionRule->certificates_number = ($credentialClassification->id == 5) ? 0 : 1;
                            $professionRule->save();
                        }
                    }
                }
            }


            // redirect
            //Session::flash('message', 'Successfully created profession!');
            return Redirect::route('professions.index')->with(['success' => 'data saved successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professionCountries = ProfessionCountry::with('professionRule','profession', 'country')->where('profession_id', $id)->get();
        $professionCountries->load('professionRule.credential');
        $profession = Profession::findorFail($id);
        $countries = Country::all();

        //return $professionCountries;
        return view('admin.profession.show', compact('professionCountries', 'profession', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $profession = Profession::findorFail($id);
          return view('admin.profession.edit', compact('profession'));
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
       $profession = Profession::findorFail($id);
       $profession->profession = $request->profession;
       $profession->save();
       return Redirect::route('professions.index')->with(['success' => 'data updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Profession::findorFail($id)->update(['activation'=>0]);
        Profession::findorFail($id)->delete();
        return Redirect::back()->with(['success' => 'data deleted successfully']);
    }

    public function professionRestore($id)
    {
        Profession::withTrashed()->find($id)->restore();
        Profession::findorFail($id)->update(['activation'=>1]);
        return Redirect::back()->with(['success' => 'data restored successfully']);
    }  

    function professionActivation($id, $status)
    {
        Profession::findorFail($id)->update(['activation'=>$status]);
        return Redirect::back()->with(['success' => 'data updated successfully']);
    }



}
