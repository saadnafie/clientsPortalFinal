@extends('layouts/master-without-nav')
@section('title')
Create New Account
@endsection

@section('page-style')
<!-- <link rel="stylesheet" href="{{asset('assets/css/intlTelInput.css')}}"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
@endsection


@section('content')
<div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep"
    id="kt_create_account_stepper">
    <div class="d-flex flex-column flex-lg-row-auto w-lg-350px w-xl-400px">
        <div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-350px w-xl-400px scroll-y bgi-size-cover bgi-position-center"
            style="background-image: url(assets/media/misc/background1.jpg)">
            <div class="d-flex flex-center py-10 py-lg-20">
                <a href="{{url('register')}}">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-80px" />
                </a>
            </div>
            <div class="d-flex flex-row-fluid justify-content-center p-2">
                <div class="stepper-nav">
                    <div class="stepper-item current" data-kt-stepper-element="nav">
                        <div class="stepper-wrapper">
                            <div class="stepper-icon rounded-3">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">1</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title fs-2">Account Type</h3>
                                <div class="stepper-desc fw-normal">Select your account type</div>
                            </div>
                        </div>
                        <div class="stepper-line h-40px"></div>
                    </div>
                    <div class="stepper-item" data-kt-stepper-element="nav">
                        <div class="stepper-wrapper">
                            <div class="stepper-icon">
                                <i class="stepper-check fas fa-check"></i>
                                <span class="stepper-number">2</span>
                            </div>
                            <div class="stepper-label">
                                <h3 class="stepper-title">Account Authentication</h3>
                                <div class="stepper-desc fw-normal">Setup your account authentication</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-gray-100 text-center fw-semibold fs-6">
                Already have an Account?
                <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
            </div>
            <!-- <div class="d-flex flex-center flex-wrap px-5 py-10">
                <div class="d-flex fw-normal">
                    <a href="#" class="text-success px-5" target="_blank">Terms</a>
                    <a href="#" class="text-success px-5" target="_blank">Plans</a>
                    <a href="#" class="text-success px-5" target="_blank">Contact
                        Us</a>
                </div>
            </div> -->
        </div>
    </div>
    <div class="d-flex flex-column flex-lg-row-fluid py-10">
        <div class="d-flex flex-center flex-column flex-column-fluid">
            <div class="w-lg-650px w-xl-800px p-10 p-lg-15 mx-auto">
                <form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form" method="POST"
                    action="{{ route('register') }}">
                    <div class="current" data-kt-stepper-element="content">
                        <div class="w-100">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bold d-flex align-items-center text-dark">
                                    Choose Account Type
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        title="If you are individual, please select individual account. Otherwise, select company account"></i>
                                </h2>
                                <div class="text-muted fw-semibold fs-6">
                                    Select you account type
                                </div>
                            </div>
                            <div class="fv-row">
                                <div class="row pb-10">
                                    <div class="col-lg-6">
                                        <input type="radio" class="btn-check" name="account_type" value="3"
                                            id="kt_create_account_form_account_type_personal" />
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10"
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
                                                <span class="text-dark fw-bold d-block fs-4 mb-2">Personal
                                                    Account</span>
                                                <span class="text-muted fw-semibold fs-6">Personal
                                                    Account</span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="radio" class="btn-check" name="account_type" value="2"
                                            id="kt_create_account_form_account_type_corporate" />
                                        <label
                                            class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center"
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
                                                <span class="text-dark fw-bold d-block fs-4 mb-2">Company
                                                    Account</span>
                                                <span class="text-muted fw-semibold fs-6">Company Account</span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="row pb-10 account-type-validate physician-show">
                                    <div class="d-flex flex-stack">
                                        <div class="me-5">
                                            <div class="fw-semibold">
                                                <h4 class="text-gray-900 fw-bold">
                                                    Are you Physician?
                                                </h4>
                                                <div class="fs-6 text-gray-700">
                                                    If you are a physician, please select YES
                                                </div>
                                            </div>
                                        </div>
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <span class="form-check-label fw-semibold text-muted px-2">No
                                            </span>
                                            <input class="form-input physician-no" name="physician" type="radio"
                                                value="0" />
                                            <span class="form-check-label fw-semibold text-muted px-2">Yes</span>
                                            <input class="form-input physician-yes" name="physician" type="radio"
                                                value="1" />
                                        </label>
                                    </div>
                                </div>
                                <div class="row pb-10 account-type-validate equivalency-show">
                                    <div class="d-flex flex-stack">
                                        <div class="me-5">
                                            <div class="fw-semibold">
                                                <h4 class="text-gray-900 fw-bold">
                                                    Are you Equivalency?
                                                </h4>
                                                <div class="fs-6 text-gray-700">
                                                    If you are equivalency, please select YES
                                                </div>
                                            </div>
                                        </div>
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <span class="form-check-label fw-semibold text-muted px-2">No
                                            </span>
                                            <input class="form-input equivalency-no" name="equivalency" type="radio"
                                                value="0" />
                                            <span class="form-check-label fw-semibold text-muted px-2">Yes</span>
                                            <input class="form-input equivalency-yes" name="equivalency" type="radio"
                                                value="1" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="" data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bold text-dark">
                                    Account Authentication
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                        title="Enter your credentials information to validate them and allow you to access the portal"></i>
                                </h2>

                                <div class="text-muted fw-semibold fs-6">
                                    Please fill in all the required fields
                                </div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" autocomplete="off"
                                    class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row mb-8 text-center">
                                <div class="col-md-12">
                                    <input id="phone" type="tel" name="phone_number" class="form-control bg-transparent"
                                        onkeyup="check_phone()" />
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="phone" id="phone_check"
                                        class="form-control bg-transparent" />
                                </div>
                            </div>
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password"
                                            placeholder="Password" name="password" autocomplete="off" />
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    Use 8 or more characters with a mix of small letters, capital letters, numbers
                                    & symbols.
                                </div>
                            </div>
                            <div class="fv-row mb-8">
                                <input placeholder="Repeat Password" name="confirmpassword" type="password"
                                    autocomplete="off" class="form-control bg-transparent" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-stack pt-15">
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3"
                                data-kt-stepper-action="previous">
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
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                                <span class="indicator-label">Register
                                    <span class="svg-icon svg-icon-4 ms-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                transform="rotate(-180 18 13)" fill="currentColor" />
                                            <path
                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">Continue
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
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
<!-- <script src="{{asset('assets/js/utils.js')}}"></script>
<script src="{{asset('assets/js/intlTelInput.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-account.js')}}"></script>
@endsection