<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

use Illuminate\Support\Facades\DB;
use DataTables;

class AgentInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::with('status', 'applicationDetails', 'invoice')->where('status_id', 2)->get();
        //return $applications;
        return view('agent.invoice.index', compact('applications'));
    }


    public function invoiceListDataTable()
    {
       
           $data = Application::with('status', 'invoice');
           /* if($type != 0){
                $data = $data->where('type', $type);
            }
            if($dateRange != "null" ){
                $dateRange = explode('to',$dateRange);
                $data = $data->whereBetween(DB::raw('DATE(created_at)'), [trim($dateRange[0]), trim($dateRange[1])]);
                
            }   */
            $data = $data->where('status_id', 2)->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                                $btn = '<a href="'.$row->invoice_pdf.'" target="_blank"  class="menu-link px-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';

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
