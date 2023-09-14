<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application - Credentinal Information') }}
        </h4>
    </x-slot>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

      <style>
      #stepper {
    /*text-align: center;*/
    position: relative;
    margin-top: 20px
}
#stepper li{
text-align: center;
}
#stepper fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;
    position: relative
}
.finish {
    text-align: center
}
#stepper fieldset:not(:first-of-type) {
    display: none
}
#stepper .pre-step {
    width: 100px;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}
.next-step {
    width: 100px;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px 10px 0px;
    float: right
}
.stepper, .pre-step {
    background: #616161;
}
.stepper, .next-step {
    background: red;
}
#stepper .pre-step:hover
{
    background-color: #000000
}
#stepper .pre-step:focus {
    background-color: #000000
}
#stepper .next-step:hover
{
    background-color: #2F8D46
}
#stepper .next-step:focus {
    background-color: #2F8D46
}
.text {
    color: red;
    font-weight: normal
}
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey
}
#progressbar .active {
    color: #2F8D46
}
#progressbar li {
    list-style-type: none;
    font-size: 15px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}
#progressbar #step1:before {
    content: "1"
}
#progressbar #step2:before {
    content: "2"
}
#progressbar #step3:before {
    content: "3"
}
#progressbar #step4:before {
    content: "4"
}
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px
}
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1
}
#progressbar li.active:before
{
    background: #2F8D46
}
#progressbar li.active:after {
    background: #2F8D46
}
#progressbar li.active:after {
    background: #2F8D46
}
h2 {
text-transform: uppercase;
   font-weight: normal;
text-align: center;
 margin: 10;
   padding: 10
color: red;
}
.progress {
    height: 20px
}
.pbar {
    background-color: #2F8D46
}

