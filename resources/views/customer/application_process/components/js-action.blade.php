<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>-->

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!--<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">-->
<!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>-->
<script type="text/javascript" src="{{ asset('client_assets/js/signature.js') }}"></script>

<!-- ✅ SECOND - load jquery validate ✅ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<!-- ✅ THIRD - load additional methods ✅ -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"
    integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
const nxtBtn = document.querySelector('#submitBtn');
const form1 = document.querySelector('#form1');
const form2 = document.querySelector('#form2');
const form3 = document.querySelector('#form3');
const form4 = document.querySelector('#form4');
const form5 = document.querySelector('#form5');
const form6 = document.querySelector('#form6');

const icon1 = document.querySelector('#icon1');
const icon2 = document.querySelector('#icon2');
const icon3 = document.querySelector('#icon3');
const icon4 = document.querySelector('#icon4');
const icon5 = document.querySelector('#icon5');
const icon6 = document.querySelector('#icon6');

var viewId = 1;

var currentStep = "{{ $application->step_id }}";
if (currentStep == 2) {
    viewId = 2;
    progressBar1();
    progressBar();
    displayForms();
} else if (currentStep == 3) {
    viewId = 3;
    progressBar1();
    progressBar();
    displayForms();
} else if (currentStep == 4) {
    viewId = 4;
    progressBar1();
    progressBar();
    displayForms();
} else if (currentStep == 5) {
    viewId = 5;
    progressBar1();
    progressBar();
    displayForms();
} else if (currentStep == 6) {
    viewId = 6;
    progressBar1();
    progressBar();
    displayForms();
}


function nextForm() {
    console.log("hellonext");
    viewId = viewId + 1;
    progressBar();
    displayForms();

    console.log(viewId);

}

