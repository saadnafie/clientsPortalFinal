<?php

namespace App\Http\Controllers\ApplicationProcess;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Traits\ApplicationFile;
//use Barryvdh\DomPDF\Facade\Pdf;
use App;
use Illuminate\Filesystem\Filesystem;

use App\Models\Profession;
use App\Models\SubProfession;
use App\Models\Country;
use App\Models\ProfessionCountry;
use App\Models\CredentialFormField;
use App\Models\Application;
use App\Models\ApplicationDetail;
use App\Models\User;
use App\Models\Invoice;
use App\Models\ProfessionRule;
use App\Models\CredentialClassification;
use App\Models\ApplicationLicense;
use \PDF;
use App\DataTables\ApplicationDataTable;
use DataTables;




class ApplicationProcessController extends Controller
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

        $applications = Application::with('status', 'applicationDetails', 'processStatus')->where('user_id',auth()->user()->id)->get();
        //return $applications;
        $draft = Application::where('process_id',1)->where('user_id',auth()->user()->id)->count();
        $process = Application::where('process_id',2)->where('user_id',auth()->user()->id)->count();
        $pending = Application::where('process_id',3)->where('user_id',auth()->user()->id)->count();
        $complete = Application::where('process_id',4)->where('user_id',auth()->user()->id)->count();
        return view('customer.dashboard', compact('applications', 'draft','process','pending','complete'));
    
        //return DataTables::of(Application::query())->make(true);
        //return $dataTable->render('customer.app-list');

        //return $dataTable->render('customer.app-list');
        //$applications = Application::with('status', 'applicationDetails')->where('user_id',auth()->user()->id)->get();
        //return view('customer.dashboard',compact('applications'));

        //not used code
        //$applications->loadMissing(['credential.applicationDetail'/* => fn ($query) => $query->groupBy('credential_id')*/]);
        //return $applications;
        
    }

    public function applicationListDataTable($type, $status, $dateRange, $processID)
    {
       
           $data = Application::with('status', 'processStatus');
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
            if($processID != "null"){
                $data = $data->where('process_id', $processID);
            }   
            $data = $data->where('user_id', auth()->user()->id)->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                            if($row->status_id == 1){
                                $appName = "'".$row->application_name."'";
                                $btn = '<a href="application-processes/'.$row->id.'" class="menu-link p-1"><i class="fa fa-eye text-purple" style="font-size:1.3rem !important;" aria-hidden="true"></i></a>
                                        <a href="#" onclick="deleteApplication('.$row->id.', '.$appName.')" class="menu-link p-1"><i style="font-size:1.3rem !important;"  class="fa fa-trash csg-color" aria-hidden="true"></i></a>';
                            }else if($row->status_id == 2){
                                $btn = '<a href="dashboardApplicationDetail/'.$row->id.'" target="_blank"  class="menu-link p-1"><i class="fa fa-eye text-purple" style="font-size:1.3rem !important;"  aria-hidden="true"></i></a>
                                        <a href="'.$row->invoice_pdf.'" target="_blank"  class="menu-link p-1"><i class="fa fa-file-pdf-o" style="font-size:1.3rem !important;" aria-hidden="true"></i></a>';
                            }
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

     

    }

    public function dashboardApplicationDetail($id)
    {
        $applicationData = Application::with('status', 'applicationDetails')->findOrFail($id);
        //return $applicationData;
        return view('customer.dashboard-application-detail', compact('applicationData'));
        //$html = view('customer.dashboard-application-detail', compact('applicationData'))->render();
        //return response()->json(['status' => true, 'result' => $html]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.app-list');
          //return view('customer.application.create');
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
      $application->country_id = 2;
      $application->application_serial = $serial; //str_pad(random_int(1, 999999) ,6 ,0 , STR_PAD_LEFT); //str_pad($str,6,0, STR_PAD_LEFT);
      $application->type = $request->application_type;
      $application->status_id = 1;
      $application->save();
      /*$application->application_serial = "app".$application->id.$serial;
      $application->save();*/
      if($request->application_type == 2){
        $license = new ApplicationLicense();
        $license->application_id = $application->id;
        $license->license_number = $request->license_no;
        $license->issue_date = $request->issue_date;
        $license->expiry_date = $request->expiry_date;
        $license->save();
      }

      return redirect()->route('application-processes.show',['application_process'=>$application->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('userDetails')->find(auth()->user()->id);
        $application = Application::with('profession', 'country')->where('user_id',auth()->user()->id)->findOrFail($id);
        $basic_info = CredentialClassification::where('id',1)->with('formFields', function($query){
            $query->where('type_id','!=',8);
        })->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->first();
        $basic_files = CredentialClassification::where('id',1)->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->with('formFields', function($query){
            $query->where('type_id',8);
        })->first();
        $professions = Profession::where('activation', 1)->get();
        $subProfessions = SubProfession::all();
        $countries = Country::where('activation', 1)->get();
        $profession_country = ProfessionCountry::with('professionRule')->where('profession_id', $application->profession_id)->where('country_id', $application->country_id)->first();
        //return $profession_country;
        $profession_country->load('professionRule.credential');
        
        $rule = ProfessionRule::where('profession_country_id', $profession_country->id)->with('credential')->get();
        $rule->load(['credential.applicationDetail'=> fn ($query) => $query->where('application_id',$id),'credential.formFields' => fn ($query) => $query->where('type_id','!=',8)]);
        $credential_ids = $rule->pluck('credential_id');
        $app_cerdential = CredentialClassification::whereIn('id',$credential_ids)->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->get();
        $employmentRecord = $app_cerdential[3]->applicationDetail->count();
        $app_cerdential_files = CredentialClassification::whereIn('id',$credential_ids)->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->with('formFields',function($query){
            $query->where('type_id',8);
        })->get();

        //return $rule;
      return view('customer.application_process.application-process',compact('user','application', 'basic_info','basic_files','professions','subProfessions','countries','rule','app_cerdential_files','profession_country', 'employmentRecord'));
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
      $countries = Country::where('activation', 1)->get();
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
        $application = Application::findorFail($id);   
        File::deleteDirectory(public_path('/attachments/applications/').$application->application_serial);
        Application::findorFail($id)->delete();
        //return redirect()->back();
        return response()->json(['message' => 'success', 'code' => '200']);
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

    public function setNextStep($id, $step)
    {
        $applicationLog = Application::find($id);
        $applicationLog->disableLogging();
        $applicationLog->update(['step_id'=> $step]);
        return response()->json(['message' => 'success', 'code' => '200']);
    }


    public function refreshData($id)
    {
       $application = Application::with('profession', 'country')->where('user_id',auth()->user()->id)->findOrFail($id);
       $data['application'] = $application;
      $basic_info = CredentialClassification::where('id',1)->with('formFields', function($query){
          $query->where('type_id','!=',8);
      })->with('applicationDetail', function ($query) use($id) {
          $query->where('application_id',$id);
      })->first();
      $data['basic_info'] = $basic_info;
      $basic_files = CredentialClassification::where('id',1)->with('formFields', function($query){
          $query->where('type_id',8);
      })->first();
      $professions = Profession::where('activation', 1)->get();
      $subProfessions = SubProfession::all();
      $countries = Country::all();
      $profession_country = ProfessionCountry::where('profession_id', $application->profession_id)->where('country_id', $application->country_id)->first();
      $rule = ProfessionRule::where('profession_country_id', $profession_country->id)->with('credential.formFields',function($query){
          $query->where('type_id','!=',8);
      })->get();
      $credential_ids = $rule->pluck('credential_id');
      $app_cerdential = CredentialClassification::whereIn('id',$credential_ids)->with('applicationDetail', function ($query) use($id) {
          $query->where('application_id',$id);
      })->get();
      $data['app_cerdential_files'] = CredentialClassification::whereIn('id',$credential_ids)->with('applicationDetail', function ($query) use($id) {
          $query->where('application_id',$id);
      })->with('formFields',function($query){
          $query->where('type_id',8);
      })->get();
      return response()->json(['data' => $data ,'message' => 'success', 'code' => '200']);
    }

    public function reviewData($id)
    {
      $application = Application::with('profession','applicationDetails','status')->where('user_id',auth()->user()->id)->findOrFail($id);
      return response()->json(['data' => $application ,'message' => 'success', 'code' => '200']);
    }


    public function invoiceData($id)
    {
        $application = Application::with('profession', 'country')->where('user_id',auth()->user()->id)->findOrFail($id);

        $credentials = CredentialClassification::with('rule')->whereHas('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id)->where('credential_id','!=',1);
        })->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id)->where('credential_id','!=',1);
        })->get();

        $employmentCredential = CredentialClassification::with('rule')->with('applicationDetail', function ($query) use($id) {
            $query->where('application_id',$id);
        })->find(5);
        $checkEmploymentExist = false;
        $type = 1;
        if($employmentCredential->applicationDetail->count() > 0){
            $checkEmploymentExist = true;
            $type = 2;
        }
        $rule = ProfessionCountry::where('profession_id',$application->profession_id)->where('country_id',$application->country_id)->where('package_type_id',$type)->first();
        $base_cost = $rule->base_cost;

        return response()->json(['data' => $credentials ,'checkEmploymentExist' => $checkEmploymentExist,'base_cost' => $base_cost, 'message' => 'success', 'code' => '200']);
    }

    public function loaCleaFiles(Request $request)
    {
        $application = Application::with('profession','applicationDetails','status')->where('user_id',auth()->user()->id)->findOrFail($request->app_id);
        // dd($application->application_serial);
        $path = public_path('attachments/applications/'.$application->application_serial.'/'.'loa/');

        File::deleteDirectory($path);
    }
    public function loaGenerate(Request $request)
    {

      $image_parts = explode(";base64,", $request->input('mybase64image'));
      $image_type_aux = explode("image/", $image_parts[0]);
      $image_type = $image_type_aux[1];
      $image_base64 = base64_decode($image_parts[1]);
      $file = date("Ymdhms") .''. uniqid() . '.' . $image_type;
      $uniqueID = uniqid();

      // $confirm_id = Auth::id();
      // $user = User::find($confirm_id);
      $app_id = $request->application_id;
      $application = Application::with('profession','applicationDetails','status')->where('user_id',auth()->user()->id)->findOrFail($app_id);

      $path = public_path('attachments/applications/'.$application->application_serial.'/'.'loa/');

        File::deleteDirectory($path);
        
      $folder = Auth::id();
      $path = public_path('attachments/applications/'.$application->application_serial.'/loa/');
      $path_store = 'attachments/'.$uniqueID.'/';
      if (!file_exists($path)) {
          mkdir($path, 0777, true);
      }

      if (file_put_contents(($path.$file), $image_base64)) {

      }

      $html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <style>
      body{
          font-family: times
      }
      @page *{
          size: auto;
          sheet-size: A4;
      }

      p {
          font-size: 13px;

      }

      .title-auth {
          font-size: 13px;
      }


      table{
          color:#333;

      }
      .items_table_1 {
          width:100%;
          font-size:9.5pt;
          line-height:18px;
      }
      .items_table_1 th {
      }
      .items_table_1 td {
          padding:1px;
      }

      .data{
      font-size:20px;
      height:6px;
      color:#009;
      }

      </style>
      '
      ;

      $img2 = public_path('assets/img/logo2.png');
      $img1 = public_path('assets/img/logo.png');
      $html .= '<table>
      <tr>
          <td style="vertical-align:top" align="center" width="43%">
              <img src="'.$img2.'" width="160px">
              <h4 style="padding-top: 30px; ">Letter of Authorization</h4>
          </td>
          <td width="4%"></td>
          <td style="vertical-align:top" align="center" width="43%">
              <img src="'.$img1.'" width="180px" style="margin-top: 50px; padding-bottom: 30px" >
              <h4 class="title-auth" style="padding-top: 30px;font-family: times;">خطاب التفويض</h4>
          </td>
      </tr>

      <tr>
          <td width="43%" style="text-align: justify; padding-top: 30px; padding-bottom: 10px;">
              <p > I the undersigned, authorize Optimum Verification Company, and its
              authorized affiliates, agents, and subsidiaries, to verify my information and documents which
              includes Educational and employment certificates.</p>
          </td>
          <td  width="4%" style="text-align: justify; padding-top: 30px;">
          </td>
          <td width="43%" style="vertical-align:top; direction: rtl; text-align: justify;  padding-top: 30px;">
          <p> أنا الموقع أدناه أفوض شركة التوثيق الأمثل أو من تفوضه رسميّاً بالحصول على جميع المعلومات والوثائق الخاصة بعملية التحقق من الشهادات العلمية وشهادات الخبرة.</p>
          </td>
      </tr>
      <tr>
          <td width="43%"  style="text-align: justify; padding-bottom: 10px;">
          <p> Based on this letter, I hereby grant the authority for the bearer of
              this letter, with immediate effect to release all necessary information, to the official authorized
              to conduct the verification process, and I acknowledge and agree to all the services provided by
              Optimum Verification Company for data verification and data validation services.</p>
          </td>

          <td width="4%">
          </td>

          <td width="43%" style="vertical-align:top; direction: rtl; text-align: justify;">
          <p> وبموجب هذا التفويض، أمنح الحق لحاملي هذا الخطاب تسليم جميع المعلومات الخاصة بي، ومن يتم تفويضه رسمياً بذلك. وأقر بالعلم والموافقة على كل الخدمات التي تزودها شركة التوثيق الأمثل لخدمات التحقق والتأكد من صحة البيانات.</p>
          </td>
      </tr>

      <tr>
          <td width="43%" style="text-align: justify; padding-bottom: 10px;">
          <p> This information / documentation may contain grades, dates of
              attendance, grade point average, degree / diploma certification, letter of employment, employment
              title, employment tenure, license attained, status of the license, place of issue I also pledge that
              all the data provided below are correct.</p>
          </td>

          <td width="4%">
          </td>

          <td width="43%" style="vertical-align:top; direction: rtl; text-align: justify;">
          <p> تشمل هذه المعلومات والوثائق المطلوبة على تواريخ الدراسة، والمعدل التراكمي، والدرجة أو الشهادة العلمية، أو خطاب الخبرة والمسمى الوظيفي، ومدة الخدمة، والترخيص المهني، وحالة الترخيص، ومكان الإصدار، كما أتعهّد بأنَ كافة البيانات التي تم تقديمها ادناه صحيحة.</p>
          </td>
      </tr>

      <tr>
          <td width="43%"  style="text-align: justify; padding-bottom: 10px;">
          <p> I hereby release all persons or entities requesting or supplying such
              information from any liability arising from such disclosure. I confirm and acknowledge that a
              photocopy of this authorization be accepted with the same authority as the original.</p>
          </td>

          <td width="4%">
          </td>

          <td width="43%" style="vertical-align:top; direction: rtl; text-align: justify;">
          <p> وأقر بأن أخلي مسؤولية جميع الأشخاص أو الجهات الطالبة لهذه المعلومات من أي مسؤولية قانونية قد تنشأ عن ذلك. وأوافق على أن تكون صورة هذا الخطاب مطابقة للأصل.</p>
          </td>
      </tr>

      <tr>
          <td width="43%"  style="text-align: justify; padding-bottom: 10px;">
          <p> I acknowledge the right for the Information Recipient to disclose my
              information to any relevant third party.</p>
          </td>

          <td width="4%">
          </td>

          <td width="43%" style="vertical-align:top; direction: rtl; text-align: justify;">
          <p> كما أفوض مستلم المعلومات الكشف عن هذه المعلومات إلى أي طرف ثالث ذات علاقة.</p>
          </td>
      </tr>

      <tr>
          <td width="43%"  style="text-align: justify; padding-bottom: 10px;">
          <p> I acknowledge that I have read the authorization letter, and I pledge
              to bring and deliver clear copy of documents incase its requested by the company, and it should be
              within 20 working days maximum.</p>
          </td>

          <td width="4%">
          </td>

          <td width="43%" style="vertical-align:top; direction: rtl; text-align: justify;">
          <p> وأْقر بأني قرأت خطاب التفويض، كما أتعهّد بإحضار وتسليم نسخة واضحة من المستندات في حال تم طلبها من الشركة، وذلك خلال 20 يوم عمل كحد أقصى.</p>
          </td>
      </tr>
      </table>';

      $html .= "<br>";

      $html .= '<table width="100%">
      <tr>
          <td style="vertical-align:top" align="left" width="20%">Passport</td>
          <td style="vertical-align:top; border-bottom:2px solid #999;" align="center" width="60%;" >' . $request->input('name') . '</td>
          <td style="vertical-align:top" align="right" width="20%">رقم جواز السفر</td>
      </tr>
      <tr><td colspan="3" height="30px"></td></tr>
      <tr>
          <td style="vertical-align:top" align="left">Name</td>
          <td style="vertical-align:top; border-bottom:2px solid #999;" align="center">' . $request->input('passport') . '</td>
          <td style="vertical-align:top;  direction: rtl" align="right">الاسم</td>
      </tr>
      <tr><td colspan="3" height="30px"></td></tr>
      <tr>
          <td style="vertical-align:top" align="left">Date</td>
          <td style="vertical-align:top; border-bottom:2px solid #999;" align="center">' . $request->input('date') . '</td>
          <td style="vertical-align:top;  direction: rtl" align="right">التاريخ</td>
      </tr>
      <tr><td colspan="3" height="20px"></td></tr>
      <tr>
          <td style="vertical-align:bottom" align="left">Signature</td>
          <td style="vertical-align:bottom; border-bottom:2px solid #999;" align="center"><img src="' . $path . $file . '" height="80"></td>
          <td style="vertical-align:bottom;  direction: rtl" align="right">التوقيع</td>
      </tr>

      </table>
      ';

      $path_PDF = $path;
      if (!file_exists($path_PDF)) {
          mkdir($path_PDF, 0777, true);
      }

        $name = $application->applicationDetails[0]->form_data['First_Name']. ' ' . $application->applicationDetails[0]->form_data['Middle_Name']. ' ' . $application->applicationDetails[0]->form_data['Last_Name'];
        $passport = $application->applicationDetails[0]->form_data['Passport_Number'];
        $date = date('d/m/Y');
      $filename = 'LetterOfAuthorization.pdf';

      // "barryvdh/laravel-dompdf": "^2.0",
      // "carlos-meneses/laravel-mpdf": "^2.1",
              // Barryvdh\DomPDF\ServiceProvider::class,
      // 'PDF' => Barryvdh\DomPDF\Facade::class,

      // Pdf::setOption(['defaultFont' => 'dejavu sans']);
      // Pdf::loadHTML($html)
      // ->setPaper('a4', 'landscape')
      // ->setWarnings(false)
      // ->save($path_PDF.$filename);


      
          $attachFile = $path . $file;

      $pdf = \PDF::loadView('PDF.template', compact(['name', 'passport', 'date', 'attachFile']));
      $pdf->save($path_PDF.$filename);
      if($pdf)
      {
        $response = array(
            'op' => 'ok',
            'error' => '',
            'filename' => '/attachments/applications/'.$application->application_serial.'/loa/LetterOfAuthorization.pdf',
        );
  
        return response()->json($response);
      }
      else
      {
        $response = array(
            'op' => 'no',
            'error' => 'Letter of authorization already signed',
            'filename' => '/attachments/applications/'.$application->application_serial.'/loa/LetterOfAuthorization.pdf',
        );
  
        return response()->json($response);
      }

      

    }
}