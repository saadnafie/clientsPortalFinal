@extends('layouts/master-with-nav')

@section('main-title')
Dashboard
@endsection

@section('username')
{{auth()->user()->name}}
@endsection

@section('page-style')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/introjs.min.css')}}" rel="stylesheet" type="text/css" />
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">-->

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


@endsection

<style>
td:first-child {
    text-align: center !important;
}
.table td,
.table th,
.table tr {
    font-size: 12px !important;
}
table.dataTable thead th:first-child {
    text-align: center !important;
}
</style>

@section('content')
<script>
window.onload = function() {
    var optionsApplications = {
        animationEnabled: true,
        title: {
            text: "Application Status Statistics"
        },
        data: [{
            type: "doughnut",
            innerRadius: "40%",
            showInLegend: true,
            legendText: "{label}",
            indexLabel: "{label}: #percent",
            dataPoints: [{
                    label: "Pending",
                    y: {{ $pending }}
                },
                {
                    label: "In Progress",
                    y: {{ $process }}
                },
                {
                    label: "Completed",
                    y: {{ $complete }}
                },
                {
                    label: "Drafts",
                    y: {{ $draft }}
                }
            ]
        }]
    };
    $("#chartContainer2").CanvasJSChart(optionsApplications);
}
</script>
@include('sweet_alert')

@if(auth()->user()->role_id == 3)

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card h-md-100" dir="ltr">
                <div class="card-body ">
            <div class="row g-xl-12 mb-xl-12">
        
                @if(count($applications) > 0)
                @php $index = 0; @endphp
                @foreach($applications as $key=>$application)
                @php $application->load(['credential.applicationDetail' => fn ($query) =>
                $query->where('application_id',$application->id)]); @endphp
                <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-6 mb-md-5 mb-xl-12">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 mb-5 mb-xl-10"
                        style="background-color: #E96559">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <span
                                    class="fs-1hx fw-bold text-white me-1 lh-1 ls-n2">{{ $application->application_name }}</span>
                                <span
                                    class="text-white opacity-50 pt-1 fw-semibold fs-6">#{{ $application->application_serial }}</span>
                            </div>
                            <div class="d-flex">
                                <div class="me-0">
                                    <button
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary show menu-dropdown"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="bi bi-three-dots fs-3"></i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3"
                                        data-kt-menu="true"
                                        style="z-index: 107; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-60px, 279px);"
                                        data-popper-placement="bottom-end">
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                                Quick Actions</div>
                                        </div>
                                        @if($application->status_id == 1)
                                        <div class="menu-item px-3">
                                            <a href="{{ route('application-processes.show',['application_process'=>$application->id]) }}"
                                                class="menu-link px-3">Edit Information</a>
                                        </div>
                                        <div class="menu-item px-3 my-1">
                                            <a href="#"
                                                onclick="deleteApplication({{$application->id}}, '{{$application->application_name}}')"
                                                class="menu-link px-3">Delete Application</a>
                                        </div>
                                        @endif
                                        @if($application->status_id == 2)
                                        <div class="menu-item px-3">
                                            <a href="dashboardApplicationDetail/{{$application->id}}" target="_blank"
                                                class="menu-link px-3">Show Details</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="{{$application->invoice_pdf}}" target="_blank"
                                                class="menu-link px-3">Download Invoice</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body align-items-end pt-0">
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($application->credential as $key=>$credential)
                                    @if($key > 0)
                                    <div class="d-flex fw-semibold align-items-center">
                                        <div class="bullet w-8px h-3px rounded-2 bg-success me-3">
                                        </div>
                                        <div class="text-gray-500 flex-grow-1 me-4 color-white">
                                            {{ $credential->credential_type }}
                                            ({{$credential->applicationDetail->count()}})
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                {{--<div class="col-md-4">
                                        @if($application->status_id == 2)
                                        <div class="d-flex align-items-center flex-column mt-3 w-100">
                                            <a href="{{$application->invoice_pdf}}"
                                class="btn btn-sm btn-success fw-bold ms-2 fs-8 py-1 px-3">
                                Download Invoice</a>
                            </div>
                            @else
                            <div class="d-flex align-items-center flex-column mt-3 w-100">
                                <a href=" {{ route('application-processes.show',['application_process'=>$application->id]) }}"
                                    class="btn btn-sm btn-warning fw-bold ms-2 fs-8 py-1 px-3">
                                    Continue</a>
                            </div>
                            @endif
                        </div>--}}
                    </div>
                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                        @if($application->status_id == 2)
                        <div
                            class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                            <span> In Progress</span>
                            <span>50%</span>
                        </div>
                        <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                            <div class="bg-warning rounded h-8px" role="progressbar" style="width: 50%"
                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="50"></div>
                        </div>
                        @else
                        <div
                            class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                            <span> Not Completed</span>
                            <span>0%</span>
                        </div>
                        <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                            <div class="bg-warning rounded h-8px" role="progressbar" style="width: 0%" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="0"></div>
                        </div>
                        @endif

                    </div>
                    <br>
                    @if($application->status_id == 2)
                    <span
                        class="badge badge-light-success fs-base">{{ $application->status->application_status }}</span>
                    @else
                    <span class="badge badge-light-danger fs-base">{{ $application->status->application_status }}</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach


        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-md-5 mb-xl-12">
            <div class="showAppData"></div>
        </div>
    </div>
    @else

    <div class="row g-xl-12 mb-xl-12">
        <div class="col-md-12 col-lg-12 col-xl-12 mb-xl-12">
            <div class="card " dir="ltr">
                <div class="card-body d-flex flex-column flex-center">
                    <div class="mb-2">
                        <h1 class="fw-semibold text-gray-800 text-center lh-lg">Welcome
                            {{auth()->user()->name}}
                            <br />
                            <span class="fw-bolder"> You don't have any application yet</span>
                        </h1>
                        <div class="py-10 text-center">
                            <img src="{{asset('assets/media/svg/no-data.svg')}}"
                                class="theme-light-show w-200px" alt="" />
                            <img src="{{asset('assets/media/svg/no-data.svg')}}"
                                class="theme-dark-show w-200px" alt="" />
                        </div>
                    </div>
                    <div class="text-center mb-1">
                        <a href="{{ route('applications.create') }}" class="btn btn-sm btn-primary me-2"
                            data-bs-target="#kt_modal_bidding">Create New Application</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    </div>
