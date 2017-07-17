@extends('layouts.admin')

@section('page-title', 'Contract End Dates | All')
@section('page-description', 'List Of all ceds.')

@section('content')
	@php
		$firstDate = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('verbalCED', '!=', null)->orderBy('date', 'asc')->first();
        $lastDate = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('verbalCED', '!=', null)->orderBy('date', 'desc')->first();

        if($firstDate != null){
            if($firstDate->date == "0000-00-00"){
                $firstDate = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('verbalCED', '!=', null)->orderBy('date', 'asc')->skip(1)->first();
            }
        }
	@endphp

	<a>
		<div class='cbp_time' style='background:none; margin-left:25%;'>
			<ul style='list-style-type: none; display: inline; font-size:16px; '>
				<li style='float: left;'>
					@if($firstDate != null)
						<a href="{{route('ced.timeline_admin')}}?beginDate={{Carbon\Carbon::createFromFormat('Y-m-d', $firstDate->date)->format('d/m/Y')}}&endDate={{Carbon\Carbon::createFromFormat('Y-m-d', $lastDate->date)->format('d/m/Y')}}" class="btn btn-default">View {{Carbon\Carbon::createFromFormat('Y-m-d', $firstDate->date)->format('d/m/Y')}} - {{Carbon\Carbon::createFromFormat('Y-m-d', $lastDate->date)->format('d/m/Y')}} (All CED's)</a>
					@endif
					<span style='float: left; margin-top:4px;'>Showing CED's from </span>
					<input type='text' class="form-control" style="float:left; width:100px; margin:0px 10px 0px 10px;" id='callbackBeginDate'/>
					<span style='float: left; margin-top:4px;'> - </span>
					<input type='text' class="form-control" style="float:left; width:100px; margin:0px 10px 0px 10px;" id='callbackEndDate' />
					<a href="{{route('ced.timeline')}}" class="btn btn-default">View just your CED's</a>
				</li>
			</ul>
		</div>
	</a>
	

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
		@php
		$dates = array();
		$dates = $prospectModal->select(DB::raw("*, STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->orderBy('date')->paginate(10);
		@endphp
		@foreach($dates as $core)
            {
            "category": "{{$core->id.'-'.$core->company}}",
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
<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">CED</h3>
	</div>
	<div id="chartdiv" style="width : 100%!important;"></div>
</div>

<center>{{$dates->links()}}</center>
@endsection