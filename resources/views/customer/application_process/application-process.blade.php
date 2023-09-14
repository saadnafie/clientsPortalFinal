@extends('layouts/master-with-nav-steps')
@section('main-title')
New Application
@endsection

@section('username')
{{Auth()->user()->name}}
@endsection


@section('page-style')
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css')}}" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="{{asset('assets/js/signature_pad.min.js')}}"></script>

<style>
.text-justify {
    text-align: justify;
}

input[type="file"]::file-selector-button {
    margin-right: 20px;
    border: none;
    background: #e96559;
    padding: 10px 20px;
    border-radius: 10px;
    color: #fff;
    cursor: pointer;
    transition: background 0.2s ease-in-out;
}

input[type="file"]::file-selector-button:hover {
    background: #0d45a5;
}

i {
    font-size: 2rem !important;
}

.error {
    color: red;
    font-size: 11px;
}
</style>


@endsection

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid gap-10"
                id="kt_create_account_stepper">
                <div
                    class="card d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px w-xxl-300px card-background-color">
                    <div class="card-body px-10 px-lg-10 px-xxl-10 py-5">
                        <div class="stepper-nav">
                            <div class="stepper-item current" id="icon1" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Basic Information</h3>
                                        <!-- <div class="stepper-desc fw-semibold">
                                            Individual's Details
                                        </div> -->
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" id="icon2" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Credentials</h3>
                                        <!-- <div class="stepper-desc fw-semibold">
                                            Application certificates and license
                                            information
                                        </div> -->
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" id="icon3" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">LOA</h3>
                                        <!-- <div class="stepper-desc fw-semibold">
                                            Sign the Letter of Authorization
                                        </div> -->
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" id="icon4" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">4</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Documents</h3>
                                        <!-- <div class="stepper-desc fw-semibold">
                                            Upload all required documents
                                        </div> -->
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" id="icon5" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">5</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Review</h3>
                                        <!-- <div class="stepper-desc fw-semibold">
                                            Review the details in your application
                                        </div> -->
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item mark-completed" id="icon6" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">6</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Payment</h3>
                                        <!-- <div class="stepper-desc fw-semibold">
                                            Quotation & Payment
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card d-flex flex-row-fluid flex-center card-background-color"
                    style="align-items:normal !important;">
                    <div class="current" id="form1" data-kt-stepper-element="content">
                        @include('customer.application_process.components.add-basic-information-step')
                    </div>


                    <div class="pending" id="form2" data-kt-stepper-element="content">
                        @include('customer.application_process.components.credential-step')
                    </div>

                    <div class="pending" id="form3" data-kt-stepper-element="content">
                        @include('customer.application_process.components.loa')
                    </div>


                    <div class="pending" id="form4" data-kt-stepper-element="content">
                        @include('customer.application_process.components.documents')
                    </div>


                    <div class="pending" id="form5" data-kt-stepper-element="content">
                        @include('customer.application_process.components.review')
                    </div>


                    <div class="pending" id="form6" data-kt-stepper-element="content">
                        @include('customer.application_process.components.payment')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Select Payment Method</h6>
                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="get" action="{{route('stripe.show',['stripe' => $application->id ])}}">
                    <input type="hidden" id="total_cost_payment" name="total_cost"
                        value="{{$profession_country->base_cost}}">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="stripe_opt" name="optradio"
                                checked="checked"> <img src="{{ url('visa-mastercard-logo.png') }}" width="120px">
                        </label>
                    </div>
                    <hr>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="apple_opt" name="optradio" disabled> <img
                                src="{{ url('apple-pay-logo.png') }}" width="80px">
                        </label>
                    </div>
                    <hr>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" id="paypal_opt" name="optradio" disabled> <img
                                src="{{ url('paypal-logo.png') }}" width="100px">
                        </label>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary text-capitalize float-right"
                        style="background-color: rgb(96, 189, 243);width:100%;">Pay $<span
                            id="total_cost_button">{{$profession_country->base_cost}}</span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection

@section('page-script')

@include('customer.application_process.components.js-action')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/create-application.js')}}"></script>
<script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/LOA-main.js')}}"></script>





<!-- <script src="{{asset('assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
<script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script> -->
@endsection