function prevForm() {
    console.log("helloprev");
    viewId = viewId - 1;
    console.log(viewId);
    progressBar1();
    displayForms();
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function progressBar1() {
    if (viewId === 1) {
        icon1.classList.add('current');
        icon2.classList.remove('completed');
        icon2.classList.remove('current');
        icon2.classList.remove('pending');
        icon3.classList.remove('completed');
        icon3.classList.remove('current');
        icon3.classList.remove('pending');
        icon4.classList.remove('completed');
        icon4.classList.remove('current');
        icon4.classList.remove('pending');
        icon5.classList.remove('completed');
        icon5.classList.remove('current');
        icon5.classList.remove('pending');
        icon6.classList.remove('completed');
        icon6.classList.remove('current');
        icon6.classList.remove('pending');
    }
    if (viewId === 2) {
        icon1.classList.add('completed');
        icon1.classList.remove('current');
        icon2.classList.remove('completed');
        icon2.classList.remove('pending');
        icon2.classList.add('current');
        icon3.classList.remove('completed');
        icon3.classList.remove('current');
        icon3.classList.remove('pending');
        icon4.classList.remove('completed');
        icon4.classList.remove('current');
        icon4.classList.remove('pending');
        icon5.classList.remove('completed');
        icon5.classList.remove('current');
        icon5.classList.remove('pending');
        icon6.classList.remove('completed');
        icon6.classList.remove('current');
        icon6.classList.remove('pending');
    }
    if (viewId === 3) {
        icon1.classList.add('completed');
        icon1.classList.remove('current');
        icon1.classList.remove('pending');
        icon2.classList.add('completed');
        icon2.classList.remove('current');
        icon2.classList.remove('pending');
        icon3.classList.add('current');
        icon4.classList.remove('completed');
        icon4.classList.remove('current');
        icon4.classList.remove('pending');
        icon5.classList.remove('completed');
        icon5.classList.remove('current');
        icon5.classList.remove('pending');
        icon6.classList.remove('completed');
        icon6.classList.remove('current');
        icon6.classList.remove('pending');
    }
    if (viewId === 4) {
        icon1.classList.add('completed');
        icon1.classList.remove('current');
        icon1.classList.remove('pending');
        icon2.classList.add('completed');
        icon2.classList.remove('current');
        icon2.classList.remove('pending');
        icon3.classList.add('completed');
        icon3.classList.remove('current');
        icon3.classList.remove('pending');
        icon4.classList.add('current');
        icon5.classList.remove('completed');
        icon5.classList.remove('current');
        icon5.classList.remove('pending');
        icon6.classList.remove('completed');
        icon6.classList.remove('current');
        icon6.classList.remove('pending');
    }
    if (viewId === 5) {
        icon1.classList.add('completed');
        icon1.classList.remove('current');
        icon1.classList.remove('pending');
        icon2.classList.add('completed');
        icon2.classList.remove('current');
        icon2.classList.remove('pending');
        icon3.classList.add('completed');
        icon3.classList.remove('current');
        icon3.classList.remove('pending');
        icon4.classList.add('completed');
        icon4.classList.remove('current');
        icon4.classList.remove('pending');
        icon5.classList.add('current');
        icon6.classList.remove('pending');
        icon6.classList.remove('current');
        icon6.classList.remove('completed');
        //nxtBtn.innerHTML = "Submit"
    }
    if (viewId === 6) {
        icon1.classList.add('completed');
        icon1.classList.remove('current');
        icon1.classList.remove('pending');
        icon2.classList.add('completed');
        icon2.classList.remove('current');
        icon2.classList.remove('pending');
        icon3.classList.add('completed');
        icon3.classList.remove('current');
        icon3.classList.remove('pending');
        icon4.classList.add('completed');
        icon4.classList.remove('current');
        icon4.classList.remove('pending');
        icon5.classList.add('completed');
        icon5.classList.remove('current');
        icon5.classList.remove('pending');
        icon6.classList.add('current');
        icon6.classList.remove('pending');
        icon6.classList.remove('completed');
        // nxtBtn.innerHTML = "Submit"
    }
    if (viewId > 6) {
        icon2.classList.remove('completed');
        icon2.classList.remove('current');
        icon3.classList.remove('completed');
        icon3.classList.remove('current');
        icon4.classList.remove('completed');
        icon4.classList.remove('current');
        icon5.classList.remove('completed');
        icon5.classList.remove('current');
        icon6.classList.remove('completed');
        icon6.classList.remove('current');

    }
}

function progressBar() {
    if (viewId === 2) {
        icon1.classList.add('completed');
        icon2.classList.add('current');
    }
    if (viewId === 3) {
        icon1.classList.add('completed');
        icon2.classList.add('completed');
        icon3.classList.add('current');
    }
    if (viewId === 4) {
        icon1.classList.add('completed');
        icon2.classList.add('completed');
        icon3.classList.add('completed');
        icon4.classList.add('current');
    }
    if (viewId === 5) {
        icon1.classList.add('completed');
        icon2.classList.add('completed');
        icon3.classList.add('completed');
        icon4.classList.add('completed');
        icon5.classList.add('current');
        //nxtBtn.innerHTML = "Submit"
    }
    if (viewId === 6) {
        icon1.classList.add('completed');
        icon2.classList.add('completed');
        icon3.classList.add('completed');
        icon4.classList.add('completed');
        icon5.classList.add('completed');
        icon6.classList.add('current');
        // nxtBtn.innerHTML = "Submit"
    }
    if (viewId > 6) {
        icon2.classList.remove('current');
        icon3.classList.remove('current');
        icon4.classList.remove('current');
        icon5.classList.remove('current');
        // icon6.classList.remove('current');

    }
}

function showPaymentMethod() {
    $('#myModal').modal('show');
}

function displayForms() {
    // if (viewId > 6) {
    //     viewId = 6;
    // }

    if (viewId === 1) {
        form1.style.display = 'block';
        form2.style.display = 'none';
        form3.style.display = 'none';
        form4.style.display = 'none';
        form5.style.display = 'none';
        form6.style.display = 'none';

    } else if (viewId === 2) {
        form1.style.display = 'none';
        form2.style.display = 'block';
        form3.style.display = 'none';
        form4.style.display = 'none';
        form5.style.display = 'none';
        form6.style.display = 'none';

    } else if (viewId === 3) {
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'block';
        form4.style.display = 'none';
        form5.style.display = 'none';
        form6.style.display = 'none';

    } else if (viewId === 4) {
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';
        form4.style.display = 'block';
        form5.style.display = 'none';
        form6.style.display = 'none';

    } else if (viewId === 5) {
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';
        form4.style.display = 'none';
        form5.style.display = 'block';
        form6.style.display = 'none';

    } else if (viewId === 6) {
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'none';
        form4.style.display = 'none';
        form5.style.display = 'none';
        form6.style.display = 'block';
    }
}

// for slider

/*var slider = document.querySelector(".slider");
var output = document.querySelector(".output__value");
output.innerHTML = slider.value ;

slider.oninput = function() {
    output.innerHTML = this.value ;


}*/
$(document).ready(function() {
    getCredentialRule();
    reviewData();
    invoiceDetail();
    getFiles();

    console.log("formsNo= " + document.forms.length);
    var formsCollection = document.getElementsByTagName("form");
    for (var i = 0; i < formsCollection.length; i++) {
        console.log("formName= " + formsCollection[i].name + " " + formsCollection[i].name);
    }

});

var credentialRule = 0;

function getCredentialRule() {
    var ruleObj = '{{$rule}}';
    //console.log(ruleObj[0]);JSON.stringify()JSON.parse()

    var currentCredentialRule = JSON.parse(ruleObj.replace(/&quot;/g, '"')); //JSON.stringify(ruleObj);
    for (var r = 0; r < currentCredentialRule.length; r++) {
        credentialRule += currentCredentialRule[r].certificates_number;
        credential_condition += currentCredentialRule[r].credential.application_detail.length;
        if (currentCredentialRule[r].credential.application_detail.length > currentCredentialRule[r]
            .certificates_number)
            AdditionalCredentialRule += (currentCredentialRule[r].credential.application_detail.length -
                currentCredentialRule[r].certificates_number);
    }
    //console.log("currentRule= " +currentCredentialRule);
    console.log("BaseRule= " + credentialRule);
}

function setNextStep(step) {
    var url = "{{url('/')}}/customer/setNextStep/{{$application->id}}/" + step;
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        cache: false,
        async: true,
        success: function(response) {
            if (response.code == 200) {
                nextForm();
            }
        }
    });
}

