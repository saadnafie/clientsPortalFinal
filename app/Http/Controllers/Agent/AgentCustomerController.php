<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;

use Illuminate\Support\Facades\DB;
use DataTables;

class AgentCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('agent.user.index');
    }

    public function userListDataTable()
    {
           $data = User::whereIn('role_id', [2, 3])->with('userRole');

           /* if($type != 0){
                $data = $data->where('role_id', $type);
            }
            if($dateRange != "null" ){
                $dateRange = explode('to',$dateRange);
                $data = $data->whereBetween(DB::raw('DATE(created_at)'), [trim($dateRange[0]), trim($dateRange[1])]);
                
            }   */
            $data = $data->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                                $btn = '<a href="'.route('user-list.show',['user_list' => $row->id]).'" ><i class="fa fa-eye text-purple" style="font-size:1.3rem !important;" aria-hidden="true"></i></a>';
                            return $btn;
                    })
                    ->addColumn('date', function($row){
                        $date = Date($row->created_at);
                        return $date;
                      })
                    ->rawColumns(['action', 'date'])
                    ->make(true);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $userApplications = Application::where('user_id', $id)->get();
         return view('agent.user.show', compact('userApplications'));
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
