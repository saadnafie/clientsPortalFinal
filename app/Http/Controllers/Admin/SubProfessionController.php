<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\SubProfession;
use Redirect;

class SubProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subprofessions = SubProfession::with('profession')->get();
        return view('admin.subprofession.index', compact('subprofessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $professions = Profession::all();
          return view('admin.subprofession.create', compact('professions'));
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
          $subprofession = new SubProfession;
          $subprofession->profession_id = $request->profession;
          $subprofession->sub_profession = $request->subprofession;
          $subprofession->save();
          // redirect
          //Session::flash('message', 'Successfully created profession!');
          return Redirect::route('subprofessions.index');
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
          $subprofession = SubProfession::find($id);
          return view('admin.subprofession.edit', compact('professions', 'subprofession'));
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
          $subprofession = SubProfession::find($id);
          $subprofession->profession_id = $request->profession;
          $subprofession->sub_profession = $request->subprofession;
          $subprofession->save();
          return Redirect::route('subprofessions.index');
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