async function fireAlertMessage() {
    Toastify({
        text: "Great, your data saved successfully!",
        className: "success",
        style: {
            background: "linear-gradient(to right, #59C552, #59C552)",
            color: "#FFFFFF",
        },
    }).showToast();
}

/*async function fireAlertWarningMessage(currentCredentialDataID, currentKey, currentVal){
      Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        //timer: 2000,
      }).then((result) => {
      if (result.isConfirmed) {
        removeAdditionalCredentialData(currentCredentialDataID);
        removeAdditionalCredential(currentKey, currentVal);
        Swal.fire(
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
    });
}*/

async function fireAlertErrorMessage() {
    Toastify({
        text: 'You should fill all required credentials to proceed for next step!',
        className: "error",
        style: {
            background: "linear-gradient(to right, #FF3043, #FF3043)",
            color: "#FFFFFF",
        },
    }).showToast();
}


//-----------------------------------------------------------------------------------------------------
//-----------------------------Add Basic Information step-1-------------------------------------------------
//-----------------------------------------------------------------------------------------------------

function basicStep(key, i) {
    addBasic(key, i);
    nextForm();
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------Credential step-2-------------------------------------------------
//-----------------------------------------------------------------------------------------------------

function increaseValue(key, CredentialDetail, countryList) {
    var value = parseInt(document.getElementById('number' + key).value, 10);
    console.log(value);
    value = isNaN(value) ? 0 : value;
    addAdditionalCredential(key, value, CredentialDetail, countryList);
    value++;
    document.getElementById('number' + key).value = value;
    document.getElementById('decrease' + key).disabled = false;
}

function decreaseValue(key, min_value) {
    var value = parseInt(document.getElementById('number' + key).value, 10);
    console.log('currentVal= ' + value);
    if (value == min_value) {
        document.getElementById('decrease' + key).disabled = true;
    } else {
        currentCredentialDataID = document.getElementById('detail' + key + (value - 1)).value;
        if (currentCredentialDataID != 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'Are you sure?',
                text: "You won't be able to delete this credential!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                //timer: 2000,
            }).then((result) => {
                if (result.isConfirmed) {
                    value--;
                    removeAdditionalCredentialData(currentCredentialDataID);
                    removeAdditionalCredential(key, value);
                    document.getElementById('number' + key).value = value;
                    Swal.fire(
                        'Deleted!',
                        'Your credential has been deleted.',
                        'success'
                    )
                }
            });

        } else if (currentCredentialDataID == 0) {
            value--;
            removeAdditionalCredential(key, value);
            document.getElementById('number' + key).value = value;
        }
    }
}

var currentStepNumber = "{{$application->step_id}}";
var credential_condition = 0;
if (currentStepNumber == 1)
    credential_condition = -1;


function containsSpecialChars(str) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

console.log('containsSpecialChars= ' + containsSpecialChars('hello!'));



