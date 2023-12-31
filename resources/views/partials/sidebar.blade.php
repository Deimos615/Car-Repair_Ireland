<div class="db-sidebar col-lg-3 col-md-5 col-sm-12 col-12">
    <div class="sidebar-cell">
        <a class="sidebar-link" href="dashboard">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/dashboard.png') }}" alt="dashboard icon">
                <p class="barcell-title">Dashboard</p>
            </div>
        </a>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="booking">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/my bookings.png') }}" alt="dashboard icon">
                <p class="barcell-title">My Bookings</p>
            </div>
        </a>
        <div>
            <p class="barcell-number upcoming-booking" id="sidebar_booking">0</p>
        </div>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="quote">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/requests.png') }}" alt="dashboard icon">
                <p class="barcell-title">My Quote Requests</p>
            </div>
        </a>
        <div>
            <p class="barcell-number upcoming-quote" id="sidebar_quote">0</p>
        </div>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="prepurchase">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/requests.png') }}" alt="dashboard icon">
                <p class="barcell-title">My Pre-Purchase Request</p>
            </div>
        </a>
        <div>
            <p class="barcell-number upcoming-purchase" id="sidebar_purchase">0</p>
        </div>
    </div>
    <div class="sidebar-cell">
        <a class="sidebar-link" href="profile">
            <div class="sidebar-left">
                <img class="sidebar-img" src="{{ asset('images/small/dashboard/profile.png') }}" alt="dashboard icon">
                <p class="barcell-title">My Profile</p>
            </div>
        </a>
    </div>
</div>
<script>
    var upcomingCount = 0;
    var upcomingRepair = 0;
    function reloadUpcomming(){
        $(".upcoming-booking").html(upcomingBooking);
        $(".upcoming-quote").html(upcomingRepair);
        $(".upcoming-purchase").html(upcomingCount);
    }
</script>