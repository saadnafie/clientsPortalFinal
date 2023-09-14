function containsSpecialChars(str) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

const min = 1,
    max = 150;
const isBetween = (length, min, max) =>
    length < min || length > max ? false : true;

const isRequired = (value) => (value === "" ? false : true);

function containsOnlyNumbers(str) {
    return /^\d+$/.test(str);
}

function dateIsValid(new_date) {
    var dateFrom = "01/01/1920";
    const date = new Date();

    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    let dateTo = `${day}/${month}/${year}`;

    var from = Date.parse(dateFrom);
    var to = Date.parse(dateTo);
    var check = Date.parse(new_date);
    if (check <= to && check >= from) {
        return true;
    } else {
        return false;
    }
}

function checkEmailPassword() {
    let valid = false;
    let value = $("#confirmemailpassword").val();
    let id = $("#confirmemailpassword").attr("id");

    let passwordRGEX =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    let passResult = passwordRGEX.test(value);

    if (!isRequired(value)) {
        $("." + id).text("Password is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!passResult) {
        $("." + id).text("Please enter your password");
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

function checkEmail() {
    let valid = false;
    let value = $("#emailaddress").val();
    let id = $("#emailaddress").attr("id");

    let emailRGEX =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let emailResult = emailRGEX.test(value);

    if (!isRequired(value)) {
        $("." + id).text("Email is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!emailResult) {
        $("." + id).text("Please enter a valid email address");
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

function checkPassword() {
    let valid = false;
    let value = $("#newpassword").val();
    let id = $("#newpassword").attr("id");

    let passwordRGEX =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    let passResult = passwordRGEX.test(value);

    if (!isRequired(value)) {
        $("." + id).text("New password is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!passResult) {
        $("." + id).text("Please enter a valid and strong password");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!isBetween(value.length, min, max)) {
        $("." + id).text("Please enter a valid password");
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

function checkConfirmPassword() {
    let valid = false;
    let value = $("#confirmpassword").val();
    let id = $("#confirmpassword").attr("id");

    if (!isRequired(value)) {
        $("." + id).text("Confirm password is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if ($("#newpassword").val() != $("#confirmpassword").val()) {
        $("." + id).text("The password and its confirm are not the same");
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

function checkCurrentPassword() {
    let valid = false;
    let value = $("#currentpassword").val();
    let id = $("#currentpassword").attr("id");

    let passwordRGEX =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    let passResult = passwordRGEX.test(value);

    if (!isRequired(value)) {
        $("." + id).text("Current password is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!passResult) {
        $("." + id).text("Please enter your valid password");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!isBetween(value.length, min, max)) {
        $("." + id).text("Please enter your valid password");
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

function checkTextField(event) {
    let valid = false;
    let value = $(event).val();
    let id = $(event).attr("id");

    if (!isRequired(value)) {
        $("." + id).text("This field is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (containsSpecialChars(value)) {
        $("." + id).text("Must not contain specialchars i.e. < ^ %");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!isBetween(value.length, min, max)) {
        $("." + id).text("Please enter a valid input");
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

function checkDateField(events) {
    let valid = false;
    let value = $(events).val();
    let id = $(events).attr("id");

    if (!isRequired(value)) {
        $("." + id).text("This field is required");
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

function Emailtimer() {
    $.ajax({
        url: "/customer/getTimerRemainingEmail",
        type: "get",
        dataType: "json",
        success: function (data) {
            timerEmail(data.remaining * 60);
        },
    });
}

let timerEmailOn = true;

function timerEmail(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 3 ? "0" + m : m;
    s = s < 3 ? "0" + s : s;
    document.getElementById("timerEmail").innerHTML = m + ":" + s;
    remaining -= 1;

    if (remaining >= 0 && timerEmailOn) {
        setTimeout(function () {
            timerEmail(remaining);
        }, 1000);
        return;
    }

    if (!timerEmailOn) {
        return;
    }
}

function checkVerifyEmailCode() {
    let valid = false;
    let value = $("#verification_code_email").val();
    let id = $("#verification_code_email").attr("id");

    if (!isRequired(value)) {
        $("." + id).text("Verification Code is required");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!containsOnlyNumbers(value)) {
        $("." + id).text("Verification Code must be only digits");
        $("#" + id).addClass("is-invalid");
        $("#" + id).removeClass("is-valid");
    } else if (!isBetween(value.length, 8, 8)) {
        $("." + id).text("Verification Code must be 8 digits");
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
    var values = $("#verify-phone").serializeArray();
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

function resendEmailCode() {
    var values = $("#verify-email").serializeArray();
    $.ajax({
        url: "/customer/send_new_email_code",
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
                Emailtimer();
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

$(document).ready(function () {
    OTPtimer();
    Emailtimer();

    document.querySelectorAll("#dateOfBirth").forEach((el) => {
        el.addEventListener("keydown", function (e) {
            e.preventDefault();
        });
    });

    let type = $("#user_type").val();
    if (type == 2) {
        $(".company").css("display", "flex");
    } else {
        $(".company").css("display", "none");
    }

    $("#user-basic-form").submit(function (e) {
        e.preventDefault();
        let valid = true;
        $("form#user-basic-form input[type=text]").each(function () {
            let input = $(this);
            let input_type = $(this).attr("id");
            if (
                type != 2 &&
                (input_type == "organizationName" ||
                    input_type == "designation")
            ) {
            } else {
                let result = checkTextField(input);
                valid = valid & result;
            }
        });
        $("form#user-basic-form input[type=date]").each(function () {
            let input = $(this);
            let result = checkDateField(input);
            valid = valid & result;
        });

        if (valid) {
            var values = new FormData(this);
            $.ajax({
                url: "/customer/update-user-account",
                type: "post",
                data: values,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status == "Success") {
                        swal.fire({
                            title: "Thank you!",
                            text: data.message,
                            icon: "success",
                            timer: 3000,
                        }).then(() => {
                            window.location.href = "/customer/user-account";
                        });
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

    $("#user-password").submit(function (e) {
        e.preventDefault();
        let valid = true;
        let checkvalidPassword =
            valid &&
            checkConfirmPassword() &&
            checkPassword() &&
            checkCurrentPassword();

        if (checkvalidPassword) {
            var values = $("#user-password").serializeArray();
            $.ajax({
                url: "/customer/updateUserPassword",
                type: "post",
                dataType: "json",
                data: values,
                success: function (data) {
                    if (data.status == "Success") {
                        swal.fire({
                            title: "Thank you!",
                            text: data.message,
                            icon: "success",
                            timer: 3000,
                        }).then(() => {
                            window.location.href = "/customer/edit-account";
                        });
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

    $("#user-email").submit(function (e) {
        e.preventDefault();
        let valid = true;
        let checkvalidEmail = valid && checkEmailPassword() && checkEmail();

        if (checkvalidEmail) {
            var values = $("#user-email").serializeArray();
            $.ajax({
                url: "/customer/changeUserEmail",
                type: "post",
                dataType: "json",
                data: values,
                success: function (data) {
                    if (data.status == "Success") {
                        $("#verify-email")[0].reset();
                        $(".new_user_email").text(data.new_email);
                        $("#new_email_not_verified").val(data.new_email);
                        $("#verify_email_modal").modal("show");
                        Emailtimer();
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

    $("#user-phone").submit(function (e) {
        e.preventDefault();
        let valid = true;
        let checkvalidPhone = valid && check_phone();

        if (checkvalidPhone) {
            var values = $("#user-phone").serializeArray();

            $.ajax({
                url: "/customer/sendOptUserPhone",
                type: "post",
                dataType: "json",
                data: values,
                success: function (data) {
                    if (data.status == "Success") {
                        $(".new_user_phone_number").text(data.phone_number);
                        $("#new_user_phone_number_value").val(
                            data.phone_number
                        );
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
        let valid = true;
        let checkvalidPhone = valid && checkVerifyPhone();

        if (checkvalidPhone) {
            var values = $("#verify-phone").serializeArray();
            $.ajax({
                url: "/customer/verify_otp",
                type: "post",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                            window.location.href = "/customer/edit-account";
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

    $("#verify-email").submit(function (e) {
        e.preventDefault();
        let valid = true;
        let checkvalidEmailCode = valid && checkVerifyEmailCode();

        if (checkvalidEmailCode) {
            var values = $("#verify-email").serializeArray();
            $.ajax({
                url: "/customer/verify_Email_code",
                type: "post",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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
                            window.location.href = "/customer/edit-account";
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
});