function addBasic(key, i) {
    var field_rules = null;
    if (key === "00" && i == 0) {
        field_rules = '{{$basic_info}}';
        field_rules = JSON.parse(field_rules.replace(/&quot;/g, '"'));
        field_rules = field_rules.form_fields;
    } else {
        var credintial_rules = '{{$rule}}';
        credintial_rules = JSON.parse(credintial_rules.replace(/&quot;/g, '"'));
        field_rules = credintial_rules[key].credential.form_fields;
    }
    console.log(field_rules);

    $("#add-credential-form" + key + "" + i).validate({

        /*rules:{
     
            //'`${feild1}`': objJson,
            
            'Middle_Name': {
                required: true,
                minlength: 5,
                maxlength: 20,
            },
            'Last_Name': {
                required: true,
                minlength: 5,
                maxlength: 20,
            }
        },*/
        /*messages:{
            'First_Name': {
                required: 'the field should be filled obligatory',
                minlength: 'the field has to be minimum 5 characters',
                maxlength: 'the field has to be maximum 20 characters',
            },
            'Middle_Name': {
                required: 'the field should be filled obligatory',
                minlength: 'the field has to be minimum 5 characters',
                maxlength: 'the field has to be maximum 20 characters',
            },
            'Last_Name': {
                required: 'the field should be filled obligatory',
                minlength: 'the field has to be minimum 5 characters',
                maxlength: 'the field has to be maximum 20 characters',
            }
        },*/
        submitHandler: function(form) {
            console.log(key + '  ' + i);
            var url = "{{route('application-detail-processes.store')}}";
            var serializedData = $('#add-credential-form' + key + '' + i).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'POST',
                cache: false,
                async: true,
                data: serializedData,
                success: function(response) {
                    if (response.code == 200) {
                        fireAlertMessage();
                        $('.collapse, .show').removeClass('show');
                        $('.accordion-header-change-' + key + i + ' button').css('background',
                            '#c0f1c0');
                        var val = document.getElementById("detail" + key + "" + i).value;
                        console.log(response);
                        if (val == 0) {
                            console.log("condition:" + credential_condition);
                            credential_condition++;
                            console.log("condition:" + credential_condition);
                            document.getElementById("detail" + key + "" + i).value = response
                                .detail_id;
                            console.log("condition1:" + credential_condition);
                        }
                        if (key === "00" && i == 0)
                            nextForm();
                    }
                }
            });
        }
    });

    var jsRuleField = new Array();
    for (let i1 = 0; i1 < field_rules.length; i1++) {
        var ff_rule = field_rules[i1];
        var jsRule = {};
        for (let j = 0; j < ff_rule.field_rule.length; j++) {
            var f_rule = ff_rule.field_rule[j];
            if (f_rule.rule_value == 'true')
                jsRule[f_rule.rule.rule_name] = true;
            else
                jsRule[f_rule.rule.rule_name] = f_rule.rule_value;
        }
        console.log(jsRule);
        console.log(ff_rule.lable_name);

        $("#add-credential-form" + key + "" + i + ' #' + ff_rule.lable_name).rules("add", jsRule);
        //$('#'+ff_rule.lable_name).rules("add",objJson);
    }

    //$("#First_Name").rules( "add",objJson );
    /*$("#First_Name").rules( "add", {
            required: true,
            minlength: 2,
            messages: {
                required: "Required input",
                minlength: jQuery.validator.format("Please, at least {0} characters are necessary")
            }
        });*/
}

var AdditionalCredentialRule = 0;

