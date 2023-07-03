@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/transport.css') }}">
@endsection

@section("content")   
    <div class="container payment-section">
        
        <h1 class="fredoka">Deposit Payment</h1>
        
        <div class="row payment-area">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-body">
        
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <p>{{ Session::get('success') }}</p>
                                <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">To your dashboard <i class="fa fa-hand-o-right" aria-hidden="true"></i></a> -->
                            </div>
                        @endif
        
                        <form 
                            role="form" 
                            action="{{ route('transport.stripe') }}" 
                            method="post" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form"
                        >
                            @csrf
        
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> 
                                    <input class='form-control' size='4' type='text'>
                                </div>
                            </div>
        
                            <div class='form-row row'>
                                <div class='col-xs-12 form-group card-number required'>
                                    <label class='control-label'>Card Number</label> 
                                    <input autocomplete='off' class='form-control card-number-input' size='20' type='text'>
                                </div>
                            </div>
        
                            <div class='form-row row'>
                                <div class='col-xs-12 col-lg-4 form-group cvc required stripe-details'>
                                    <label class='control-label'>CVC</label> 
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-lg-4 form-group expiration required stripe-details'>
                                    <label class='control-label'>Expiration Month</label> 
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-lg-4 form-group expiration required stripe-details'>
                                    <label class='control-label'>Expiration Year</label> 
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>
        
                            <div class='form-row row'>
                                <div class='col-md-12 error form-group d-none'>
                                    <div class='alert-danger alert'>Please correct the errors and try again.</div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-xs-12">
                                    @foreach($estiValues as $estiValue)
                                        <p class="mb-3" id="esti_value">Estimation Price: <span id="esti_val">{{$estiValue}}</span>€</p>
                                    @endforeach
                                    @foreach($req_ids as $req_id)
                                        <p class="mb-3 d-none" id="request_id">Request ID: <span id="req_id">{{$req_id}}</span></p>
                                    @endforeach
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now (<span id="deposit_value">500</span>€)</button>
                                </div>
                            </div>
                                
                        </form>
                    </div>
                </div>        
            </div>
            <div class="col-md-6 col-md-offset-3 stripe-img">
                <img class="stripe-image" src="{{ asset('images/large/transport/stripe.png') }}" alt="stripe" />
            </div>
        </div>
            
    </div> 
    <script>
        var esti_val = $('#esti_val').html();
        deposit_value = Number(esti_val) / 2;
        $('#deposit_value').html(deposit_value);
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    
    <script type="text/javascript">
    
    $(function() {
    
        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        $('deposit_value').html(deposit_value);
        
        var $form = $(".require-validation");
        
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = [
                'input[type=email]', 
                'input[type=password]',
                'input[type=text]', 
                'input[type=file]',
                'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('d-none');
        
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                }
            });
        
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({    
                    number: $('.card-number-input').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });
        
        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                var amount = $('#deposit_value').html();
                var req_id = $('#req_id').html();
                    
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.append("<input type='hidden' name='amount' value='" + amount + "'/>");
                $form.append("<input type='hidden' name='req_id' value='" + req_id + "'/>");
                $form.get(0).submit();
            }
        }
        
    });
    </script>
@endsection