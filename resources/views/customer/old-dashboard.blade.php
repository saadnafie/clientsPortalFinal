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
<!-- <link href="{{asset('assets/css/themes/introjs-nazanin.css')}}" rel="stylesheet" type="text/css" /> -->

@endsection

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-5 mb-xl-12">
                    @php $index = 0; @endphp
                    @foreach($applications as $key=>$application)
                    @php $application->load(['credential.applicationDetail' => fn ($query) =>
                    $query->where('application_id',$application->id)]); @endphp
                    <div class="row  g-xl-12 mb-xl-12">
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 mb-md-5 mb-xl-12">
                            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center border-0 h-md-100 mb-5 mb-xl-10"
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
                                                @if($application->status_id == 2)
                                                <div class="menu-item px-3">
                                                    <a href="{{route('dashboardApplicationDetail' ,['id'=>$application->id]) }}"
                                                        target="_blank" class="menu-link px-3">Show Details</a>
                                                    {{--<a onclick="showApplicationDetail({{$application->id}})"
                                                    href="#" class="menu-link px-3">Show Details</a>--}}
                                                </div>
                                                @endif
                                                @if($application->status_id == 1)
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('application-processes.show',['application_process'=>$application->id]) }}"
                                                        class="menu-link px-3">Edit Information</a>
                                                </div>
                                                @endif
                                                @if($application->status_id == 2)
                                                <div class="menu-item px-3">
                                                    <a href="{{$application->invoice_pdf}}" target="_blank"
                                                        class="menu-link px-3">Download Invoice</a>
                                                </div>
                                                @endif
                                                @if($application->status_id == 1)
                                                <div class="menu-item px-3 my-1">
                                                    <a href="#"
                                                        onclick="deleteApplication({{$application->id}}, '{{$application->application_name}}')"
                                                        class="menu-link px-3">Delete Application</a>
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
                                    <span> Completed</span>
                                    <span>100%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                    <div class="bg-success rounded h-8px" role="progressbar" style="width: 100%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @elseif($application->step_id == 1)
                                <div
                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span> Not Completed</span>
                                    <span>20%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                    <div class="bg-warning rounded h-8px" role="progressbar" style="width: 20%"
                                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @elseif($application->step_id == 2)
                                <div
                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span> Not Completed</span>
                                    <span>40%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                    <div class="bg-warning rounded h-8px" role="progressbar" style="width: 40%"
                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @elseif($application->step_id == 3)
                                <div
                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span> Not Completed</span>
                                    <span>60%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                    <div class="bg-warning rounded h-8px" role="progressbar" style="width: 60%"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @elseif($application->step_id == 4 || $application->step_id == 5 ||
                                $application->step_id == 6)
                                <div
                                    class="d-flex justify-content-between fw-bold fs-6 text-white opacity-50 w-100 mt-auto mb-2">
                                    <span> Not Completed</span>
                                    <span>80%</span>
                                </div>
                                <div class="h-8px mx-3 w-100 bg-light-warning rounded">
                                    <div class="bg-warning rounded h-8px" role="progressbar" style="width: 80%"
                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                @endif

                            </div>
                            <br>
                            <span
                                class="badge badge-light-success fs-base">{{ $application->status->application_status }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-md-5 mb-xl-12">
            <div class="showAppData"></div>
        </div>
    </div>

</div>
</div>
</div>

@endsection

@section('page-script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
<script src="{{asset('assets/js/introjs.min.js')}}"></script>
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
                title: "New Application",
                intro: "You can always click here to create new application"
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
        text: "You want to delete this Application! " + appName,
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