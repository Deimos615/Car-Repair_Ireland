@extends('layouts.adminApp')

@section("style")
    <link rel="stylesheet" href="{{ asset('css/admindashboard.css') }}">
@endsection
  
@section('content')
        <!-- Moving Car Effect in the background -->
        <div class="country-wrap">
            <!--<div class="mountain-1"></div>
            <div class="mountain-2"></div>-->

            <div class="sun"></div>
            <div class="grass"></div>
            <div class="street">
                <div class="car">
                <!--<div class="car-base"></div>-->
                <div class="car-body">
                    <div class="car-top-back">
                        <div class="back-curve"></div>
                    </div>
                    <div class="car-gate"></div>
                    <div class="car-top-front">
                        <div class="wind-sheild"></div>
                    </div>
                    <div class="bonet-front"></div>
                    <div class="stepney"></div>
                </div>
                <div class="boundary-tyre-cover">
                    <div class="boundary-tyre-cover-back-bottom"></div>
                    <div class="boundary-tyre-cover-inner"></div>	
                </div>
                <div class="tyre-cover-front">
                    <div class="boundary-tyre-cover-inner-front"></div>
                </div>
                <div class="base-axcel">
                    
                </div>
                <div class="front-bumper"></div>
                <div class="tyre">		
                    <div class="gap"></div>	
                </div>
                <div class="tyre front">
                    <div class="gap"></div>	
                </div>
                <div class="car-shadow"></div>
            </div>
            </div>
            <div class="street-stripe"></div>
            <div class="hill">
                <!--<div class="tree-1">
                    <div class="branch-1"></div>
                    <div class="branch-2"></div>
                    <div class="branch-3"></div>
                </div>
                <div class="tree-1">
                <div class="branch"></div>
                <div class="trunk"></div>
            </div>-->
            </div>
        </div>
        
        <div class="row d-flex justify-content-center">
            
            <div class="row dt-content mt-5">
                <div class="col-md-12 text-right mb-5 d-flex justify-content-between">
                    <h1 class="mt-0 fredoka">Admin Dashboard</h1>
                </div>
            </div>
        </div>
    
        <div class="col-12">
            <div class="quick_activity_wrap d-flex flex-wrap">
                <div class="col-lg-6 single-card">
                    <a href="adminUser">
                        <div class="interior interior-one d-flex justify-content-between">
                            <div class="card-content">
                                <h4 class="card-title fredoka">Total Clients</h4>
                                <h1 class="card-text fredoka" id="tuser">0</h1>
                                <p class="card-percent">New: <span class="counter" id="new_user"></span> </p>
                            </div>
                            <div class="card-icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 single-card">
                    <a href="adminService">
                        <div class="interior interior-two d-flex justify-content-between">
                            <div class="card-content">
                                <h4 class="card-title fredoka">Total Services</h4>
                                <h1 class="card-text fredoka" id="tservice">0</h1>
                                <p class="card-percent">Detail: <span class="counter" id="ser_detail"></span> </p>
                            </div>
                            <div class="card-icon">
                                <i class="fa fa-truck" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>    
                </div>
                <div class="col-lg-6 single-card">
                    <a href="adminLocation">
                        <div class="interior interior-three d-flex justify-content-between">
                            <div class="card-content">
                                <h4 class="card-title fredoka">Total Locations</h4>
                                <h1 class="card-text fredoka" id="tlocation">0</h1>
                                <p class="card-percent d-flex justify-content-around">
                                    Garage: <span class="counter" id="tgarage"></span>
                                    New: <span class="counter" id="new_garage"></span>
                                </p>
                            </div>
                            <div class="card-icon">
                                <i class="fa fa-bank" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 single-card">
                    <a href="#" class="d-none">
                        <div class="interior interior-four d-flex justify-content-between">
                            <div class="card-content">
                                <h4 class="card-title fredoka">Announcement</h4>
                                <h1 class="card-text fredoka">0</h1>
                                <p class="card-percent">News: <span class="counter"></span></p>
                            </div>
                            <div class="card-icon">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        
    <script type="text/javascript">
        $(function () {
        
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $users = {{$tuser}}
            $('#tuser').html($users);
            $ser_details = {{$tser_details}}
            $('#ser_detail').html($ser_details);
            $garages = {{$tgarage}}
            $('#tgarage').html($garages);
            $locations = {{$tlocation}}
            $('#tlocation').html($locations);
            $services = {{$tservice}}
            $('#tservice').html($services);
            $newuser = {{$tnewuser}}
            $('#new_user').html($newuser);
            $('#new_garage').html({{$tnewgarage}});
        });
    </script>
@endsection