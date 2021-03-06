@extends('layouts.admin')

@section('page-title', 'Timeline')
@section('page-description', 'List of all your notifications.')

@section('content')
    <div class="container">
        <ul class="cbp_tmtimeline">
            @if(count($chosen_user->notifications) == 0)
                <li>
                    <time class="cbp_tmtime" datetime="2017-10-09T18:30"><span class="hidden">09/10/2017</span> <span class="large">Now</span></time>
                    <div class="cbp_tmicon timeline-bg-gray">
                        <i class="fa-user"></i>
                    </div>
                    <div class="cbp_tmlabel empty">
                        <span>No Notifications</span>
                    </div>
                </li>
            @else
                @php
                $date_notification = '';
                @endphp
                @foreach ($chosen_user->notifications as $notification)
                    @php
                        $current_notification_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at )->format( 'd/m/Y' );
                        if($date_notification != $current_notification_date){
                            echo "<li>
                                <time class='cbp_tmtime' datetime='2017-10-09T03:45'><span>".$current_notification_date."</span><span></span></time>
                                <div class='cbp_tmicon timeline-bg-gray'>
                                    <i class='fa-calendar'></i>
                                </div>
                                <div class='cbp_tmlabel' style='background-color:#eee'>
                                </div>
                            </li>
                            ";
                        }
                        display_notification($notification, true);
                        $date_notification = $current_notification_date;
                    @endphp
                @endforeach
            @endif
        </ul>
    </div>
    <style>
        .cbp_tmtimeline > li .cbp_tmtime {
            display: block;
            width: 25%;
            padding-right: 100px;
            position: absolute;
        }

        .cbp_tmtimeline > li .cbp_tmtime > span:first-child {
            font-weight: bold;
            margin-bottom: 2px;
        }

        .cbp_tmtimeline > li .cbp_tmtime > span.hidden + span {
            margin-top: 8px;
        }

        .cbp_tmtimeline {
            margin: 30px 0 0 0;
            padding: 0;
            list-style: none;
            position: relative;
        }

        .cbp_tmtimeline > li .cbp_tmlabel {
            background: #fff;
            color: #737881;
            margin-bottom: 30px;
            padding: 20px;
            -webkit-border-radius: 0px;
            -webkit-background-clip: padding-box;
            -moz-border-radius: 0px;
            -moz-background-clip: padding;
            border-radius: 0px;
            background-clip: padding-box;
        }
    </style>
@endsection
