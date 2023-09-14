@extends('layouts/master-without-nav')
@section('title')
Verify Phone Number
@endsection

@section('page-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
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

                <div>
                    <div class="mb-7 phone-verification-show">
                        <img alt="Logo" class="h-150px" src="{{asset('assets/media/svg/misc/smartphone-2.svg')}}" />
                    </div>
                    <div class="mb-7 whatsapp-verification-show" style="display:none">
                        <img alt="Logo" class="h-150px" src="{{asset('assets/media/svg/misc/Whats_app.jpg')}}" />
                    </div>
                    <div class="text-center mb-5">
                        <h1 class="text-dark mb-3">Phone Verification</h1>
                        <div class="text-muted fw-semibold fs-5 mb-5">Please enter the code sent to <span
                                class="text-success"><b>{{auth()->user()->phone}}</b></span></div>

                        <a href="/customer/verify-phone" class="text-muted fw-semibold fs-5 mb-5 csg-color">Click here
                            to
                            change
                            your phone
                            number</a>
                    </div>
                    <div class="text-center mb-5">
                        <div class="text-muted fw-semibold "><b>Time remaining: <span class="timerPhone"
                                    id="timerPhone"></span></b>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('verify_otp') }}" id="verify_phone_code"
                        class="form w-100 mb-5" novalidate="novalidate">
                        @csrf
                        <div class="mb-5">
                            <div class="d-flex flex-wrap flex-stack justify-content-center">
                                <input class="form-control block mt-1  w-50" onkeyup="checkVerifyPhone()" type="text"
                                    id="verification_code" name="verification_code" required autofocus />
                                <div class="fv-plugins-message-container invalid-feedback verification_code">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="verification_type" id="verification_type" value="twilio">
                        <div class="d-flex flex-center">
                            <div class="d-flex flex-wrap">
                                <button type="submit" id="kt_sing_in_two_steps_submit"
                                    class="btn btn-lg btn-primary fw-bold">
                                    <span class="indicator-label">Verify</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>

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
                                receive the verification code</span>
                            <form method="POST" action="" id="sendOPTWhatsapp">
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button type="button" onClick="resendPhoneCode('whatsapp');"
                                    class="btn btn-outline-success">Get Whatsapp
                                    code <span id="boot-icon" class="bi bi-whatsapp"></span></button>
                            </form>
                        </div>

                        <div class="d-flex flex-center flex-column-fluid  ">
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
</div>
@endsection
@section('page-script')
<script src="{{asset('assets/js/verify-check.js')}}"></script>
@endsection