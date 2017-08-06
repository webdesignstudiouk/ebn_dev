@extends('ceds.timeline-admin')

@section('extra-breadcrumbs')

@endsection

@section('sub-content')
    <a>
        <div class='cbp_time' style='background:none; margin-bottom: 20px;'>
            <ul style='list-style-type: none; display: inline; font-size:16px; '>
                <li style='float: left;'>
                    <span style='float: left; margin-top:4px; margin-left:20px;'><i class='fa fa-circle' style='color:#5cb85c;'></i> 18 Month Before CED</span>
                    <span style='float: left; margin-top:4px; margin-left:20px;'><i class='fa fa-circle' style='color:#F89406;'></i> 14 Month Before CED</span>
                    <span style='float: left; margin-top:4px; margin-left:20px;'><i class='fa fa-circle' style='color:#ff6264;'></i> 1 Year Before CED</span>
                    <span style='float: left; margin-top:4px; margin-left:20px;'>CED's Before </span>
                    <input type='text' class="form-control" style="float:left; width:100px; margin:0px 10px 0px 10px;" id='callbackEndDate'/>
                </li>
            </ul>
        </div>
    </a>

    <!-- Resources -->
    <script src='{{url("js/amcharts.js")}}'></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/gantt.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <!-- Chart code -->
    @php
    $count = 0;
    @endphp
    <script>
        var chart = AmCharts.makeChart( "chartdiv", {
            "type": "gantt",
            "theme": "light",
            "marginRight": 70,
            "period": "DD",
            "dataDateFormat": "YYYY-MM-DD",
            "columnWidth": 0.5,
            "valueAxis": {
                "type": "date",
                "minPeriod": "MM",
                {{--"minimumDate": "{{Carbon\Carbon::now()->format('Y-m-d')}}",--}}
            },
            "brightnessStep": 10,
            "graph": {
                "fillAlphas": 1,
                "lineAlpha": 1,
                "lineColor": "#fff",
                "fillAlphas": 0.85,
                "balloonText": "<b>[[task]]</b>:<br />[[open]] -- [[value]] | [[diff]] months before"
            },
            "rotate": true,
            "categoryField": "category",
            "segmentsField": "segments",
            "colorField": "color",
            "startDateField": "start",
            "endDateField": "end",
            "dataProvider": [
                @if($prospectType == 1)
                    @foreach($dates as $core)
                        @if(Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED)->between(Carbon\Carbon::createFromFormat('Y-m-d', '2000-01-01'), Carbon\Carbon::createFromFormat('Y-m-d', $endDate)) && isset($core->verbalCED))
                            {
                            "category": "{{$core->id.'-'.$core->company.'-'.$core->type_id}}",
                            "segments": [
                                    {
                                        "start": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->subMonths($core->verbalCED_notification2+(18-$core->verbalCED_notification2))->format('Y-m-d') }}",
                                        "end": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->subMonths($core->verbalCED_notification2)->format('Y-m-d') }}",
                                        "diff": "{{($core->verbalCED_notification2+(18-$core->verbalCED_notification2)) - $core->verbalCED_notification1}}",
                                        "color": "#5cb85c",
                                        "task": "Ok"
                                    },{
                                        "start": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->subMonths($core->verbalCED_notification2)->format('Y-m-d') }}",
                                        "end": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->subMonths($core->verbalCED_notification1)->format('Y-m-d') }}",
                                        "diff": "{{$core->verbalCED_notification2 - $core->verbalCED_notification1}}",
                                        "color": "#F89406",
                                        "task": "Warning"
                                    },
                                    {
                                        "start": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->subMonths($core->verbalCED_notification1)->format('Y-m-d') }}",
                                        "end": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->format('Y-m-d') }}",
                                        "diff": "{{$core->verbalCED_notification1}}",
                                        "color": "#d9534f",
                                        "task": "Danger"
                                    }
                                ]
                            },
                        @php $count++; @endphp
                        @endif
                    @endforeach
                @endif
                @if($prospectType == 2 || $prospectType == 3)
                    @if($meterType == 'electric' || $meterType == 'gas')
                        @foreach($dates as $core)
                            @if(Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate)->between(Carbon\Carbon::createFromFormat('Y-m-d', '2000-01-01'), Carbon\Carbon::createFromFormat('Y-m-d', $endDate)) && isset($core->contractEndDate))
                                {
                                "category": "{{$core->prospectId.'-'.$core->siteId.'-'.$core->meterId.'-'.$core->prospectCompany}}",
                                "segments": [
                                    {
                                        "start": "{{Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate )->subMonths(14+(18-14))->format('Y-m-d') }}",
                                        "end": "{{Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate )->subMonths(14)->format('Y-m-d') }}",
                                        "diff": "{{(14+(18-14)) - 12}}",
                                        "color": "#5cb85c",
                                        "task": "Ok"
                                    },{
                                        "start": "{{Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate )->subMonths(14)->format('Y-m-d') }}",
                                        "end": "{{Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate )->subMonths(12)->format('Y-m-d') }}",
                                        "diff": "{{14 - 12}}",
                                        "color": "#F89406",
                                        "task": "Warning"
                                    },
                                    {
                                        "start": "{{Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate )->subMonths(12)->format('Y-m-d') }}",
                                        "end": "{{Carbon\Carbon::createFromFormat('Y-m-d', $core->contractEndDate )->format('Y-m-d') }}",
                                        "diff": "{{12}}",
                                        "color": "#d9534f",
                                        "task": "Danger"
                                    }
                                ]
                            },
                            @php $count++; @endphp
                            @endif
                        @endforeach
                    @endif
                @endif
            ],
            "chartCursor": {
                "cursorColor":"#55bb76",
                "valueBalloonsEnabled": false,
                "cursorAlpha": 0,
                "valueLineAlpha":0.5,
                "valueLineBalloonEnabled": true,
                "valueLineEnabled": true,
                "zoomable":true,
            },
            "listeners": [{
                "event": "clickGraphItem",
                "method": function(event) {
                   var label = event.item.category;
                   var id = label.split('-');
                   var base_url = window.location.origin;
                   var pathArray = window.location.pathname.split( '/' );
                   var prospectType = jQuery.inArray('1', pathArray);
                   if(prospectType == -1) {
                       var meterType = jQuery.inArray('electric', pathArray);
                       if (meterType == -1) {
                           window.location.replace(base_url + '/admin/prospects/' + id[0] + '/sites/' + id[1] + '/gasMeters/' + id[2] + '/edit');
                       } else {
                           window.location.replace(base_url + '/admin/prospects/' + id[0] + '/sites/' + id[1] + '/electricMeters/' + id[2] + '/edit');
                       }
                   }else{
                       window.location.replace(base_url + '/admin/prospects/' + id[0] + '/edit');
                   }
                }
            }]
        } );
    </script>

    <!-- HTML -->

    @if($prospectType == '2')
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <li class="{{active('*contract-end-dates/*/electric*')}}" ><a href="{{route('ced.timeline', array('prospectType'=>'2', 'meterType'=>'electric'))}}">Electric Meters</a></li>
                <li class="{{active('*contract-end-dates/*/gas*')}}"><a href="{{route('ced.timeline', array('prospectType'=>'2', 'meterType'=>'gas'))}}">Gas Meters</a></li>
            </ul>
        </nav>
    @elseif($prospectType == '3')
        <nav class="navbar navbar-default">
            <ul class="nav navbar-nav">
                <li class="{{active('*contract-end-dates/*/electric*')}}" ><a href="{{route('ced.timeline', array('prospectType'=>'3', 'meterType'=>'electric'))}}">Electric Meters</a></li>
                <li class="{{active('*contract-end-dates/*/gas*')}}"><a href="{{route('ced.timeline', array('prospectType'=>'3', 'meterType'=>'gas'))}}">Gas Meters</a></li>
            </ul>
        </nav>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading" style="margin-bottom:20px;">
            <h3 class="panel-title">
                @if($meterType == 'electric') Electric Contract End Dates @endif
                @if($meterType == 'gas') Gas Contract End Dates @endif
                @if($meterType == '') Prospect Contract End Dates @endif
            </h3>
        </div>
        <div id="containerdiv">
            <div id="chartdiv" style="width : 100%!important;"></div>
        </div>
    </div>
    <style>
        #chartdiv {
            width: 100%;
            height:calc(30px * {{$count + 1}});
        }
    </style>
@endsection

