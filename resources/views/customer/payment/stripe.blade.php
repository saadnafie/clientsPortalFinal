@extends('layouts/master-with-nav')
@section('main-title')
Application Payment
@endsection

@section('username')
{{Auth()->user()->name}}
@endsection


@section('page-style')
@endsection

@section('content')
<div class="container">
    <div class="row  justify-content-center">
        <!--<h3 style="text-align: center;margin-top: 40px;margin-bottom: 40px;">How To Integrate Stripe Payment Gateway In Laravel 8 - Techsolutionstuff</h3>-->
        <div class="col-md-6">
            <br>
            <div class="card">

                <div class="card-body">
                    <img src="{{ url('stripe-payment.png')}}" width="300px" />
                    @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <p>{{ Session::get('success') }}</p><br>
                    </div>
                    @endif
                    <br>
                    <form role="form" action="{{ route('stripe.store') }}" method="post" class="require-validation"
                        data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                        @csrf
                        <input type="hidden" name="application_id" value="{{$application->id}}">
                        <input type="hidden" name="total_cost" value="{{$total_cost}}">
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-12 form-group pt-3'>
                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Name on Card</span>
                                </label>

                                <input class='form-control form-control-solid' size='4' value="Test" type='text'
                                    placeholder="Name on Card" required>
                            </div>
                            <div class='col-xs-12 col-md-12 form-group  pt-3'>
                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Card Number</span>
                                </label>
                                <input autocomplete='off' class='form-control form-control-solid card-number'
                                    value="4242424242424242" size='20' type='text' required placeholder="Card Number">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc  pt-3'>
                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                    <span class="required">CVC</span>
                                </label>
                                <input autocomplete='off' class='form-control form-control-solid card-cvc' value="123"
                                    placeholder='ex. 311' size='4' type='text' required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration  pt-3'>
                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Expiration Month</span>
                                </label>
                                <input class='form-control form-control-solid card-expiry-month' value="12"
                                    placeholder='MM' size='2' type='text' required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration  pt-3'>
                                <label class="d-flex align-items-center fs-6 fw-semibold form-label mb-2">
                                    <span class="required">Expiration Year</span>
                                </label>
                                <input class='form-control form-control-solid card-expiry-year' value="2028"
                                    placeholder='YYYY' size='4' type='text' required>
                            </div>
                        </div>
                        <div class="form-row row">
                            <div class="pt-10" style="text-align: right !important;">
                                <button type="submit" id="stripe_click_payment"
                                    class="btn btn-lg btn-primary nxt__btn pull-right">
                                    Pay Now
                                </button>
                            </div>
                        </div>
                    </form>
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <h4>{{$errors->first()}}</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js')}}"></script>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script type="text/javascript">
$(function() {
    $('#stripe_click_payment').click(function() {
        $('#loading-load').show();
    })
    var $form = $(".require-validation");
    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]',
                'input[type=file]', 'textarea'
            ].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
        $errorMessage.addClass('hide');
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
            var $input = $(el);
            if ($input.val() === '') {
                $input.parent().addClass('has-error');
                $errorMessage.removeClass('hide');
                e.preventDefault();
            }

        });
        if (!$form.data('cc-on-file')) {
            e.preventDefault();
            //Stripe.setPublishableKey($form.data('stripe-publishable-key'));
            Stripe.setPublishableKey(
                "pk_test_51MHqdoBt5ogGDchXMsJdlIsyr3LNjcImULdz7U0wNi7FIgPZq2Qeott0SoDdW5LgWgbuAZ6tNhngfi8Wz6p5Eg1C00m9wgnPsz"
            );
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
        }
    });

    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('#loading-load').hide();
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }


});
</script>
@endsection