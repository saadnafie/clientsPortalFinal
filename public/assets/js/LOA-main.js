$(document).ready(function ($) {
    var canvas = document.getElementById("signature");
    var signaturePad = new SignaturePad(canvas);

    $("#clear-signature").on("click", function () {
        signaturePad.clear();
    });
});

function containsSpecialChars(str) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

const isRequired = (value) => (value === "" ? false : true);
const name_in = document.querySelector("#name");
const date_in = document.querySelector("#date");
const passport_in = document.querySelector("#passport");
const signature_validate = document.querySelector("#signature");
var check_sig =
    "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAV4AAACWCAYAAACW5+B3AAAAAXNSR0IArs4c6QAABMpJREFUeF7t1MEJAAAIAzG7/9Juca+4QCHI7RwBAgQIpAJL14wRIECAwAmvJyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQICK8fIECAQCwgvDG4OQIECAivHyBAgEAsILwxuDkCBAgIrx8gQIBALCC8Mbg5AgQIPF0WAJcLlD1nAAAAAElFTkSuQmCC";

const min = 5,
    max = 75;
const isBetween = (length, min, max) =>
    length < min || length > max ? false : true;

const checkSignature = () => {
    let valid = false;

    const base64Image = $("#signature").get(0).toDataURL();

    if (base64Image === check_sig) {
        $(".error_signature_en").text("Signature field cannot be blank.");
        $(".error_signature_en").addClass("small");
        $(".error_signature_en").css("color", "red");
        $(".error_signature_ar").text("يرجى إدخال التوقيع");
        $(".error_signature_ar").addClass("small");
    } else {
        $(".error_signature_en").text("");
        $(".error_signature_ar").text("");
        valid = true;
    }
    return valid;
};

$(document).ready(function () {
    var fileExist = $("#loaFileExist").val();
    console.log("fileExist= " + fileExist);
    if (fileExist != null && fileExist != "") {
        $(".show-loa").css("display", "block");
        $(".show-signature").css("display", "none");

        let content_img_pdf =
            "<a href='" +
            fileExist +
            "' download><img src='/assets/img/pdf.png' width='250' height='150'></a>";
        $(".show-loa-file").html(content_img_pdf);
    } else {
        $(".show-loa").css("display", "none");
        $(".next-loa").prop("disabled", true);
    }

    $("#change-loa").click(function (e) {
        let app_id = $("#app_id").val();
        $.ajax({
            url: "/customer/loa/clearfiles",
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            data: { app_id: app_id },
            success: function (data) {},
        });
        $("#clear-signature").click();
        $(".show-loa").css("display", "none");
        $(".show-signature").css("display", "block");
        $(".next-loa").prop("disabled", true);
    });

    $("#letter_auth").submit(function (e) {
        e.preventDefault();
        $("#loading-load").show();

        let isSignatureValid = checkSignature();

        let isFormValid = isSignatureValid;

        if (isFormValid) {
            var base64Image = $("#signature").get(0).toDataURL();
            console.log(base64Image);
            $("#outputBase64FormInput").val(base64Image);

            var values = $("#letter_auth").serializeArray();
            $.ajax({
                url: "/customer/loaGenerate",
                type: "post",
                dataType: "json",
                data: values,
                success: function (data) {
                    if (data.op == "no") {
                        $("#loading-load").hide();
                        $(".show-loa").css("display", "none");
                        $(".show-signature").css("display", "block");
                        Toastify({
                            text: data.error,
                            className: "error",
                            style: {
                                background:
                                    "linear-gradient(to right, #FF3043, #FF3043)",
                                color: "#FFFFFF",
                            },
                        }).showToast();
                    } else {
                        let content_img_pdf =
                            "<a href='" +
                            data.filename +
                            "' download><img src='/assets/img/pdf.png' width='250' height='150'></a>";
                        $(".show-loa").css("display", "block");
                        $(".show-signature").css("display", "none");
                        $(".show-loa-file").html(content_img_pdf);
                        $("#loading-load").hide();
                        Toastify({
                            text: "You have successfuly generate your letter of authorization",
                            className: "success",
                            style: {
                                background:
                                    "linear-gradient(to right, #59C552, #59C552)",
                                color: "#FFFFFF",
                            },
                        }).showToast();
                        $(".next-loa").prop("disabled", false);
                    }
                },
                complete: function () {},
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#loading-load").hide();
                    console.log(textStatus, errorThrown);
                },
            });
        } else {
            $("#loading-load").hide();
        }
    });
});
