@php
    $notification_count = Auth::user()->unreadNotifications->count();
@endphp

<nav class="navbar user-info-navbar fixed" role="navigation">
    <ul class="user-info-menu left-links list-inline list-unstyled">

        <li class="dropdown hover-line" style=" margin-left: 20px;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa-bell-o"></i>
                <span class="badge badge-green" id="toolbar_notification_count">{{$notification_count}}</span>
            </a>
            <ul class="dropdown-menu notifications">
                <li class="top">
                    <p class="small">
                        <a class="pull-right" href="#" id="clear_notifications">Mark all Read</a> You have <strong id="dropdown_notification_count">{{$notification_count}}</strong> unread notification(s).
                    </p>
                </li>
                <li>
                    <ul id="notification_list" class="dropdown-menu-list list-unstyled ps-scrollbar ps-container" style="overflow-y: scroll;">
                        @if(count(Auth::user()->notifications) == 0)
                        <li class="active notification-secondary">
                            <a href="#">
                                <i class="fa-exclamation"></i>
                                <span class="line"> <strong>No Notifications</strong></span>
                                <span class="line small time">Try again later</span>
                            </a>
                        </li>
                        @else
                            @foreach (Auth::user()->notifications as $notification)
                                {{display_notification($notification)}}
                                @if($loop->iteration == 10)
                                    @break
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="external"> <a href="{{route('notifications')}}"> <span>View all notifications</span> <i class="fa-link-ext"></i> </a> </li>
            </ul>
        </li>

        @role('admin')
        <li class="dropdown hover-line" style=" margin-left: 20px;">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                EBN Users
            </a>
            <ul class="dropdown-menu notifications">
                <li>
                    <ul id="notification_list" class="dropdown-menu-list list-unstyled ps-scrollbar ps-container" style="overflow-y: scroll;">
                        @foreach(\App\Models\Users::all() as $ebn_user)
                            @if($ebn_user->first_name != '' && $ebn_user->id != 100 && $ebn_user->id != Auth::user()->id)
                                <li>
                                    <a href="#" style="color:#A6CE39;"><strong>{{$ebn_user->first_name}} {{$ebn_user->second_name }}</strong></a>
                                    <a href="{{route('notifications.user', $ebn_user->id)}}">
                                        <span class="line">
                                           View Notifications
                                        </span>
                                    </a>
                                    <a href="{{route('impersonate.impersonate', $ebn_user->id)}}">
                                        <span class="line">
                                           Switch To This User
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
        @endrole

    </ul>
    <ul class="user-info-menu right-links list-inline list-unstyled">
        <li class="dropdown user-profile" style="">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span>{{Auth::user()->first_name}} {{Auth::user()->second_name}} <i class="fa-angle-down"></i></span></a>
            <ul class="dropdown-menu user-profile-menu list-unstyled">
                <li class="last">
                    <a href="{{route('notifications')}}"><i class="fa-bars"></i> My Notifications</a>
                    <a href="{{route('logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();"><i class="fa-lock"></i> Logout</a>
                    <form id="logout-form-nav" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                </li>
            </ul>
        </li>
        {{--<li style="">--}}
            {{--<a data-toggle="chat" href="#"><i class="fa-comments-o"></i></a>--}}
        {{--</li>--}}
    </ul>
</nav>