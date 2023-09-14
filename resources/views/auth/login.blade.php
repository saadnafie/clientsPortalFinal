@extends('layouts/master-without-nav')
@section('title')
Sign in
@endsection

@section('page-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@endsection


@section('content')

<style>
body {
    background-image: url("assets/media/auth/bg10.jpeg");
}

.g-recaptcha {
    display: inline-block;
}

[data-bs-theme="dark"] body {
    background-image: url("assets/media/auth/bg10-dark.jpeg");
}
</style>
<div class="d-flex flex-column flex-lg-row flex-column-fluid">
    <div class="d-flex flex-lg-row-fluid">
        <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
            <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                src="{{asset('assets/media/auth/csg-thumbnel.png')}}" alt="" />
            <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                src="{{asset('assets/media/auth/csg-thumbnel.png')}}" alt="" />
            <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
                Clients Portal
            </h1>
            <div class="text-gray-600 fs-base text-center fw-semibold">
                CSG offers the simplest background check workflow in the industry,
                making it easy for you to order and for your candidates to
                complete.
            </div>
        </div>
    </div>

    <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end ">
        <div class="bg-body d-flex flex-column flex-center rounded-4  p-10">
            <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                <div class="pb-1 pb-lg-1">
                    <div class="d-flex flex-center pb-7">
                        <a href="{{url('login')}}">
                            <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-80px" />
                        </a>
                    </div>

                    <div class="text-center mb-11 pt-1">
                        <h1 class="text-dark fw-bolder mb-3 ">Sign In</h1>
                    </div>
                    <div class="row g-3 mb-1">
                        <ul class="nav nav-pills  nav-justified mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-email-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-email" type="button" role="tab" aria-controls="pills-email"
                                    aria-selected="true"><i class="fa fa-envelope fa-icon-login" aria-hidden="true"></i>
                                    Email
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-phone-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-phone" type="button" role="tab" aria-controls="pills-phone"
                                    aria-selected="false"><i class="fa fa-mobile fa-icon-login" aria-hidden="true"></i>
                                    Phone
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-email" role="tabpanel"
                                aria-labelledby="pills-email-tab">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row g-3 mb-9">
                                        <input type="text" placeholder="Email" name="email" id="login-email"
                                            autocomplete="off"
                                            class="form-control @error('email') is-invalid @enderror bg-transparent"
                                            autofocus value="{{ old('email') }}" />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="fv-row mb-3">
                                        <input type="password" placeholder="Password" id="login-password"
                                            name="password" autocomplete="off"
                                            class="form-control @error('password') is-invalid @enderror bg-transparent"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                            aria-describedby="password" />

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                        <div></div>
                                        <a href="{{ route('password.request') }}" class="link-primary">Forgot
                                            Password
                                            ?</a>
                                    </div>

                                    <div class="fv-row mb-3 ">
                                        <div
                                            class="form-group text-center {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }} ">
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}
                                            <br>
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback p-1" role="alert">

                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                            @enderror

                                            @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block  p-1" style="color:#f1416c;">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                            <span class="indicator-label">Sign In</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-phone" role="tabpanel"
                                aria-labelledby="pills-phone-tab">
                                <form method="POST" action="#" id="login-phone">
                                    @csrf
                                    <div class="row g-3 mb-9 text-center">
                                        <input id="phone" type="tel" name="phone" class="form-control bg-transparent"
                                            onkeyup="check_phone()" />
                                        <div class="fv-plugins-message-container invalid-feedback phone">
                                        </div>
                                        <input type="hidden" name="phone_number" id="phone_number"
                                            class="form-control bg-transparent" />
                                    </div>
                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit"
                                            class="btn btn-primary phone_button_login">
                                            <span class="indicator-label">Sign In</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-gray-500 text-center fw-semibold fs-6">
                        Not a Member yet?
                        <a href="{{url('register')}}" class="link-primary">Sign up</a>
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
                <form method="post" action="#" id="verify-phone">
                    @csrf
                    <div class="text-center mb-10 phone-verification-show">
                        <img alt="Logo" class="mh-125px" src="{{asset('assets/media/svg/misc/smartphone-2.svg')}}" />
                    </div>
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Phone Verification</h1>
                        <div class="text-muted fw-semibold fs-5 mb-5">Enter the verification code we sent to</div>
                        <div class="fw-bold text-success fs-3 user_phone_number">
                        </div>
                        <input type="hidden" name="phone_number" value="" id="user_phone_number_value">
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
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="{{asset('assets/js/sign-in.js')}}"></script>
@endsection