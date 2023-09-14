@extends('layouts/master-without-nav')
@section('title')
Required User Informaion
@endsection

@section('page-style')
@endsection

@section('content')
<style>
body {
    background-image: url("{{asset('assets/media/auth/bg5.jpg')}}");
}

[data-bs-theme="dark"] body {
    background-image: url("{{asset('assets/media/auth/bg5-dark.jpg')}}");
}
</style>
<div class="d-flex flex-column flex-center flex-column-fluid">
    <div class="d-flex flex-column flex-center text-center p-8">
        <div class="card card-flush w-lg-650px py-1">
            <div class="card-body py-1 py-lg-10">
                <div class="mb-7">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-100px" />
                </div>
                <h1 class="fw-bolder text-gray-900 mb-1">We are almost done</h1>
                <div class="fs-6 mb-1">
                    <span class="fw-semibold text-gray-500">Please fill in all the fields below correctly, and ensure
                        that the names in the fields are similar to those in your passport. Same for passport number,
                        date of birth, and other fields.</span>
                </div>
                <div class="fs-6 mb-1 p-5">
                    <!-- <span class="fw-semibold text-gray-500">Did’t receive verification code?</span> -->
                    <form method="POST" id="save_user_details" action="">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-12 d-flex flex-column mb-8 fv-row fv-plugins-icon-container">

                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">First Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your first name must be the same as in your passport."
                                        data-bs-original-title="Your first name must be the same as in your passport."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    onkeyup="checkTextField(this)" placeholder="Enter First Name" name="first_name"
                                    id="first_name">
                                <div class="fv-plugins-message-container invalid-feedback first_name"></div>
                            </div>

                            <div class=" col-md-6 col-sm-12  d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Middle Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your Middle name must be the same as in your passport."
                                        data-bs-original-title="Your Middle name must be the same as in your passport."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    onkeyup="checkTextField(this)" placeholder="Enter Middle Name " name="middle_name"
                                    id="middle_name">
                                <div class="fv-plugins-message-container invalid-feedback middle_name"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6 col-sm-12  d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Last Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your Last name must be the same as in your passport."
                                        data-bs-original-title="Your Last name must be the same as in your passport."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Last Name"
                                    name="last_name" id="last_name" onkeyup="checkTextField(this)">
                                <div class="fv-plugins-message-container invalid-feedback last_name"></div>
                            </div>

                            <div class=" col-md-6 col-sm-12  d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Passport Number</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Passport Number must be the same as in your passport."
                                        data-bs-original-title="Passport Number must be the same as in your passport."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    placeholder="Enter Passport Number" name="passport_number"
                                    onkeyup="checkTextField(this)" id="passport_number">
                                <div class="fv-plugins-message-container invalid-feedback passport_number"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-12 d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">ID</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your Residency ID." data-bs-original-title="Your ID."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid" placeholder="Enter Your ID"
                                    onkeyup="checkTextField(this)" name="residency_id" id="residency_id">
                                <div class="fv-plugins-message-container invalid-feedback residency_id"></div>
                            </div>

                            <div class="col-md-6 col-sm-12 d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Date of Birth <span
                                            class="text-muted small">(DD/MM/YYYY)</span></span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your Date of Birth must be the same as in your passport."
                                        data-bs-original-title="Your Date of Birth must be the same as in your passport."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid" name="dateofbirth"
                                    id="dateofbirths" onkeyup="checkDateField(this)">
                                <div class="fv-plugins-message-container invalid-feedback dateofbirths"></div>
                            </div>
                        </div>

                        <div class="row company">
                            <div class="col-md-6 col-sm-12 d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <input type="hidden" name="user_type" id="user_type"
                                    value="{{auth()->user()->role_id}}">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Organization Name</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your organization name."
                                        data-bs-original-title="Your organization name."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    onkeyup="checkTextField(this)" placeholder="Enter your organization name"
                                    name="organization_name" id="organization_name">
                                <div class="fv-plugins-message-container invalid-feedback organization_name"></div>
                            </div>

                            <div class=" col-md-6 col-sm-12  d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Designation</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        aria-label="Your designation in your organization."
                                        data-bs-original-title="Your designation in your organization."></i>
                                </label>
                                <input type="text" class="form-control form-control-solid"
                                    onkeyup="checkTextField(this)" placeholder="Enter your designation "
                                    name="designation" id="designation">
                                <div class="fv-plugins-message-container invalid-feedback designation"></div>
                            </div>
                        </div>

                        <div>
                            <div class="fw-bolder text-gray-900 mb-1">
                                <button type="submit" id="save_details" class="btn btn-success">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="py-1 py-lg-10">
                        <form method="POST" action="{{route('logout')}}" id="logout-form">
                            @csrf

                            <span class="fw-semibold text-gray-500">To logout click</span>
                            <a href="javascript:;" onclick="document.getElementById('logout-form').submit();"
                                class="link-primary fs-5 me-1">
                                here <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<script src="{{asset('assets/js/imask.js')}}"></script>
<script src="{{asset('assets/js/user-details.js')}}"></script>
@endsection