</div>

    </div>
</div>
</div>

@elseif(auth()->user()->role_id == 2)

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-md-12 col-lg-12 col-xxl-12">
                    <div class="card h-xl-100">
                        <div class="card-body pb-3">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_chart_widgets_22_tab_content_2">
                                    <div class="d-flex flex-wrap flex-md-nowrap">
                                        <div class="me-md-5 w-100">
                                            <div class="d-flex border border-gray-300 border-dashed rounded p-4 mb-3">
                                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                    <div class="symbol symbol-50px me-4">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2qx svg-icon-danger">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3"
                                                                        d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="me-2">
                                                        <a href="#all_application" id="draftFilter"
                                                            class="text-gray-800 text-hover-danger fs-6 fw-bold">Draft</a>
                                                        <span class="text-gray-400 fw-bold d-block fs-7">Applications
                                                            in
                                                            the draft stage</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-lg fs-2x badge-light-danger align-self-center px-2">{{ $draft }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex border border-gray-300 border-dashed rounded p-4 mb-3">
                                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                    <div class="symbol symbol-50px me-4">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2qx svg-icon-info">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3"
                                                                        d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="me-2">
                                                        <a href="#all_application" id="progressFilter" 
                                                            class="text-gray-800 text-hover-info fs-6 fw-bold">In
                                                            Progress </a>
                                                        <span class="text-gray-400 fw-bold d-block fs-7">Applications
                                                            that are in progress</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-lg fs-2x  badge-light-info align-self-center px-2">{{ $process }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex border border-gray-300 border-dashed rounded p-4 mb-3">
                                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                    <div class="symbol symbol-50px me-4">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2qx svg-icon-warning">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3"
                                                                        d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="me-2">
                                                        <a href="#all_application" id="pendingFilter" 
                                                            class="text-gray-800 text-hover-warning fs-6 fw-bold">Pending
                                                        </a>
                                                        <span class="text-gray-400 fw-bold d-block fs-7">Applications
                                                            missed some additional updates/documents </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-lg fs-2x badge-light-warning align-self-center px-2">{{ $pending }}</span>
                                                </div>
                                            </div>
                                            <div class="d-flex border border-gray-300 border-dashed rounded p-4 mb-3">
                                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                    <div class="symbol symbol-50px me-4">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2qx svg-icon-success">
                                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3"
                                                                        d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                                                        fill="currentColor" />
                                                                    <path
                                                                        d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                                                        fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="me-2">
                                                        <a href="#all_application" id="completeFilter" 
                                                            class="text-gray-800 text-hover-success fs-6 fw-bold">Completed</a>
                                                        <span class="text-gray-400 fw-bold d-block fs-7">Applications
                                                            that have completed verifications</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <span
                                                        class="badge badge-lg fs-2x badge-light-success align-self-center px-2">{{ $complete }}</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div
                                            class="d-flex justify-content-between flex-column w-225px w-md-600px mx-auto mx-md-0 pt-3 pb-10">
                                            @if(count($applications) > 0)
                                            <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
                                            @else
                                            <div class="mb-2">
                                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">Welcome
                                                    {{auth()->user()->name}}
                                                    <br />
                                                    <span class="fw-bolder"> You don't have any application yet</span>
                                                </h1>
                                                <div class="py-10 text-center">
                                                    <img src="{{asset('assets/media/svg/no-data.svg')}}"
                                                        class="theme-light-show w-200px" alt="" />
                                                    <img src="{{asset('assets/media/svg/no-data.svg')}}"
                                                        class="theme-dark-show w-200px" alt="" />
                                                </div>
                                            </div>
                                            <div class="text-center mb-1">
                                                <a href="{{ route('applications.create') }}" class="btn btn-sm btn-primary me-2"
                                                    data-bs-target="#kt_modal_bidding">Create New Application</a>
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

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-md-12 col-lg-12 col-xxl-12">
                    <div class="card card-flush h-xl-100" id="all_application">
                        <div class="card-header align-items-center border-0">
                            <h3 class="fw-bold text-gray-900 m-0">My Applications</h3>
                        </div>
                        <div class="card-body pt-1">
                            <div class="d-flex flex-stack flex-wrap gap-4">
                                <div class="outside_buttons d-flex align-items-center flex-wrap gap-3 gap-xl-9 pt-3">
                                </div>
                                <div class="d-flex align-items-center gap-4">
                                    <a href="#" class="text-hover-primary ps-4 menuFix btn btn-secondary buttons-html5"
                                        style="color: #ffffff !important;" data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2 svg-icon-gray-400 white">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span> Filter Options
                                    </a>

                                    <a href="#all_application" id="resetFilter" class="text-hover-primary ps-4 menuFix btn btn-secondary buttons-html5"
                                        style="color: #ffffff !important;" >
                                        <span class="fa fa-refresh"></span> Reset
                                    </a>

                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px " data-kt-menu="true"
                                        id="kt_menu_63de7a9678cc8" style="width:320px !important;">
                                        <div class="px-7 py-5">
                                            <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                        </div>
                                        <div class="separator border-gray-200"></div>
                                        <div class="px-7 py-5">

                                            <div class="mb-3">
                                                <label class="text-muted fs-7 me-2">Type</label>
                                                <select class=""
                                                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%"
                                                    data-hide-search="true" data-control="select2"
                                                    data-dropdown-css-class="w-150px"
                                                    data-placeholder="Select an option" id="appType">
                                                    <option value="0" selected="selected">Show All</option>
                                                    <option value="1">New</option>
                                                    <option value="2">Renew</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="text-muted fs-7 me-2">Status</label>
                                                <select class=""
                                                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%"
                                                    data-hide-search="true" data-control="select2"
                                                    data-dropdown-css-class="w-150px"
                                                    data-placeholder="Select an option"
                                                    data-kt-table-widget-3="filter_status" id="appStatus">
                                                    <option value="0" selected="selected">Show All</option>
                                                    <option value="2">Paid</option>
                                                    <option value="1">Not Paid</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <div class="text-muted fs-7 me-2">Date Range</div>
                                                <div id="reportrange"
                                                    style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <span></span> <i class="fa fa-caret-down"></i>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">Reset</button>
                                                <button type="button" id="applyFilter" class="btn btn-sm btn-primary"
                                                    data-kt-menu-dismiss="true">Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="d-flex align-items-center flex-wrap gap-3 gap-xl-9 pt-3">
                                    <input type="text" id="myCustomSearchBox" class="form-control"
                                        placeholder="Search ...">
                                </div>

                            </div>
                            <table class="table table-bordered table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Application Name</th>
                                        <th>Serial</th>
                                        <th>Type</th>
                                        <th>Payment Status</th>
                                        <th>Process Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endsection