function addAdditionalCredential(credentialKey, collapseNumber, credentialContent, countryList) {
    credentialContent = JSON.parse(credentialContent);
    console.log(credentialContent);
    var countries = JSON.parse(countryList);
    //console.log(credentialContent[credentialKey].credential.form_fields[0]);
    // console.log(JSON.parse(countryList));
    /*for(var i = 0; i < credentialContent.length ; i++){
      console.log(credentialContent[credentialKey].credential.form_fields[i]);
    }*/
    var collapseElement = `<div class="accordion-item collapseOne` + credentialKey + collapseNumber + `">
                        <h2 class="accordion-header" id="kt_accordion_1_header_1">
                            <button id="additionalAccordionButton` + credentialKey + collapseNumber + `" class="accordion-button fs-4 fw-semibold" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne` + credentialKey + collapseNumber + `" aria-expanded="false"
                                aria-controls="collapseOne` + credentialKey + collapseNumber + `">` +

        credentialContent[credentialKey].credential.credential_type + ' #' + (collapseNumber + 1) +
        `</button>
                        </h2>
                        <div id="collapseOne` + credentialKey + collapseNumber + `" class="accordion-collapse collapse border border-danger border-1"
                            aria-labelledby="collapseOne` + credentialKey + collapseNumber +
        `" data-bs-parent="#collapseOne` + credentialKey + collapseNumber + `">
                            <div class="accordion-body">
                            <form  method="post" enctype="multipart/form-data" id="add-credential-form` +
        credentialKey +
        collapseNumber + `" class="card-body py-3 w-100 mw-xl-700px px-3" >` +
        `<input type="hidden" value="` + '{{$application->id }}' + `" name="application_id">` +
        `<input type="hidden" value="` + credentialContent[credentialKey].credential.id + `" name="credential_id">` +
        `<input type="hidden" value="0" name="detail_id" id="detail` + credentialKey + collapseNumber + `">
                            <div class="row">`;
    for (var i = 0; i < credentialContent[credentialKey].credential.form_fields.length; i++) {
        var formFields = credentialContent[credentialKey].credential.form_fields[i];
        if ((formFields.field_type.field_type == "text") || (formFields.field_type.field_type == "email") || (formFields
                .field_type.field_type == "date")) {
            collapseElement += `<div class="col-md-6 p-2 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="">` + formFields.field_label + `</span></label>` +
                `<input type="` + formFields.field_type.field_type + `" class="form-control form-control-solid" id="` +
                formFields.field_label.replaceAll(" ", "_") + `" name="` + formFields.field_label.replaceAll(' ', '_') +
                `"  required>
            </div>`;
        } else if (formFields.field_type.field_type == "select-country") {
            collapseElement += `<div class="col-md-6 p-2 fv-row">
            <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                <span class="">` + formFields.field_label + `</span></label>` +
                `<select id="` + formFields.field_label.replaceAll(" ", "_") + `"
                name="` +
                formFields.field_label.replaceAll(" ", "_") + `" data-control="select2"
                class="form-select form-select-solid form-select-lg fw-semibold">`;
            for (var c = 0; c < countries.length; c++) {
                collapseElement += `<option value="` + countries[c].country_name + `">` + countries[c].country_name +
                    `</option>`;
            }
            collapseElement += `</select>
        </div>`;
        }
    }
    collapseElement += `<div class="pt-10" style="text-align: right !important;">
        <button type="submit" class="btn btn-lg btn-sm btn-primary pull-right" onclick="addBasic(` +
        credentialKey + `,` + collapseNumber + `)">
            Add
        </button> </div>`;

    collapseElement += '</div> </form> </div></div></div>';

    $('#additinal_credential_' + credentialKey).append(collapseElement);
    AdditionalCredentialRule++;
}

function removeAdditionalCredential(currentCredential, currentCollapseNumber) {
    console.log("t: " + currentCredential + " c: " + currentCollapseNumber);
    var currentCollapse = document.getElementById('collapseOne' + currentCredential + currentCollapseNumber);
    var additionalAccordionButton = document.getElementById('additionalAccordionButton' + currentCredential +
        currentCollapseNumber);
    currentCollapse.remove();
    additionalAccordionButton.remove();
    AdditionalCredentialRule--;
}

function removeAdditionalCredentialData(credentialDataID) {
    console.log(credentialDataID);

    var url = "{{url('customer/application-detail-processes')}}/" + credentialDataID;
    console.log(url);
    //var currentID = credentialDataID;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'DELETE',
        cache: false,
        async: true,
        success: function(response) {
            if (response.code == 200) {
                console.log(response);
            }
        }
    });
}


function credentialStep() {
    console.log('credentialCondition= ' + credential_condition);
    console.log('currentRule= ' + (credentialRule + AdditionalCredentialRule));
    if (credential_condition >= (credentialRule + AdditionalCredentialRule)) {
        fireAlertMessage();
        setNextStep(3);
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    } else {
        fireAlertErrorMessage();
    }
}


//-----------------------------------------------------------------------------------------------------
//-----------------------------LOA Step-3-------------------------------------------------
//-----------------------------------------------------------------------------------------------------

var sign = $('#sign').signature({
    syncField: '#signature_txt',
    syncFormat: 'PNG'
});
$('#clear-signature').click(function(e) {
    e.preventDefault();
    sign.signature('clear');
    $('#signature_txt').val('');
});

