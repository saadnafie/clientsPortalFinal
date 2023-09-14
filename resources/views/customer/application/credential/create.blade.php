<x-app-layout>
    <x-slot name="header">
        <h4 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Application - Credentinal Information') }}
        </h4>
    </x-slot>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">

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
                                    <h2> Welcome To Credential Information Step 2 </h2>
                                <input type="button" name="next-step" class="next-step" value="Next Step" />
                                <a href="{{route('applicationDetails.edit',['applicationDetail' => $application->applicationDetails[0]->id])}}" name="pre-step" class="pre-step"> Pre Step </a>

                                  </fieldset>


                                  <fieldset>

                              </fieldset>


                          <fieldset>
                              <h2> Welcome To JavaTpoint Step 3 </h2> <input type="button" name="next-step" class="next-step" value="Final Step" />
                              <input type="button" name="pre-step" class="pre-step" value="Pre Step" />
                          </fieldset>


                          <fieldset>
                                  <div class="finish">
                                  <h2 class="text text-center">
                                  <strong> FINISHED </strong>
                                      </h2>
                                  </div>
                              <input type="button" name="pre-step"  class="pre-step" value="Pre Step" />
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
