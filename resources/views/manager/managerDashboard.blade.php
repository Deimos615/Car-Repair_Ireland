@extends('layouts.app')

@section("style")
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection

@section('content')
    <section class="container dashboard">
        <div class="dashboard-area">

            @include("partials.managerSidebar")

            <div class="db-content col-lg-9 col-md-7 col-sm-12 col-12">
                <div class="db-top">
                    <h3 class="fredoka">
                        {{ Auth::user()->name }}'s Dashboard
                    </h3>
                    <!-- <div>
                        <img class="db-img" src="{{ asset('images/small/dashboard/search.png') }}">
                        <img class="db-img" src="{{ asset('images/small/dashboard/notification.png') }}">
                    </div> -->
                </div>
                <div class="db-field">
                    <p class="db-subtitle fredoka">Overview</p>
                    <div class="field-content">
                        <div class="field-boxes">
                            <a href="managerBooking" class="dash-link col-lg-5 col-md-10 col-sm-12 col-12">
                                <div class="field-box">
                                    <div class="fbox-image1">
                                        <img class="fbox-img" src="{{ asset('images/small/dashboard/booking.png') }}">
                                    </div>
                                    <div class="fbox-text">
                                        <h3 class="fbox-num fredoka upcoming-booking" id="upcoming_booking">0</h3>
                                        <p class="fbox-title">Upcoming Booking</p>
                                    </div>
                                </div>
                            </a>
                            <a href="managerQuote" class="dash-link col-lg-5 col-md-10 col-sm-12 col-12">
                                <div class="field-box">
                                    <div class="fbox-image2">
                                        <img class="fbox-img" src="{{ asset('images/small/dashboard/quotes.png') }}">
                                    </div>
                                    <div class="fbox-text">
                                        <h3 class="fbox-num fredoka upcoming-quote" id="upcoming_quote">0</h3>
                                        <p class="fbox-title">New Quotes!</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="db-illustration">
                            <div class="sale-image col-lg-6 col-md-12">
                                <img class="sale-img" src="{{ asset('images/large/dashboard/sale.png') }}"> 
                            </div>
                            <div class="sale-text col-lg-6 col-md-12">
                                <p class="sale-title">SELL YOUR CAR WITH AUTOGURU</p>
                                <p class="sale-description">Did you know you can sell your car quickly and easily with Autoguru? Click here to get a valuation today! Etc </p>
                            </div>
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

            $(".upcoming-purchase").html(upcomingCount);
            $(".upcoming-quote").html(upcomingRepair);
            $(".upcoming-booking").html(upcomingBooking);
            
            reloadUpcomming();
        });
    </script>
@endsection
