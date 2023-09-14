function containsSpecialChars(str) {
    const specialChars = /[`!@#$%^&*()+\-=\[\]\_{};':"\\|,<>\?~]/;
    return specialChars.test(str);
}

function containsSpecialCharsDate(str) {
    const specialChars = /[`!@#$%^&*()+\-=\[\]\_{};':"\\|,<>\?~]/;
    return specialChars.test(str);
}

const min = 1,
    max = 150;
const isBetween = (length, min, max) =>
    length < min || length > max ? false : true;

const isRequired = (value) => (value === "" ? false : true);

var momentFormat = "DD/MM/YYYY";
var momentMask = IMask(document.getElementById("dateofbirths"), {
    mask: Date,
    pattern: momentFormat,
    lazy: false,
    min: new Date(1900, 0, 1),
    max: new Date(2000, 0, 1),

    format: function (date) {
        return moment(date).format(momentFormat);
    },
    parse: function (str) {
        return moment(str, momentFormat);
    },

    blocks: {
        YYYY: {
            mask: IMask.MaskedRange,
            from: 1970,
            to: 2030,
        },
        MM: {
            mask: IMask.MaskedRange,
            from: 1,
            to: 12,
        },
        DD: {
            mask: IMask.MaskedRange,
            from: 1,
            to: 31,
        },
        HH: {
            mask: IMask.MaskedRange,
            from: 0,
            to: 23,
        },
        mm: {
            mask: IMask.MaskedRange,
            from: 0,
            to: 59,
        },
    },
});

function checkTextField(event) {
    let valid = false;
    let value = $(event).val();
    let id = $(event).attr("id");

    console.log(value);
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
    } else if (containsSpecialCharsDate(value)) {
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

$(document).ready(function () {
    document.querySelectorAll("#dateofbirth").forEach((el) => {
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

    $("#save_user_details").submit(function (e) {
        e.preventDefault();
        let valid = true;
        $("form#save_user_details input[type=text]").each(function () {
            let input = $(this);
            let input_type = $(this).attr("id");
            if (
                type != 2 &&
                (input_type == "organization_name" ||
                    input_type == "designation")
            ) {
            } else if (input_type == "dateofbirths") {
                let result = checkDateField(input);
                valid = valid & result;
            } else {
                let result = checkTextField(input);
                valid = valid & result;
            }
        });

        if (valid) {
            var values = $("#save_user_details").serializeArray();

            $.ajax({
                url: "/customer/storedUserData",
                type: "post",
                dataType: "json",
                data: values,
                success: function (data) {
                    if (data.status == "Yes") {
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
                        });
                    }
                },
                complete: function () {},
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                },
            });
        }
    });
});
