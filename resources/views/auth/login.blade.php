@extends('layouts.app')

@section("style")
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<section class="register-section">
    <div class="reg-image col-md-6 col-sm-12 col-12" data-aos="zoom-in" data-aos-delay="200">
        <img class="reg-img" src="{{ asset('images/large/Landing/landing-slide.png') }}" alt="main image">
    </div>
    <div class="reg-area col-md-6 col-sm-12 col-12" data-aos="zoom-in" data-aos-delay="400">
        <div class="back-btn">
            <a class="back-tag" href="<?= url('/'); ?>">{{ __('Back') }}</a>
        </div>
        <div class="reg-content">
            <!-- <form method="POST" class="reg-form" action="{{ route('login') }}"> -->
            <form method="POST" class="reg-form">
                @csrf

                <h1 class="form-title fredoka">Get’s started</h1>
                <p class="form-subtitle">Please login to continue with us</p>

                <div class="alert alert-danger print-error-msg">
                    <ul></ul>
                </div>
                <div class="row reg-input">
                    <input id="email" type="email" class="reg-text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row reg-input">
                    <input id="password" type="password" class="reg-text form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row my-3 mx-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>

                <div class="row mb-0">
                        <button type="submit" class="btn reg-btn" id="submitbtn">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                </div>
                <p>Don 't have an account? <a href="{{ route('register') }}" class="login-link">Register</a></p>
            </form>
        </div>
    </div>
    
</Section>
<script>
    AOS.init({
        duration: 1200,
    })
</script>
<script>
    $(document).ready(function() {
        $("#submitbtn").click(function(e){
            e.preventDefault();

            var _token = $("input[name='_token']").val();
            var email = $('#email').val();
            var password = $('#password').val();

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
                url:"{{ route('login') }}",
                data:{
                    _token:_token, 
                    email:email, 
                    password:password
                },
                success:function(data){
                    if(data.status == '5') {
                        Command: toastr["error"]("Email-Address Or Password Are Wrong!", "Warning");
                        return false;
                    }else if(data.status == '3') {
                        window.location.href = "{{URL::to('admin/adminDashboard')}}";
                        return false;
                    }else if(data.status == '2') {
                        window.location.href = "{{URL::to('manager/managerDashboard')}}";
                        return false;
                    }else if(data.status == '9') {
                        window.location.href = "{{URL::to('dashboard')}}";
                        return false;
                    }else if(data.status == '1') {
                        Command: toastr["error"]("Your account is in review yet. Please wait for a while!", "Warning");
                        return false;
                    }else if(data.status == '0') {
                        printErrorMsg(data.error);
                        return false;
                    }                                     
                },
                error: function(data) {
                    Command: toastr["error"]("An error occured!", "Error");
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