function loaStep() {
    fireAlertMessage();
    setNextStep(4);
    getFiles();
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------documents Step-4--------------------------------------------------
//-----------------------------------------------------------------------------------------------------
function getFiles() {
    var url = "{{route('refreshData',['id' => $application->id])}}";
    $('#loading-load').show();
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        cache: false,
        async: true,
        success: function(response) {
            if (response.code == 200) {
                setFiles(response.data);
            }
        }
    });
    $('#loading-load').hide();
}

function setFiles(data) {
    $('#loading-load').show();
    condition_file_rule = 1;
    condition_file = 0;
    if (data.basic_info.application_detail.length > 0) {
        document.getElementById("app_basic_id").value = data.basic_info.application_detail[0].id;
        if (data.basic_info.application_detail[0].file_data != null) {
            condition_file++;
        }
    }
    console.log(data.app_cerdential_files);
    drawTable(data);
    $('#loading-load').hide();
}

var condition_file_rule = 1;
var condition_file = 0;

function drawTable(data) {
    $('#loading-load').show();
    document.getElementById('dynamicTable').innerHTML = "";

    for (var i = 0; i < data.app_cerdential_files.length; i++) {
        var cerdential = data.app_cerdential_files[i];
        console.log('detaillllllllllllllll');
        console.log(cerdential.application_detail);
        for (var j = 0; j < cerdential.application_detail.length; j++) {
            var detail = cerdential.application_detail[j];
            var file_form = cerdential.form_fields;
            condition_file_rule++;
            var part1 = '<div class="d-flex flex-column fv-row p-2">';
            part1 += '<form method="post" enctype="multipart/form-data" id="uploadCredentialFilesForm' + i + '' + j +
                '">';
            part1 += '<input type="hidden" value="' + detail.id + '" name="app_id" id="app_datail_id">' +
                //'<b>' + cerdential.credential_type + '#' + (j + 1) + '</b>' +
                '<b>' + cerdential.application_detail[j].form_data.Issuing_Authority_Name + '-' + cerdential
                .application_detail[j].form_data.Country + '</b>' +
                '';
            var part2 = '';
            for (var x = 0; x < file_form.length; x++) {
                file = file_form[x];
                part2 += `<div class="overflow-auto pb-5">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed flex-shrink-0 p-4">
                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                    </span>
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <div class="mb-3 mb-md-0 fw-semibold">
                            <h4 class="text-gray-900 fw-bold">` + file.field_label + `</h4>
                        </div><input type="file" id="images" name="` + file.lable_name + `" required> </div>`;
                if (detail.file_data != null) {
                    part2 += `<span>` + detail.file_data[file.lable_name] + `</span>`;
                    condition_file++;
                }
                part2 += '</div> </div>';
            }
            part1 += part2;
            part1 +=
                '<div><button type="submit" class="btn btn-success"  style="float:right" onClick=saveDocument("uploadCredentialFilesForm' +
                i + '' + j + '")>' + cerdential.credential_type + '</button></div></form></div>';
            console.log(part1);

            $('.main').append(part1);
        }

    }
}

function saveDocument(form_id) {
    $('#loading-load').show();
    $("#" + form_id).validate({
        submitHandler: function(form) {
            var url = "{{route('saveDocument')}}";
            var serializedData = $('#' + form_id).serialize();
            var form1 = $('#' + form_id)[0];
            console.log(form1);
            var data1 = new FormData(form1);
            console.log(data1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: url,
                type: 'POST',
                enctype: 'multipart/form-data',
                cache: false,
                async: true,
                processData: false,
                contentType: false,
                data: data1,
                success: function(response) {
                    if (response.code == 200) {
                        console.log(response);
                        $('#loading-load').hide();
                        if (response.condition == 0)
                            condition_file++;
                        fireAlertMessage();
                    }
                }
            });
        }
    });
    $('#loading-load').hide();
}

function documentStep() {
    console.log("t " + condition_file + " r " + condition_file_rule);

    if (condition_file_rule <= condition_file) {
        fireAlertMessage();
        reviewData();
        setNextStep(5);
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    } else {
        fireAlertErrorMessage();
    }
}
//-----------------------------------------------------------------------------------------------------
//-----------------------------Review Step-5--------------------------------------------------
//-----------------------------------------------------------------------------------------------------



function reviewData() {
    var url = "{{route('reviewData',['id' => $application->id])}}";
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        cache: false,
        async: true,
        success: function(response) {
            if (response.code == 200) {
                console.log(response);
                drawReview(response.data);
            }
        }
    });
}

function removeReviewData() {
    var reviewRemove = document.getElementById('review_main');
    reviewRemove.remove();
}

