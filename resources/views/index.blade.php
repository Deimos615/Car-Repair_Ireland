@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section("content")
    <section class="slide">
        <div class="container slide-area">
            <div class="slide-img col col-lg-6 col-md-12 col-sm-12 col-12" data-aos="zoom-in-up">
                <img class="slide-image" src="{{ asset('images/large/Landing/landing-slide.png') }}" alt="slide image">
            </div>
            <div class="slide-text col-lg-6 col-md-12 col-sm-12 col-12" data-aos="zoom-in-right">
                <h1 class="fredoka slide-title1 mb-5">Buying, Maintaining, Repairing or Selling your vehicle?<br/>We’re here to help! </h1>
                <a href="/repair" class="quote-link"><div class="button effect-btn">Get a quote</div></a>
            </div>
        </div>
    </section>  
    <section class="service">
        <div class="container">
            <p class="ser-index">AutoGuru Service</p>
            <h3 class="ser-title fredoka">OUR SERVICES</h3>
            <div class="service-cards">
                <a href="/repair" class="col-lg-3 col-sm-12 col-12" data-aos="fade-right">
                    <div class="ser-card">
                        <div class="service-card">
                            <p class="card-num">01</p>
                            <img class="ser-img repair-img" src="{{ asset('images/small/Landing/Diagnostics and Repair.svg') }}" alt="repair image">
                            <h4 class="fredoka service-subtitle">Maintenance & Repair</h4>
                        </div>
                    </div>
                </a>
                <a href="/transport" class="col-lg-3 col-sm-12 col-12" data-aos="fade-right">
                    <div class="ser-card">
                        <div class="service-card">
                            <p class="card-num">02</p>
                            <img class="ser-img transport-img" src="{{ asset('images/small/Landing/Transport.svg') }}" alt="transport image">
                            <h4 class="fredoka service-subtitle">Transport</h4>
                        </div>
                    </div>
                </a>
                <a href="/sell" class="col-lg-3 col-sm-12 col-12" data-aos="fade-right">
                    <div class="ser-card">
                        <div class="service-card">
                            <p class="card-num">03</p>
                            <img class="ser-img tyre-img" src="{{ asset('images/small/Landing/Sell my car.svg') }}" alt="tyres image">
                            <h4 class="fredoka service-subtitle">Sell My Car</h4>
                        </div>
                    </div>
                </a>
                <a href="/purchase" class="col-lg-3 col-sm-12 col-12" data-aos="fade-right">
                    <div class="ser-card">
                        <div class="service-card">
                            <p class="card-num">04</p>
                            <img class="ser-img tyre-img" src="{{ asset('images/small/Landing/Pre Purchase Inspections.png') }}" alt="tyres image">
                            <h4 class="fredoka service-subtitle">Pre Purchase Inspections</h4>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>   
    <section class="howto">
        <div class="container howto-area">
            <div class="howto-img col-lg-6 col-md-12 col-12" data-aos="zoom-in-down">
                <img class="howto-image" src="{{ asset('images/large/Landing/howto.png') }}" alt="howto image">
            </div>
            <div class="howto-text col-lg-6 col-md-12 col-12">
                <h3 class="fredoka howto-title">What do we offer?</h3>
                <div class="howto-card" data-aos="flip-down">
                    <div><img src="{{ asset('images/small/Landing/Diagnostics and Repair.svg') }}" alt="service image"></div>
                    <div class="howto-cardtext">
                        <p class="fredoka howto-subtitle">Maintenance & Repairs</p>
                        <p class="howto-detail">
                            With a few clicks, easily compare estimates for routine maintenance or vehicle repairs from local
                            garages. Find an estimate you’re happy with, then simply book online.
                        </p>
                    </div>
                </div>
                <div class="howto-card" data-aos="flip-down">
                    <div><img src="{{ asset('images/small/Landing/Sell my car.svg') }}" alt="service image"></div>
                    <div class="howto-cardtext">
                        <p class="fredoka howto-subtitle">Sell My Car</p>
                        <p class="howto-detail">
                            Remove the stress of selling your car by dealing directly with professionals - avoiding the
                            headaches of a private sale. Quick. Easy. Fair.
                        </p>
                    </div>
                </div>
                <div class="howto-card" data-aos="flip-down">
                    <div><img src="{{ asset('images/small/Landing/Transport.svg') }}" alt="service image"></div>
                    <div class="howto-cardtext">
                        <p class="fredoka howto-subtitle">Transport</p>
                        <p class="howto-detail">
                            Whether it’s getting your new car home, or your existing car to a garage, get an instant quote and
                            easily book transportation online!
                        </p>
                    </div>
                </div>
                <div class="howto-card" data-aos="flip-down">
                    <div>
                        <img class="landing-purchase-img" src="{{ asset('images/small/Landing/Pre Purchase Inspections.png') }}" alt="service image">
                    </div>
                    <div class="howto-cardtext">
                        <p class="fredoka howto-subtitle">Pre-purchase inspections</p>
                        <p class="howto-detail">
                            Avoid hidden issues and buy your next used car with confidence! Book an independent mechanic
                            to come along and carry out a thorough inspection before you buy - whether from a dealership or
                            private seller.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>          
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
    <section class="about">
        <div class="container about-body">
            <div class="about-content col-md-6 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="100">
                <h3 class="fredoka about-title">How our Pre-Purchase Inspection Works</h3>
                <p class="about-text">
                    Tell us when & where you would like us to inspect the vehicle - we offer
                    inspections on both private & dealership vehicles.<br/><br/>
                    A mobile technician will be assigned to your booking.<br/></br>
                    The technician will carry out a thorough inspection of the vehicle.<br/></br>
                    You’ll receive a report by email allowing you to make an informed buying decision.
                </p>
            </div>
            <div class="about-cards col-md-6 col-sm-12 col-12">
                <div data-aos="fade-up" data-aos-delay="200">
                    <div class="about-card">
                        <div class="about-img"><img class="about-cardimg" src="{{ asset('images/small/Landing/Easy.svg') }}" alt="about image"></div>
                        <div class="about-cardbody">
                            <h5 class="fredoka">Easy</h5>
                            <p class="about-cardtext">Meeting at your specified Time / Location</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end" data-aos="fade-up" data-aos-delay="400">
                    <div class="about-card">
                        <div class="about-img"><img class="about-cardimg" src="{{ asset('images/small/Landing/Reliable.svg') }}" alt="about image"></div>
                        <div class="about-cardbody">
                            <h5 class="fredoka">Reliable</h5>
                            <p class="about-cardtext">Multi-Point Inspection Qualified Mechanic</p>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-delay="600">
                    <div class="about-card">
                        <div class="about-img"><img class="about-cardimg" src="{{ asset('images/small/Landing/Safe.svg') }}" alt="about image"></div>
                        <div class="about-cardbody">
                            <h5 class="fredoka">Safe</h5>
                            <p class="about-cardtext">Trusted Advice Customer Rated Mechanics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <section class="people">
        <div class="container people-content">
            <div class="desc_item" data-aos="fade-up" data-aos-delay="100">
                <h2 class="fredoka desc-title"> Why use AutoGuru? </h2>
                <p class="desc-text">
                    We know the car ownership journey can be stressful and confusing. Our objective is to
                    empower drivers and simplify the daunting world of car purchasing, maintenance,
                    repairs and selling. By using Autoguru, you can be informed about the car you’re
                    purchasing, ensure you’re not overpaying for maintenance & repairs while you have it,
                    and get a fair price when it’s time to sell!
                </p>
            </div>
            <div class="desc-item" data-aos="fade-up" data-aos-delay="100">
                <h2 class="fredoka desc-title"> Empowering drivers and growing garages </h2>
                <p class="desc-text">
                    Our aim is to modernise the used car ownership cycle by building a car maintenance
                    marketplace that works for everyone. Drivers get transparency, allowing them to make
                    informed decisions and garages get access to thousands of potential new customers.<br/>
                    Providing transparency and choice is at the heart of everything we do.
                </p>
            </div>
        </div>
    </section>
    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
@endsection                                                                                                    
