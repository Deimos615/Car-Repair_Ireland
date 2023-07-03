@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section("content")   
    <section class="service">
        <div class="container">
            <h3 class="ser-title fredoka">DID YOU KNOW?</h3>
            <div class="service-cards">
                <a href="#" class="col-lg-3 col-sm-12 col-12" data-aos="slide-up">
                    <div class="ser-card">
                        <div class="service-card">
                            <img class="ser-img nct-img" src="{{ asset('images/small/Landing/NCT.png') }}" alt="repair image">
                            <h4 class="know-subtitle fredoka">NCT</h4>
                            <p class="know-text">
                                Our technicians will check for costly mechanical repairs such as clutches, turbos & head gasket issues.
                                Contrary to what many consumers think, These items, along with many others are not checked during the NCT.
                            </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="col-lg-3 col-sm-12 col-12" data-aos="slide-up">
                    <div class="ser-card">
                        <div class="service-card">
                            <img class="ser-img diag-img" src="{{ asset('images/small/Landing/Pre Purchase Inspections.png') }}" alt="transport image">
                            <h4 class="know-subtitle fredoka">Diagnostics</h4>
                            <p class="know-text">
                                Our state-of-the-art diagnostic scan will reveal any underlying issues by identifying fault codes stored in the vehicle’s ECU such as EGR & DPF issues.
                            </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="col-lg-3 col-sm-12 col-12" data-aos="slide-up">
                    <div class="ser-card">
                        <div class="service-card">
                            <img class="ser-img mile-img" src="{{ asset('images/small/Landing/Mileage.svg') }}" alt="tyres image">
                            <h4 class="know-subtitle fredoka">Mileage Discrepancies</h4>
                            <p class="know-text">
                                It’s often extremely difficult to detect if a vehicle’s mileage is genuine or not. Thankfully, through experience, our technicians know the telltale signs that may indicate a mileage discrepancy.
                            </p>
                        </div>
                    </div>
                </a>
                <a href="#" class="col-lg-3 col-sm-12 col-12" data-aos="slide-up">
                    <div class="ser-card">
                        <div class="service-card">
                            <img class="ser-img upcoming-img" src="{{ asset('images/small/Landing/Upcoming.svg') }}" alt="tyres image">
                            <h4 class="know-subtitle fredoka">Upcoming Costs</h4>
                            <p class="know-text">
                                Our technicians will identify and explain any future costs to budget for based on their assessment of the vehicle such as timing belts and specific repairs.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>   
    <section class="img-bg-section">

    </section>
    <section class="booking">
        <div class="container">
            
            <form class="form col-lg-9 col-md-10 col-sm-12 col-12" id="reg_form" method="post" data-aos="fade-down" action="{{ route('purchase.store') }}">
                {{ csrf_field() }}
            
                <h3 class="fredoka book-title">Pre Purchase Inspections</h3>
                <div class="user-info">
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="reg_number" name="reg_number" placeholder="Registraton Number *">
                    </div>
                    @guest
                        <div class="book-box col-lg-6 col-md-12 col-12 d-none">
                            <input class="form-control book-input" type="text" id="auth_check" name="auth_check" placeholder="auth_check *">
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="text" id="name" name="name" placeholder="Name *">
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="email" id="email" name="email" placeholder="Email *">
                        </div>
                    @else
                        <div class="book-box col-lg-6 col-md-12 col-12 d-none">
                            <input class="form-control book-input" type="text" id="auth_check" name="auth_check" value="{{ Auth::user()->type }}" placeholder="auth_check *" readonly>
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="text" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="Name *" readonly>
                        </div>
                        <div class="book-box col-lg-6 col-md-12 col-12">
                            <input class="form-control book-input" type="email" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="Email *" readonly>
                        </div>
                    @endguest
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="number" id="phone_number" name="phone_number" placeholder="Phone Number *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="garage" name="garage" placeholder="Dealership (if applicable) *">
                    </div>
                    <!-- <div class="book-box col-lg-6 col-md-12 col-12">
                        <select class="form-control book-input form-select" id="garage" name="garage" aria-label="Garage">
                            <option class="pur-option d-none" selected disabled>Garage</option>
                            @foreach($garages as $key => $data)
                                <option class="rep-option" value="{{$data->name}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div> -->
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="number" id="seller_phone" name="seller_phone" placeholder="Seller Phone Number *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input placeholder="Date" class="form-control book-input" type="date" name="date" onblur="(this.type='text')" onfocus="(this.type='date')" id="datepicker" data-date-days-of-week-disabled="0,6">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="location" name="location" placeholder="Location *">
                        <!-- <select class="form-control book-input form-select" id="location" name="location" aria-label="Location">
                            <option class="pur-option d-none" selected disabled>Location</option>
                            @foreach($locations as $key => $data)
                                <option class="rep-option" value="{{$data->location}}">{{$data->location}}</option>
                            @endforeach
                        </select> -->
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <select class="form-control book-input form-select" id="prefer_time" name="prefer_time" aria-label="preferred">
                            <option class="pur-option d-none" selected disabled>Select Preferred Time</option>
                            <option class="pur-option" value="am">Morning 9:30am - 11:30am</option>
                            <option class="pur-option" value="pm">Afternoon 12:30pm - 2:30pm</option>
                            <!-- <option class="pur-option" value="eve">Evening 18:30pm - 20:30pm</option> -->
                        </select>
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <select class="form-control book-input form-select" id="inspection" name="inspection" aria-label="Inspection">
                            <option class="pur-option d-none" selected disabled>Level of Inspection</option>
                            <option class="pur-option" value="Premium">Premium</option>
                            <option class="pur-option" value="Standard">Standard</option>
                        </select>
                    </div>
                    <div class="col-12 policy-area">
                        <div class="form-check policy-check">
                            <input class="form-check-input" type="checkbox" name="flexCheckDefault" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Accept <span class="check-bold">Terms of use</span> and <span class="check-bold">privacy Policy</span>
                            </label>
                        </div>
                    </div>

                    <div class="alert alert-danger print-error-msg col-12">
                        <ul></ul>
                    </div>
                    <button type="button" class="btn trans-btn" id="submitbtn">Submit</button>
                </div>
            </form>
        </div>
    </section>          
    <section class="help">
        <div class="container">
            <h3 class="help-title">How AutoGuru Works</h3>
            <div class="help-cards">
                <div class="help-card col-md-3 col-sm-12 col-12">
                    <div class="help-card-content">
                        <img class="help-img" src="{{ asset('images/small/purchase/service.png') }}">
                        <p>Tell us when and where you would like the vehicle inspected. We carry out inspections from trade and private sellers throughout Leinster.</p>
                    </div>
                </div>
                <div class="help-card col-md-3 col-sm-12 col-12">
                    <div class="help-card-content">
                        <img class="help-img" src="{{ asset('images/small/purchase/repair.png') }}">
                        <p>A mechanic will be assigned to your booking, the day before your booking the mechanic will make contact with you to introduce himself and confirm specifics.</p>
                    </div>
                </div>
                <div class="help-card col-md-3 col-sm-12 col-12">
                    <div class="help-card-content">
                        <img class="help-img" src="{{ asset('images/small/purchase/reg.png') }}">
                        <p>It's entirely upto the buyer if they would like to be present during the inspection. Reports will be emailed directly after completion along with a call to discuss any concerns.</p>
                    </div>
                </div>
                <div class="help-card col-md-3 col-sm-12 col-12">
                    <div class="help-card-content">
                        <img class="help-img" src="{{ asset('images/small/purchase/car.png') }}">
                        <p>Make an informed buying decision on your new vehicle!</p>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <section class="about">
        <div class="container about-body">
            <div class="flevel-area col-md-6 col-sm-12 col-12" data-aos="flip-left">
                <div class="level-card col-7">
                    <p class="level-btn">STANDARD</p>
                    <h2 class="level-cost">€139</h2>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">88 Checks</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">2km Test DriveDealership</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">1st & 2nd gear on Private Road, Car Park or Driveway*</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Emailed Report</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Photos on Report</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/close-circle.png') }}">
                        <p class="tick-text">Diagnostic Scan</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/close-circle.png') }}">
                        <p class="tick-text">Follow-up Call</p>
                    </div>
                </div>
            </div>
            <div class="plevel-area col-md-6 col-sm-12 col-12" data-aos="flip-right">
                <div class="level-card col-7">
                    <p class="level-btn">PREMIUM</p>
                    <h2 class="level-cost">€189</h2>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">100 Checks</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">5 km On Public Road</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Emailed Report</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Photos on Report</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Diagnostic Scan</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Follow-up Call</p>
                    </div>
                    <div class="check-row">
                        <img class="tick-img" src="{{ asset('images/small/purchase/tick-circle.png') }}">
                        <p class="tick-text">Full MotorCheck History Check</p>
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
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script src="{{ asset('js/xmltojson.js') }}"></script>
    <script>
        $(document).ready(function() {
            //Submitting
            $("#submitbtn").click(function(e){
                e.preventDefault();

                var authCheck = $('#auth_check').val();
                if(authCheck == '') {
                    Command: toastr["warning"]("Please login firstly!", "Warning");
                    return false;
                } else if(authCheck == 'manager' || authCheck == 'admin') {
                    Command: toastr["warning"]("You do not have permission to access for this page!", "Warning");
                    return false;
                }

                const fetchFunc = async () => {
                    var _token = $("input[name='_token']").val();
                    var reg_number = $('#reg_number').val();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var phone_number = $('#phone_number').val();
                    var garage = $('#garage').val();
                    var seller_phone = $('#seller_phone').val();
                    var date = $('#datepicker').val();
                    var location = $('#location').val();
                    var prefer_time = $('#prefer_time').val();
                    var inspection = $('#inspection').val();
                    var flexCheckDefault = $('#flexCheckDefault').prop('checked');

                    if(reg_number == '') {
                        Command: toastr["warning"]("Please input a registration number!", "Warning");
                        return false;
                    }
                    
                    const result = await fetch(`/repair/getCarDetailXML/${reg_number}`)
                    .then(response => response.text());

                    dom = parseXml(result);
                    json = xml2json(dom);
                    json = JSON.parse(json.slice(0, json.indexOf('undefined')) + json.slice(json.indexOf('ned"') + 3));

                    if(typeof(json.response.vehicle) != 'undefined' && json.response.vehicle != null) {
                        var _vehicle = json.response.vehicle;
                        var reg = _vehicle.reg;
                        var make = _vehicle.make;
                        var model = _vehicle.model;
                        var version = _vehicle.version;
                        var body = _vehicle.body;
                        var engine_cc = _vehicle.engine_cc;
                        var year_of_manufacture = _vehicle.year_of_manufacture;
                    }

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
                        url:"{{ route('purchase.store') }}",
                        data:{
                            _token:_token,
                            reg: reg,
                            make: make,
                            model: model,
                            version: version,
                            engine_cc: engine_cc,
                            body: body,
                            year_of_manufacture:year_of_manufacture,
                            reg_number:reg_number, 
                            location:location,
                            name:name,
                            garage:garage,
                            email:email, 
                            date:date,
                            prefer_time:prefer_time,
                            inspection:inspection,
                            seller_phone:seller_phone, 
                            phone_number:phone_number,
                            flexCheckDefault:flexCheckDefault,
                        },
                        success:function(data){
                            console.log(data);
                            if(data.status == '2') {
                                window.location.href = "{{route('purchaseConfirm')}}";
                                return false;
                            } else if(data.status == '1') {
                                Command: toastr["error"]("Database Error", "Error");
                                return false;
                            }  else if(data.status == '0') {
                                Command: toastr["warning"]("Validation Error", "Warning");
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
                }
                fetchFunc();

                
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