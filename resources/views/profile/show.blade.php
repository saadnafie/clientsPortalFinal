@extends('layouts/master-with-nav')

@section('main-title')
{{auth()->user()->name}}
@endsection

@section('username')
{{auth()->user()->name}}
@endsection


@section('page-style')
@endsection

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Profile Details</h3>
                    </div>
                    <a href="{{ route('account.edit') }}" class="btn btn-sm btn-primary align-self-center">Edit
                        Profile</a>

                </div>
                <div class="card-body p-9">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="card">

                                <div class="card-body">
                                    <div class="user text-center">

                                        <div class="profile">

                                            @if(is_null(auth()->user()->avatar))
                                            <img src="{{asset('assets/media/avatars/blank-main-page.jpg')}}" alt="image"
                                                class="rounded-circle" width="80" />
                                            @else
                                            <img src="{{asset('assets/media/avatars/'.$user->avatar)}}" alt="image"
                                                class="rounded-circle" width="80" />
                                            @endif

                                        </div>

                                    </div>


                                    <div class="mt-5 text-center">

                                        <h4 class="mb-0">{{auth()->user()->name}}</h4>
                                        <span class="text-muted d-block mb-2">{{$user->userDetails->Passport}}</span>
                                    </div>

                                    <div class="separator separator-dashed my-3"></div>
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-500 flex-grow-1 me-4">All Applications</div>
                                        <div class="badge badge-light-info fs-base ">
                                            {{$applications->count()}}</div>

                                    </div>
                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-500 flex-grow-1 me-4">In Progress Applications</div>
                                        <div class="badge badge-light-warning fs-base ">
                                            {{$process}}</div>

                                    </div>
                                    <div class="separator separator-dashed my-3"></div>

                                    <div class="d-flex flex-stack">
                                        <span class="text-gray-500 flex-grow-1 me-4">Completed Applications</span>
                                        <div class="badge badge-light-success fs-base ">
                                            {{$complete}}</div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-8">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{$user->name}}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Passport Number</label>
                                        <div class="col-lg-8 fv-row">
                                            <span
                                                class="fw-semibold text-gray-800 fs-6">{{$user->userDetails->Passport}}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Date of Birth</label>
                                        <div class="col-lg-8 fv-row">
                                            <span
                                                class="fw-semibold text-gray-800 fs-6">{{$user->userDetails->DateOfBirth}}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">ID/Residence Number
                                        </label>
                                        <div class="col-lg-8 fv-row">
                                            <span
                                                class="fw-semibold text-gray-800 fs-6">{{$user->userDetails->Residency}}</span>
                                        </div>
                                    </div>
                                    @if($user->role_id == 2)
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Organization Name</label>
                                        <div class="col-lg-8 fv-row">
                                            <span
                                                class="fw-semibold text-gray-800 fs-6">{{$user->userDetails->Organization_Name}}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Designation
                                        </label>
                                        <div class="col-lg-8 fv-row">
                                            <span
                                                class="fw-semibold text-gray-800 fs-6">{{$user->userDetails->Designation}}</span>
                                        </div>
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

    @endsection

    @section('page-script')
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->

    @endsection