@extends('layouts/master-without-nav')
@section('title')
Verify Email
@endsection

@section('page-style')
@endsection

@section('content')
<style>
body {
    background-image: url("assets/media/auth/bg5.jpg");
}

[data-bs-theme="dark"] body {
    background-image: url("assets/media/auth/bg5-dark.jpg");
}
</style>
<div class="d-flex flex-column flex-center flex-column-fluid">
    <div class="d-flex flex-column flex-center text-center p-8">
        <div class="card card-flush w-lg-650px py-1">
            <div class="card-body py-1 py-lg-10">
                <div class="mb-2">
                    <img src="{{asset('assets/media/auth/please-verify-your-email.png')}}"
                        class="mw-100 mh-150px theme-light-show" alt="" />
                    <!-- <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-100px" /> -->
                </div>
                <h1 class="fw-bolder text-gray-900 mb-7">Verify your email</h1>
                <div class="fs-6 mb-6">
                    <span class="fw-semibold text-gray-500">Account activation code sent to your email address:
                        <span class="text-success"><strong>{{Auth::user()->email}}</strong> </span><br>
                        Please follow the link inside to continue.</span>
                </div>
                <div class="fs-6 mb-1">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf


                        <span class="fw-semibold text-gray-500">Did’t receive an email?</span>
                        <button type="submit" class="btn btn-label-secondary">
                            Try again
                        </button>
                    </form>
                </div>
                <div class="mb-0"></div>

                <div class="mb-0">

                    <form method="POST" action="{{route('logout')}}">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')
@if (session('status') == 'verification-link-sent')
<script>
swal.fire({
    title: "Thank you!",
    text: " A new activation code has been sent to the email address you provided during registration.",
    icon: "success",
    timer: 3000,
});
</script>
@endif
@endsection