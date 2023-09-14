@extends('layouts/master-with-nav')
@section('main-title')
New Application
@endsection

@section('username')
{{auth()->user()->name}}
@endsection

@section('page-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
@endsection

@section('content')
<style>
.hide-content {
    display: none;
}
</style>




<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
										<div class="col-sm-12 col-md-8 col-lg-8 col-xxl-8">
											<div class="card card-flush overflow-hidden">
												<div class="card-body d-flex justify-content-between flex-column pt-0 pb-1 px-0">
													<div class="px-9 mb-5">
														  <form action="{{route('application-processes.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @if(auth()->user()->role_id == 2 )
                <div class="tab" id="step1">
                    <div class="pb-3 pt-4 pb-lg-15">
                        <h2 class="fw-bold d-flex align-items-center text-dark">
                            Are you Physician?
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Note: physician is not allowed to
                    create a new application"></i>
                        </h2>
                        <div class="text-muted fw-semibold fs-6">
                            If you are a physician, please select YES. Otherwise, select No
                        </div>
                    </div>
                    <div class="fv-row">
                        <div class="row pb-3">
                            <div class="col-sm-6 col-md-6">
                                <input type="radio" name="physician_val" class="btn-check physician_val_yes" required
                                    value="true" id="kt_create_account_form_account_type_personal1" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-danger p-3 d-flex align-items-center mb-10"
                                    for="kt_create_account_form_account_type_personal1">
                                    <span class="svg-icon svg-icon-3x me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                fill="currentColor" />
                                            <path opacity="0.3"
                                                d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">Yes</span>
                                        <span class="text-muted fw-semibold fs-6">I'm a physician</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <input type="radio" name="physician_val" class="btn-check physician_val_no"
                                    id="kt_create_account_form_account_type_corporate1" value="false" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-danger p-3 d-flex align-items-center"
                                    for="kt_create_account_form_account_type_corporate1">
                                    <span class="svg-icon svg-icon-3x me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                fill="currentColor" />
                                            <path
                                                d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">No</span>
                                        <span class="text-muted fw-semibold fs-6">I'm not a physician</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="pb-3 pb-lg-15 hide-content" style="display:none">
                        <h2 class="fw-bold d-flex align-items-center text-dark">
                            Are you Equivalency?
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Note: equivalency is not allowed to
                    create a new application"></i>
                        </h2>
                        <div class="text-muted fw-semibold fs-6">
                            If you are a equivalency, please select YES. Otherwise, select No
                        </div>
                    </div>
                    <div class="fv-row hide-content">
                        <div class="row pb-3">
                            <div class="col-sm-6 col-md-6">
                                <input type="radio" name="equivalency_val" class="btn-check equivalency_val_yes"
                                    value="true" id="kt_create_account_form_account_type_personal" required/>
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-danger p-3 d-flex align-items-center mb-10"
                                    for="kt_create_account_form_account_type_personal">
                                    <span class="svg-icon svg-icon-3x me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                fill="currentColor" />
                                            <path opacity="0.3"
                                                d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">Yes</span>
                                        <span class="text-muted fw-semibold fs-6">I'm equivalency</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <input type="radio" name="equivalency_val" class="btn-check equivalency_val_no"
                                    value="false" id="kt_create_account_form_account_type_corporate" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-danger p-3 d-flex align-items-center"
                                    for="kt_create_account_form_account_type_corporate">
                                    <span class="svg-icon svg-icon-3x me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                fill="currentColor" />
                                            <path
                                                d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">No</span>
                                        <span class="text-muted fw-semibold fs-6">I'm not an equivalency</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-stack pt-0 hide-content" style="float:right !important">
                        <div>
                            <button type="button" class="btn btn-lg btn-primary" onclick="display_next_step()">Next
                                <span class="svg-icon svg-icon-4 ms-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                            transform="rotate(-180 18 13)" fill="currentColor" />
                                        <path
                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <div class="tab" id="step2">
                    <div class="pb-3 pb-lg-15 pt-4">
                        <h2 class="fw-bold d-flex align-items-center text-dark">
                            Do you have license issues with MOHK ?
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                title="Note: If you have a license issues with MOHK, please select YES. Otherwise, select No"></i>
                        </h2>
                        <div class="text-muted fw-semibold fs-6">
                            If you have a license issues with MOHK, please select YES. Otherwise, select No
                        </div>
                    </div>
                    <div class="fv-row">
                        <div class="row pb-3">
                            <div class="col-sm-6 col-md-6">
                                <input type="radio" onclick="display_license_detail()" name="application_type"
                                    class="btn-check application_type_renew" value="2"
                                    id="kt_create_account_form_account_type_personal2" required/>
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-danger p-3 d-flex align-items-center mb-10"
                                    for="kt_create_account_form_account_type_personal2">
                                    <span class="svg-icon svg-icon-3x me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                                fill="currentColor" />
                                            <path opacity="0.3"
                                                d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">Yes</span>
                                        <span class="text-muted fw-semibold fs-6">I have MOHK License</span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <input type="radio" name="application_type" onclick="display_license_detail()"
                                    class="btn-check application_type_new"
                                    id="kt_create_account_form_account_type_corporate2" value="1" />
                                <label
                                    class="btn btn-outline btn-outline-dashed btn-active-light-danger p-3 d-flex align-items-center"
                                    for="kt_create_account_form_account_type_corporate2">
                                    <span class="svg-icon svg-icon-3x me-5">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3"
                                                d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                fill="currentColor" />
                                            <path
                                                d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <span class="d-block fw-semibold text-start">
                                        <span class="text-dark fw-bold d-block fs-4 mb-2">No</span>
                                        <span class="text-muted fw-semibold fs-6">I don't have MOHK License</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="license_detail">
                        <div class="w-100">
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">license Number</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Enter your license number"
                                        data-bs-original-title="Enter your license number"></i>
                                </label>
                                <input type="text" placeholder="license No" name="license_no" autocomplete="off"
                                    class="form-control form-control-lg form-control-solid center-date" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Issue Date</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Enter your license issue date"
                                        data-bs-original-title="Enter your license issue date"></i>
                                </label>
                                <input type="date" name="issue_date" id="issue_date" autocomplete="off"
                                    class="form-control form-control-lg form-control-solid center-date" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Expiry Date</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Enter your license Expiry Date"
                                        data-bs-original-title="Enter your license Expiry Date"></i>
                                </label>
                                <input type="date" name="expiry_date" id="expiry_date" autocomplete="off"
                                    class="form-control form-control-lg form-control-solid center-date" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-stack pt-15">
                        @if(auth()->user()->role_id == 2 )
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3"
                                onclick="display_previous_step()">
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                            fill="currentColor" />
                                        <path
                                            d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                Previous
                            </button>
                        </div>
                        @endif
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary">Submit
                                <span class="svg-icon svg-icon-4 ms-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                            transform="rotate(-180 18 13)" fill="currentColor" />
                                        <path
                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-4 col-xxl-4">
											<div class="card " dir="ltr">
												<div class="card-body d-flex flex-column flex-center">
													<div class="mb-2">
														<h3 class="fw-semibold text-gray-800 text-center lh-lg">
														<span class="fw-bolder">New Application</span></h3>
														<div class="py-10 text-center">
															<img src="{{asset('assets/media/svg/note_taking.svg')}}" class="theme-light-show w-200px" alt="" />
															<img src="{{asset('assets/media/svg/note_taking.svg')}}" class="theme-dark-show w-200px" alt="" />
														</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    document.getElementById("license_detail").style.display = "none";

    var accountType = "{{ auth()->user()->isCompany()}}";
    console.log(accountType);
    if (accountType == true) {
        document.getElementById("step1").style.display = "block";
        document.getElementById("step2").style.display = "none";
    } else {
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
    }
});

