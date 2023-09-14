@extends('layouts/master-with-nav')

@section('main-title')
{{auth()->user()->name}}
@endsection

@section('username')
{{auth()->user()->name}}
@endsection

@section('page-style')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@endsection

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <div class="card-header cursor-pointer">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Edit Profile Details</h3>
                    </div>
                </div>
                <div class="card-body p-9">
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <form id="user-basic-form" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Avatar</label>
                                    <div class="col-lg-8" style="text-align: center !important;">
                                        @if(is_null(auth()->user()->avatar))
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="
                                    background-image: url({{asset('assets/media/avatars/blank-main-page.jpg')}});
                                  ">
                                            <div class="image-input-wrapper w-125px h-125px" style="
                                      background-image: url({{asset('assets/media/avatars/blank-main-page.jpg')}});
                                    "></div>
                                            @else
                                            <div class="image-input image-input-outline" data-kt-image-input="true"
                                                style="
                                    background-image: url({{asset('assets/media/avatars/'.$user->avatar)}});
                                  ">
                                                <div class="image-input-wrapper w-125px h-125px" style="
                                      background-image: url({{asset('assets/media/avatars/'.$user->avatar)}});
                                    "></div>
                                                @endif


                                                <input type="hidden" name="user_type" id="user_type"
                                                    value="{{auth()->user()->role_id}}">
                                                <input type="hidden" name="details_id" id="details_id"
                                                    value="{{$user->userDetails->id}}">
                                                <label
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                    title="Change avatar">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                    title="Cancel avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <span
                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                    title="Remove avatar">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                            </div>
                                            <div class="form-text">
                                                Allowed file types: png, jpg, jpeg.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full
                                            Name</label>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-lg-4 fv-row">
                                                    <input type="text" name="fname" id="fname"
                                                        class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                        placeholder="First name" onkeyup="checkTextField(this)"
                                                        value="{{$user->userDetails->First_Name}}" />
                                                    <div class="fv-plugins-message-container invalid-feedback fname">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 fv-row">
                                                    <input type="text" name="mname"
                                                        class="form-control form-control-lg form-control-solid"
                                                        id="mname" placeholder="Middle name"
                                                        onkeyup="checkTextField(this)"
                                                        value="{{$user->userDetails->Middle_Name}}" />
                                                    <div class="fv-plugins-message-container invalid-feedback mname">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 fv-row">
                                                    <input type="text" name="lname" onkeyup="checkTextField(this)"
                                                        id="lname"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="Last name"
                                                        value="{{$user->userDetails->Last_Name}}" />
                                                    <div class="fv-plugins-message-container invalid-feedback lname">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                            Date of Birth</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="date" name="dateOfBirth" onChange="checkDateField(this)"
                                                id="dateOfBirth" class="form-control form-control-lg form-control-solid"
                                                style="text-align: center;" value="{{$user->userDetails->DateOfBirth}}"
                                                min="1900-01-01" max="{{ date('Y-m-d')}}" />
                                            <div class="fv-plugins-message-container invalid-feedback dateOfBirth">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">Passport
                                            Number</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="passport" onkeyup="checkTextField(this)"
                                                id="passport" class="form-control form-control-lg form-control-solid"
                                                placeholder="Passport Number"
                                                value="{{$user->userDetails->Passport}}" />
                                            <div class="fv-plugins-message-container invalid-feedback passport">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">ID/Residence Number</span>

                                        </label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="residenceNumber" onkeyup="checkTextField(this)"
                                                class="form-control form-control-lg form-control-solid "
                                                id="residenceNumber" placeholder="ID/Residence Number"
                                                value="{{$user->userDetails->Residency}}" />
                                            <div class="fv-plugins-message-container invalid-feedback residenceNumber">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-6 company">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Organization Name</span>

                                        </label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="organizationName" onkeyup="checkTextField(this)"
                                                class="form-control form-control-lg form-control-solid"
                                                id="organizationName" placeholder="Organization Name"
                                                value="{{$user->userDetails->Organization_Name}}" />
                                            <div class="fv-plugins-message-container invalid-feedback organizationName">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mb-6 company">
                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                            <span class="required">Designation</span>

                                        </label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="designation" onkeyup="checkTextField(this)"
                                                class="form-control form-control-lg form-control-solid" id="designation"
                                                placeholder="Your Designation"
                                                value="{{$user->userDetails->Designation}}" />
                                            <div class="fv-plugins-message-container invalid-feedback designation">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!(auth()->user()->isIndividual() && $app->status_id = 2))
                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">
                                        Discard
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Save Changes
                                    </button>
                                </div>
                                @endif
                        </form>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Phone Number </h3>
                    </div>
                </div>
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="d-flex flex-wrap align-items-center">
                            <div id="kt_signin_phone">
                                <div class="fs-6 fw-bold mb-1">Phone Number</div>
                                <div class="fw-semibold text-gray-600">
                                    {{$user->phone}}
                                </div>
                            </div>
                            <div id="kt_signin_phone_edit" class="flex-row-fluid d-none">
                                <form id="user-phone" class="form" method="POST">
                                    @csrf
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="phone" class="form-label fs-6 fw-bold mb-3">Enter New
                                                    Phone
                                                    Number</label><br />
                                                <input id="phone" type="tel" name="phone"
                                                    class="form-control form-control-lg form-control-solid"
                                                    onkeyup="check_phone()" value="{{$user->phone}}" />
                                                <input type="hidden" name="phone_number" id="phone_number"
                                                    class="form-control bg-transparent" />
                                                <div
                                                    class="fv-plugins-message-container invalid-feedback designation phone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button id="savePhone" type="submit" class="btn btn-primary me-2 px-6">
                                            Verify
                                        </button>
                                        <button id="kt_signin_cancel_phone" type="button"
                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @if(!(auth()->user()->isIndividual() && $app->status_id = 2))
                            <div id="kt_signin_phone_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">
                                    Change Phone
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_account_signin_method">
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">Sign-in Method</h3>
                    </div>
                </div>
                <div id="kt_account_settings_signin_method" class="collapse show">
                    <div class="card-body border-top p-9">
                        <div class="d-flex flex-wrap align-items-center">
                            <div id="kt_signin_email">
                                <div class="fs-6 fw-bold mb-1">Email Address</div>
                                <div class="fw-semibold text-gray-600">
                                    {{$user->email}}
                                </div>
                            </div>
                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                <form id="user-email" class="form" method="POST">
                                    @csrf
                                    <div class="row mb-6">
                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                            <div class="fv-row mb-0">
                                                <label for="emailaddress" class="form-label fs-6 fw-bold mb-3">Enter
                                                    New
                                                    Email Address</label>
                                                <input type="email"
                                                    class="form-control form-control-lg form-control-solid"
                                                    onkeyup="checkEmail()" id="emailaddress" placeholder="Email Address"
                                                    name="emailaddress" value="{{$user->email}}" />
                                                <div
                                                    class="fv-plugins-message-container invalid-feedback designation emailaddress">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="fv-row mb-0">
                                                <label for="confirmemailpassword"
                                                    class="form-label fs-6 fw-bold mb-3">Confirm Password</label>
                                                <input type="password" onkeyup="checkEmailPassword()"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="confirmemailpassword" id="confirmemailpassword" />
                                                <div
                                                    class="fv-plugins-message-container invalid-feedback designation confirmemailpassword">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button id="saveEmail" type="submit" class="btn btn-primary me-2 px-6">
                                            Update Email
                                        </button>
                                        <button id="kt_signin_cancel" type="button"
                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            @if(!(auth()->user()->isIndividual() && $app->status_id = 2))
                            <div id="kt_signin_email_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">
                                    Change Email
                                </button>
                            </div>
                            @endif
                        </div>
                        <div class="separator separator-dashed my-6"></div>
                        <div class="d-flex flex-wrap align-items-center mb-10">
                            <div id="kt_signin_password">
                                <div class="fs-6 fw-bold mb-1">Password</div>
                                <div class="fw-semibold text-gray-600">
                                    ************
                                </div>
                            </div>
                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                <form id="user-password" class="form" method="POST">
                                    @csrf
                                    <div class="row mb-1">
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="currentpassword"
                                                    class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                                <input type="password" onkeyup="checkCurrentPassword()"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="currentpassword" id="currentpassword" />
                                                <div
                                                    class="fv-plugins-message-container invalid-feedback currentpassword">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="newpassword" class="form-label fs-6 fw-bold mb-3">New
                                                    Password</label>
                                                <input type="password" onkeyup="checkPassword()"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="newpassword" id="newpassword" />
                                                <div class="fv-plugins-message-container invalid-feedback newpassword">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="fv-row mb-0">
                                                <label for="confirmpassword"
                                                    class="form-label fs-6 fw-bold mb-3">Confirm New
                                                    Password</label>
                                                <input type="password" onkeyup="checkConfirmPassword()"
                                                    class="form-control form-control-lg form-control-solid"
                                                    name="confirmpassword" id="confirmpassword" />
                                                <div
                                                    class="fv-plugins-message-container invalid-feedback confirmpassword">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-text mb-5">
                                        Password must be at least 8 character and
                                        contain small letters, capital letters, numbers and symbols
                                    </div>
                                    <div class="d-flex">
                                        <button id="savePassword" type="submit" class="btn btn-primary me-2 px-6">
                                            Update Password
                                        </button>
                                        <button id="kt_password_cancel" type="button"
                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div id="kt_signin_password_button" class="ms-auto">
                                <button class="btn btn-light btn-active-light-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="verify_phone_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="get" id="verify-phone">
                    @csrf
                    <div class="text-center mb-10 phone-verification-show">
                        <img alt="Logo" class="mh-125px" src="{{asset('assets/media/svg/misc/smartphone-2.svg')}}" />
                    </div>
                    <div class="text-center mb-10 whatsapp-verification-show" style="display:none">
                        <img alt="Logo" class="mh-125px" src="{{asset('assets/media/svg/misc/Whats_app.jpg')}}" />
                    </div>
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Phone Verification</h1>
                        <div class="text-muted fw-semibold fs-5 mb-5">Enter the verification code we sent to</div>
                        <div class="fw-bold text-success fs-3 new_user_phone_number">
                        </div>
                        <input type="hidden" name="phone_number" value="" id="new_user_phone_number_value">
                        <input type="hidden" name="verification_type" id="verification_type" value="twilio">
                    </div>
                    <div class="mb-4">
                        <div class="text-center mb-4">
                            <div class="text-muted fw-semibold "><b>Time remaining: <span class="timerPhone"
                                        id="timerPhone"></span></b>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-stack">
                            <input id="verification_code" class="form-control block mt-1 w-full"
                                onkeyup="checkVerifyPhone()" type="text" name="verification_code"
                                placeholder="Type your 6 digit security code" required autofocus />
                            <div class="fv-plugins-message-container invalid-feedback verification_code">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-center mb-4">
                        <button type="submit" id="kt_sing_in_two_steps_submit" class="btn btn-lg btn-primary fw-bold">
                            <span class="indicator-label">Verify</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>

                <div class="row">
                    <div class="d-flex flex-center flex-column-fluid ">
                        <span class="text-muted me-1">Didn’t get the code ?</span>
                        <form method="POST" action="{{ route('send_otp') }}" id="sendOPTphone">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <a href="javascript:;" class="link-primary fs-5 me-1"
                                onClick="resendPhoneCode('twilio');">Resend</a>
                        </form>
                    </div>
                    <div class="d-flex flex-center flex-column-fluid  ">
                        <span class="text-muted me-1"> Or use Whatsapp to
                            receive the code</span>
                        <form method="POST" action="" id="sendOPTWhatsapp">
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <button type="button" onClick="resendPhoneCode('whatsapp');"
                                class="btn btn-sm btn-outline-success">Whatsapp
                                code <span id="boot-icon" class="bi bi-whatsapp"></span></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="verify_email_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form method="get" id="verify-email">
                    @csrf
                    <div class="text-center mb-10">
                        <img alt="Logo" class="mh-125px"
                            src="{{asset('assets/media/auth/please-verify-your-email.png')}}" />
                    </div>
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Email Verification</h1>
                        <div class="text-muted fw-semibold fs-5 mb-5">Enter the verification code we sent to</div>
                        <div class="fw-bold text-success fs-3 new_user_email">
                        </div>
                        <input type="hidden" name="new_email_not_verified" value="" id="new_email_not_verified">
                    </div>
                    <div class="mb-4">
                        <div class="text-center mb-4">
                            <div class="text-muted fw-semibold "><b>Time remaining: <span class="timerEmail"
                                        id="timerEmail"></span></b>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-stack">
                            <input id="verification_code_email" class="form-control block mt-1 w-full"
                                onkeyup="checkVerifyEmailCode()" type="text" name="verification_code_email"
                                placeholder="Type your 8 digit verification code" required autofocus />
                            <div class="fv-plugins-message-container invalid-feedback verification_code_email">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-center mb-4">
                        <button type="submit" id="kt_sing_in_two_steps_submit" class="btn btn-lg btn-primary fw-bold">
                            <span class="indicator-label">Verify</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>

                <div class="row">
                    <div class="d-flex flex-center flex-column-fluid ">
                        <span class="text-muted me-1">Didn’t get the code ?</span>
                        <form method="POST" action="#" id="sendVerificationCodeemail">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <a href="javascript:;" class="link-primary fs-5 me-1"
                                onClick="resendEmailCode();">Resend</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/account/settings/signin-methods.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="{{asset('assets/js/user-account.js')}}"></script>
@endsection