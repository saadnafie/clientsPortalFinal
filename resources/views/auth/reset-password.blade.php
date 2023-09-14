@extends('layouts/master-without-nav')
@section('title')
    Reset Password
@endsection

@section('page-style')
@endsection

@section('content')
    <style>
        body {
            background-image: url("{{asset('assets/media/auth/bg10.jpeg')}}");
        }

        [data-bs-theme="dark"] body {
            background-image: url("{{asset('assets/media/auth/bg10-dark.jpeg')}}");
        }
    </style>

    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{asset('assets/media/auth/agency.png')}}" alt=""/>
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{asset('assets/media/auth/agency-dark.png')}}" alt=""/>
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
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                        <form method="POST" action="{{ route('password.store') }}" class="form w-100">

                            <div class="text-center mb-10">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                <h1 class="text-dark fw-bolder mb-3">Setup New Password</h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    Have you already reset the password ?
                                    <a href="{{ route('login') }}" class="link-primary fw-bold">Sign in</a>
                                </div>
                            </div>
                            <div class="fv-row mb-8">

                                <x-text-input id="email" class="form-control bg-transparent " type="email" name="email"
                                              :value="old('email', $request->email)" required autofocus/>
                                <x-input-error :messages="$errors->get('email')" class="mt-2"/>

                            </div>
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <div class="position-relative mb-3">

                                        <x-text-input id="password" class="form-control bg-transparent"
                                                      autocomplete="off"
                                                      type="password" name="password" required placeholder="Password"/>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2"/>

                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                        <i class="bi bi-eye-slash fs-2"></i>
                                        <i class="bi bi-eye fs-2 d-none"></i>
                                    </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3"
                                         data-kt-password-meter-control="highlight">
                                        <div
                                            class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div
                                            class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div
                                            class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                </div>
                                <div class="text-muted">
                                    Use 8 or more characters with a mix of letters, numbers &
                                    symbols.
                                </div>
                            </div>
                            <div class="fv-row mb-8">

                                <x-text-input id="password_confirmation" class="form-control bg-transparent"
                                              type="password"
                                              name="password_confirmation" placeholder="Repeat Password"
                                              autocomplete="off"
                                              required/>

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                            </div>
                            <div class="d-grid mb-10">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </x-primary-button>
                                <!-- <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
                                    <span class="indicator-label">Save</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button> -->
                            </div>
                        </form>
                    </div>
                    <div class="w-lg-500px d-flex flex-stack">
                        <div class="me-10">
                            <button
                                class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
                                data-kt-menu-offset="0px, 0px">
                                <img data-kt-element="current-lang-flag" class="w-20px h-20px rounded me-3"
                                     src="{{asset('assets/media/flags/united-states.svg')}}" alt=""/>
                                <span data-kt-element="current-lang-name" class="me-1">English</span>
                                <span class="svg-icon svg-icon-5 svg-icon-muted rotate-180 m-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                        fill="currentColor"/>
                                </svg>
                            </span>
                            </button>
                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-4 fs-7"
                                data-kt-menu="true" id="kt_auth_lang_menu">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="English">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1"
                                             src="{{asset('assets/media/flags/united-states.svg')}}" alt=""/>
                                    </span>
                                        <span data-kt-element="lang-name">English</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link d-flex px-5" data-kt-lang="Arabic">
                                    <span class="symbol symbol-20px me-4">
                                        <img data-kt-element="lang-flag" class="rounded-1"
                                             src="{{asset('assets/media/flags/saudi-arabia.svg')}}" alt=""/>
                                    </span>
                                        <span data-kt-element="lang-name">Arabic</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="d-flex fw-semibold text-primary fs-base gap-5">
                            <a href="#" target="_blank">Terms</a>
                            <a href="#" target="_blank">Plans</a>
                            <a href="#" target="_blank">Contact Us</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/custom/authentication/reset-password/new-password.js')}}"></script>
@endsection
