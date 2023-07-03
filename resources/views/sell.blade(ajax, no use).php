@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/transport.css') }}">
@endsection

@section("content")   
    <section class="slide">
        <div class="container">
            <p class="ser-index">HELPS YOU TO FIND PERFECT</p>
            <h3 class="ser-title fredoka">How AutoGuru Works</h3>
            <div>
                <div class="service-cards">
                    <div class="col-lg-4 col-12" data-aos="fade-right" data-aos-delay="200">
                        <div class="ser-card">
                            <div class="service-card">
                                <img class="ser-img repair-img" src="{{ asset('images/small/sell/Vehicle.svg') }}" alt="repair image">
                                <h4 class="fredoka service-subtitle">Vehicle Details</h4>
                                <p class="card-num">Fill out our valuation form</p>
                            </div>
                        </div>
                        <div class="down-arrow-image col-3" data-aos="fade-down">
                            <img class="down-arrow-img" src="{{ asset('images/small/sell/down-arrow.png') }}" alt="Arrow Image">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12" data-aos="fade-right" data-aos-delay="600">
                        <div class="ser-card">
                            <div class="service-card">
                                <img class="ser-img transport-img" src="{{ asset('images/small/sell/Deposit.svg') }}" alt="transport image">
                                <h4 class="fredoka service-subtitle">Deposit</h4>
                                <p class="card-num">Place a €99 booking deposit for us to come and inspect your vehicle. This deposit is held and refunded if the sale goes ahead</p>
                            </div>
                        </div>
                        <div class="down-arrow-image col-3" data-aos="fade-down">
                            <img class="down-arrow-img" src="{{ asset('images/small/sell/down-arrow.png') }}" alt="Arrow Image">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12" data-aos="fade-right" data-aos-delay="1000">
                        <div class="ser-card">
                            <div class="service-card">
                                <img class="ser-img tyre-img" src="{{ asset('images/small/sell/payment.svg') }}" alt="tyres image">
                                <h4 class="fredoka service-subtitle">Payment</h4>
                                <p class="card-num">If the vehicle passes, we instantly transfer the agreed price to your bank account - no hidden fees and your booking deposit is refunded!</p>
                            </div>
                        </div>
                        <div class="down-arrow-image col-3" data-aos="fade-down">
                            <img class="down-arrow-img" src="{{ asset('images/small/sell/down-arrow.png') }}" alt="Arrow Image">
                        </div>
                    </div>
                </div>
                <div class="service-arrow">
                    <div class="arrow-image col-3" data-aos="fade-right" data-aos-delay="300">
                        <img class="arrow-img" src="{{ asset('images/small/sell/arrow (1).svg') }}" alt="Arrow Image">
                    </div>
                    <div class="arrow-image col-3" data-aos="fade-right" data-aos-delay="500">
                        <img class="arrow-img" src="{{ asset('images/small/sell/arrow (2).svg') }}" alt="Arrow Image">
                    </div>
                    <div class="arrow-image col-3" data-aos="fade-right" data-aos-delay="700">
                        <img class="arrow-img" src="{{ asset('images/small/sell/arrow (3).svg') }}" alt="Arrow Image">
                    </div>
                    <div class="arrow-image col-3" data-aos="fade-right" data-aos-delay="900">
                        <img class="arrow-img" src="{{ asset('images/small/sell/arrow (4).svg') }}" alt="Arrow Image">
                    </div>
                </div>
                <div class="service-cards-row">
                    <div class="col-lg-4 col-12" data-aos="fade-right" data-aos-delay="400">
                        <div class="ser-card">
                            <div class="service-card">
                                <img class="ser-img tyre-img" src="{{ asset('images/small/sell/Valuation.svg') }}" alt="tyres image">
                                <h4 class="fredoka service-subtitle">Valuation</h4>
                                <p class="card-num">We make an offer for your vehicle</p>
                            </div>
                        </div>
                        <div class="down-arrow-image col-3" data-aos="fade-down">
                            <img class="down-arrow-img" src="{{ asset('images/small/sell/down-arrow.png') }}" alt="Arrow Image">
                        </div>
                    </div>
                    <div class="col-lg-4 col-12" data-aos="fade-right" data-aos-delay="800">
                        <div class="ser-card">
                            <div class="service-card">
                                <img class="ser-img tyre-img" src="{{ asset('images/small/sell/Inspection.svg') }}" alt="tyres image">
                                <h4 class="fredoka service-subtitle">Inspection</h4>
                                <p class="card-num">We come to you & inspect the vehicle</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section class="img-bg-section">

    </section>
    <section class="booking">
        <div class="container">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
            </div>
            <img src="images/{{ Session::get('image') }}">
            @endif
        
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form class="form col-lg-9 col-md-10 col-sm-12 col-12" id="sell_form" enctype="multipart/form-data" data-aos="fade-down" data-aos-delay="200">
                @csrf
                <h3 class="fredoka book-title">Sell My Car</h3>
                <div class="user-info">
                    <div class="col-12 form-subtitle-area">
                        <div class="form-subtitle-section">
                            <h5 class="form-subtitle">Sell My Car</h5>
                        </div>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="first_name" name="first_name" placeholder="First Name *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="last_name" name="last_name" placeholder="Last Name *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="email" id="useremail" name="useremail" placeholder="Email *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="number" id="phone_number" name="phone_number" placeholder="Phone Number *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="eircode" name="eircode" placeholder="Eircode *">
                    </div>
                </div>
                <div class="user-info">
                    <div class="col-12 form-subtitle-area">
                        <div class="form-subtitle-section">
                            <h5 class="form-subtitle">Vehicle photos</h5>
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="passenger_img">Click me to upload a passenger side image*</label>
                        <input class="form-control book-input" type="file" id="passenger_img" name="passenger_img" placeholder="Passenger Side *">
                        <div class="preview-image-box">
                            <img id="preview_passenger_img" class="preview-image" width="300px">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="driver_img">Click me to upload a driver side image*</label>
                        <input class="form-control book-input" type="file" id="driver_img" name="driver_img" placeholder="Driver Side *">
                        <div class="preview-image-box">
                            <img id="preview_driver_img" class="preview-image" width="300px">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="front_img">Click me to upload a front image*</label>
                        <input class="form-control book-input" type="file" id="front_img" name="front_img" placeholder="Front *">
                        <div class="preview-image-box">
                            <img id="preview_front_img" class="preview-image" width="300px">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="rear_img">Click me to upload a rear image*</label>
                        <input class="form-control book-input" type="file" id="rear_img" name="rear_img" placeholder="Rear">
                        <div class="preview-image-box">
                            <img id="preview_rear_img" class="preview-image" width="300px">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="interior_img">Click me to upload an interior image*</label>
                        <input class="form-control book-input" type="file" name="interior_img" id="interior_img" placeholder="interior">
                        <div class="preview-image-box">
                            <img id="preview_interior_img" class="preview-image" width="300px">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="odometer_img">Click me to upload an odometer image*</label>
                        <input class="form-control book-input" type="file" name="odometer_img" id="odometer_img" placeholder="odometer">
                        <div class="preview-image-box">
                            <img id="preview_odometer_img" class="preview-image" width="300px">
                        </div>
                    </div>
                </div>
                <div class="user-info">
                    <div class="col-12 form-subtitle-area">
                        <div class="form-subtitle-section">
                            <h5 class="form-subtitle">Vehicle details</h5>
                        </div>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="reg_number" name="reg_number" placeholder="Registraton Number *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="mileage" name="mileage" placeholder="Mileage *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="miles" name="miles" placeholder="Select Km/ Miles *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="timing" name="timing" placeholder="Select Timing Belt *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="history" name="history" placeholder="Service History *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="finance" name="finance" placeholder="Outstanding Finance">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <textarea class="form-control book-input" rows="3" type="text" id="car_issue" name="car_issue" placeholder="Enter Car Issues..."></textarea>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <textarea class="form-control book-input" rows="3" type="text" id="your_issue" name="your_issue" placeholder="Enter Your Notes..."></textarea>
                    </div> 
                </div>
                <div class="col-12 policy-area">
                    <div class="form-check policy-check">
                        <input class="form-check-input" type="checkbox" value="agree" name="flexCheckDefault" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Accept <span class="check-bold">Terms of use</span> and <span class="check-bold">privacy Policy</span>
                        </label>
                    </div>
                </div>
                    
                <div class="alert alert-danger print-error-msg">
                    <ul></ul>
                </div>
                <button type="button" class="btn trans-btn" id="submitbtn">Submit</button>
            </form>
        </div>
    </section>

    <section class="help">
        <div class="container">
            <h3 class="help-title">Why sell your car with this way?</h3>
            <div class="help-cards">
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">It 's a hassle-free, no-stress, professional service</p>
                            <p class="help-desc-text">You 'll deal with the pros, not the public</p>
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">Receive an instant estimated dealer offer</p>
                            <p class="help-desc-text">Simply enter your reg and mileage. We 'll let you know what to expect</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">You 'll get the best possible dealer offer for your car</p>
                            <p class="help-desc-text">We 'll get you the best offer from our trusted dealer network(with zero obligation to accept)</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">It 's the quickest way to sell your car</p>
                            <p class="help-desc-text">If you accept an offer, you could sell your car in as little as 24 hours</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">It 's convenient, safe and secure</p>
                            <p class="help-desc-text">A trusted dealer can pick up your car from the comfort of your own home pay direcctly into your bank account</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">Maximum flexibility</p>
                            <p class="help-desc-text">Once you get paid, you 'll have the flexibility to shop around and buy your next car from wherever you want</p>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
    <script>
        $(document).ready(function() {

            $('#passenger_img').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview_passenger_img').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            }); 
            $('#driver_img').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview_driver_img').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            });
            $('#front_img').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview_front_img').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            });
            $('#rear_img').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview_rear_img').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            });
            $('#interior_img').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview_interior_img').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            });
            $('#odometer_img').change(function(){    
                let reader = new FileReader();
                reader.onload = (e) => { 
                    $('#preview_odometer_img').attr('src', e.target.result); 
                }   
                reader.readAsDataURL(this.files[0]); 
            });
            
            //Submitting
            $("#submitbtn").click(function(e){
                e.preventDefault();
                let formData = new FormData(document.getElementById("sell_form"));
                console.log(formData);
                return;

                var _token = $("input[name='_token']").val();
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var useremail = $('#useremail').val();
                var phone_number = $('#phone_number').val();
                var eircode = $('#eircode').val();
                var reg_number = $('#reg_number').val();
                var mileage = $('#mileage').val();
                var miles = $('#miles').val();
                var timing = $('#timing').val();
                var history = $('#history').val();
                var finance = $('#finance').val();
                var car_issue = $('#car_issue').val();
                var your_issue = $('#your_issue').val();
                var agreed = $('#flexCheckDefault').is(':checked');

                var image = $('#passenger_img')[0].files[0];
                console.log(image);
                return;
                
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
                    url:"{{ route('sell.store') }}",
                    data:{
                        _token: _token,
                        first_name: first_name,
                        last_name: last_name,
                        useremail: useremail,
                        phone_number: phone_number,
                        eircode: eircode,
                        reg_number: reg_number,
                        mileage: mileage,
                        miles: miles,
                        timing: timing,
                        history: history,
                        finance: finance,
                        car_issue: car_issue,
                        your_issue: your_issue,
                        agreed: agreed,
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