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
    utilsScript:
        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});

function check_phone() {
    const phoneNumber = phoneInput.getNumber();
    if (phoneInput.isValidNumber()) {
        $("body #phone_number").val(phoneNumber);
        $(".phone").text("");
        $("#phone").removeClass("is-invalid");
        $("#phone").addClass("is-valid");
        $(".phone_button_login").prop("disabled", false);
    } else {
        $(".phone").text("Phone number is invalid");
        $("#phone").addClass("is-invalid");
        $("#phone").removeClass("is-valid");
        $(".phone_button_login").prop("disabled", true);
    }
}

function checkVerifyPhone() {
    let valid = false;
    let value = $("#verification_code").val();
    let id = $("#verification_code").attr("id");

    if (!isRequired(value)) {
        $("." + id).text("Verification Code is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!containsOnlyNumbers(value)) {
        $("." + id).text("Verification Code must be only digits");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!isBetween(value.length, 6, 6)) {
        $("." + id).text("Verification Code must be 6 digits");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else {
        $("." + id).text("");
        $("#" + id).addClass("is-valid");
        $("#" + id).removeClass("is-invalid");
        valid = true;
    }
    return valid;
}

function OTPtimer() {
    $.ajax({
        url: "/getTimerRemainingLogin",
        type: "get",
        dataType: "json",
        success: function (data) {
            $("#verification_type").val("twilio");
            timerPhone(data.remaining * 60);
        },
    });
}

let timerPhoneOn = true;

function timerPhone(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 3 ? "0" + m : m;
    s = s < 3 ? "0" + s : s;
    document.getElementById("timerPhone").innerHTML = m + ":" + s;
    remaining -= 1;

    if (remaining >= 0 && timerPhoneOn) {
        setTimeout(function () {
            timerPhone(remaining);
        }, 1000);
        return;
    }

    if (!timerPhoneOn) {
        return;
    }
}

function resendPhoneCode(verification_type) {
    var values = $("#verify-phone").serializeArray();
    values.push({ name: "verification_type", value: verification_type });
    $.ajax({
        url: "/send_new_otp_login",
        type: "post",
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: values,
        success: function (data) {
            if (data.status == "Success") {
                swal.fire({
                    title: "Thank you!",
                    text: data.message,
                    icon: "success",
                    timer: 3000,
                });
                $(".is-invalid").removeClass("is-invalid");
                $(".invalid-feedback").text("");
                $("input:text").val("");
                $("#verification_type").val("twilio");
                OTPtimer();
            } else {
                swal.fire({
                    title: "Sorry!",
                    text: data.message,
                    icon: "error",
                    timer: 3000,
                });
            }
        },
        complete: function () {},
        error: function (jqXHR, textStatus, errorThrown) {
            swal.fire({
                title: "Sorry!",
                text: jqXHR.responseText,
                icon: "error",
                timer: 3000,
            });
        },
    });
    return false;
}

$("#login-phone").submit(function (e) {
    e.preventDefault();
    // let valid = true;
    // let checkvalidPhone = valid && check_phone();

    let checkvalidPhone = true;
    if (checkvalidPhone) {
        var values = $("#login-phone").serializeArray();
        $.ajax({
            url: "/sendOptUserPhoneLogin",
            type: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: values,
            success: function (data) {
                if (data.status == "Success") {
                    $(".user_phone_number").text(data.phone_number);
                    $("#user_phone_number_value").val(data.phone_number);
                    $("#verify_phone_modal").modal("show");
                    OTPtimer();
                } else {
                    Toastify({
                        text: data.message,
                        className: "error",
                        style: {
                            background:
                                "linear-gradient(to right, #FF3043, #FF3043)",
                            color: "#FFFFFF",
                        },
                    }).showToast();
                }
            },
            complete: function () {},
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            },
        });
    }
});

$("#verify-phone").submit(function (e) {
    e.preventDefault();
    // let valid = true;
    // let checkvalidPhone = valid && checkVerifyPhone();
    let checkvalidPhone = true;
    if (checkvalidPhone) {
        var values = $("#verify-phone").serializeArray();
        $.ajax({
            url: "/verify_otp_login",
            type: "post",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: values,
            success: function (data, textStatus, xhr) {
                if (data.status == "Success") {
                    swal.fire({
                        title: "Thank you!",
                        text: data.message,
                        icon: "success",
                        timer: 3000,
                    }).then(() => {
                        window.location.href = "/";
                    });
                } else {
                    swal.fire({
                        title: "Sorry!",
                        text: data.message,
                        icon: "error",
                    });
                }
            },
            complete: function () {},
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 302 || jqXHR.status == 200) {
                    swal.fire({
                        title: "Thank you!",
                        text: "Successfully Logged in!",
                        icon: "success",
                        timer: 3000,
                    }).then(() => {
                        window.location.href = "/";
                    });
                } else {
                    swal.fire({
                        title: "Sorry!",
                        text: jqXHR.responseText,
                        icon: "error",
                    });
                }
            },
        });
    }
});
