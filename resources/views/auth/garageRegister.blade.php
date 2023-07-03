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
            <form method="POST" class="reg-form" action="{{ route('garageRegister') }}">
                @csrf

                <h1 class="form-title fredoka">Get’s started</h1>
                <p class="form-subtitle">Please Register to continue with us</p>

                <div class="row reg-input">
                    <!-- <input id="location" type="text" class="reg-text form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" autocomplete="name" autofocus placeholder="Location"> -->
                    <select class="form-control rep-in reg-text form-select @error('location') is-invalid @enderror" id="location" name="location" aria-label="Location">
                        <option class="rep-option d-none" selected disabled>Location</option>
                        <option class="rep-option" value="Dublin">Dublin</option>
                        <option class="rep-option" value="Cork">Cork</option>
                        <option class="rep-option" value="Galway">Galway</option>
                        <option class="rep-option" value="Limerick">Limerick</option>
                        <option class="rep-option" value="Waterford">Waterford</option>
                        <option class="rep-option" value="Drogheda">Drogheda</option>
                        <option class="rep-option" value="Dun Dealgan">Dun Dealgan</option>
                        <option class="rep-option" value="Swords">Swords</option>
                        <option class="rep-option" value="Blackrock">Blackrock</option>
                        <option class="rep-option" value="Tralee">Tralee</option>
                        <option class="rep-option" value="Carlow">Carlow</option>
                        <option class="rep-option" value="Ennis">Ennis</option>
                        <option class="rep-option" value="Dunleary">Dunleary</option>
                        <option class="rep-option" value="Kilkenny">Kilkenny</option>
                        <option class="rep-option" value="Naas">Naas</option>
                        <option class="rep-option" value="Sligo">Sligo</option>
                    </select>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row reg-input">
                    <input id="name" type="text" class="reg-text form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Trading Name">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row reg-input">
                    <input id="email" type="email" class="reg-text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- <div class="row reg-input">
                    <input id="email" type="email" class="reg-text form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Contact Email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> -->

                <div class="row reg-input">
                    <input id="password" type="password" class="reg-text form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="New Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row reg-input">
                    <input id="password-confirm" type="password" class="reg-text form-control" name="password_confirmation" autocomplete="new-password" placeholder="Confirm Password">
                </div>

                <div class="row reg-input">
                    <button type="submit" class="btn reg-btn">
                        {{ __('Register') }}
                    </button>
                </div>
                <p>Already have an account? <a href="{{ route('login') }}" class="login-link">Login</a></p>
            </form>
        </div>
    </div>
</Section>
<script>
    AOS.init({
        duration: 1200,
    })
</script>
@endsection
