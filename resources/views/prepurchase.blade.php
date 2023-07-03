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
                        {{ Auth::user()->name }}'s Pre-Purchase
                    </h3>
                    <!-- <div>
                        <img class="db-img" src="{{ asset('images/small/dashboard/search.png') }}">
                        <img class="db-img" src="{{ asset('images/small/dashboard/notification.png') }}">
                    </div> -->
                </div>
                <div class="db-field">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Upcoming Pre-Purchase</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Previous Pre-Purchase</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            @foreach($services as $key => $data)
                                @if($data->date >= now())
                                    <div class="service-card d-flex flex-wrap">
                                        <div class="basic-service col-lg-7 col-md-12 col-sm-12 col-12">
                                            <div class="service-top">
                                                <div class="service-title">
                                                    <p class="fredoka ser-title">{{$data->inspection}}</p>
                                                </div>
                                                <div class="service-date">
                                                    <img class="ser-calendar" src="{{ asset('images/small/dashboard/calendar.png') }}" alt="calendar image">
                                                    <p class="ser-date">{{$data->date}}</p>
                                                </div>
                                            </div>
                                            <div class="service-area">
                                                <div class="service-content">
                                                    <img class="ser-img" src="{{ asset('images/small/dashboard/location.png') }}">
                                                    <p class="ser-text">{{$data->garage}} *****{{$data->location}}</p>
                                                </div>
                                                <div class="service-content">
                                                    <img class="ser-img" src="{{ asset('images/small/dashboard/attach-square.png') }}">
                                                    <p class="ser-text">{{$data->reg_number}}</p>
                                                </div>
                                                <div class="service-content">
                                                    <img class="ser-img" src="{{ asset('images/small/dashboard/call.png') }}">
                                                    <p class="ser-text">{{$data->seller_phone}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="post-service col-lg-5 col-md-12 col-sm-12 col-12">
                                            <div class="post-serarea">
                                                <div class="service-title">
                                                    <p class="fredoka ser-title">
                                                        Reg Number Detail
                                                        @if($data->make == "")
                                                            <span class="invalid-reg-number">(Invalid Number)</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="post-detail1">
                                                    <p class="post-title">Year</p>
                                                    <p class="post-cost">{{$data->year_of_manufacture}}</p>
                                                </div>
                                                <div class="post-detail2">
                                                    <p class="post-title">Make & Model</p>
                                                    <p class="post-cost">{{$data->make}} {{$data->model}}</p>
                                                </div>
                                                <div class="post-detail3">
                                                    <p class="post-title">Engine Capacity</p>
                                                    <p class="post-cost">{{$data->engine_cc}}</p>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            @foreach($services as $key => $data)
                                @if($data->date <= now())
                                    <div class="basic-service col-lg-7 col-md-12 col-sm-12 col-12">
                                        <div class="service-top">
                                            <div class="service-title">
                                                <p class="fredoka ser-title">{{$data->inspection}}</p>
                                            </div>
                                            <div class="service-date">
                                                <img class="ser-calendar" src="{{ asset('images/small/dashboard/calendar.png') }}" alt="calendar image">
                                                <p class="ser-date">{{$data->date}}</p>
                                            </div>
                                        </div>
                                        <div class="service-area">
                                            <div class="service-content">
                                                <img class="ser-img" src="{{ asset('images/small/dashboard/location.png') }}">
                                                <p class="ser-text">{{$data->garage}} *****{{$data->location}}</p>
                                            </div>
                                            <div class="service-content">
                                                <img class="ser-img" src="{{ asset('images/small/dashboard/attach-square.png') }}">
                                                <p class="ser-text">{{$data->reg_number}}</p>
                                            </div>
                                            <div class="service-content">
                                                <img class="ser-img" src="{{ asset('images/small/dashboard/call.png') }}">
                                                <p class="ser-text">{{$data->seller_phone}}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(function () {
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
        });
    </script>
@endsection