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
            <div class="card-body py-1 py-lg-5">

                <div class="mb-7">
                    <img alt="Logo" src="{{asset('assets/media/logos/logo.png')}}" class="h-100px" />
                </div>
                <div class="show-verify-phone-number">
                    <h1 class="fw-bolder text-gray-900 mb-6">Verify your phone number</h1>
                    <div class="fs-6 mb-1">
                        <span class="fw-semibold text-gray-500">Thanks for signing up! Before getting started,
                            please verify your phone number <span
                                class="text-success"><b>({{auth()->user()->phone}})</b></span> by clicking on the button
                            below
                            to request a verification
                            code.</span>
                    </div>
                    <div class="fs-6 mb-1 p-5">
                        <form method="POST" action="{{ route('send_otp') }}">
                            @csrf
                            <div>
                                <button type="submit" class="btn btn-primary new-phone">
                                    Send Verification Code
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="mb-0">
                        <span class="fw-semibold text-gray-500 csg-color">If you want to change your phone,
                            click <a id="change-phone" href="">here</a></span>
                    </div>
                    @if(Request::get('error_message'))
                    <div class="fv-plugins-message-container alert alert-danger">
                        {{ Request::get('error_message') }}
                    </div>
                    @endif

                </div>
                <div class="show-change-phone-number" style="display:none;">
                    <h1 class="fw-bolder text-gray-900 mb-1">Change your phone number</h1>

                    <form id="user-phone" class="form" method="POST">
                        @csrf
                        <div class="p-6 fs-6 mb-1">
                            <label for="phone" class="form-label fs-6 fw-bold mb-3">Enter New Phone
                                Number</label><br />
                            <input id="phone" type="tel" name="phone"
                                class="form-control form-control-lg form-control-solid" onkeyup="check_phone()" />
                            <input type="hidden" name="phone_number" id="phone_number"
                                class="form-control bg-transparent" />
                            <div class="fv-plugins-message-container invalid-feedback  phone">
                            </div>
                        </div>

                        <div class="fs-6 mb-1 p-5">
                            <button id="savePhone" type="submit" class="btn btn-primary me-2 px-6">
                                Save
                            </button>
                            <button id="cancel-change-phone" type="button"
                                class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                A new verification code has been sent to the phone number you provided during registration
            </div>
            @endif

            <div class="mb-0">
                <img src="{{asset('assets/media/auth/phoneverification.png')}}" class="mw-100 mh-100px theme-light-show"
                    alt="" />
                <img src="{{asset('assets/media/auth/phoneverification.png')}}" class="mw-100 mh-100px theme-dark-show"
                    alt="" />
                <form method="POST" action="{{route('logout')}}" class="p-3">
                    @csrf

                    <button type="submit" class="btn btn-secondary btn-sm">
                        <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
$(document).ready(function() {
    $("#change-phone").click(function() {
        $(".show-verify-phone-number").css("display", "none");
        $(".show-change-phone-number").css("display", "block");
        return false;
    });

    $("#cancel-change-phone").click(function() {
        $('#user-phone')[0].reset();
        $(".show-verify-phone-number").css("display", "block");
        $(".show-change-phone-number").css("display", "none");
    });

    let type = $("#user_type").val();
    if (type == 2) {
        $(".company").css("display", "flex");
    } else {
        $(".company").css("display", "none");
    }

    $("#user-phone").submit(function(e) {
        e.preventDefault();
        let valid = true;
        let checkvalidPhone = valid && check_phone();

        if (checkvalidPhone) {
            var values = $("#user-phone").serializeArray();

            $.ajax({
                url: "/customer/storeNewPhone",
                type: "post",
                dataType: "json",
                data: values,
                success: function(data) {
                    if (data.status == "Yes") {
                        $('.new-phone').html(data.newphone +
                            '<br> Send Verification Code');
                        $('#user-phone')[0].reset();
                        $(".show-verify-phone-number").css("display", "block");
                        $(".show-change-phone-number").css("display", "none");
                        swal.fire({
                            title: "Thank you!",
                            text: data.message,
                            icon: "success",
                            timer: 3000,
                        }).then(() => {
                            window.location.href = "/customer/dashboard";
                        });
                    } else {
                        Toastify({
                            text: data.message,
                            className: "error",
                            style: {
                                background: "linear-gradient(to right, #FF3043, #FF3043)",
                                color: "#FFFFFF",
                            },
                        }).showToast();
                    }
                },
                complete: function() {},
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
            });
        }
    });

});

function getIp(callback) {
    fetch("https://ipinfo.io/json?token=d37b9e77d31ce5", {
            headers: {
                Accept: "application/json",
            },
        })
        .then((resp) => resp.json())
        .catch(() => {
            return {
                country: "Jo",
            };
        })
        .then((resp) => callback(resp.country));
}

const phoneInputField = document.querySelector("#phone");

const phoneInput = window.intlTelInput(phoneInputField, {
    initialCountry: "auto",
    geoIpLookup: getIp,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});

function check_phone() {
    let valid = false;
    let value = $("#phone").val();
    let id = $("#phone").attr("id");

    const phoneNumber = phoneInput.getNumber();
    $("body #phone_number").val(phoneNumber);
    if (phoneInput.isValidNumber()) {
        $("." + id).text("");
        $("#" + id).addClass("is-valid");
        $("#" + id).removeClass("is-invalid");
        valid = true;
    } else {
        $("." + id).text("Please enter a valid input");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    }
    return valid;
}
</script>
@endsection