function drawReview(data) {
    var part1 = `<div class="w-100 p-3">
                            <div class="p-6">
                              <div
                                class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6"
                              >
                                <div class="d-flex flex-stack flex-grow-1">
                                  <div class="fw-semibold">
                                    <h4 class="text-gray-900 fw-bold">
                                      Your Are Almost Done!
                                    </h4>
                                    <div class="fs-6 text-gray-700">
                                      Please review your application and ensure
                                      that the provided information is accurate
                                      before proceeding to checkout
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br />
                            <h2 class="p-4 text-gray-900 fw-bold">
                              Application Information(#` + data.application_serial + `)
                            </h2> <hr>`;
    var part2 = '';
    let randNum = 0;
    for (var i = 0; i < data.application_details.length; i++) {
        var detail = data.application_details[i];
        let details_info = JSON.stringify(detail.form_data);

        part2 += '<div class="p-3"><div class="accordion p-3" id="kt_accordion_1">';

        if (detail.credential.credential_type == 'Basic Information') {

            part2 += `<div class="px-4 mb-0">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="table-responsive">
                                    <table
                                      class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px"
                                    >
                                      <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                            First Name
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + detail.form_data.First_Name + `
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                              <span
                                                class="svg-icon svg-icon-2 me-2"
                                              >
                                              </span>
                                             Middle Name 
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + detail.form_data.Middle_Name + `
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                              <span
                                                class="svg-icon svg-icon-2 me-2"
                                              >
                                              </span>
                                              Last Name
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + detail.form_data.Last_Name + `
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                              <span
                                                class="svg-icon svg-icon-2 me-2"
                                              >
                                              </span>
                                              Passport Number
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + detail.form_data.Passport_Number + `
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="table-responsive">
                                    <table
                                      class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px"
                                    >
                                      <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                              <span
                                                class="svg-icon svg-icon-2 me-2"
                                              >
                                              </span>
                                              Nationality
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + detail.form_data.nationality + `
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                              <span
                                                class="svg-icon svg-icon-2 me-2"
                                              >
                                              </span>
                                              Profession
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + data.profession.profession + `
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                              <span
                                                class="svg-icon svg-icon-2 me-2"
                                              >
                                              </span>
                                              ID/Residence Number
                                            </div>
                                          </td>
                                          <td class="fw-bold ">
                                          ` + detail.form_data.ID_or_Residence_Number + `
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                `;

            var part3 = '';

            $.each(detail.file_data, function(index_file, value_file) {
                var path = "{{url('/')}}/" + detail.file_path + detail.file_data[index_file];
                let extension = path.split(".").pop();
                if (extension == 'pdf') {
                    part3 += "<div class='item'><a href='" +
                        path +
                        "' download><img src={{asset('assets/img/pdf.png')}} width='150' height='50'> <span class='caption'>" +
                        index_file.replace(/_/g, ' ') + "</span></a></div>";

                } else {
                    part3 += '<a target="_blank" href="' + path + '"><img src="' + path +
                        '" width="100px"></a>';
                }
            });
            var LOA = "{{url('/')}}/" + (detail.file_path.substring(0, detail.file_path.indexOf(data
                .application_serial))) + data.application_serial + '/loa/LetterOfAuthorization.pdf';

            part3 += "<div class='item'><a href='" +
                LOA +
                "' download><img src={{asset('assets/img/pdf.png')}} width='150' height='50'> <span class='caption'>LOA</span></a></div>";
            part2 += part3;
            part2 += ` </div></div>
                            </div>
                            <br />
                            <div class="mb-0">`;



        } else {
            let sample_credentail = JSON.parse(details_info);
            randNum++;
            part2 += `<div class="accordion-item">
                                  <h2
                                    class="accordion-header"
                                    id="kt_accordion_1_header_` + randNum + `"
                                  >
                                    <button
                                      class="accordion-button fs-4 fw-semibold"
                                      type="button"
                                      data-bs-toggle="collapse"
                                      data-bs-target="#kt_accordion_1_body_` + randNum + `"
                                      aria-expanded="false"
                                      aria-controls="kt_accordion_1_body_` + randNum + `"
                                      style=""
                                    >
                                      ` + sample_credentail.Issuing_Authority_Name + '-' + sample_credentail.Country + `
                                    </button>
                                  </h2>
                                  <div
                                    id="kt_accordion_1_body_` + randNum + `"
                                    class="accordion-collapse collapse border border-success border-1"
                                    aria-labelledby="kt_accordion_1_header_` + randNum + `"
                                    data-bs-parent="#kt_accordion_` + randNum + `"
                                  >
                                    <div class="accordion-body">`;


            console.log(sample_credentail);
            // for (var j = 0; j < sample_credentail.length; j++) {
            $.each(sample_credentail, function(index, value) {
                part2 += `<div class="row"><div class="table-responsive"><table
                                      class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px"
                                    >
                                    <tbody class="fw-semibold text-gray-600">
                                        <tr>
                                          <td class="text-muted">
                                            <div
                                              class="d-flex align-items-center"
                                            >
                                            ` + index.replace(/_/g, ' ') + `
                                            </div>
                                          </td>
                                          <td class="fw-bold text-end">
                                          ` + value + `
                                          </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>`;
            });

            var part3 = '';
            $.each(detail.file_data, function(index_file, value_file) {
                var path = "{{url('/')}}/" + detail.file_path + detail.file_data[index_file];
                let extension = path.split(".").pop();
                if (extension == 'pdf') {
                    part3 += "<div class='item'><a href='" +
                        path +
                        "' download><img src={{asset('assets/img/pdf.png')}} width='150' height='50'> <span class='caption'>" +
                        index_file.replace(/_/g, ' ') + "</span></a></div>";

                } else {
                    part3 += '<a target="_blank" href="' + path + '"><img src="' + path +
                        '" width="100px"></a>';
                }
            });
            part2 += part3;
            part2 += `</div></div></div>`;
        }
        part2 += `</div></div>`;

    }
    //$('.review_main').append(part1 + part2);
    document.getElementById('review_main').innerHTML = (part1 + part2);
}

