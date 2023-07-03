@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/repair.css') }}">
@endsection

@section("content")    
    <section class="help">
        <div class="container">
            <h3 class="help-title">How our Maintenance & Repair process works</h3>
            <div class="help-cards">
                <div class="help-card col-md-4 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="help-card-content">
                        <h2 class="help-num">01</h2>
                        <p class="help-subtitle">Enter your details</p>
                        <p>Provide your details, vehicle registration & service you require.</p>
                    </div>
                </div>
                <div class="help-card col-md-4 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="400">
                    <div class="help-card-content">
                        <h2 class="help-num">02</h2>
                        <p class="help-subtitle">We compile quotes</p>
                        <p>We send your request to local garages and gather estimates for you to review in your dashboard.</p>
                    </div>
                </div>
                <div class="help-card col-md-4 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="600">
                    <div class="help-card-content">
                        <h2 class="help-num">03</h2>
                        <p class="help-subtitle">Book your appointment</p>
                        <p>After reviewing your quotes, easily place your deposit & secure your booking online.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>   
    <section class="repair">
        
        <form class="container rep-container" id="reg_form" method="post" data-aos="fade-up" data-aos-delay="200">
            {{ csrf_field() }}

            <div class="repair-section col-md-10 col-sm-12 col-12" id="first_section">
                <h3 class="rep-title fredoka">Maintenance & Repair Service</h3>
                <div class="repair-input">
                    <div class="rep-input col-md-6 col-sm-12 col-12">
                        <input class="form-control rep-in" id="reg_number" name="reg_number" placeholder="Registration Number *">
                        <p class="error-one error d-none">Please input the registration number.</P>
                    </div> 
                    <div class="rep-input col-md-6 col-sm-12 col-12">
                        <select class="form-control rep-in form-select" id="sel_location" name="sel_location" aria-label="Location">
                            <option class="rep-option d-none" selected disabled>Location *</option>
                            @foreach($locations as $key => $data)
                                <option class="rep-option" value="{{$data->location}}">{{$data->location}}</option>
                            @endforeach
                        </select>
                        <p class="error-two error d-none">Please select a location.</P>
                    </div>
                </div>
                
                <p class="pop-title">Select service list below</p>
                <div class="service-list">
                    <div class="accordion" id="accordionExample">
                        <!-- Popular service adding -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSpecialItem">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSpecialItem" aria-expanded="true" aria-controls="collapseSpecialItem">
                                    <img class="list-img" src="{{ asset('images/small/repair/oil.png') }}">
                                    <p class="accor-title">Servicing</p>
                                    <p class="check-counter check-count-special">0</p>
                                </button>
                            </h2>
                            <div id="collapseSpecialItem" class="accordion-collapse collapse" aria-labelledby="headingSpecialItem" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-special">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Servicing')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-special" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThirteen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="true" aria-controls="collapseThirteen">
                                    <img class="list-img" src="{{ asset('images/small/repair/belt.png') }}">
                                    <p class="accor-title">Timing Belts & Chains</p>
                                    <p class="check-counter check-count-one">0</p>
                                </button>
                            </h2>
                            <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-one">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Timing Belts & Chains')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-one" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                    <img class="list-img" src="{{ asset('images/small/repair/diagnotics.png') }}">
                                    <p class="accor-title">General Diagnostics</p>
                                    <p class="check-counter check-count-eight">0</p>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-eight">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'General Diagnostics')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-eight" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFourteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="true" aria-controls="collapseFourteen">
                                <img class="list-img" src="{{ asset('images/small/repair/brake.png') }}">
                                <p class="accor-title">Brakes</p>
                                <p class="check-counter check-count-two">0</p>
                            </button>
                            </h2>
                            <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-two">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Brakes')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-two" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFifteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="true" aria-controls="collapseFifteen">
                                <img class="list-img" src="{{ asset('images/small/repair/clutch.png') }}">
                                <p class="accor-title">Clutch & Transmission</p>
                                <p class="check-counter check-count-three">0</p>
                            </button>
                            </h2>
                            <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#accordionExample">
                            <div class="accordion-side accordion-body">
                                <ul class="ps-5 col-12 accor-ul accordion-ul-three">
                                    @foreach($services as $key => $data)
                                        @if($data->service === 'Clutch & Transmission')
                                            <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                <input class="form-check-input acc-three" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                <label class="form-check-label" for="{{$data->id}}">
                                                    {{$data->detail}}
                                                </label>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSixteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="true" aria-controls="collapseSixteen">
                                <img class="list-img" src="{{ asset('images/small/repair/Engine.png') }}">
                                <p class="accor-title">Engine Management Light</p>
                                <p class="check-counter check-count-four">0</p>
                            </button>
                            </h2>
                            <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#accordionExample">
                            <div class="accordion-side accordion-body">
                                <ul class="ps-5 col-12 accor-ul accordion-ul-four">
                                    @foreach($services as $key => $data)
                                        @if($data->service === 'Engine Management Light')
                                            <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                <input class="form-check-input acc-four" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                <label class="form-check-label" for="{{$data->id}}">
                                                    {{$data->detail}}
                                                </label>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            </div>
                        </div>
                        <!-- Other service list -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <img class="list-img" src="{{ asset('images/small/repair/suspension.png') }}">
                                <p class="accor-title">Suspension</p>
                                <p class="check-counter check-count-five">0</p>
                            </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-side accordion-body">
                                <ul class="ps-5 col-12 accor-ul accordion-ul-five">
                                    @foreach($services as $key => $data)
                                        @if($data->service === 'Suspension')
                                            <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                <input class="form-check-input acc-five" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                <label class="form-check-label" for="{{$data->id}}">
                                                    {{$data->detail}}
                                                </label>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <img class="list-img" src="{{ asset('images/small/repair/engine-sm.png') }}">
                                    <p class="accor-title">Engine, Fuel & Turbo</p>
                                    <p class="check-counter check-count-six">0</p>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-six">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Engine, Fuel & Turbo')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-six" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                    <img class="list-img" src="{{ asset('images/small/repair/steering.png') }}">
                                    <p class="accor-title">Steering</p>
                                    <p class="check-counter check-count-seven">0</p>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-seven">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Steering')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-seven" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingfive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                    <img class="list-img" src="{{ asset('images/small/repair/ignition.png') }}">
                                    <p class="accor-title">Electrical & Ignition</p>
                                    <p class="check-counter check-count-nine">0</p>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-nine">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Electrical & Ignition')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-nine" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                    <img class="list-img" src="{{ asset('images/small/repair/heating.png') }}">
                                    <p class="accor-title">Heating</p>
                                    <p class="check-counter check-count-ten">0</p>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-ten">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Heating')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-ten" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    <img class="list-img" src="{{ asset('images/small/repair/cooling.png') }}">
                                    <p class="accor-title">Cooling</p>
                                    <p class="check-counter check-count-eleven">0</p>
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-eleven">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Cooling')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-eleven" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
                                    <img class="list-img" src="{{ asset('images/small/repair/exhaust.png') }}">
                                    <p class="accor-title">Exhaust</p>
                                    <p class="check-counter check-count-twelve">0</p>
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-twelve">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Exhaust')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-twelve" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingNine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="true" aria-controls="collapseNine">
                                    <img class="list-img" src="{{ asset('images/small/repair/ac diagnosis.png') }}">
                                    <p class="accor-title">A/C</p>
                                    <p class="check-counter check-count-thirteen">0</p>
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-thirteen">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'A/C Diagnosis')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-thirteen" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTen">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="true" aria-controls="collapseTen">
                                    <img class="list-img" src="{{ asset('images/small/repair/wipers.png') }}">
                                    <p class="accor-title">Wipers</p>
                                    <p class="check-counter check-count-fourteen">0</p>
                                </button>
                            </h2>
                            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-fourteen">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Wipers')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-fourteen" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingEleven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
                                    <img class="list-img" src="{{ asset('images/small/repair/windscreens.png') }}">
                                    <p class="accor-title">Windscreens</p>
                                    <p class="check-counter check-count-fifteen">0</p>
                                </button>
                            </h2>
                            <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-fifteen">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Windscreens')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-fifteen" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwelve">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                                    <img class="list-img" src="{{ asset('images/small/repair/bodywork.png') }}">
                                    <p class="accor-title">Bodywork</p>
                                    <p class="check-counter check-count-sixteen">0</p>
                                </button>
                            </h2>
                            <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" data-bs-parent="#accordionExample">
                                <div class="accordion-side accordion-body">
                                    <ul class="ps-5 col-12 accor-ul accordion-ul-sixteen">
                                        @foreach($services as $key => $data)
                                            @if($data->service === 'Bodywork')
                                                <li class="form-check col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <input class="form-check-input acc-sixteen" type="checkbox" value="{{$data->id}}" name="{{$data->id}}" id="{{$data->id}}">
                                                    <label class="form-check-label" for="{{$data->id}}">
                                                        {{$data->detail}}
                                                    </label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="next-button">
                    <button type="button" id="nextbtn" class="btn next-btn">Next</button>
                </div>
            </div>
            
            <div class="repair-section col-md-10 col-sm-12 col-12 d-none" id="second_section" data-aos="fade-up" data-aos-delay="200">
                <h3 class="rep-title fredoka">Maintenance & Repair Service</h3>
                @guest
                    <div class="repair-input">
                        <div class="rep-input col-md-6 col-sm-12 col-12">
                            <input type="text" class="form-control rep-in" name="name" id="name" placeholder="Name *">
                            <p class="error-three error-msg d-none">Please input your name</P>
                            <p class="error-name error-show d-none">Please input your name</P>
                        </div>
                        
                        <div class="rep-input col-md-6 col-sm-12 col-12">
                            <input type="email" class="form-control rep-in" name="email" id="email" placeholder="Email *">
                            <p class="error-five error-msg d-none">Please input your email</P>
                            <p class="error-email error-show d-none">Please input your email</P>
                        </div>
                        <div class="rep-input col-md-6 col-sm-12 col-12">
                            <input type="number" class="form-control rep-in" name="phone_number" id="phone_number" placeholder="Phone Number *">
                            <p class="error-six error-msg d-none">Please input your phone number.</P>
                            <p class="error-phone error-show d-none">Please input your phone number</P>
                        </div>
                    </div>

                    <div class="next-button">
                        <button type="button" id="backbtn" class="btn back-btn">Back</button>
                        <button type="button" id="secondguestbtn" class="btn submit-btn">Next</button>
                    </div>
                @else
                    <div class="repair-input">
                        <div class="rep-input col-md-6 col-sm-12 col-12">
                            <input type="text" class="form-control rep-in" name="name" id="name" value="{{ Auth::user()->name }}" placeholder="Name *" readonly>
                            <p class="error-three error-msg d-none">Please input your name</P>
                            <p class="error-name error-show d-none">Please input your name</P>
                        </div>
                        <div class="rep-input col-md-6 col-sm-12 col-12">
                            <input type="email" class="form-control rep-in" name="email" id="email" value="{{ Auth::user()->email }}" placeholder="Email *" readonly>
                            <p class="error-five error-msg d-none">Please input your email</P>
                            <p class="error-email error-show d-none">Please input your email</P>
                        </div>
                        <div class="rep-input col-md-6 col-sm-12 col-12">
                            <input type="number" class="form-control rep-in" name="phone_number" id="phone_number" placeholder="Phone Number *">
                            <p class="error-six error-msg d-none">Please input your phone number.</P>
                            <p class="error-phone error-show d-none">Please input your phone number</P>
                        </div>
                        <div class="alert alert-danger print-error-msg">
                            <ul></ul>
                        </div>
                    </div>

                    <div class="next-button">
                        <button type="button" id="backbtn" class="btn back-btn">Back</button>
                        <button type="button" id="secondbtn" class="btn submit-btn">Next</button>
                        <button id="secondbtn_loading" class="btn submit-btn d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                @endguest

                
            </div>

            <div class="repair-section col-md-10 col-sm-12 col-12 d-none" id="third_section" data-aos="fade-up" data-aos-delay="200">
                <h3 class="rep-title fredoka">Maintenance & Repair Service</h3>

                <div class="repair-input">
                    <p class="pop-title col-12">Client Info</p>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Name</p>
                        <p type="text" class="api-detail" name="mail_name" id="mail_name"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Email</p>
                        <p type="text" class="api-detail" name="mail_email" id="mail_email"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Phone Number</p>
                        <p type="text" class="api-detail" name="mail_phone" id="mail_phone"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Reg Number</p>
                        <p type="text" class="api-detail" name="mail_regnumber" id="mail_regnumber"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Location</p>
                        <p type="text" class="api-detail" name="mail_location" id="mail_location"></p>
                    </div>
                </div>

                <div>
                    <p class="pop-title">Selected service list</p>
                    <div class="select-service-items">
                        <ul></ul>
                    </div>
                </div>
                
                <div class="repair-input">
                    <p class="pop-title col-12">Vehicle Detail</p>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Reg Number</p>
                        <p type="text" class="api-detail" name="api_regnumber" id="api_regnumber"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Make</p>
                        <p type="text" class="api-detail" name="api_make" id="api_make"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Model</p>
                        <p type="text" class="api-detail" name="api_model" id="api_model"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Version</p>
                        <p type="text" class="api-detail" name="api_version" id="api_version"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Body</p>
                        <p type="text" class="api-detail" name="api_body" id="api_body"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Doors</p>
                        <p type="text" class="api-detail" name="api_doorsname" id="api_doors"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Seats</p>
                        <p type="text" class="api-detail" name="api_seat" id="api_seat"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Reg Date</p>
                        <p type="text" class="api-detail" name="api_regdate" id="api_regdate"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Reg Date Ireland</p>
                        <p type="text" class="api-detail" name="api_regdate_ie" id="api_regdate_ie"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Sale Date</p>
                        <p type="text" class="api-detail" name="api_saledate" id="api_saledate"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Engine Capacity</p>
                        <p type="text" class="api-detail" name="api_enginecc" id="api_enginecc"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Colour</p>
                        <p type="text" class="api-detail" name="api_color" id="api_color"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Fuel</p>
                        <p type="text" class="api-detail" name="api_fuel" id="api_fuel"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Transmission</p>
                        <p type="text" class="api-detail" name="api_transmission" id="api_transmission"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Year of manufacture</p>
                        <p type="text" class="api-detail" name="api_manufacture" id="api_manufacture"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Tax Class</p>
                        <p type="text" class="api-detail" name="api_taxclass" id="api_taxclass"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Tax Expiry Date</p>
                        <p type="text" class="api-detail" name="api_taxexpiry" id="api_taxexpiry"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">NCT Expiry Date</p>
                        <p type="text" class="api-detail" name="api_nctexpiry" id="api_nctexpiry"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">NCT Pass Date</p>
                        <p type="text" class="api-detail" name="api_nctpass" id="api_nctpass"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">No_of_Owners</p>
                        <p type="text" class="api-detail" name="api_owners" id="api_owners"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Chassis_No</p>
                        <p type="text" class="api-detail" name="api_chassis" id="api_chassis"></p>
                    </div>
                    <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">Engine_No</p>
                        <p type="text" class="api-detail" name="api_engineno" id="api_engineno"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">CO2_Emissions</p>
                        <p type="text" class="api-detail" name="api_co2" id="api_co2"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">CrwExpDate</p>
                        <p type="text" class="api-detail" name="api_crwexpdate" id="api_crwexpdate"></p>
                    </div>
                    <div class="d-none justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                        <p class="api-label">vehicle_category</p>
                        <p type="text" class="api-detail" name="api_category" id="api_category"></p>
                    </div>
                </div>

                <div class="alert alert-danger print-error-msg">
                    <ul></ul>
                </div>

                <div class="next-button">
                    <button type="button" id="secondbackbtn" class="btn back-btn">Back</button>
                    <button type="submit" id="submitbtn" class="btn submit-btn">Submit</button>
                </div>
            </div>
        </form>
    </section>  
    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
    <script src="{{ asset('js/repair.js') }}"></script>
    <script src="{{ asset('js/xmltojson.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });

            $('#nextbtn').click(function() {

                var reg_number = $('#reg_number').val();
                var sel_location = $('#sel_location').val();
                if(reg_number == '' && sel_location == null){
                    $('.error').removeClass('d-none');
                    $( "#reg_number" ).focus();
                } 
                else if (reg_number == '') {
                    $('.error-two').addClass('d-none');
                    $('.error-one').removeClass('d-none');
                    $( "#reg_number" ).focus();
                } else if (sel_location == null) {
                    $('.error-one').addClass('d-none');
                    $('.error-two').removeClass('d-none');
                    $( "#sel_location" ).focus();
                } else {
                    $('.error-one').addClass('d-none');
                    $('.error-two').addClass('d-none');
                    $('#second_section').removeClass('d-none');      
                    $('#first_section').addClass('d-none');
                    $( "#name" ).focus();
                }
            })

            $('#backbtn').click(function() {
                $('#first_section').removeClass('d-none');      
                $('#second_section').addClass('d-none');
            })

            $('#secondbackbtn').click(function() {
                $('.error-show').addClass('d-none');

                $('#second_section').removeClass('d-none');   
                $('#third_section').addClass('d-none');
            })

            $('#secondguestbtn').click(function() {
                Command: toastr["warning"]("Please Log In or Create Account immediately", "Warning");
                setTimeout(() => {
                    window.location.href = "{{route('login')}}";
                }, 3000);
            })

            $('#secondbtn').click(function() {

                var name = $('#name').val();
                var email = $('#email').val();
                var phone_number = $('#phone_number').val();
                var array = [];
                @foreach($services as $key => $data)
                if ($('#{{$data->id}}').is(":checked"))
                {
                    var checkbox = $('#{{$data->id}}').closest('li').find('label').text();
                    array.push(checkbox);
                }
                @endforeach

                if(name == '') {
                    $('.error-name').removeClass('d-none');
                    $( "#name" ).focus();
                } else if(name != '') {
                    $('.error-name').addClass('d-none');
                }
                if(email == '') {
                    $('.error-email').removeClass('d-none');
                    $( "#email" ).focus();
                }else if(email != '') {
                    $('.error-email').addClass('d-none');
                }
                if(phone_number == '') {
                    $('.error-phone').removeClass('d-none');
                    $( "#phone_number" ).focus();
                } else if(phone_number != '') {
                    $('.error-phone').addClass('d-none');
                }

                if(array.length == 0) {
                    Command: toastr["warning"]("Please select one service item at least!", "Warning");
                    return false;
                } else if(name != '' && email != '' && phone_number != '') {
                    $('#secondbtn').addClass('d-none');
                    $('#secondbtn_loading').removeClass('d-none');

                    var regNumber = $('#reg_number').val();
                    var selLocation = $('#sel_location').val();
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var phone_number = $('#phone_number').val();
                    var array = [];
                    @foreach($services as $key => $data)
                    if ($('#{{$data->id}}').is(":checked"))
                    {
                        var checkbox = $('#{{$data->id}}').closest('li').find('label').text();
                        array.push(checkbox);
                    }
                    @endforeach

                    const fetchFunc = async () => {
                        let inputed_regNum = $('#reg_number').val();

                        const result = await fetch(`/repair/getCarDetailXML/${inputed_regNum}`)
                        .then(response => response.text());

                        dom = parseXml(result);
                        json = xml2json(dom);
                        json = JSON.parse(json.slice(0, json.indexOf('undefined')) + json.slice(json.indexOf('ned"') + 3));
                        
                        if(typeof(json.response.vehicle) != 'undefined' && json.response.vehicle != null) {
                            var prefix = json.response.vehicle;
                            var reg = prefix.reg;
                            var make = prefix.make;
                            var model = prefix.model;
                            var version = prefix.version;
                            var body = prefix.body;
                            var doors = prefix.doors;
                            var seats = prefix.seats;
                            var reg_date = prefix.reg_date;
                            var reg_date_ie = prefix.reg_date_ie;
                            var sale_date = prefix.sale_date;
                            var previous_reg = prefix.previous_reg;
                            var engine_cc = prefix.engine_cc;
                            var colour = prefix.colour;
                            var fuel = prefix.fuel;
                            var transmission = prefix.transmission;
                            var year_of_manufacture = prefix.year_of_manufacture;
                            var tax_class = prefix.tax_class;
                            var tax_expiry_date = prefix.tax_expiry_date;
                            var NCT_expiry_date = prefix.NCT_expiry_date;
                            var nct_pass_date = prefix.nct_pass_date;
                            var no_of_owners = prefix.no_of_owners;
                            var chassis_no = prefix.chassis_no;
                            var engine_no = prefix.engine_no;
                            var co2_emissions = prefix.co2_emissions;
                            var crwExpDate = prefix.crwExpDate;
                            var vehicle_category = prefix.vehicle_category;
                        }

                        $('#mail_name').html(name);
                        $('#mail_email').html(email);
                        $('#mail_phone').html(phone_number);
                        $('#mail_regnumber').html(regNumber);
                        $('#mail_location').html(selLocation);

                        var regNumber = $('#reg_number').val();
                        $('#api_regnumber').html(regNumber);
                        $('#api_make').html(make);
                        $('#api_model').html(model);
                        $('#api_version').html(version);
                        $('#api_body').html(body);
                        $('#api_doors').html(doors);
                        $('#api_seat').html(seats);
                        $('#api_regdate').html(reg_date);
                        $('#api_regdate_ie').html(reg_date_ie);
                        $('#api_saledate').html(sale_date);
                        $('#api_enginecc').html(engine_cc);
                        $('#api_color').html(colour);
                        $('#api_fuel').html(fuel);
                        $('#api_transmission').html(transmission);
                        $('#api_manufacture').html(year_of_manufacture);
                        $('#api_taxclass').html(tax_class);
                        $('#api_taxexpiry').html(tax_expiry_date);
                        $('#api_nctexpiry').html(NCT_expiry_date);
                        $('#api_nctpass').html(nct_pass_date);
                        $('#api_owners').html(no_of_owners);
                        $('#api_chassis').html(chassis_no);
                        $('#api_engineno').html(engine_no);
                        $('#api_co2').html(co2_emissions);
                        $('#api_crwexpdate').html(crwExpDate);
                        $('#api_category').html(vehicle_category);

                        $('#secondbtn').removeClass('d-none');
                        $('#secondbtn_loading').addClass('d-none');
                        $('#second_section').addClass('d-none');
                        $('#third_section').removeClass('d-none');

                        $.each( array, function( key, value ) {
                            $(".select-service-items").find("ul").append('<li>'+value+'</li>');
                            $( ".select-service-items" ).focus();
                        });
                    }

                    fetchFunc();
                }
                
            })

            $("#submitbtn").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var reg_number = $('#reg_number').val();
                var sel_location = $('#sel_location').val();
                var name = $('#name').val();
                var email = $('#email').val();
                var phone_number = $('#phone_number').val();

                var reg = $('#api_regnumber').html();
                var make = $('#api_make').html();
                var model = $('#api_model').html();
                var version = $('#api_version').html();
                var body = $('#api_body').html();
                var doors = $('#api_doors').html();
                var seats = $('#api_seat').html();
                var reg_date = $('#api_regdate').html();
                var reg_date_ie = $('#api_regdate_ie').html();
                var sale_date = $('#api_saledate').html();
                var engine_cc = $('#api_enginecc').html();
                var colour = $('#api_color').html();
                var fuel = $('#api_fuel').html();
                var transmission = $('#api_transmission').html();
                var year_of_manufacture = $('#api_manufacture').html();
                var tax_class = $('#api_taxclass').html();
                var tax_expiry_date = $('#api_taxexpiry').html();
                var NCT_expiry_date = $('#api_nctexpiry').html();
                var nct_pass_date = $('#api_nctpass').html();
                var no_of_owners = $('#api_owners').html();
                var chassis_no = $('#api_chassis').html();
                var engine_no = $('#api_engineno').html();
                var co2_emissions = $('#api_co2').html();
                var crwExpDate = $('#api_crwexpdate').html();
                var vehicle_category = $('#api_category').html();

                // Get value of inputs checked and add them to a new array
                var array = [];
                @foreach($services as $key => $data)
                if ($('#{{$data->id}}').is(":checked"))
                {
                    var checkbox = $('#{{$data->id}}').val();
                    array.push(checkbox);
                }
                @endforeach

                var detailArray = [];
                @foreach($services as $key => $data)
                if ($('#{{$data->id}}').is(":checked"))
                {
                    var selectItem = $('#{{$data->id}}').closest('li').find('label').text();
                    detailArray.push(selectItem);
                }
                @endforeach

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
                    url:"{{ route('repair.store') }}",
                    data:{
                        _token:_token,
                        reg_number:reg_number,
                        sel_location:sel_location,
                        name:name,
                        email:email, 
                        phone_number:phone_number,
                        array:array,
                        detailArray:detailArray,
                        reg:reg,
                        make:make,
                        model:model,
                        version:version,
                        body:body,
                        doors:doors,
                        seats:seats,
                        reg_date:reg_date,
                        reg_date_ie:reg_date_ie,
                        sale_date:sale_date,
                        engine_cc:engine_cc,
                        colour:colour,
                        fuel:fuel,
                        transmission:transmission,
                        year_of_manufacture:year_of_manufacture,
                        tax_expiry_date:tax_expiry_date,
                        NCT_expiry_date:NCT_expiry_date,
                        nct_pass_date:nct_pass_date,
                        no_of_owners:no_of_owners,
                        chassis_no:chassis_no,
                        engine_no:engine_no,
                        co2_emissions:co2_emissions,
                        crwExpDate:crwExpDate,
                        vehicle_category:vehicle_category
                    },
                    success:function(data){
                        if(data.status == '2') {
                            window.location.href = "{{route('repairConfirm')}}";
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
                        } else {
                            Command: toastr["error"]("An error occured!", "Error");
                        }
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