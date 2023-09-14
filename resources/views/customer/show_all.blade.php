@extends('layouts/master-with-nav')

@section('main-title')
Show All Applications
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
<div class="container">
    @include('sweet_alert')


    @if(auth()->user()->role_id == 3)
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-xl-12 mb-xl-12">
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
                                                <a href="dashboardApplicationDetail/{{$application->id}}"
                                                    target="_blank" class="menu-link px-3">Show Details</a>
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
                                <div class="bg-warning rounded h-8px" role="progressbar" style="width: 0%"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                            </div>
                            @endif

                        </div>
                        <br>
                        @if($application->status_id == 2)
                        <span
                            class="badge badge-light-success fs-base">{{ $application->status->application_status }}</span>
                        @else
                        <span
                            class="badge badge-light-danger fs-base">{{ $application->status->application_status }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach


            <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 mb-md-5 mb-xl-12">
                <div class="showAppData"></div>
            </div>
        </div>

    </div>
</div>
</div>
</div>


@elseif(auth()->user()->role_id == 2)

<!----------------------------------Company-------------------------------------------------------------------->

<div class="col-xl-12 col-xxl-12 mb-5 mb-xl-12">
    <div class="card card-flush h-xl-100">
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
                                    data-hide-search="true" data-control="select2" data-dropdown-css-class="w-150px"
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
                                    data-hide-search="true" data-control="select2" data-dropdown-css-class="w-150px"
                                    data-placeholder="Select an option" data-kt-table-widget-3="filter_status"
                                    id="appStatus">
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
                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                    data-kt-menu-dismiss="true">Reset</button>
                                <button type="button" id="applyFilter" class="btn btn-sm btn-primary"
                                    data-kt-menu-dismiss="true">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="d-flex align-items-center flex-wrap gap-3 gap-xl-9 pt-3">
                    <input type="text" id="myCustomSearchBox" class="form-control" placeholder="Search ...">
                </div>

            </div>
            <table class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Application Name</th>
                        <th>Serial</th>
                        <th>Type</th>
                        <th>Status</th>
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
<!--<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>-->
<!--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

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


/*$('.flatpickr').flatpickr({
    mode: "range",
    dateFormat: "Y-m-d",
    defaultDate: ["2023-03-10", "2023-03-20"],
    onChange: function(dates) {
        if (dates.length == 2) {
            console.log($('.flatpickr').val());
            var dateRange = $('.flatpickr').val();
            //dates[0].toLocaleDateString().replaceAll('/','-');
            console.log("dateRange= " +dateRange);
            // interact with selected dates here
            ApplicationsLists(dateRange);
        }
    }
});*/

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
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
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
    ApplicationsLists(dateRange);
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

function ApplicationsLists(appDateRange = null) {
    let appType = $('#appType').val();
    let appStatus = $('#appStatus').val();

    console.log('appType' + appType);
    console.log('appStatus' + appStatus);

    $(".data-table").dataTable().fnDestroy();
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/customer/applicationListDataTable/" + appType + "/" + appStatus + "/" + appDateRange,
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
        table.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
    })
}

ApplicationsLists(dateRange);


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