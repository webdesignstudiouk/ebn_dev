@extends('layouts.admin')

@section('page-title', 'Contract End Dates | '.Auth::user()->first_name) 
@section('page-description', 'List Of all ceds.')

@section('content')
@php
	$firstDate = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('verbalCED', '!=', null)->where('user_id', '=', Auth::user()->id)->orderBy('date', 'asc')->first();
	$lastDate = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('verbalCED', '!=', null)->where('user_id', '=', Auth::user()->id)->orderBy('date', 'desc')->first();
	
	if($firstDate != null){
		if($firstDate->date == "0000-00-00"){
			$firstDate = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('verbalCED', '!=', null)->where('user_id', '=', Auth::user()->id)->orderBy('date', 'asc')->skip(1)->first();
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
				@role('admin')
					<a href="{{route('ced.timeline_admin')}}" class="btn btn-default">View CED's from all users</a>
				@endrole
			</li>   
		</ul>
	</div>
</a>
<ul class='cbp_tmtimeline'>
	@php
	$distinctCED = $prospectModal->select(DB::raw("STR_TO_DATE( verbalCED ,'%d/%m/%Y' ) as date"))->distinct()->where('verbalCED', '!=', '')->where('user_id', '=', Auth::user()->id)->orderBy('date')->pluck('date');
	@endphp
	@foreach($distinctCED as $c1)
	@if(Carbon\Carbon::createFromFormat('Y-m-d', $c1)->between(Carbon\Carbon::createFromFormat('Y-m-d', $beginDate), Carbon\Carbon::createFromFormat('Y-m-d', $endDate)))
	@php
	$collapseId = str_replace('-', '', stripslashes($c1));
	$count = $prospectModal->where('verbalCED', Carbon\Carbon::createFromFormat('Y-m-d', $c1)->format('d/m/Y'))->where('user_id', '=', Auth::user()->id)->count();
	@endphp
	<li>
		<div class='cbp_tmicon timeline-bg-success '>
			<a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}' aria-expanded='false' aria-controls='{{$collapseId}}'>
				{{$count}}
			</a>
		</div>
		<a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}' aria-expanded='false' aria-controls='{{$collapseId}}'>
			<div class='cbp_time'>{{Carbon\Carbon::createFromFormat('Y-m-d', $c1)->format('d/m/Y')}} - <small style='font-size:12px;'>{{Carbon\Carbon::createFromFormat('Y-m-d', $c1)->diffForHumans()}}</small></div>
		</a>
		<div class='collapse' id='{{$collapseId}}'>
			@foreach($prospectModal->where('verbalCED', Carbon\Carbon::createFromFormat('Y-m-d', $c1)->format('d/m/Y'))->where('user_id', '=', Auth::user()->id)->get() as $c2)
			<div class='cbp_tmlabel' style='padding:0px!important; color:#000!important'>
				<div class='xe-widget xe-weather' style='background:#fff!important;'>
					<div class='xe-current-day'>
						<div class='xe-now'>
							<div class='xe-temperature' style='color:#000!important;'>
								<h3>{{$c2->company}}</h3>
							</div>
						</div>
					</div>
					<div class='xe-weekdays' style='background:#459ec4!important;'>
						<ul class='list-unstyled'>
							<li>
								<div class='xe-weekday-forecast'>
									<div class='xe-day' style='cursor:pointer;'>
										<a href="{{route('prospects.edit', $c2->id)}}" style='color:#fff;'>View Prospect</a>
									</div>
								</div>
							</li>
							<li>
								<div class='xe-weekday-forecast'>
									<div class='xe-day' style='cursor:pointer;'>
										<a href="{{route('prospect.sites', $c2->id)}}" style='color:#fff;'>View Sites</a>
									</div>
								</div>
							</li>
							<li>
								<div class='xe-weekday-forecast'>
									<div class='xe-day' style='cursor:pointer;'>

									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		@endif
		@endforeach
	</ul>
	@endsection
