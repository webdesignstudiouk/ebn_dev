<div class='sidebar-menu toggle-others fixed' style=''>
    <div class='sidebar-menu-inner ps-container'>
        <section class='sidebar-user-info'>
            <div class='sidebar-user-info-inner'><a href='#' class='user-profile'> <img
                            src='http://www.energybuyersnetwork.com/content/images/energy-buyers-network.png'
                            width='90%' style='margin-left:5%; margin-right:5%;' alt='user-pic'>  <h4
                            style='color:#fff; text-align:center;'>Energy Buyers Network</h4></a>
                <ul class='user-links list-unstyled'>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           style="color:#8dc63f;"><i class='fa fa-lock' style='color:#fff'></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">        {{ csrf_field() }}    </form>
                    </li>
                </ul>
            </div>
        </section>
        <div class="content" style="marign-bottom:0px!important;">
            <div class="user-name">{{Auth::user()->first_name}} {{Auth::user()->second_name}} <span
                        class="text-muted f9">
            @role('admin')
                ADMIN
            @else
                AGENT
            @endrole
            </span></div>
        </div>
        <ul class='main-menu' id='main-menu'>
            <!--<li class="{{ active(['admin/options/*', 'admin/options']) }}"><a href='{{url("admin/options")}}'><span class='title'>Admin</span></a></li>-->
            <li class="{{ active(['admin/dashboard/*', 'admin/dashboard']) }}">
                <a href='{{route("dashboard")}}'><span class='title'>Dashboard</span></a></li>
            @role('admin')
            <li class="{{ active(['admin/options/source-codes/*', 'admin/options/source-codes','admin/options/stored-infomation/*', 'admin/options/stored-infomation']) }}" style="margin-top:30px;">
                <a href='{{url("admin/options/source-codes")}}'><span class='title'>Admin</span></a></li>
            <li class="{{ active(['admin/users/*', 'admin/users']) }}"><a href='{{url("admin/users")}}'><span
                            class='title'>Users</span></a></li>
            @endrole
            <li class="{{ active(['admin/prospects/*', 'admin/prospects']) }}"><a
                        href='{{url("admin/prospects")}}'><span class='title'>Prospects 1 & 2 / Clients</span></a></li>
            <li class="{{ active(['admin/callbacks/*', 'admin/callbacks']) }}"><a href='{{url("admin/callbacks")}}'>
                    <span class='title'>Callbacks</span></a></li>
            <li class="{{ active(['admin/contract-end-dates/*', 'admin/contract-end-dates']) }}"><a
                        href='{{route("ced.timeline")}}'> <span class='title'>Contract End Dates</span></a></li>
            <li class="{{ active(['search.index']) }}" style="margin-top:30px;"><a href='{{route("search.index")}}'>
                    <span class='title'>Search</span> </a></li>
        </ul>
        <div class='ps-scrollbar-x-rail' style='display: block; width: 340px; left: 0px; bottom: 3px;'>
            <div class='ps-scrollbar-x' style='left: 0px; width: 0px;'></div>
        </div>
        <div class='ps-scrollbar-y-rail' style='display: block; top: 0px; height: 1236px; right: 2px;'>
            <div class='ps-scrollbar-y' style='top: 0px; height: 0px;'></div>
        </div>
    </div>
</div>
<div class='main-content' style='padding-top:0px!important;'>
    <div class="page-title" style="margin-bottom:20px;">
        <div class="title-env"><h1 class="title">@yield("page-title")</h1>
            <p class="description">@yield("page-description")</p></div>
    </div> @if (session()->has('flash_notification.message'))
        <script>        $('body').addClass('chat-open');        </script>    @endif