@extends('ceds.timeline-admin')

@section('extra-breadcrumbs')

@endsection

@section('sub-content')
    <style>
        #chartdiv {
            width: 100%;
            height: 500px;
        }
    </style>

    <!-- Resources -->
    <script src='{{url("js/amcharts.js")}}'></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/gantt.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

    <!-- Chart code -->
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
                @endforeach
                @endif

                @if($prospectType == 2 || $prospectType == 3)
                    @if($meterType == 'electric' || $meterType == 'gas')
                        @foreach($dates as $core)
                        {
                            "category": "{{$core->meterId.'-'.$core->siteId.'-'.$core->prospectCompany}}",
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
            }
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
        <div id="chartdiv" style="width : 100%!important;"></div>
    </div>

    <center>{{$dates->links()}}</center>
@endsection

