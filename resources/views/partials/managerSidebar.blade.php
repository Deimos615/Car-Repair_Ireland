<div class="db-sidebar col-lg-3 col-md-5 col-sm-12 col-12">
    <div class="sidebar-cell">
        <a class="sidebar-link" href="managerDashboard">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/dashboard.png') }}" alt="dashboard icon">
                <p class="barcell-title">Dashboard</p>
            </div>
        </a>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="managerBooking">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/my bookings.png') }}" alt="dashboard icon">
                <p class="barcell-title">Bookings</p>
            </div>
        </a>
        <div>
            <p class="barcell-number upcoming-booking" id="sidebar_booking">0</p>
        </div>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="managerQuote">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/requests.png') }}" alt="dashboard icon">
                <p class="barcell-title">Quote Requests</p>
            </div>
        </a>
        <div>
            <p class="barcell-number upcoming-quote" id="sidebar_quote">0</p>
        </div>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="managerPurchase">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/requests.png') }}" alt="dashboard icon">
                <p class="barcell-title">Pre-Purchase</p>
            </div>
        </a>
        <div>
            <p class="barcell-number upcoming-purchase" id="sidebar_purchase">0</p>
        </div>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="managerProfile">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/profile.png') }}" alt="dashboard icon">
                <p class="barcell-title">Profile</p>
            </div>
        </a>
    </div>
</div>
<script>
    var upcomingCount = 0;
    var upcomingRepair = 0;
    var upcomingBooking = 0;
    function reloadUpcomming(){
        if(upcomingCount == '0') {
            $('#sidebar_purchase').hide();
        }
        if(upcomingRepair == '0') {
            $('#sidebar_quote').hide();
        }
        if(upcomingBooking == '0') {
            $('#sidebar_booking').hide();
        }
    }
</script>