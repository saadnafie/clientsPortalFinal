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
use App\Models\ApplicationLicense;

use DataTables;
use Spatie\Activitylog\Models\Activity;


class ApplicationController extends Controller
{
  use ApplicationFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function applicationType()
    {
      return view('customer.application.applicationType');
    }*/

    public function index()
    {
      /*$applications = Application::with('applicationDetails','status')->where('user_id',auth()->user()->id)->get();       
      return view('customer.dashboard',compact('applications'));*/
        $applications = Application::with('status', 'applicationDetails')->where('user_id',auth()->user()->id)->get();
        return view('customer.dashboard',compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //$user = User::find(auth()->user()->id);         
          //return view('customer.application.create',compact('user'));
          return view('customer.application.create');
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
      $application->profession_id = 1;
      $application->application_serial = $serial;
      $application->type = $request->application_type;
      $application->status_id = 1;
      $application->save();
      $application->application_serial = "app".$application->id.$serial;
      $application->save();
      if($request->application_type == 2){
        $license = new ApplicationLicense();
        $license->application_id = $application->id;
        $license->license_number = $request->license_no;
        $license->issue_date = $request->issue_date;
        $license->expiry_date = $request->expiry_date;
        $license->save();
      }
      return redirect()->route('app-basic',['id'=>$application->id]);
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

    public function show_all()
    {
        $applications = Application::with('status', 'applicationDetails')->where('user_id',auth()->user()->id)->get();
        return view('customer.show_all', compact('applications'));
    }

    public function search()
    {
      return view('customer.search');
    }

    public function invoices()
    {
      $applications = Application::with('status', 'applicationDetails', 'invoice')->where('user_id',auth()->user()->id)->where('status_id', 2)->get();
      //return $applications;
      return view('customer.invoices', compact('applications'));
    }

    public function invoiceDataTable($type, $dateRange)
    {
       
           $data = Application::with('status', 'invoice');
            if($type != 0){
                $data = $data->where('type', $type);
            }
            if($dateRange != "null" ){
                $dateRange = explode('to',$dateRange);
                $data = $data->whereBetween(DB::raw('DATE(created_at)'), [trim($dateRange[0]), trim($dateRange[1])]);
                
            }   
            $data = $data->where('user_id', auth()->user()->id)->where('status_id', 2)->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                                $btn = '<a href="'.$row->invoice_pdf.'" target="_blank"  class="menu-link px-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);


    }




    public function verification_history()
    {
      /*$data = Application::all();
      return Activity::with('subject')->Where(function($query) use ($data) {
        $query->where('subject_type', (new Application())->getMorphClass())
                ->whereIn('subject_id', $data->pluck('id'));
    })->get();*/
    /*$appList = Application::where('user_id', auth()->user()->id)->get();
    return $data =  Activity::with('subject')->Where(function($query) use ($appList) {
      $query->where('subject_type', (new Application())->getMorphClass())
         ->whereIn('subject_id', $appList->pluck('id'));
        })->get();
    $data =  Activity::with('subject')->where('event','deleted')->where('causer_id', auth()->user()->id)->where(function($query) {
             $query->where('subject_type', (new Application())->getMorphClass());
    })->get();
*/

/*$appList = Application::where('user_id', auth()->user()->id)->get();
          $data = Activity::with('subject')->Where(function($query) use ($appList) {
            $query->where('subject_type', (new Application())->getMorphClass())
                    ->whereIn('subject_id', $appList->pluck('id'));
        })->withProperties(['status.application_status'=> 1])->get();
        $data->load('subject.status');

        return $data;*/
 

      $applications = Application::where('user_id',auth()->user()->id)->with('applicationActivity')->get();
      //return $applications;
      return view('customer.verification_history', compact('applications'));
    }

    public function verifyHistoryDataTable()
    {

          $appList = Application::where('user_id', auth()->user()->id)->get();
          $data = Activity::with('subject')->Where(function($query) use ($appList) {
            $query->where('subject_type', (new Application())->getMorphClass())
                    ->whereIn('subject_id', $appList->pluck('id'));
        })->get();
        $data->load('subject.status');
    
        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function($row){
                      $btn = '<a href="'.$row->id.'" target="_blank"  class="menu-link px-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                      return $btn;
              })
              ->addColumn('eventDesc', function($row){
                if($row->event == 'created')
                  $eventDesc = 'Your Application Created Successfully';
                elseif($row->event == 'updated')
                  $eventDesc = 'Your Application Updated Successfully';
                  elseif($row->event == 'deleted')
                  $eventDesc = 'Your Application Deleted Successfully';

                return $eventDesc;
              })
              ->addColumn('date', function($row){
                $date = Date($row->created_at);
                return $date;
              })
              ->rawColumns(['eventDesc', 'date', 'action'])
              ->make(true);


            
          /*  $data =  Activity::where('causer_id', auth()->user()->id)->where(function($query) {
                     $query->where('subject_type', (new Application())->getMorphClass());
            })->get();


              
              $appList = Application::where('user_id', auth()->user()->id)->get();
              $data =  Activity::with('subject')->Where(function($query) use ($appList) {
                     $query->where('subject_type', (new Application())->getMorphClass())
                        ->whereIn('subject_id', $appList->pluck('id'));
            })->get();
            $data = $data->where('user_id', auth()->user()->id)->get();

            return $data;/*/
              
            //$data->load('subject.status');
           /*$data = Application::with('status', 'applicationActivity');
           if($status != 0){
            $data = $data->where('status_id', $status);
            }
            if($type != 0){
                $data = $data->where('type', $type);
            }
            if($dateRange != "null" ){
                $dateRange = explode('to',$dateRange);
                $data = $data->whereBetween(DB::raw('DATE(created_at)'), [trim($dateRange[0]), trim($dateRange[1])]);
                
            }  
            */ 

            /*return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            $btn = '<a href="'.$row->id.'" target="_blank"  class="menu-link px-3"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                            return $btn;
                    })
                    ->addColumn('appName', function($row){
                      $appName = ($row->event == 'deleted') ? $row->properties['old']['application_name'] : $row->properties['attributes']['application_name'];
                      $appName = ($appName == null) ? '___' : $appName ;
                      return $appName;
                    })
                    ->addColumn('appSerial', function($row){
                      $appSerial = ($row->event == 'deleted') ? $row->properties['old']['application_serial'] : $row->properties['attributes']['application_serial'];
                      return $appSerial;
                    })
                    ->addColumn('appType', function($row){
                      $typeApp = ($row->event == 'deleted') ? $row->properties['old']['type'] : $row->properties['attributes']['type'];
                      if($typeApp == 1)
                        $appType = 'New Application';
                      else
                        $appType = 'Renew Application';

                        return $appType;
                    })
                    ->addColumn('date', function($row){
                      $date = Date($row->created_at);
                      return $date;
                    })
                    ->addColumn('properties', function($row){
                      $properties = json_encode($row->properties);
                      return $properties;
                    })
                    ->addColumn('eventDesc', function($row){
                      if($row->event == 'created')
                        $eventDesc = 'Your Application Created Successfully';
                      elseif($row->event == 'updated')
                        $eventDesc = 'Your Application Updated Successfully';
                        elseif($row->event == 'deleted')
                        $eventDesc = 'Your Application Deleted Successfully';

                      return $eventDesc;
                    })
                    ->rawColumns(['appName', 'appSerial', 'appType', 'action', 'date', 'properties', 'eventDesc'])
                    ->make(true);*/


    }


}