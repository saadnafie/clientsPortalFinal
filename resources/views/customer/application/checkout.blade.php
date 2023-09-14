<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application - Payment ') }}
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
                  <h4> Application Payment - Invoice Details</h4>
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
                                  <li class="active" id="step4"> <strong> Payment</strong> </li>
                                      </ul>
                              <div class="progress">
                              <div class="pbar"> </div>
                                  </div> <br>

                              <fieldset>

                                    <div class="flex flex-column mb-5 mt-4 faq-section">
                                      <div class="row">
                                        <div class="col-md-12" >

                                          <div class="container" style=" border: 1px dashed silver; padding: 20px; ">
                                            <h2>Invoice</h2>
                                            <center><p>Your application invoice details</p></center>
                                            <p>To: <span style="color:#5d9fc5 ;">{{ auth()->user()->name }}</span><br>
                                               ID: <span style="color:gray;">#{{ $application->application_serial }}</span><br>
                                               Issued Date: <span style="color:gray;">{{ now() }}</span><br>
                                             status: <span class="badge badge-warning">Unpaid</span> </p><br>
                                            <div class="table-responsive">

                                            <table class="table table-striped">
                                              <thead style="background-color:#84B0CA ;" class="text-white">
                                                <tr>
                                                  <th>#</th>
                                                  <th>Description</th>
                                                  <th>Qty</th>
                                                  <th>Unit Price</th>
                                                  <th>Amount</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                @php $total = 0; @endphp
                                                @foreach($credentials as $key=>$credentialData)
                                                @php $total += ($credentialData->applicationDetail->count()) * ($credentialData->credential_cost); @endphp
                                                  @if($key > 0)
                                                <tr>
                                                  <td>{{ $key }}</td>
                                                  <td>{{ $credentialData->credential_type }}</td>
                                                  <td>{{ $credentialData->applicationDetail->count() }}</td>
                                                  <td>${{ $credentialData->credential_cost }}</td>
                                                  <td>${{ ($credentialData->applicationDetail->count()) * ($credentialData->credential_cost) }}</td>
                                                </tr>
                                                @endif
                                               @endforeach

                                              </tbody>
                                            </table>
                                            </div>
                                            <hr>
                                            <p class="text-right"><b>SubTotal: ${{ $total }}</b></p>
                                            <p class="text-right"><b>Tax(0%): $0</b></p>
                                            <hr>
                                            <p class="text-right"><b>Total Amount: ${{ $total }}</b></p>
                                            <hr>

                                            <button data-toggle="modal" data-target="#myModal" type="button" class="btn btn-primary text-capitalize pull-right" style="background-color: rgb(96, 189, 243);">Pay Now</button>
                                            <br><br>
                                            </div>

                                            <!-- The Modal -->
                                            <div class="modal" id="myModal">
                                              <div class="modal-dialog">
                                                <div class="modal-content">

                                                  <!-- Modal Header -->
                                                  <div class="modal-header">
                                                    <h6 class="modal-title">Select Payment Method</h6>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  </div>

                                                  <!-- Modal body -->
                                                  <div class="modal-body">
                                                    <form method="get" action="{{route('stripe.show',['stripe' => $application->id ])}}">
                                                      <input type="hidden" name="total_cost" value="{{$total}}">
                                                    <div class="form-check">
                                                      <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="optradio" checked> <img src="{{ url('visa-mastercard-logo.png') }}" width="120px" >
                                                      </label>
                                                    </div>
                                                    <hr>
                                                    <div class="form-check">
                                                      <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="optradio" > <img src="{{ url('apple-pay-logo.png') }}" width="80px" >
                                                      </label>
                                                    </div>
                                                    <hr>
                                                    <div class="form-check">
                                                      <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="optradio" > <img src="{{ url('paypal-logo.png') }}" width="100px">
                                                      </label>
                                                    </div>
                                                    <hr>
                                                    <button type="submit" class="btn btn-primary text-capitalize float-right" style="background-color: rgb(96, 189, 243);width:100%;">Pay ${{ $total }}</button>
                                                    {{--<a href="{{route('stripe.show',['stripe' => $application->id ])}}" type="button" class="btn btn-primary text-capitalize float-right" style="background-color: rgb(96, 189, 243);width:100%;">Pay ${{ $total }}</button>--}}
                                                  </form>
                                                  </div>

                                                </div>
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
    var current = 4;
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