.btn-circle {
            width: 50px;
            height: 50px;
            padding: 7px 10px;
            border-radius: 25px;
            font-size: 10px;
            text-align: center;
        }

        .faq-section .mb-0 > a {
          display: block;
          position: relative;
        }

        .faq-section .mb-0 > a:after {
          content: "\f067";
          font-family: "Font Awesome 5 Free";
          position: absolute;
          right: 0;
          font-weight: 600;
        }

        .faq-section .mb-0 > a[aria-expanded="true"]:after {
          content: "\f068";
          font-family: "Font Awesome 5 Free";
          font-weight: 600;
        }

      </style>
    </head>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <!-- MultiStep Form -->
                <div class="container">
                  <h4> Credential Information </h4>
                  <hr>
                      <div class="row">
                          <div class="col-11 col-sm-9 col-md-7
                              col-lg-12 col-xl-12 p-0 mt-3 mb-2">
                              <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                                  <div id="stepper">
                                  <ul id="progressbar">
                                  <li class="active" id="step1"><strong>Main Information</strong></li>
                                  <li class="active" id="step2"> <strong>Credential Information</strong> </li>
                                  <li id="step3"> <strong>Application Review </strong> </li>
                                  <li id="step4"> <strong> Payment</strong> </li>
                                      </ul>
                              <div class="progress">
                              <div class="pbar"> </div>
                                  </div> <br>

                              <fieldset>
                                <div class="alert alert-warning">
                                  - Please, upload the following credentials certificates <br>
                                  @php $condition = true; @endphp
                                  <ul class="list-group">
                                      @foreach($credentials as $key=>$credentialRule)
                                      @if($credentialRule->rule->certificates_number > $credentialRule->applicationDetail->count())
                                        @php $condition = false; @endphp
                                      @endif
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                       {{$credentialRule->credential_type}}
                                      <span class="badge badge-primary badge-pill">{{$credentialRule->rule->certificates_number}}</span>
                                    </li>
                                    @endforeach
                                  </ol>
                                </div>
                                <!--<h2> Welcome To Credential Information Step 2 </h2>-->
                              <div class="row">
                                @foreach($credentials as $key=>$credential)
                                    <div class="col-md-4">
                                      <div class="card text-center">
                                        <div class="card-body">
                                          <i class="fa fa-file-o" style="font-size:40px;"></i> <br>
                                          {{ $credential->credential_type }}
                                          <br><br>
                                          <button type="button" class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#myModal{{$key+1}}">
                                            <i class="fa fa-plus" style="font-size:12px;"></i>
                                          </button>
                                        </div>
                                      </div>
                                    </div>

                                  @include('customer.application.partials.credential-add-modal')


                                  @endforeach
                                </div>

                                <div class="flex flex-column mb-5 mt-4 faq-section">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="accordion">

                                @foreach($credentials as $key=>$credentialData)
                                    <div class="card">
                                      <div class="card-header" id="heading-{{$key+1}}">
                                        <h5 class="mb-0">
                                          <a role="button" data-toggle="collapse" href="#collapse-{{$key+1}}" aria-expanded="{{ ($key+1 === 1) ? 'true' : 'false'}}" aria-controls="collapse-{{$key+1}}">
                                            {{ $credentialData->credential_type }} : fees  {{$credentialData->credential_cost}}$/item
                                          </a>
                                        </h5>
                                      </div>
                                      <div id="collapse-{{$key+1}}" class="collapse {{ ($key+1 === 1) ? 'show' : ''}}" data-parent="#accordion" aria-labelledby="heading-{{$key+1}}">
                                        <div class="card-body">
                                          <table class="table table-bordered">
                                            <tbody>
                                              @foreach($credentialData->applicationDetail as $appKey=>$credentialRecord)
                                              @php $count = 0; @endphp
                                              <tr>
                                                <td>#{{ $appKey+1 }}</td>
                                                @foreach($credentialRecord->form_data as $index=>$credentialValue)
                                                <td>{{ $credentialValue }}</td>
                                                @if(++$count == 3)
                                                @break
                                                @endif
                                                @endforeach
                                                <td>
                                                  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalEdit{{$credentialRecord->id}}">
                                                    <i class="fa fa-eye" style="font-size:12px;"></i>
                                                  </button>
                                                </td>
                                              </tr>
                                              <!-- The Modal -->
                                              <div class="modal fade" id="myModalEdit{{$credentialRecord->id}}">
                                                <div class="modal-dialog modal-xl">
                                                  <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                      <h4 class="modal-title">Edit Data</h4>
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">

                                                <form action="{{route('applicationDetails.update',['applicationDetail'=>$credentialRecord->id])}}" method="post" enctype="multipart/form-data">
                                                  @csrf
                                                  @method('PUT')
                                                  <input type="hidden" name="credential_id" value="{{$credentialData->id}}">
                                                  <div class="row">
                                                  @foreach ($credentialData->formFields as $fieldKey => $credentialFields)
                                                  <div class="col-md-4">
                                                    <div class="form-group">

                                                      @if(($credentialFields->fieldType->field_type == "text") ||
                                                        ($credentialFields->fieldType->field_type == "email") ||
                                                        ($credentialFields->fieldType->field_type == "date"))
                                                      <label>{{ $credentialFields->field_label }}</label>
                                                      <input type="{{ $credentialFields->fieldType->field_type }}" class="form-control" id="{{str_replace(" ", "_", $credentialFields->field_label)}}" name="{{str_replace(" ", "_", $credentialFields->field_label)}}"  value="{{$credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)]}}" required>

                                                      @elseif($credentialFields->fieldType->field_type == "select-country")
                                                          <label>{{ $credentialFields->field_label }}</label>
                                                          <select class="form-control" id="{{str_replace(" ", "_", $credentialFields->field_label)}}"  name="{{str_replace(" ", "_", $credentialFields->field_label)}}">
                                                            @foreach($countries as $key=>$country)
                                                              <option value="{{$country->country_name}}" {{($credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)] == $country->country_name)?"selected":""}}>{{ $country->country_name }}</option>
                                                            @endforeach
                                                          </select>
                                                      @endif

                                                    </div>
                                                  </div>

                                                  @endforeach
                                                </div>

                                                <hr>

                                                <div class="row">
                                                @foreach ($credentialData->formFields as $fieldKey => $credentialFields)
                                                  @if($credentialFields->fieldType->field_type === "file" )
                                                    <div class="col-md-4">
                                                      <div class="form-group">
                                                        <label>{{ $credentialFields->field_label }}</label>
                                                        <input type="{{ $credentialFields->fieldType->field_type }}" accept="image/*,.pdf, .doc, .docx" class="form-control" id="{{str_replace(" ", "_", $credentialFields->field_label)}}" name="{{str_replace(" ", "_", $credentialFields->field_label)}}" value="{{$credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)]}}" >

                                                        <br>
                                                        <center>
                                                        @if(pathinfo($credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)], PATHINFO_EXTENSION) == 'pdf' ||
                                                        pathinfo($credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)], PATHINFO_EXTENSION) == 'doc' ||
                                                        pathinfo($credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)], PATHINFO_EXTENSION) == 'docx')
                                                          <a href="{{url('/')}}/{{ $credentialRecord->file_path}}/{{$credentialRecord->form_data[str_replace(" ", "_", $credentialFields->field_label)]}}" download> {{$credentialRecord->form_data[str_replace(" ","_",$credentialFields->field_label)]}}</a>
                                                        @else
                                                        <img class="img-thumbnail" src="{{url('/')}}/{{ $credentialRecord->file_path}}/{{$credentialRecord->form_data[str_replace(" ", "_", $credentialFields->field_label)]}}" width="100px" >
                                                        @endif
                                                      </center>
                                                      </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                </div>


                                                          <button type="submit" class="btn btn-info mb-2 pull-right"style="padding: 15px;font-size:22px;">Edit</button>
                                                      </form>


                                                  </div><!---modal body -->
                                                </div><!---modal content -->
                                              </div><!---modal dialog -->
                                            </div><!---modal -->
                                              @endforeach

                                            </tbody>
                                          </table>
                                        </div>
                                      </div>
                                    </div>
                                @endforeach

                              </div>
                            </div>

                          </div>
                        </div>

                              @if($condition)
                              <a href="{{ route('applications.show', ['application' => $application->id]) }}" class="btn btn-success mb-2 pull-right"style="padding: 15px;font-size:22px;">Next</a>
                              @else
                              <button data-toggle="modal" data-target="#myModalNotAllowed" class="btn btn-success mb-2 pull-right"style="cursor:not-allowed;padding: 15px;font-size:22px;">Next</button>
                              @endif
                              <a href="{{route('applicationDetails.edit',['applicationDetail' => $application->applicationDetails[0]->id])}}" class="btn btn-info mb-2 pull-right mr-3"style="padding: 15px;font-size:22px;">Previouse Step</a>



                              <!-- The Modal -->
                              <div class="modal" id="myModalNotAllowed">
                                <div class="modal-dialog">
                                  <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header" style=" background-color: red; color: white; ">
                                      <h6 class="modal-title">To proceed for next step</h6>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                      <div class="alert alert-danger">
                                        - Please, upload the following credentials certificates <br>
                                        <ul class="list-group">
                                            @foreach($credentials as $key=>$credentialRule)
                                          <li class="list-group-item d-flex justify-content-between align-items-center">
                                             {{$credentialRule->credential_type}}
                                            <span class="badge badge-primary badge-pill">{{$credentialRule->rule->certificates_number}}</span>
                                          </li>
                                          @endforeach
                                        </ol>
                                      </div>

                                    </div>
                                  </div>
                                </div>
                              </div>

                              </fieldset>


                              <fieldset>
                                step2
                              </fieldset>


                              <fieldset>
                                  step3
                              </fieldset>


                              <fieldset>
                                    step4
                              </fieldset>


                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
