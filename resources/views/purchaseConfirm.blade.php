@extends("layouts.app")

@section("style")
    <link rel="stylesheet" href="{{ asset('css/repairConfirm.css') }}">
@endsection

@section("content")   
    <section class="repair">
        <div class="container">
            <div>
                <img class="" src="{{ asset('images/small/repair/Confirmed 1.png') }}" alt="image">
            </div>
            <h1 class="confirm-title fredoka">Confirmation</h1>
            <h4 class="confirm-text">A payment link will be sent to your email when a mechanic has been assigned.</h4>
            <div class="repair-input">
                <h3 class="pop-title col-12">Vehicle Detail</h3>
                <h5 class="invalid-regnumber col-12">(You inputed an invalid reg number.)</h5>
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
                <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                    <p class="api-label">Engine Capacity</p>
                    <p type="text" class="api-detail" name="api_enginecc" id="api_enginecc"></p>
                </div>
            </div>
        </div>
    </section> 
    <script>
        $(document).ready(function() {
            const fetchFunc = async () => {
                const result = await fetch(`/purchase/getRegDetail`)
                .then(response => response.text());
                var _result = JSON.parse(result);
                console.log(_result);
                var check_id = _result[0].make;
                if(check_id == null){
                    $(".invalid-regnumber").show();
                    $('#api_regnumber').html(_result[0].reg);
                } else {
                    $('#api_regnumber').html(_result[0].reg);
                    $('#api_make').html(_result[0].make);
                    $('#api_model').html(_result[0].model);
                    $('#api_version').html(_result[0].version);
                    $('#api_body').html(_result[0].body);
                    $('#api_enginecc').html(_result[0].engine_cc);
                }
            }
            fetchFunc();
        })
    </script> 
@endsection