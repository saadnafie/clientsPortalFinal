$(document).ready(function () {
    OTPtimer();
});

function containsSpecialChars(str) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

function containsOnlyNumbers(str) {
    return /^\d+$/.test(str);
}

const min = 1,
    max = 150;
const isBetween = (length, min, max) =>
    length < min || length > max ? false : true;

const isRequired = (value) => (value === "" ? false : true);

function OTPtimer() {
    $.ajax({
        url: "/customer/getTimerRemaining",
        type: "get",
        dataType: "json",
        success: function (data) {
            if (data.type == "twilio") {
                $(".phone-verification-show").css("display", "block");
                $(".whatsapp-verification-show").css("display", "none");
                $("#verification_type").val("twilio");
            } else {
                $(".phone-verification-show").css("display", "none");
                $(".whatsapp-verification-show").css("display", "block");
                $("#verification_type").val("whatsapp");
            }
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

function resendPhoneCode(verification_type) {
    var values = $("#sendOPTphone").serializeArray();
    values.push({ name: "verification_type", value: verification_type });
    $.ajax({
        url: "/customer/send_new_otp",
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
                if (data.verification_type == "twilio") {
                    $(".phone-verification-show").css("display", "block");
                    $(".whatsapp-verification-show").css("display", "none");
                    $("#verification_type").val("twilio");
                } else {
                    $(".phone-verification-show").css("display", "none");
                    $(".whatsapp-verification-show").css("display", "block");
                    $("#verification_type").val("whatsapp");
                }
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

$("#verify_phone_code").submit(function (e) {
    e.preventDefault();

    let valid = true;
    let checkvalidPhone = valid && checkVerifyPhone();

    if (checkvalidPhone) {
        var values = $("#verify_phone_code").serializeArray();
        $.ajax({
            url: "/customer/verify_otp",
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
                    }).then(() => {
                        window.location.href = "/customer/dashboard";
                    });
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
                var err = eval("(" + xhr.responseText + ")");

                swal.fire({
                    title: "Sorry!",
                    text: jqXHR.responseText,
                    icon: "error",
                    timer: 3000,
                });
            },
        });
    }
});