function display_license_detail() {
    if (document.getElementById('kt_create_account_form_account_type_personal2').checked) {
        document.getElementById("license_detail").style.display = "block";
        $('input:text[name="license_no"]').prop('required', true);
        $('input:text[name="issue_date"]').prop('required', true);
        $('input:text[name="expiry_date"]').prop('required', true);
    } else {
        document.getElementById("license_detail").style.display = "none";
        $('input:text[name="license_no"]').prop('required', false);
        $('input:text[name="issue_date"]').prop('required', false);
        $('input:text[name="expiry_date"]').prop('required', false);
    }
}

function display_next_step() {
    if (document.getElementById('kt_create_account_form_account_type_corporate1').checked && document.getElementById(
            'kt_create_account_form_account_type_corporate').checked) {
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
    } else {
        Swal.fire({
            text: "Sorry, Equivalency is not allowed to create new application",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-light",
            },
        }).then(function() {
            window.location = "{{ route('applications.create') }}";
        });
        // {{ url('new application') }}
    }
}

function display_previous_step() {
    document.getElementById("step2").style.display = "none";
    document.getElementById("step1").style.display = "block";
}

$('input:radio[name="physician_val"]').change(function() {
    const physician_val_check = $('input[name=physician_val]:checked').val();
    if (physician_val_check == 'true') {
        Swal.fire({
            text: "Sorry, Physician is not allowed to create new application",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-light",
            },
        }).then(function() {
            window.location = "{{ route('applications.create') }}";
        });
    } else {
        $('.hide-content').css('display', 'block');
    }
});


$('#issue_date').change(function() {
    const date_expire = $('#issue_date').val();
    $('#expiry_date').val(date_expire);
    jQuery('#expiry_date').attr('min', date_expire);

    // if (physician_val_check == 'true') {
    //     Swal.fire({
    //         text: "Sorry, Physician is not allowed to create new application",
    //         icon: "error",
    //         buttonsStyling: !1,
    //         confirmButtonText: "Ok, got it!",
    //         customClass: {
    //             confirmButton: "btn btn-light",
    //         },
    //     }).then(function() {
    //         window.location = "{{ route('applications.create') }}";
    //     });
    // } else {
    //     $('.hide-content').css('display', 'block');
    // }
});
</script>
@endsection