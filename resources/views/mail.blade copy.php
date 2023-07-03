<!DOCTYPE html>
<html>
<head>
    <title>Autoguru Service</title>
</head>
<body>
    <h1>Hi, {{ $name }}</h1>

    <div class="repair-section col-md-10 col-sm-12" id="third_section">
        <div class="alert alert-danger print-error-msg">
            <ul></ul>
        </div>
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
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
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
                <p class="api-label">Doors</p>
                <p type="text" class="api-detail" name="api_doorsname" id="api_doors"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Seats</p>
                <p type="text" class="api-detail" name="api_seat" id="api_seat"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Reg Date</p>
                <p type="text" class="api-detail" name="api_regdate" id="api_regdate"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Sale Date</p>
                <p type="text" class="api-detail" name="api_saledate" id="api_saledate"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Engin CC</p>
                <p type="text" class="api-detail" name="api_enginecc" id="api_enginecc"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Color</p>
                <p type="text" class="api-detail" name="api_color" id="api_color"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Fuel</p>
                <p type="text" class="api-detail" name="api_fuel" id="api_fuel"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Transmission</p>
                <p type="text" class="api-detail" name="api_transmission" id="api_transmission"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Year of manufacture</p>
                <p type="text" class="api-detail" name="api_manufacture" id="api_manufacture"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Tax Class</p>
                <p type="text" class="api-detail" name="api_taxclass" id="api_taxclass"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Tax Expiry Date</p>
                <p type="text" class="api-detail" name="api_taxexpiry" id="api_taxexpiry"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">NCT Expiry Date</p>
                <p type="text" class="api-detail" name="api_nctexpiry" id="api_nctexpiry"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">NCT Pass Date</p>
                <p type="text" class="api-detail" name="api_nctpass" id="api_nctpass"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">No_of_Owners</p>
                <p type="text" class="api-detail" name="api_owners" id="api_owners"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Chassis_No</p>
                <p type="text" class="api-detail" name="api_chassis" id="api_chassis"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">Engine_No</p>
                <p type="text" class="api-detail" name="api_engineno" id="api_engineno"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">CO2_Emissions</p>
                <p type="text" class="api-detail" name="api_co2" id="api_co2"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">CrwExpDate</p>
                <p type="text" class="api-detail" name="api_crwexpdate" id="api_crwexpdate"></p>
            </div>
            <div class="d-flex justify-content-between regapi-input col-md-6 col-sm-12 col-12">
                <p class="api-label">vehicle_category</p>
                <p type="text" class="api-detail" name="api_category" id="api_category"></p>
            </div>
        </div>

        <div class="next-button">
            <button type="button" id="secondbackbtn" class="btn back-btn">Back</button>
            <button type="submit" id="submit-btn" class="btn submit-btn">Submit</button>
        </div>
    </div>
</body>
</html>
  