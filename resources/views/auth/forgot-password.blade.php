@extends('layouts/master-without-nav')
@section('title')
    Reset password
@endsection

@section('page-style')
@endsection

@section('content')
    <style>
        body {
            background-image: url("assets/media/auth/bg10.jpeg");
        }

        [data-bs-theme="dark"] body {
            background-image: url("assets/media/auth/bg10-dark.jpeg");
        }
    </style>
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{asset('assets/media/auth/csg-thumbnel.png')}}" alt=""/>
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                     src="{{asset('assets/media/auth/csg-thumbnel.png')}}" alt=""/>
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
                    <div class="pb-15 pb-lg-20">

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="text-center mb-10">
                                <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
                                <div class="text-gray-500 fw-semibold fs-6">
                                    Enter your email to reset your password.
                                </div>
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" id="email" autocomplete="off"
                                       class="form-control @error('email') is-invalid @enderror bg-transparent"/>
                                @error('email')
                                <span class=" invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror

                            </div>
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="submit" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                    <span class="indicator-label">Send</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
                            </div>
                            <br/>
                            @if (session('status'))
                                <div class="alert alert-success mb-1 text-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <!-- <script src="{{asset('assets/js/custom/authentication/reset-password/reset-password.js')}}"></script> -->
@endsection