<!-- /.MultiStep Form -->

            </div>
        </div>
    </div>
</div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
<script>
$(document).ready(function () {
    var currentGfgStep, nextGfgStep, preGfgStep;
    var opacity;
    var current = 2;
    var steps = $("fieldset").length;
    setProgressBar(current);
  /*  $(".next-step").click(function () {
        currentGfgStep = $(this).parent();
        console.log(currentGfgStep);
        nextGfgStep = $(this).parent().next();
        $("#progressbar li").eq($("fieldset")
            .index(nextGfgStep)).addClass("active");
        nextGfgStep.show();
        currentGfgStep.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;
                currentGfgStep.css({
                    'display': 'none',
                    'position': 'relative'
                });
                nextGfgStep.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(++current);
    });
    $(".pre-step").click(function () {
        currentGfgStep = $(this).parent();
        preGfgStep = $(this).parent().prev();
        $("#progressbar li").eq($("fieldset")
        .index(currentGfgStep)).removeClass("active");
        preGfgStep.show();
        currentGfgStep.animate({ opacity: 0 }, {
            step: function (now) {
                opacity = 1 - now;
                currentGfgStep.css({
                    'display': 'none',
                    'position': 'relative'
                });
                preGfgStep.css({ 'opacity': opacity });
            },
            duration: 500
        });
        setProgressBar(--current);
    });
    */
    function setProgressBar(currentStep) {
        var percent = parseFloat(100 / steps) * current;
        percentpercent = percent.toFixed();
        $(".pbar")
            .css("width", percent + "%")
    }
    $(".submit").click(function () {
        return false;
    })

});
</script>