function reviewStep() {
    fireAlertMessage();
    invoiceDetail();
    setNextStep(6);
}

//-----------------------------------------------------------------------------------------------------
//-----------------------------Payment Step-6--------------------------------------------------
//-----------------------------------------------------------------------------------------------------

function invoiceDetail() {
    var url = "{{route('invoiceData',['id' => $application->id])}}";
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'GET',
        cache: false,
        async: true,
        success: function(response) {
            if (response.code == 200) {
                console.log(response);
                var qtyPrice = 0;
                var part1 = '';
                var part2 = '';
                var additional_credential_count = 0;
                for (var i = 0; i < response.data.length; i++) {
                    var detail = response.data[i];
                    console.log(detail.credential_type);
                    part1 += '<tr><td>' + (i + 1) + '</td><td>' + detail.credential_type + '</td>';
                    var qty = detail.application_detail.length - detail.rule.certificates_number;
                    if (detail.id == 5 && response.checkEmploymentExist) {
                        part1 += '<td>1</td>';
                        qty -= 1;
                    } else {
                        part1 += '<td>' + detail.rule.certificates_number + '</td>';
                    }
                    if (i == 0) {
                        part1 += '<td class="text-end" rowspan="' + response.data.length + '">$' + response
                            .base_cost + '</td></tr>';
                    }
                    if (qty > 0) {
                        additional_credential_count++;
                        part2 += '<tr><td>' + additional_credential_count + '</td><td>' + detail
                            .credential_type + '</td>';
                        part2 += '<td>' + qty + '</td><td>$' + detail.credential_cost +
                            '</td><td class="text-end">$' + (qty * detail.credential_cost) + '</td></tr>';
                        qtyPrice += (qty * detail.credential_cost);

                    }

                }

                var total = parseInt(response.base_cost) + parseInt(qtyPrice);
                part2 +=
                    '<tr><td colspan="4" class="text-end">Main Credentials Cost</td><td class="text-end"><b>$' +
                    response.base_cost + '</b></td>' +
                    '</tr><td colspan="4" class="text-end">Additional Credentials Cost</td><td class="text-end"> <b>$' +
                    qtyPrice + '</b></td><tr></tr>' +
                    '<tr><td colspan="4" class="fs-3 text-dark fw-bold text-end">Total Amount</td><td class="text-dark fs-3 fw-bolder text-end">$' +
                    total + '</td></tr>';
                document.getElementById('basic_credential_price').innerHTML = part1;
                document.getElementById('additional_credential_price').innerHTML = part2;
                if (additional_credential_count == 0)
                    document.getElementById('additionalCredentialTableShow').style.display = "none";
                document.getElementById('total_cost_payment').value = total;
                document.getElementById('total_cost_button').innerHTML = total;
            }

        }
    });
}



//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
//------------------------------------------------------------------------------------
</script>