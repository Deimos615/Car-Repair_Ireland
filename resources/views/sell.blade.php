@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/transport.css') }}">
    <script src="{{ asset('js/xmltojson.js') }}"></script>
@endsection

@section("content")   
    <section class="slide">
        <div class="container">
            <h3 class="ser-title fredoka">How our Buying Process Works</h3>
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
        
            <form class="form col-lg-9 col-md-10 col-sm-12 col-12" id="sell_form" action="{{ route('sell.store') }}" method="POST" enctype="multipart/form-data" data-aos="fade-down" data-aos-delay="200">
                @csrf

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong id="msg_alert" class="d-flex flex-wrap">
                            <p class="col-12">Success! Your sell car request has been saved successfully! Our team will respond you soon !</p>
                            <br/><br/>
                            <p class="col-12">Registration Number Infomation</p>
                            <div class="d-flex flex-wrap">
                                @foreach($message as $key => $data)
                                    <p class="col-lg-6 col-md-12 reg-num-detail" style="color: dimgrey">{{$key}} : {{$data}}</p>
                                @endforeach
                            </div>
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <script type="text/javascript">
                        Command: toastr["success"]("Submitted successfully!", "Success");
                    </script>
                @endif

                <h3 class="fredoka book-title">Sell My Car</h3>

                @if($errors->any())
                    <ul class="alert alert-warning" id="sell_error">
                        @foreach ($errors->all() as $error)
                            <li class="ms-3">{{$error}}</li>
                        @endforeach
                    </ul>
                    <script type="text/javascript">
                        Command: toastr["error"]("Input Exactly!", "Error");
                    </script>
                @endif

                <div class="user-info">
                    <div class="col-12 form-subtitle-area">
                        <div class="form-subtitle-section">
                            <h5 class="form-subtitle">Sell My Car</h5>
                        </div>
                    </div>
                    @guest
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="text" id="name" name="name" value="{{old('name')}}" placeholder="Name *">
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="email" id="useremail" name="useremail" value="{{old('useremail')}}" placeholder="Email *">
                        </div>
                    @else
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="text" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Name *"  readonly>
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="email" id="useremail" name="useremail" value="{{ Auth::user()->email }}" placeholder="Email *"  readonly>
                        </div>
                    @endguest
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="number" id="phone_number" name="phone_number" value="{{old('phone_number')}}" placeholder="Phone Number *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="eircode" name="eircode" value="{{old('eircode')}}" placeholder="Eircode *">
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
                        <input class="form-control book-input" type="file" id="passenger_img" name="passenger_img" value="{{old('passenger_img')}}" placeholder="Passenger Side *">
                        <div class="preview-image-box">
                            <img id="preview_passenger_img" class="preview-image" width="100%">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="driver_img">Click me to upload a driver side image*</label>
                        <input class="form-control book-input" type="file" id="driver_img" name="driver_img" value="{{old('driver_img')}}" placeholder="Driver Side *">
                        <div class="preview-image-box">
                            <img id="preview_driver_img" class="preview-image" width="100%">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="front_img">Click me to upload a front image*</label>
                        <input class="form-control book-input" type="file" id="front_img" name="front_img" value="{{old('front_img')}}" placeholder="Front *">
                        <div class="preview-image-box">
                            <img id="preview_front_img" class="preview-image" width="100%">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="rear_img">Click me to upload a rear image*</label>
                        <input class="form-control book-input" type="file" id="rear_img" name="rear_img" value="{{old('rear_img')}}" placeholder="Rear">
                        <div class="preview-image-box">
                            <img id="preview_rear_img" class="preview-image" width="100%">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="interior_img">Click me to upload an interior image*</label>
                        <input class="form-control book-input" type="file" name="interior_img" id="interior_img" value="{{old('interior_img')}}" placeholder="interior">
                        <div class="preview-image-box">
                            <img id="preview_interior_img" class="preview-image" width="100%">
                        </div>
                    </div>
                    <div class="book-box file-box col-lg-6 col-md-12 col-12">
                        <label for="odometer_img">Click me to upload an odometer image*</label>
                        <input class="form-control book-input" type="file" name="odometer_img" id="odometer_img" value="{{old('odometer_img')}}" placeholder="odometer">
                        <div class="preview-image-box">
                            <img id="preview_odometer_img" class="preview-image" width="100%">
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
                        <input class="form-control book-input" type="text" id="reg_number" name="reg_number" value="{{old('reg_number')}}" placeholder="Registraton Number *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="mileage" name="mileage" value="{{old('mileage')}}" placeholder="Mileage *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <select class="form-control book-input form-select" id="miles" name="miles" aria-label="Select Km/ Miles *">
                            <option class="pur-option d-none" selected disabled>Select Km/ Miles *</option>
                            <option class="rep-option" value="KM">KM</option>
                            <option class="rep-option" value="Miles">Miles</option>
                        </select>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <select class="form-control book-input form-select" id="timing" name="timing" aria-label="Select Timing Belt *">
                            <option class="pur-option d-none" selected disabled>Select Timing Belt *</option>
                            <option class="rep-option" value="Yes">Yes</option>
                            <option class="rep-option" value="Now">Now</option>
                            <option class="rep-option" value="Has a Chain">Has a Chain</option>
                        </select>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <select class="form-control book-input form-select" id="history" name="history" aria-label="Service History *">
                            <option class="pur-option d-none" selected disabled>Service History *</option>
                            <option class="rep-option" value="Full">Full</option>
                            <option class="rep-option" value="Partial">Partial</option>
                            <option class="rep-option" value="None">None</option>
                        </select>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="finance" name="finance" value="{{old('finance')}}" placeholder="Outstanding Finance">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <textarea class="form-control book-input" rows="3" type="text" id="car_issue" name="car_issue" value="{{old('car_issue')}}" placeholder="Enter Car Issues..."></textarea>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <textarea class="form-control book-input" rows="3" type="text" id="your_issue" name="your_issue" value="{{old('your_issue')}}" placeholder="Enter Your Notes..."></textarea>
                    </div>
                </div>
                <div class="col-12 policy-area">
                    <div class="form-check policy-check">
                        <input class="form-check-input" type="checkbox" name="flexCheckDefault" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Accept <span class="check-bold">Terms of use</span> and <span class="check-bold">privacy Policy</span>
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn trans-btn" id="submitbtn">Submit</button>
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
                            <p class="help-desc">It’s a hassle-free, no-stress, professional service</p>
                            <p class="help-desc-text">You’ll deal with the pros, not the public</p>
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">Receive an instant estimated dealer offer</p>
                            <p class="help-desc-text">Simply enter your reg and mileage. We’ll let you know what to expect</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">You’ll get the best possible dealer offer for your car</p>
                            <p class="help-desc-text">We’ll get you the best offer from our trusted dealer network(with zero obligation to accept)</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">It’s the quickest way to sell your car</p>
                            <p class="help-desc-text">If you accept an offer, you could sell your car in as little as 24 hours</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">It’s convenient, safe and secure</p>
                            <p class="help-desc-text">A trusted dealer can pick up your car from the comfort of your own home pay directly into your bank account</p>    
                        </div>
                    </div>
                </div>
                <div class="help-card col-md-6 col-sm-12 col-12">
                    <div class="help-card-content">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <div>
                            <p class="help-desc">Maximum flexibility</p>
                            <p class="help-desc-text">Once you get paid, you’ll have the flexibility to shop around and buy your next car from wherever you want</p>    
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

            // $('#passenger_img').on('change click touchend', function(){
            //     alert("so I am here");
            //     let file = this.files[0];
            //     let imageUrl = URL.createObjectURL(file);
            //     let img = new Image();
            //     img.onload = function() {
            //         $('#preview_passenger_img').attr('src', imageUrl);
            //         URL.revokeObjectURL(imageUrl); // free up memory
            //     };
            //     img.src = imageUrl;
            // });

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

        });
    </script>
@endsection