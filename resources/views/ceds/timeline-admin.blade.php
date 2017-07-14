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
{{--<ul class='cbp_tmtimeline'>--}}
	{{--@php--}}
	{{--$distinctCEDall = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->where('verbalCED', '!=', '')->orderBy('date')->pluck('date')->toArray();--}}
	{{--$distinctCED1 = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED_notification1_date ,'%d/%m/%Y' ) as date"))->where('verbalCED_notification1_date', '!=', '')->orderBy('date')->pluck('date')->toArray();--}}
	{{--$distinctCED2 = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED_notification2_date ,'%d/%m/%Y' ) as date"))->where('verbalCED_notification2_date', '!=', '')->orderBy('date')->pluck('date')->toArray();--}}
	{{--$distinctCED = array_unique(array_merge($distinctCEDall, $distinctCED1, $distinctCED2));--}}

	{{--//dd($distinctCED);--}}


	{{--@endphp--}}

	{{--@foreach($distinctCED as $dced)--}}
		{{--{{$dced}}<br/>--}}

		{{--@foreach($prospectModal->where('verbalCED', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->get() as $core)--}}
			{{---c {{$core->verbalCED}}<br/>--}}
		{{--@endforeach--}}

		{{--@foreach($prospectModal->where('verbalCED_notification1_date', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->get() as $n1)--}}
			{{---n1 {{$n1->verbalCED_notification1_date}}<br/>--}}
		{{--@endforeach--}}

		{{--@foreach($prospectModal->where('verbalCED_notification2_date', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->get() as $n2)--}}
			{{---n2 {{$n2->verbalCED_notification2_date}}<br/>--}}
		{{--@endforeach--}}

	{{--<br/>--}}
	{{--@endforeach--}}


	{{--@foreach($distinctCED as $dced)--}}
	{{--@if(Carbon\Carbon::createFromFormat('Y-m-d', $dced)->between(Carbon\Carbon::createFromFormat('Y-m-d', $beginDate), Carbon\Carbon::createFromFormat('Y-m-d', $endDate)))--}}
	{{--@php--}}
	{{--$collapseId = str_replace('-', '', stripslashes($dced));--}}
	{{--$count = $prospectModal->where('verbalCED', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->count();--}}
	{{--@endphp--}}
	{{--<li>--}}
		{{--<div class='cbp_tmicon timeline-bg-success '>--}}
			{{--<a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}' aria-expanded='false' aria-controls='{{$collapseId}}'>--}}
				{{--{{$count}}--}}
			{{--</a>--}}
		{{--</div>--}}
		{{--<a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}' aria-expanded='false' aria-controls='{{$collapseId}}'>--}}
			{{--<div class='cbp_time'>{{Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y')}} - <small style='font-size:12px;'>{{Carbon\Carbon::createFromFormat('Y-m-d', $dced)->diffForHumans()}}</small></div>--}}
		{{--</a>--}}
		{{--<div class='collapse in' id='{{$collapseId}}'>--}}

			{{--<!--Core-->--}}
			{{--@foreach($prospectModal->where('verbalCED', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->get() as $core)--}}
			{{--<div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>--}}
				{{--<div class='xe-widget xe-weather' style='background:#fff!important;'>--}}
					{{--<div class='xe-current-day'>--}}
						{{--<div class='xe-now'>--}}
							{{--<div class='xe-temperature' style='color:#000!important;'>--}}
								{{--<h3>{{$core->company}}</h3><p>{{$core->user->first_name}} {{$core->user->second_name}}</p>--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
					{{--<div class='xe-weekdays' style='background:red!important;'>--}}
						{{--<ul class='list-unstyled'>--}}
							{{--<li>--}}
								{{--<div class='xe-weekday-forecast'>--}}
									{{--<div class='xe-day' style='cursor:pointer;'>--}}
										{{--<a href="{{route('prospects.edit', $core->id)}}" style='color:#fff;'>View Prospect</a>--}}
									{{--</div>--}}
								{{--</div>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<div class='xe-weekday-forecast'>--}}
									{{--<div class='xe-day' style='cursor:pointer;'>--}}
										{{--<a href="{{route('prospect.sites', $core->id)}}" style='color:#fff;'>View Sites</a>--}}
									{{--</div>--}}
								{{--</div>--}}
							{{--</li>--}}
							{{--<li>--}}
								{{--<div class='xe-weekday-forecast'>--}}
									{{--<div class='xe-day' style='cursor:pointer;'>--}}

									{{--</div>--}}
								{{--</div>--}}
							{{--</li>--}}
						{{--</ul>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--@endforeach--}}

			{{--<!--N1-->--}}
			{{--@foreach($prospectModal->where('verbalCED_notification1_date', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->get() as $core)--}}
				{{--<div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>--}}
					{{--<div class='xe-widget xe-weather' style='background:#fff!important;'>--}}
						{{--<div class='xe-current-day'>--}}
							{{--<div class='xe-now'>--}}
								{{--<div class='xe-temperature' style='color:#000!important;'>--}}
									{{--<h3>{{$core->company}}</h3><p>{{$core->user->first_name}} {{$core->user->second_name}}</p>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}
						{{--<div class='xe-weekdays' style='background:orange!important;'>--}}
							{{--<ul class='list-unstyled'>--}}
								{{--<li>--}}
									{{--<div class='xe-weekday-forecast'>--}}
										{{--<div class='xe-day' style='cursor:pointer;'>--}}
											{{--<a href="{{route('prospects.edit', $core->id)}}" style='color:#fff;'>View Prospect</a>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<div class='xe-weekday-forecast'>--}}
										{{--<div class='xe-day' style='cursor:pointer;'>--}}
											{{--<a href="{{route('prospect.sites', $core->id)}}" style='color:#fff;'>View Sites</a>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<div class='xe-weekday-forecast'>--}}
										{{--<div class='xe-day' style='cursor:pointer;'>--}}

										{{--</div>--}}
									{{--</div>--}}
								{{--</li>--}}
							{{--</ul>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--@endforeach--}}

		{{--<!--N2-->--}}
			{{--@foreach($prospectModal->where('verbalCED_notification2_date', Carbon\Carbon::createFromFormat('Y-m-d', $dced)->format('d/m/Y'))->get() as $core)--}}
				{{--<div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>--}}
					{{--<div class='xe-widget xe-weather' style='background:#fff!important;'>--}}
						{{--<div class='xe-current-day'>--}}
							{{--<div class='xe-now'>--}}
								{{--<div class='xe-temperature' style='color:#000!important;'>--}}
									{{--<h3>{{$core->company}}</h3><p>{{$core->user->first_name}} {{$core->user->second_name}}</p>--}}
								{{--</div>--}}
							{{--</div>--}}
						{{--</div>--}}
						{{--<div class='xe-weekdays' style='background:green!important;'>--}}
							{{--<ul class='list-unstyled'>--}}
								{{--<li>--}}
									{{--<div class='xe-weekday-forecast'>--}}
										{{--<div class='xe-day' style='cursor:pointer;'>--}}
											{{--<a href="{{route('prospects.edit', $core->id)}}" style='color:#fff;'>View Prospect</a>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<div class='xe-weekday-forecast'>--}}
										{{--<div class='xe-day' style='cursor:pointer;'>--}}
											{{--<a href="{{route('prospect.sites', $core->id)}}" style='color:#fff;'>View Sites</a>--}}
										{{--</div>--}}
									{{--</div>--}}
								{{--</li>--}}
								{{--<li>--}}
									{{--<div class='xe-weekday-forecast'>--}}
										{{--<div class='xe-day' style='cursor:pointer;'>--}}

										{{--</div>--}}
									{{--</div>--}}
								{{--</li>--}}
							{{--</ul>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--@endforeach--}}

		{{--</div>--}}
		{{--@endif--}}
		{{--@endforeach--}}
	{{--</ul>--}}


<style>
	#chartdiv {
		width: 100%;
		height: 500px;
	}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
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
            "minimumDate": "{{Carbon\Carbon::now()->format('Y-m-d')}}",
        },
        "brightnessStep": 10,
        "graph": {
            "fillAlphas": 1,
            "lineAlpha": 1,
            "lineColor": "#fff",
            "fillAlphas": 0.85,
            "balloonText": "<b>[[task]]</b>:<br />[[open]] -- [[value]]"
        },
        "rotate": true,
        "categoryField": "category",
        "segmentsField": "segments",
        "colorField": "color",
        "startDateField": "start",
        "endDateField": "end",
        "dataProvider": [
		@foreach($prospectModal->where('verbalCED','!=', '')->where('verbalCED_notification1_date','!=', '')->take(10)->get() as $core)
            {
            "category": "{{$core->company}}",
            "segments": [ {
                "start": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->format('Y-m-d') }}",
                "end": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->addMonths(12)->format('Y-m-d') }}",
                "color": "#46615e",
                "task": "Task #1"
            }, {
                "start": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->addMonths(12)->format('Y-m-d') }}",
                "end": "{{Carbon\Carbon::createFromFormat('d/m/Y', $core->verbalCED )->addMonths(16)->format('Y-m-d') }}",
                "color": "#727d6f",
                "task": "Task #2"
            }]
        },
        @endforeach
        ],
        "valueScrollbar": {
            "autoGridCount":true
        },
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
<div id="chartdiv"></div>

@endsection