@section('page-script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
<script src="{{asset('assets/js/introjs.min.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/new-card.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="{{asset('assets/js/jquery.canvasjs.min.js')}}"></script>



<script>
let tour_status = "{{auth()->user()->details}}";
if (tour_status != 'Done') {
    introJs().setOptions({
        showProgress: true,
        disableInteraction: true,
        steps: [{
                title: 'Take a tour',
                intro: "Welcome {{auth()->user()->name}}  in Clean sheet Group Portal, Please take a few seconds to view your dashboard 👋"
            },
            {
                title: 'User Profile',
                element: document.querySelector('#tour-userprofile'),
                intro: 'Here is your profile, you can view or update your profile from here'
            },
            {
                title: 'Dashboard',
                element: document.querySelector('#tour-dashboard'),
                intro: 'Dashboard will show you all your applications including: active, pending, and closed applications'
            },
            {
                element: "#tour-newapplication",
                title: "Applications",
                intro: "You can always click here to create a new application, or to view your created applications"
            }
        ]
    }).onbeforeexit(function() {
        $.ajax({
            url: "/customer/update_tour",
            type: "get",
            dataType: "json",
            success: function() {}
        });
    }).start();
}
let dateRange = null;
$(function() {
    var start = moment().startOf("month"); //moment().subtract(29, 'days');
    var end = moment().endOf("month"); //moment();
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        console.log('start= ' + start.format('YYYY-MM-DD'));
        console.log('end= ' + end.format('YYYY-MM-DD'));
        let startDate = start.format('YYYY-MM-DD');
        let endDate = end.format('YYYY-MM-DD');
        dateRange = startDate + 'to' + endDate;
        console.log('dateRange= ' + dateRange);
        //ApplicationsLists(dateRange);
    }
    $('#reportrange').daterangepicker({
        timePicker: true,
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month')
                .endOf('month')
            ],
            /*'Last 3 Months': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 6 Months': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 9 Months': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],*/
        }
    }, cb);
    cb(start, end);
});
$('#applyFilter').on('click', function() {
    ApplicationsLists(dateRange, null);
});
$('#draftFilter').on('click', function() {
    ApplicationsLists(null, 1);
});
$('#progressFilter').on('click', function() {
    ApplicationsLists(null, 2);
});
$('#pendingFilter').on('click', function() {
    ApplicationsLists(null, 3);
});
$('#completeFilter').on('click', function() {
    ApplicationsLists(null, 4);
});
$('#resetFilter').on('click', function() {
    ApplicationsLists(null, null);
});
document.querySelector('.menuFix').addEventListener('click', function(event) {
    /*event.stopPropagation();*/
});
window.onclick = function(event) {
    if (!event.target.matches('.menuFix')) {
        var dropdowns =
            document.getElementsByClassName("menuFix");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
//////////////////// Applications Lists (DataTables) ////////////
function ApplicationsLists(appDateRange = null, processID = null) {
    let appType = $('#appType').val();
    let appStatus = $('#appStatus').val();
    console.log('appType' + appType);
    console.log('appStatus' + appStatus);
    $(".data-table").dataTable().fnDestroy();
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/customer/applicationListDataTable/" + appType + "/" + appStatus + "/" + appDateRange + "/"  + processID,
        columns: [{
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: 'application_name',
                name: 'application_name',
                orderable: true,
                searchable: true
            },
            {
                data: 'application_serial',
                name: 'application_serial',
                orderable: true,
                searchable: true
            },
            {
                data: 'application_type',
                name: 'application_type',
                orderable: true,
                searchable: true
            },
            {
                data: 'status.application_status',
                name: 'status.application_status',
                orderable: true,
                searchable: true
            },
            {
                data: 'process_status.application_process_status',
                name: 'process_status.application_process_status',
                orderable: true,
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        dom: "Brtip",
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
    });
    $("#DataTables_Table_0_wrapper > .dt-buttons").appendTo("div.outside_buttons");
    $('#myCustomSearchBox').keyup(function() {
        table.search($(this).val())
            .draw(); // this  is for customized searchbox with datatable search feature.
    })
}
ApplicationsLists(dateRange, null);
////////////////////for fetch variables////////////
function showApplicationDetail(appID) {
    var url = "{{url('/')}}/customer/dashboardApplicationDetail/" + appID;
    $.ajax({
        url: url,
        type: "get",
        success: function(response) {
            if (response) {
                //$('.showAppData').html(response.result);
                let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,
                                    width=1500,height=800,left=50,top=50`;
                open(url, 'test', params);
            }
        },
    });
}
function deleteApplication(appID, appName) {
    var url = "{{url('customer/application-processes')}}/" + appID;
    Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: 'Are you sure?',
        html: "You want to delete this Application! <br>" + appName,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        //timer: 2000,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'DELETE',
                cache: false,
                async: true,
                success: function(response) {
                    if (response.code == 200) {
                        console.log(response);
                        ApplicationsLists();
                        Toastify({
                            text: "Your Application Deleted successfully!",
                            className: "success",
                            style: {
                                background: "linear-gradient(to right, #59C552, #59C552)",
                                color: "#FFFFFF",
                            },
                        }).showToast();
                        setTimeout(() => {
                            document.location.reload();
                        }, 2000);
                    }
                }
            });
        }
    });
}
</script>
@endsection