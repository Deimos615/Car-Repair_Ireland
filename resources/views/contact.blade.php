@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/transport.css') }}">
@endsection

@section("content")   
    <section class="slide">
        <div class="container slide-section">
            <div class="slide-slogan col-lg-5 col-md-12 col-sm-12 col-12" data-aos="fade-up">
                <h1 class="fredoka">Autoguru Service</h1>
                <p class="slide-text">
                    We are an Irish company focused on bringing transparency to used car ownership. Combining technology with experienced businesses & technicians, we aim to make booking professionals & services seamless.<br/><br/>
                </p>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 col-12" data-aos="zoom-in">
                <img class="contact-slide-img" src="{{ asset('images/large/contact.png') }}">
            </div>
        </div>
    </section>
    <section class="img-bg-section">

    </section>
    <section class="booking">
        <div class="container">
            <form class="form col-lg-9 col-md-10 col-sm-12 col-12" data-aos="fade-up" data-aos-delay="200">
                <h3 class="fredoka book-title">Contact us</h3>
                <div class="user-info">
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="text" id="username" name="username" placeholder="Name *">
                    </div>
                    <div class="book-box col-lg-6 col-md-12 col-12">
                        <input class="form-control book-input" type="email" id="useremail" name="useremail" placeholder="Email *">
                    </div>
                    <div class="purpose-num">
                        <input class="form-control book-input" type="text" id="loading_purpose" name="loading_purpose" placeholder="Purpose">
                    </div>
                    <div class="purpose-num">
                        <textarea class="form-control book-input purpose-input" id="note" name="note" placeholder="Enter Your detail"></textarea>
                    </div>
                    <div class="alert alert-danger print-error-msg col-12">
                        <ul></ul>
                    </div>
                    <button type="button" id="submitbtn" class="btn trans-btn">Submit</button>
                </div>
                <div class="col-12 contact-map-section">
                    <div id="map"></div>
                </div>
            </form>
        </div>
    </section>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtV5VAafNn5zpdQhGlXwUWWf8pQ9dbahI&libraries=places&v=weekly"></script>
    <script src="{{ asset('js/map.js') }}"></script>
    <script>
        AOS.init({
            duration: 1200,
        })
    </script>
    <script>
        $(document).ready(function() {
            //Submitting
            $("#submitbtn").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var username = $('#username').val();
                var useremail = $('#useremail').val();
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
                    url:"{{ route('contact.store') }}",
                    data:{
                        _token:_token,
                        username:username,
                        useremail:useremail,
                        loading_purpose:loading_purpose,
                        note:note,
                    },
                    success:function(data){
                        console.log(data);
                        if(data.status == '2') {
                            Command: toastr["success"]("Your request successfully sent to Autoguru support team", "Success");
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