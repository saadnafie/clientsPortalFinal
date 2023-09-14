<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application - Review ') }}
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

<div class="py-12" style="padding-top: 1rem;">
  <!-- max-w-7xl -->
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <!-- MultiStep Form -->
                <div class="container-fluid">
                  <h4> Application Information Review</h4>
                  <hr>
                      <div class="row">
                        <!--mt-3-->
                          <div class="col-11 col-sm-9 col-md-12
                              col-lg-12 col-xl-12 p-0 mb-2">
                              <!--pt-4 mt-3-->
                              <div class="px-0 pb-0 mb-3">
                                  <div id="stepper">
                                  <ul id="progressbar">
                                  <li class="active" id="step1"><strong>Main Information</strong></li>
                                  <li class="active" id="step2"> <strong>Credential Information</strong> </li>
                                  <li class="active" id="step3"> <strong>Application Review </strong> </li>
                                  <li id="step4"> <strong> Payment</strong> </li>
                                      </ul>
                              <div class="progress">
                              <div class="pbar"> </div>
                                  </div> <br>

                              <fieldset>

                                    <div class="flex flex-column mb-5 mt-4 faq-section">
                                      <div class="row">
                                        <div class="col-md-9">
                                          <div id="accordion">

                                            @foreach($credentials as $key=>$credentialData)
                                            <div class="card">
                                              <div class="card-header" id="heading-{{$key+1}}">
                                                <h5 class="mb-0">
                                                  <a role="button" data-toggle="collapse" href="#collapse-{{$key+1}}" aria-expanded="{{ ($key+1 === 1) ? 'true' : 'false'}}" aria-controls="collapse-{{$key+1}}">
                                                    {{ $credentialData->credential_type }}
                                                  </a>
                                                </h5>
                                              </div>
                                              <div id="collapse-{{$key+1}}" class="collapse {{ ($key+1 === 1) ? 'show' : ''}}" data-parent="#accordion" aria-labelledby="heading-{{$key+1}}">
                                                <div class="card-body">

                                                  @foreach($credentialData->applicationDetail as $key=>$applicationDetailRecord)
                                                  @php $files = $credentialData->formFields->pluck('lable_name'); @endphp
                                                  <div class="row">
                                                    @foreach($applicationDetailRecord->form_data as $keyData=>$applicationRecordData)
                                                      @if(!(array_search($keyData,$files->toArray()) > -1))
                                                      <div class="col-md-4">
                                                        <div class="input-group mt-3">
                                                         <div class="input-group-prepend" >
                                                           <span class="input-group-text" style="width:200px; font-size:11px;">{{ str_replace("_", " ", $keyData) }}</span>
                                                         </div>
                                                         <input type="text" class="form-control" value="{{ $applicationRecordData }}" style="background-color: white;font-size:11px;" readonly>
                                                       </div>

                                                      </div>
                                                      @endif
                                                    @endforeach
                                                  </div>
                                                  <hr>

                                                    <div class="row">
                                                        @foreach($files as $file)
                                                      <div class="col-md-4">
                                                        <center>
                                                          @if(pathinfo($applicationDetailRecord->form_data[$file], PATHINFO_EXTENSION) == 'pdf' ||
                                                          pathinfo($applicationDetailRecord->form_data[$file], PATHINFO_EXTENSION) == 'doc' ||
                                                          pathinfo($applicationDetailRecord->form_data[$file], PATHINFO_EXTENSION) == 'docx')
                                                            <a href="{{url('/')}}/{{$applicationDetailRecord->file_path . $applicationDetailRecord->form_data[$file]}}" download> Download File</a>
                                                          @else
                                                          <img class="img-thumbnail" src="{{url('/')}}/{{$applicationDetailRecord->file_path . $applicationDetailRecord->form_data[$file]}}" style="width:100px;height:100px;">
                                                          @endif
                                                        </center>
                                                      </div>
                                                        @endforeach
                                                    </div>



                                                  @endforeach
                                                </div>
                                              </div>
                                            </div>
                                            @endforeach


                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                          <div class="card">
                                            <div class="card-body">
                                              <center><p>Thanks for your application<br>Invoice Summary</p></center><br><br>
                                              <p>{{ auth()->user()->name }}<br>
                                                 Invoice <span style="color:gray;">#{{ $application->application_serial }}</span><br>
                                                 {{ now() }}</p><br>
                                                 @php $total = 0; @endphp
                                                 @foreach($credentials as $key=>$credentialData)
                                                 @php $total += ($credentialData->applicationDetail->count()) * ($credentialData->credential_cost); @endphp
                                                   @if($key > 0)
                                                     <hr>
                                                      {{$credentialData->credential_type}} <span style="float:right;">${{ ($credentialData->applicationDetail->count()) * ($credentialData->credential_cost) }}.00</span>

                                                  @endif
                                                 @endforeach
                                                 <hr>
                                                 <p class="text-right"><b>Total: ${{ $total }}.00</b></p>
                                                  <!--<hr>
                                                  <button type="button" class="btn btn-primary" style="width:100%;">Checkout</button>-->
                                            </div>
                                          </div>
                                        </div>

                                      </div>
                                    </div>


                                    <a href="{{ route('checkout', ['id' => $application->id]) }}" class="btn btn-success mb-2 pull-right"style="padding: 15px;font-size:22px;">Next</a>

                                    <a href="{{route('applicationCredential', ['id' => $application->id]) }}" class="btn btn-info mb-2 pull-right mr-3"style="padding: 15px;font-size:22px;">Previouse Step</a>

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
    var current = 3;
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
