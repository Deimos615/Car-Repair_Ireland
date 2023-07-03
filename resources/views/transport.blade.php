@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/transport.css') }}">
@endsection

@section("content")   
    <section class="slide">
        <div class="container slide-section">
            <div class="slide-slogan col-lg-5 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                <h1 class="fredoka">TRANSPORT Service</h1>
                <p class="slide-text">
                    Easily find transport for your vehicle with transparent pricing. Whether it’s
                    across the country or just from home to the local garage, an experienced
                    transporter is only a few clicks away!<br/><br/>
                </p>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 col-12" data-aos="zoom-in">
                <img class="slide-img" src="{{ asset('images/large/transport/slide.png') }}">
            </div>
        </div>
    </section>
    <section class="img-bg-section">

    </section>
    <section class="booking">
        <div class="container">
            <form class="form col-lg-9 col-md-10 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="200">
                <h3 class="fredoka book-title">Transport</h3>
                <div class="user-info">
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="reg_number" name="reg_number" placeholder="Registraton Number *">
                    </div>
                    @guest
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="text" id="username" name="username" placeholder="Name *">
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="email" id="useremail" name="useremail" placeholder="Email *">
                        </div>
                    @else
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="text" id="username" name="username" value="{{ Auth::user()->name }}" placeholder="Name *" readonly>
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="email" id="useremail" name="useremail" value="{{ Auth::user()->email }}" placeholder="Email *" readonly>
                        </div>
                    @endguest
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="number" id="phone_number" name="phone_number" placeholder="Phone Number">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input placeholder="Date" class="form-control book-input" type="date" onblur="(this.type='text')" onfocus="(this.type='date')" id="datepicker" data-date-days-of-week-disabled="0,6">
                        <p style="color: grey; padding: 5px 10px">Please select the date</p>
                    </div>
                    <!-- <div class="book-box col-lg-6 col-md-12 col-12">
                        <input placeholder="Date" class="form-control book-input" type="date" id="datepicker">
                    </div> -->
                </div>
                <h4 class="fredoka book-title">Price Estimator</h4>
                <div class="calculator">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="book-box col-lg-12 col-md-12 col-sm-12 col-12">
                            <input class="form-control book-input" type="text" id="pickup_location" name="pickup_location" placeholder="Pickup Location *">
                        </div>
                        <div class="book-box col-lg-12 col-md-12 col-sm-12 col-12">
                            <input class="form-control book-input" type="text" id="destination_location" name="destination_location" placeholder="Destination *">
                        </div>
                        <button type="button" class="btn esti-btn" onclick="esti_calc()">Get Estimate</button>
                        <div class="esti-prices">
                            <p id="distance_value" class="esti-price">Distance: <span id="distance_val"></span></p>
                            <p id="duration_value" class="esti-price">Duration: <span id="duration_val"></span></p>
                            @foreach($costpers as $costper)
                                <p id="cost_value" class="esti-price">Cost per km: <span id="cost_val">{{$costper}}</span></p>
                            @endforeach
                            
                            @foreach($mincosts as $mincost)
                                <p id="mincost_value" class="esti-price">Min Transport Cost: <span id="mincost_val">{{$mincost}}</span></p>
                            @endforeach
                            <p id="estimation_value" class="esti-price">Estimate Cost(€): <span id="estimation_val"></span></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="purpose-area">
                    <div class="purpose-num">
                        <input class="form-control book-input" type="text" id="loading_purpose" name="loading_purpose" placeholder="Does the vehicle run and drive for loading purposes">
                    </div>
                    <div class="purpose-num">
                        <textarea class="form-control book-input purpose-input" id="note" name="note" placeholder="Enter Your Notes"></textarea>
                    </div>
                    <div class="alert alert-danger print-error-msg">
                        <ul></ul>
                    </div>
                    <button type="button" id="submitbtn" class="btn trans-btn">Find a Transporter</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <!-- <script>
        $(document).ready(function() {
            $("#datepicker").datepicker({
                minDate: 0,
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0 && day != 6)];
                },
                onSelect: function(dateText, inst) {
                    var day = new Date(dateText).getUTCDay();
                    if ([6,0].includes(day)) {
                        Command: toastr["warning"]("Bookings available during business hours");
                        $(this).val("");
                    }
                }
            });
        });
    </script> -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtV5VAafNn5zpdQhGlXwUWWf8pQ9dbahI&libraries=places&v=weekly"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script>
        $(document).ready(function() {
            //Submitting
            $("#submitbtn").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var reg_number = $('#reg_number').val();
                var username = $('#username').val();
                var useremail = $('#useremail').val();
                var phone_number = $('#phone_number').val();
                var date = $('#datepicker').val();
                var pickup_location = $('#pickup_location').val();
                var destination_location = $('#destination_location').val();
                var distance_value = $('#distance_val').html();
                var duration_value = $('#duration_val').html();
                var estimation_value = $('#estimation_val').html();
                var cost_value = $('#cost_val').html();
                var loading_purpose = $('#loading_purpose').val();
                var note = $('#note').val();
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                
                $.ajax({
                    type:'POST',    
                    url:"{{ route('transport.store') }}",
                    data:{
                        _token:_token,
                        reg_number:reg_number,
                        username:username,
                        useremail:useremail,
                        phone_number:phone_number,
                        date:date,
                        pickup_location:pickup_location,
                        destination_location:destination_location,
                        distance_value:distance_value,
                        duration_value:duration_value,
                        estimation_value:estimation_value,
                        cost_value:cost_value,
                        loading_purpose:loading_purpose,
                        note:note,
                    },
                    success:function(data){
                        console.log(data);
                        if(data.status == '2') {
                            window.location.href = "{{route('transportConfirm')}}";
                            return false;
                        } else if(data.status == '1') {
                            Command: toastr["error"]("Database Error", "Error");
                            return false;
                        }  else if(data.status == '0') {
                            printErrorMsg(data.error);
                            return false;
                        } 
                        
                    },
                    error: function(data) {
                        if(data.status == '401') {
                            Command: toastr["warning"]("Please login firstly!", "Warning");
                        };
                    }
                });

                function printErrorMsg (msg) {
                    $(".print-error-msg").find("ul").html('');
                    $(".print-error-msg").css('display','block');
                    $.each( msg, function( key, value ) {
                        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                        $( ".print-error-msg" ).focus();
                    });
                }
            }); 
        });
    </script>
@endsection