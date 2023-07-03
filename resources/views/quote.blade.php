@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section("content")
    <section class="container dashboard">
        <div class="dashboard-area">

            @include("partials.sidebar")

            <div class="db-content col-lg-9 col-md-7 col-sm-12 col-12">
                <div class="db-top">
                    <h3 class="fredoka">
                      {{ Auth::user()->name }}'s Quote Requests
                    </h3>
                    <!-- <div>
                        <img class="db-img" src="{{ asset('images/small/dashboard/search.png') }}">
                        <img class="db-img" src="{{ asset('images/small/dashboard/notification.png') }}">
                    </div> -->
                </div>
                <div class="success-alert-section">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <p>{{ Session::get('success') }}</p>
                            <!-- <a href="#" class="close" data-dismiss="alert" aria-label="close">To your dashboard <i class="fa fa-hand-o-right" aria-hidden="true"></i></a> -->
                        </div>
                    @endif
                </div>
                <div class="db-field">
                  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Upcoming Quote</button>
                      </li>
                      <li class="nav-item" role="presentation">
                          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Previous Quote</button>
                      </li>
                  </ul>
                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                      <table class="table table-hover"> 
                        <thead class="table-title">
                          <tr class="quote-tr">
                            <th>Sr.No.</th>
                            <th>Location</th>
                            <th>Reg Num</th>
                            <th>Service</th>
                            <th>Created At</th>
                            <th>
                              <!-- <img class="garage-th-img" src="{{ asset('images/small/repair/Garage-Warehouse-PNG-Photos.png') }}" alt="garage name" /> -->
                              <i class="fa fa-wrench" aria-hidden="true"></i>
                            </th>
                            <th class="d-none">Garage ID</th>
                            <th class="d-none">Replied ID</th>
                            <th>
                              <i class="fa fa-eur" aria-hidden="true"></i>
                            </th>
                            <th class="d-none">Date</th>
                            <th class="d-none">Message</th>
                            <th class="d-none">User Date</th>
                            <th class="d-none">Deposit</th>
                            <th><i class="fa fa-bell"></i>Reply</th>
                            <th><i class="fa fa-credit-card" aria-hidden="true"></i>deposit</th>
                          </tr>
                        </thead>   
                        @foreach($up_quotes as $key => $updata)
                            <tbody>
                              <tr>
                                <td class="quote-id">{{$updata->id}}</td>
                                <td>{{$updata->sel_location}}</td>
                                <td>
                                  {{$updata->reg_number}}:
                                  <ul class="reg-number-show">
                                    <li>Year: {{$updata->year_of_manufacture}}</li>
                                    <li>Make: {{$updata->make}}</li>
                                    <li>Model: {{$updata->model}}</li>
                                    <li>Engine CC: {{$updata->engine_cc}}</li>
                                    <li>Version: {{$updata->version}}</li>
                                  </ul>
                                </td>
                                @if ($updata->detail != "")
                                  <td>
                                    <ul>
                                      @foreach(explode(',', $updata->detail) as $info)
                                        <li>{{$info}}</li>
                                      @endforeach
                                    </ul>
                                  </td>
                                @endif
                                <td>{{$updata->created_at}}</td>
                                <td>{{$updata->gname}}</td>
                                <td class="garage-id d-none">{{$updata->garage_id}}</td>
                                <td class="replied_id d-none">{{$updata->replied_id}}</td>
                                <td class="replied-price">{{$updata->price}}</td>
                                <td class="avail-date d-none">
                                  <ul>
                                    @foreach(explode(',', $updata->picked_date) as $info) 
                                      <li>{{$info}}</li>
                                    @endforeach
                                  </ul>
                                </td>
                                <td class="ga-reply d-none">{{$updata->reply}}</td>
                                <td class="user-reply-date d-none">{{$updata->user_date}}</td>
                                <td class="user-reply-deposit d-none">{{$updata->deposit}}</td>
                                @if($updata->price == '')
                                  <td>
                                  </td>
                                @else
                                  <td>
                                    @if($updata->user_date == '')
                                      <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="fa fa-eye"></i>
                                      </button>
                                    @else 
                                      <button type="button" class="btn btn-primary reply-btn" data-bs-toggle="modal" data-bs-target="#myModal">
                                        <i class="fa fa-check"></i>
                                      </button>
                                    @endif
                                  </td>
                                @endif
                                @if($updata->user_date == '')
                                  <td>
                                  </td>
                                @else
                                  <td>
                                    @if($updata->deposit == '')
                                      <button type="button" class="btn btn-success payment-btn payment-button" data-bs-toggle="modal" data-bs-target="#payModal">
                                        <a href="#" 
                                          data-bs-toggle="tooltip" 
                                          data-bs-placement="top" 
                                          title="Secure your slot today with by paying a deposit."
                                        >
                                          <i class="fa fa-credit-card" style="color: white" aria-hidden="true"></i>
                                        </a>
                                      </button>
                                    @else 
                                      <button type="button" class="btn btn-success payment-btn">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                      </button>
                                    @endif
                                  </td>
                                @endif
                              </tr>
                            </tbody>
                        @endforeach
                      </table>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                      <table class="table table-hover">
                        <thead class="table-title">
                          <tr class="quote-tr">
                            <th>Sr.No.</th>
                            <th>Location</th>
                            <th>Reg Num</th>
                            <th>Service</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        @foreach($pre_quotes->take(5) as $key => $predata)
                            <tbody>
                              <tr>
                                <td>{{$predata->id}}</td>
                                <td>{{$predata->sel_location}}</td>
                                <td>{{$predata->reg_number}}</td>
                                @if ($predata->serviceIds != "")
                                  <td>
                                    <ul>
                                      @foreach(explode(',', $predata->serviceIds) as $info) 
                                        <li>{{$info}}</li>
                                      @endforeach
                                    </ul>  
                                  </td>         
                                @endif
                                <td>{{$predata->created_at}}</td>
                              </tr>
                            </tbody>
                        @endforeach
                      </table>
                    </div>
                  </div>
                </div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Additional Response</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <form method="post"> 
                      {{ csrf_field() }}
                      <div class="mb-3 d-none">
                        <label for="quote_id" class="col-form-label">Quote ID:</label>
                        <input type="text" class="form-control" id="quote_id" readonly>
                      </div>
                      <div class="mb-3 d-none">
                        <label for="user_id" class="col-form-label">User ID:</label>
                        <input type="text" class="form-control" id="user_id" value="{{ Auth::user()->id }}" readonly>
                      </div>
                      <div class="mb-3 d-none">
                        <label for="garage_id" class="col-form-label">Garage ID:</label>
                        <input type="text" class="form-control" id="garage_id" readonly>
                      </div>
                      <div class="mb-3 d-none">
                        <label for="replied_id" class="col-form-label">Replied ID:</label>
                        <input type="text" class="form-control" id="replied_id" readonly>
                      </div>
                      <div class="mb-3">
                        <label for="avail_date" class="col-form-label">Available Date:</label>
                        <p class="form-control" id="avail_date"></p>
                      </div>
                      <div class="mb-3">
                        <label for="reply_msg" class="col-form-label">Message of Garage:</label>
                        <textarea class="form-control" id="reply_msg"></textarea>
                      </div>

                      <p class="notify-text">Please select a date from the available slots with this garage</p>
                      <div class="mb-3">
                        <label for="selected_date" class="col-form-label">Date:</label>
                        <input type="date" class="form-control" id="selected_date" />
                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="submit_reply">Contact This Garage</button>  
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>

            <!-- The Payment Modal -->
            <div class="modal fade" id="payModal">
              <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Deposit Payment</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    <div class="row payment-area">
                      <div class="col-md-6 col-md-offset-3">
                          <div class="panel panel-default credit-card-box">
                              <div class="panel-body">
                  
                                  <form 
                                      role="form" 
                                      action="{{ route('quote.stripe') }}" 
                                      method="post" 
                                      class="require-validation"
                                      data-cc-on-file="false"
                                      data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                      id="payment-form"
                                  >
                                      @csrf
                                      <div class='form-row row d-none'>
                                          <div class='col-xs-12 form-group required'>
                                              <label class='control-label'>Replied ID</label> 
                                              <input class='form-control' id="payment_replied_id" size='4' type='text'>
                                          </div>
                                      </div>

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
                  
                                      <div class='form-row row payment-detail-form-row'>
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
                                          <div class="col-xs-12 submit-button">
                                              <button class="btn btn-primary btn-lg btn-block" id="submit_payment" type="submit">Pay Now (<span id="deposit_value">500</span>€)</button>
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

                </div>
              </div>
            </div>
        </div>
    </section>
    <script>
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
          customClass: "my-tooltip", // add a custom class to the tooltip for styling
          boundary: "window", // ensure the tooltip stays within the window
          delay: { "show": 100, "hide": 2000 }, // add a delay before showing and hiding the tooltip
          template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>' // customize the tooltip HTML
        })
      })
    </script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">

        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 5000); 

        upcomingCount = {{$upcomingCount}};
        upcomingRepair = {{$upcomingRepair}};
        upcomingBooking = {{$upcomingBooking}};

        if(upcomingCount == '0') {
            $('#sidebar_purchase').hide();
        }
        if(upcomingRepair == '0') {
            $('#sidebar_quote').hide();
        }
        if(upcomingBooking == '0') {
            $('#sidebar_booking').hide();
        }
        reloadUpcomming();

        $('.reply-btn').click(function(){
          quote_id = $(this).closest('tr').find('.quote-id').html();
          garage_id = $(this).closest('tr').find('.garage-id').html();
          replied_id = $(this).closest('tr').find('.replied_id').html();
          avail_date = $(this).closest('tr').find('.avail-date').html();
          ga_reply = $(this).closest('tr').find('.ga-reply').html();
          user_reply_date = $(this).closest('tr').find('.user-reply-date').html();
          
          $('#quote_id').val(quote_id);
          $('#garage_id').val(garage_id);
          $('#replied_id').val(replied_id);
          $('#avail_date').html(avail_date);
          $('#reply_msg').val(ga_reply);
          $('#selected_date').val(user_reply_date);
        })

        $('.payment-btn').click(function(){
          replied_id = $(this).closest('tr').find('.replied_id').html();
          replied_price = $(this).closest('tr').find('.replied-price').html();
          var deposit_price = replied_price/10;
          $('#deposit_value').html(deposit_price);
          $('#payment_replied_id').val(replied_id);
        })

        $('#submit_reply').on('click', function(e){
          e.preventDefault();

          var _token = $("input[name='_token']").val();
          var replied_id = $('#replied_id').val();
          var user_id = $('#user_id').val();
          var selected_date = $('#selected_date').val();

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
            type: 'POST',
            url: "{{ route('quote.reply') }}",
            data: {
              _token: _token,
              replied_id: replied_id,
              user_id: user_id,
              selected_date: selected_date
            },
            success: function(data) {
              if(data.status == '2') {
                // ***** Option 1
                toastr.options.closeButton = true;
                toastr.options.timeOut = 0;

                var toastrSuccess = toastr["success"]("Submitted successfully!", "Success!");
                setTimeout(() => {
                  var toastrSuccess = toastr["warning"]("To secure your booking, a 10% deposit must be paid. Please click on the flashing green card icon to pay.", "Alert!");
                }, 1000);
                setTimeout(() => {
                  toastr.clear(toastrSuccess, { force: true });
                  location.reload();
                  return false;
                }, 6000);

                // ***** Option 2
                // toastr.options.closeButton = true;
                // toastr.options.onHidden = function() {
                //   location.reload();
                // };

                // toastr["success"]("To secure your booking, a 10% deposit must be paid. Please click on the flashing green card icon to pay.", "Submitted successfully!");

                // ***** Option 3
                // Command: toastr["success"]("To secure your booking, a 10% deposit must be paid. Please click on the flashing green card icon to pay.", "Submitted successfully!");
                // setTimeout(() => {
                //   location.reload();
                //   return false;
                // }, 5000);
              } else if(data.status == '1') {
                Command: toastr["error"]("Database Error", "Error");
                return false;
              } else if(data.status == '0') {
                Command: toastr["warning"]("Validation Error", "Warning");
                return false;
              }
            }
          });
        });

        // Deposit payment gateway
        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            e.preventDefault()
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
                  var req_id = $('#payment_replied_id').val();

                  $form.find('input[type=text]').empty();
                  $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                  $form.append("<input type='hidden' name='amount' value='" + amount + "'/>");
                  $form.append("<input type='hidden' name='req_id' value='" + req_id + "'/>");
                  $form.get(0).submit();
              }
            }
          })
        
    </script>
@endsection