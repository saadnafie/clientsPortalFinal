"use strict";
var KTCreateAccount = (function () {
  var e,
    t,
    i,
    o,
    a,
    r,
    form = document.getElementById("kt_create_application_form"),
    s = [];
  return {
    init: function () {
      (e = document.querySelector("#kt_modal_create_account")) &&
        new bootstrap.Modal(e),
        (t = document.querySelector("#kt_create_account_stepper")) &&
          ((i = t.querySelector("#kt_create_application_form")),
          (o = t.querySelector('[data-kt-stepper-action="submit"]')),
          (a = t.querySelector('[data-kt-stepper-action="next"]')),
          (r = new KTStepper(t)).on("kt.stepper.changed", function (e) {
            4 === r.getCurrentStepIndex()
              ? (o.classList.remove("d-none"),
                o.classList.add("d-inline-block"),
                a.classList.add("d-none"))
              : 5 === r.getCurrentStepIndex()
              ? (o.classList.add("d-none"), a.classList.add("d-none"))
              : (o.classList.remove("d-inline-block"),
                o.classList.remove("d-none"),
                a.classList.remove("d-none"));
          }),
          r.on("kt.stepper.next", function (e) {
            console.log("stepper.next");
            var t = s[e.getCurrentStepIndex() - 1];
            t
              ? t.validate().then(function (t) {
                  console.log("validated!"),
                    "Valid" == t
                      ? (e.goNext(), KTUtil.scrollTop())
                      : Swal.fire({
                          text: "Sorry, looks like there are some errors detected, please try again.",
                          icon: "error",
                          buttonsStyling: !1,
                          confirmButtonText: "Ok, got it!",
                          customClass: { confirmButton: "btn btn-light" },
                        }).then(function () {
                          KTUtil.scrollTop();
                        });
                })
              : (e.goNext(), KTUtil.scrollTop());
          }),
          r.on("kt.stepper.previous", function (e) {
            console.log("stepper.previous"), e.goPrevious(), KTUtil.scrollTop();
          }),
          s.push(
            FormValidation.formValidation(i, {
              fields: {
                first_name: {
                  validators: {
                    notEmpty: {
                      message: "First name is required",
                    },
                    stringLength: {
                      max: 250,
                      message: "First name must be less than 250 characters",
                    },
                    regexp: {
                      regexp: /^[\u0621-\u064Aa-zA-Z0-9\-\,\.\:\'\(\)\/\\ ]+$/,
                      message:
                        "First name can only consist of alphabetical, number and space",
                    },
                  },
                },
                middle_name: {
                  validators: {
                    notEmpty: {
                      message: "Middle name is required",
                    },
                    stringLength: {
                      max: 250,
                      message: "Middle name must be less than 250 characters",
                    },
                    regexp: {
                      regexp: /^[\u0621-\u064Aa-zA-Z0-9\-\,\.\:\'\(\)\/\\ ]+$/,
                      message:
                        "Middle name can only consist of alphabetical, number and space",
                    },
                  },
                },
                last_name: {
                  validators: {
                    notEmpty: {
                      message: "Last name is required",
                    },
                    stringLength: {
                      max: 250,
                      message: "Last name must be less than 250 characters",
                    },
                    regexp: {
                      regexp: /^[\u0621-\u064Aa-zA-Z0-9\-\,\.\:\'\(\)\/\\ ]+$/,
                      message:
                        "Last name can only consist of alphabetical, number and space",
                    },
                  },
                },
                passport_number: {
                  validators: {
                    notEmpty: {
                      message: "Passport number is required",
                    },
                    stringLength: {
                      max: 250,
                      message:
                        "Passport number must be less than 250 characters",
                    },
                    regexp: {
                      regexp: /^[\u0621-\u064Aa-zA-Z0-9\-\,\.\:\'\(\)\/\\ ]+$/,
                      message:
                        "Passport number can only consist of alphabetical, number and space",
                    },
                  },
                },
                residence_number: {
                  validators: {
                    notEmpty: {
                      message: "Residence Number is required",
                    },
                    stringLength: {
                      max: 250,
                      message:
                        "Residence Number must be less than 250 characters",
                    },
                    regexp: {
                      regexp: /^[\u0621-\u064Aa-zA-Z0-9\-\,\.\:\'\(\)\/\\ ]+$/,
                      message:
                        "Residence Number can only consist of alphabetical, number and space",
                    },
                  },
                },
                profession: {
                  validators: {
                    notEmpty: { message: "Profession is required" },
                  },
                },
                nationality: {
                  validators: {
                    notEmpty: { message: "Nationality is required" },
                  },
                },
              },
              plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                  rowSelector: ".fv-row",
                  eleInvalidClass: "",
                  eleValidClass: "",
                }),
              },
            })
          ),
          s.push(
            FormValidation.formValidation(i, {
              fields: {
                account_team_size: {
                  validators: {
                    notEmpty: { message: "Time size is required" },
                  },
                },
                account_name: {
                  validators: {
                    notEmpty: { message: "Account name is required" },
                  },
                },
                account_plan: {
                  validators: {
                    notEmpty: { message: "Account plan is required" },
                  },
                },
              },
              plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                  rowSelector: ".fv-row",
                  eleInvalidClass: "",
                  eleValidClass: "",
                }),
              },
            })
          ),
          s.push(
            FormValidation.formValidation(i, {
              fields: {
                business_name: {
                  validators: {
                    notEmpty: { message: "Busines name is required" },
                  },
                },
                business_descriptor: {
                  validators: {
                    notEmpty: { message: "Busines descriptor is required" },
                  },
                },
                business_type: {
                  validators: {
                    notEmpty: { message: "Busines type is required" },
                  },
                },
                business_email: {
                  validators: {
                    notEmpty: { message: "Busines email is required" },
                    emailAddress: {
                      message: "The value is not a valid email address",
                    },
                  },
                },
              },
              plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                  rowSelector: ".fv-row",
                  eleInvalidClass: "",
                  eleValidClass: "",
                }),
              },
            })
          ),
          s.push(
            FormValidation.formValidation(i, {
              fields: {
                card_name: {
                  validators: {
                    notEmpty: { message: "Name on card is required" },
                  },
                },
                card_number: {
                  validators: {
                    notEmpty: { message: "Card member is required" },
                    creditCard: { message: "Card number is not valid" },
                  },
                },
                card_expiry_month: {
                  validators: { notEmpty: { message: "Month is required" } },
                },
                card_expiry_year: {
                  validators: { notEmpty: { message: "Year is required" } },
                },
                card_cvv: {
                  validators: {
                    notEmpty: { message: "CVV is required" },
                    digits: { message: "CVV must contain only digits" },
                    stringLength: {
                      min: 3,
                      max: 4,
                      message: "CVV must contain 3 to 4 digits only",
                    },
                  },
                },
              },
              plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                  rowSelector: ".fv-row",
                  eleInvalidClass: "",
                  eleValidClass: "",
                }),
              },
            })
          ),
          o.addEventListener("click", function (e) {
            s[3].validate().then(function (t) {
              console.log("validated!"),
                "Valid" == t
                  ? (e.preventDefault(),
                    (o.disabled = !0),
                    o.setAttribute("data-kt-indicator", "on"),
                    setTimeout(function () {
                      o.removeAttribute("data-kt-indicator"),
                        (o.disabled = !1),
                        r.goNext();
                    }, 2e3))
                  : Swal.fire({
                      text: "Sorry, looks like there are some errors detected, please try again.",
                      icon: "error",
                      buttonsStyling: !1,
                      confirmButtonText: "Ok, got it!",
                      customClass: { confirmButton: "btn btn-light" },
                    }).then(function () {
                      KTUtil.scrollTop();
                    });
            });
          }),
          $(i.querySelector('[name="nationality"]')).on("change", function () {
            s[0].revalidateField("nationality");
          }),
          $(i.querySelector('[name="profession"]')).on("change", function () {
            s[0].revalidateField("profession");
          }),
          $(i.querySelector('[name="card_expiry_month"]')).on(
            "change",
            function () {
              s[3].revalidateField("card_expiry_month");
            }
          ),
          $(i.querySelector('[name="card_expiry_year"]')).on(
            "change",
            function () {
              s[3].revalidateField("card_expiry_year");
            }
          ),
          $(i.querySelector('[name="business_type"]')).on(
            "change",
            function () {
              s[2].revalidateField("business_type");
            }
          ));
    },
  };
})();
KTUtil.onDOMContentLoaded(function () {
  KTCreateAccount.init();
});
