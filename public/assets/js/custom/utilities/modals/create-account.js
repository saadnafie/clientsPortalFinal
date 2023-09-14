"use strict";
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
    $("body #phone_check").val(phoneNumber);
    if (phoneInput.isValidNumber()) {
        $(".error_phone").css("display", "none");
        $("button").prop("disabled", false);
    } else {
        $("body #phone_check").val("NOT VALID");
        $(".error_phone").val("NOT VALID");
        $(".error_phone").css("display", "block");
        $("button").prop("disabled", true);
    }
}

var KTCreateAccount = (function () {
    var e,
        t,
        i,
        o,
        a,
        r,
        fv,
        s = [];
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_create_account")) &&
                new bootstrap.Modal(e),
                (t = document.querySelector("#kt_create_account_stepper")) &&
                    ((i = t.querySelector("#kt_create_account_form")),
                    (o = t.querySelector('[data-kt-stepper-action="submit"]')),
                    (a = t.querySelector('[data-kt-stepper-action="next"]')),
                    (r = new KTStepper(t)).on(
                        "kt.stepper.changed",
                        function (e) {
                            4 === r.getCurrentStepIndex()
                                ? (o.classList.remove("d-none"),
                                  o.classList.add("d-inline-block"),
                                  a.classList.add("d-none"))
                                : 5 === r.getCurrentStepIndex()
                                ? (o.classList.add("d-none"),
                                  a.classList.add("d-none"))
                                : (o.classList.remove("d-inline-block"),
                                  o.classList.remove("d-none"),
                                  a.classList.remove("d-none"));
                        }
                    ),
                    r.on("kt.stepper.next", function (e) {
                        console.log("stepper.next");
                        var t = s[e.getCurrentStepIndex() - 1];
                        t
                            ? t.validate().then(function (t) {
                                  console.log("validated!"),
                                      "Valid" == t
                                          ? (e.goNext(), KTUtil.scrollTop())
                                          : Swal.fire({
                                                text: "Please fill in all the inputs.",
                                                icon: "error",
                                                buttonsStyling: !1,
                                                confirmButtonText:
                                                    "Ok, got it!",
                                                customClass: {
                                                    confirmButton:
                                                        "btn btn-light",
                                                },
                                            }).then(function () {
                                                KTUtil.scrollTop();
                                                fv.resetForm();
                                            });
                              })
                            : (e.goNext(), KTUtil.scrollTop());
                    }),
                    r.on("kt.stepper.previous", function (e) {
                        console.log("stepper.previous"),
                            e.goPrevious(),
                            KTUtil.scrollTop();
                    }),
                    s.push(
                        (fv = FormValidation.formValidation(i, {
                            fields: {
                                account_type: {
                                    validators: {
                                        notEmpty: {
                                            message: "Account type is required",
                                        },
                                    },
                                },
                                physician: {
                                    validators: {
                                        notEmpty: {
                                            message: " ",
                                        },
                                    },
                                },
                                equivalency: {
                                    validators: {
                                        notEmpty: {
                                            message: " ",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        }))
                    ),
                    s.push(
                        FormValidation.formValidation(i, {
                            fields: {
                                email: {
                                    validators: {
                                        notEmpty: {
                                            message: "Email is required",
                                        },
                                        emailAddress: {
                                            message:
                                                "The value is not a valid email address",
                                        },
                                    },
                                },
                                phone: {
                                    validators: {
                                        notEmpty: {
                                            message: "Phone number is required",
                                        },
                                        regexp: {
                                            regexp: /^[0-9\+]+$/,
                                            message: "Invalid phone number",
                                        },
                                    },
                                },
                                password: {
                                    validators: {
                                        notEmpty: {
                                            message:
                                                "Please enter your password",
                                        },
                                        regexp: {
                                            regexp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
                                            message:
                                                "Please enter a valid and strong password",
                                        },
                                    },
                                },
                                confirmpassword: {
                                    validators: {
                                        notEmpty: {
                                            message: "Please confirm password",
                                        },
                                        identical: {
                                            compare: function () {
                                                return i.querySelector(
                                                    '[name="password"]'
                                                ).value;
                                            },
                                            message:
                                                "The password and its confirm are not the same",
                                        },
                                    },
                                },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap:
                                    new FormValidation.plugins.Bootstrap5({
                                        rowSelector: ".fv-row",
                                        eleInvalidClass: "",
                                        eleValidClass: "",
                                    }),
                            },
                        })
                    ),
                    o.addEventListener("click", function (e) {
                        e.preventDefault();
                        
                        s[1].validate().then(function (t) {
                           
                            console.log("validated!"),
                                "Valid" == t
                                    ? ((o.disabled = !0),
                                      o.setAttribute("data-kt-indicator", "on"),
                                      setTimeout(function () {
                                        $('#loading-load').show();
                                          o.removeAttribute(
                                              "data-kt-indicator"
                                          ),
                                              (o.disabled = !1),
                                              
                                              $.ajax({
                                                  url: "/register/store",
                                                  type: "POST",
                                                  data: $(
                                                      "#kt_create_account_form"
                                                  ).serialize(),
                                                  dataType: "json",
                                                  success: function (data) {
                                                    $('#loading-load').hide();
                                                      window.location.href =
                                                          "/verify-email";

                                                  },
                                                  error: function (data) {
                                                    $('#loading-load').hide();
                                                      Swal.fire({
                                                          text: "Email or Phone number already exist and registered before!",
                                                          icon: "error",
                                                          buttonsStyling: !1,
                                                          confirmButtonText:
                                                              "Ok, got it!",
                                                          customClass: {
                                                              confirmButton:
                                                                  "btn btn-light",
                                                          },
                                                      });
                                                  },
                                              });
                                      }, 2e3))
                                    : Swal.fire({
                                          text: "Please fill in all the inputssss",
                                          icon: "error",
                                          buttonsStyling: !1,
                                          confirmButtonText: "Ok, got it!",
                                          customClass: {
                                              confirmButton: "btn btn-light",
                                          },
                                      }).then(function () {
                                          KTUtil.scrollTop();
                                      });
                                      $('#loading-load').hide();
                        });
                        $('#loading-load').hide();
                    }),
                    $(i.querySelector('[name="phone_number"]')).on(
                        "blur",
                        function () {
                            s[1].revalidateField("phone");
                        }
                    ));
        },
    };
})();

KTUtil.onDOMContentLoaded(function () {
    KTCreateAccount.init();
});

$('input:radio[name="account_type"]').change(function () {
    const project_name = $("input[name=account_type]:checked").val();
    if (project_name === "2") {
        $(".account-type-validate").css("display", "none");
        $(".equivalency-no").attr("checked", "checked");
        $(".physician-no").attr("checked", "checked");
    } else {
        $("#kt_create_account_form_account_type_personal").attr(
            "checked",
            "checked"
        );
        $("#kt_create_account_form")[0].reset();
        $(".physician-no").removeAttr("checked");
        $(".equivalency-no").removeAttr("checked");
        $(".physician-show").css("display", "block");
        $(".equivalency-show").css("display", "none");
        // $(".account-type-validate").css("display", "block");
    }
});

$('input:radio[name="physician"]').change(function () {
    if ($(".physician-yes").is(":checked")) {
        Swal.fire({
            text: "Physician is not allowed to register",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-light",
            },
        });
        $("#kt_create_account_form")[0].reset();
        $(".fv-plugins-message-container ").remove();
        $("input[name=account_type]").removeAttr("checked");
        $(".account-type-validate").css("display", "none");
    } else {
        $(".equivalency-show").css("display", "block");
    }
});

$('input:radio[name="equivalency"]').change(function () {
    if ($(".equivalency-yes").is(":checked")) {
        Swal.fire({
            text: "Equivalency is not allowed to register",
            icon: "error",
            buttonsStyling: !1,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-light",
            },
        });
        $("#kt_create_account_form")[0].reset();
        $("input[name=account_type]").removeAttr("checked");

        $(".fv-plugins-message-container ").remove();
        $(".account-type-validate").css("display", "none");
    }
});
