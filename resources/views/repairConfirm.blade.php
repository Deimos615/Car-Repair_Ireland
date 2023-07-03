@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/repairConfirm.css') }}">
@endsection

@section("content")   
    <section class="repair">
        <div>
            <img class="" src="{{ asset('images/small/repair/Confirmed 1.png') }}" alt="image">
        </div>
        <h1 class="confirm-title fredoka">Confirmation</h1>
        <h4 class="confirm-text">Over the next 24 hours you will receive estimates from approved garages nearby</h4>
    </section>  
@endsection