@extends('layouts/master-with-nav')

@section('main-title')
Application Details
@endsection

@section('username')
{{auth()->user()->name}}
@endsection

@section('page-style')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/introjs.min.css')}}" rel="stylesheet" type="text/css" />
<!-- <link href="{{asset('assets/css/themes/introjs-nazanin.css')}}" rel="stylesheet" type="text/css" /> -->

@endsection

@section('content')
@if($applicationData->count() > 0 )
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="card bg-review border-color-red border-review">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="profile-tab-nav border-right p-1">
                                    <div class="p-4">
                                        <div class="img-circle text-center mb-3">
                                            @if(file_exists(public_path('attachments/applications/'.$applicationData->application_serial.'/BasicInformation/'.$applicationData->applicationDetails[0]->file_data['Photo_with_Medical_Uniform'])))
                                            <img src="{{asset('attachments/applications/'.$applicationData->application_serial.'/Basic Information/'.$applicationData->applicationDetails[0]->file_data['Photo_with_Medical_Uniform'])}}"
                                                alt="{{$applicationData->application_name}}"
                                                class="shadow me-7 d-none d-lg-inline  h-100px">
                                            @else
                                            <img src="{{asset('assets/media/avatars/blank-main-page.jpg')}}"
                                                alt="User Image" class="shadow me-7 d-none d-lg-inline  h-100px">
                                            @endif
                                        </div>
                                        <h6 class="text-center text-white">
                                            @if(isset($applicationData->application_name))
                                            {{$applicationData->application_name}}
                                            @endif
                                        </h6>
                                        <h6 class="text-center text-white opacity-50 ">
                                            <small class="text-muted">#{{$applicationData->application_serial}}</small>
                                        </h6>
                                    </div>
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account"
                                            role="tab" aria-controls="account" aria-selected="true">
                                            <i class="fa fa-user text-center mr-1 icon-review"></i>
                                            <span class="px-2"><b>Applicant</b></span>
                                        </a>
                                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password"
                                            role="tab" aria-controls="password" aria-selected="false">
                                            <i class="fa fa-file text-center mr-1 icon-review"></i>
                                            <span class="px-2 "><b>Credentials</b></span>
                                        </a>
                                        <a class="nav-link" id="security-tab" data-toggle="pill" href="#security"
                                            role="tab" aria-controls="security" aria-selected="false">
                                            <i class="fa fa-check-circle text-center mr-1 icon-review"></i>
                                            <span class="px-2"><b>LOA</b></span>
                                        </a>
                                        <a class="nav-link" id="application-tab" data-toggle="pill" href="#application"
                                            role="tab" aria-controls="application" aria-selected="false">
                                            <i class="fa fa-credit-card text-center mr-1 icon-review"
                                                aria-hidden="true"></i>
                                            <span class="px-2"><b>Invoice</b></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 col-sm-12">
                                <div class="tab-content p-1" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="account" role="tabpanel"
                                        aria-labelledby="account-tab">
                                        <h2 class="mb-4 csg-color text-center">Applicant Information</h2>
                                        <div class="row p-2">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table align-middle table-row-bordered mb-0 fs-6 gy-3 min-w-300px">
                                                        <tbody class="fw-semibold text-gray-600">
                                                            @foreach($applicationData->applicationDetails as $key=>$detailValue)
                                                            @if($detailValue->credential_id == 1)
                                                            @foreach($detailValue->form_data as  $indexKey=>$credentialData)
                                                            <tr>
                                                                <td class="text-muted">
                                                                    <div class="d-flex align-items-center">
                                                                        <small>{!! str_replace('_', ' ', $indexKey)
                                                                            !!}</small>
                                                                    </div>
                                                                </td>
                                                                <td class="fw-bold ">
                                                                    @if(is_array($credentialData))
                                                                    @foreach($credentialData as $val)
                                                                    {{ $val }}
                                                                    @endforeach
                                                                    @else
                                                                    <small> {{$credentialData}}</small>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach

                                                            @foreach($detailValue->file_data as $indexKeyfile=>$credentialDatafile)
                                                            @if($indexKeyfile != 'Photo_with_Medical_Uniform')
                                                            <tr>
                                                                <td class="text-muted">
                                                                    <div class="d-flex align-items-center">
                                                                        <small>{{str_replace(array('_', 'Upload'), ' ', $indexKeyfile)}}</small>
                                                                    </div>
                                                                </td>
                                                                <td class="fw-bold ">
                                                                    @php $ext = pathinfo($credentialDatafile,
                                                                    PATHINFO_EXTENSION);
                                                                    @endphp
                                                                    @if($ext == 'pdf')
                                                                    <a download
                                                                        href="{{ asset('attachments/applications/'.$applicationData->application_serial.'/Basic Information/'.$credentialDatafile) }}">
                                                                        <img src="{{asset('assets/img/pdf.png')}}"
                                                                            width="50">
                                                                    </a>
                                                                    @else
                                                                    <a target="_blank"
                                                                        href="{{ asset('attachments/applications/'.$applicationData->application_serial.'/Basic Information/'.$credentialDatafile) }}">
                                                                        <img src="{{ asset('attachments/applications/'.$applicationData->application_serial.'/Basic Information/'.$credentialDatafile) }}"
                                                                            width="40">
                                                                    </a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="password" role="tabpanel"
                                        aria-labelledby="password-tab">
                                        <h2 class="mb-4 csg-color text-center">Credentails</h2>
                                        <div class="row">
                                            <div class="mb-0">
                                                <div class="accordion" id="kt_accordion_11">
                                                    @php $count = 1; @endphp
                                                    @foreach($applicationData->applicationDetails as $key=>$detailValue)
                                                    @if($detailValue->credential_id != 1)

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header"
                                                            id="kt_accordion_1_header_{{$count}}">
                                                            <button
                                                                class="accordion-button bg-accordian-reviw fs-4 fw-semibold"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#kt_accordion_1_body_{{$count}}"
                                                                aria-expanded="false"
                                                                aria-controls="kt_accordion_1_body_{{$count}}">
                                                                <small>{{$detailValue->form_data['Issuing_Authority_Name']}}
                                                                    ({{$detailValue->form_data['Country']}})</small>
                                                            </button>
                                                        </h2>
                                                        <div id="kt_accordion_1_body_{{$count}}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="kt_accordion_1_header_{{$count}}"
                                                            data-bs-parent="#kt_accordion_11">
                                                            <div class="accordion-body">

                                                                <div class="table-responsive">
                                                                    <table
                                                                        class="table align-middle table-row-bordered mb-0 fs-6 gy-3 min-w-300px">
                                                                        <tbody class="fw-semibold text-gray-600">
                                                                            @foreach($detailValue->form_data as $indexKey=>$credentialData)
                                                                            <tr>
                                                                                <td class="text-muted">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <small>{!! str_replace('_', ' ',
                                                                                            $indexKey)
                                                                                            !!}</small>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="fw-bold ">
                                                                                    @if(is_array($credentialData))
                                                                                    @foreach($credentialData as $val)
                                                                                    {{ $val }}
                                                                                    @endforeach
                                                                                    @else
                                                                                    {{$credentialData}}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                            @foreach($detailValue->file_data as $keyfile=>$valuefile)

                                                                            <tr>
                                                                                <td class="text-muted">
                                                                                    <div
                                                                                        class="d-flex align-items-center">
                                                                                        <small>{{str_replace(array('_', 'Upload'), ' ', $keyfile)}}</small>
                                                                                    </div>
                                                                                </td>

                                                                                <td class="fw-bold ">
                                                                                    @php $ext = pathinfo($valuefile,
                                                                                    PATHINFO_EXTENSION); @endphp
                                                                                    @if($ext == 'pdf')
                                                                                    <a download
                                                                                        href="{{asset($detailValue->file_path.$valuefile)}}">
                                                                                        <img src="{{asset('assets/img/pdf.png')}}"
                                                                                            width="50">
                                                                                    </a>
                                                                                    @else
                                                                                    <a target="_blank"
                                                                                        href="{{asset($detailValue->file_path.$valuefile)}}">
                                                                                        <img src="{{asset($detailValue->file_path.$valuefile)}}"
                                                                                            width="40">
                                                                                    </a>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php $count++; @endphp
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="security" role="tabpanel"
                                        aria-labelledby="security-tab">
                                        <h2 class="mb-4 csg-color text-center">Letter of Authorization</h2>
                                        <div class="row">
                                            <iframe
                                                src="{{ asset('attachments/applications/'.$applicationData->application_serial.'/loa/LetterOfAuthorization.pdf') }}"
                                                width="50%" height="600">
                                                This browser does not support PDFs. Please download the PDF to view it:
                                                <a
                                                    href="{{ asset('attachments/applications/app120230322112209/loa/LetterOfAuthorization.pdf') }}">Download
                                                    PDF</a>
                                            </iframe>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="application" role="tabpanel"
                                        aria-labelledby="application-tab">
                                        <h2 class="mb-4 csg-color text-center">Invoice</h2>
                                        <div class="row">
                                            @if($applicationData->status_id == 2)
                                            <iframe
                                                src="{{ asset('attachments/applications/'.$applicationData->application_serial.'/invoice.pdf') }}"
                                                width="50%" height="600">
                                                This browser does not support PDFs. Please download the PDF to view it:
                                                <a
                                                    href="{{ asset('attachments/applications/'.$applicationData->application_serial.'/invoice.pdf') }}">Download
                                                    PDF</a>
                                            </iframe>
                                            @else
                                            <div class="alert alert-warning text-center" role="alert">Not Payed yet
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else

@endif

@endsection

@section('page-script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
<script src="{{asset('assets/js/introjs.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap4.min.js')}}"></script>
@endsection