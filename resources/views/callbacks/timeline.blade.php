@extends('layouts.admin')

@section('page-title', 'Callbacks')
@section('page-description', 'List Of all callbacks.')

@section('content')

	<a>
		<div class='cbp_time' style='background:none; margin-left:25%;'>
			<ul style='list-style-type: none; display: inline; font-size:16px; '>
				<li style='float: left;'>
					<span style='float: left; margin-top:4px;'><i class='fa fa-circle' style='color:#ff6264;'></i> No Time Set</span>
					<span style='float: left; margin-top:4px; margin-left:20px;'><i class='fa fa-circle' style='color:#459ec4;'></i> Time Set</span>
					<span style='float: left; margin-top:4px; margin-left:20px;'>Showing callbacks from </span>
						<input type='text' class="form-control" style="float:left; width:100px; margin:0px 10px 0px 10px;" id='callbackBeginDate'/>
						<span style='float: left; margin-top:4px;'> - </span>
						<input type='text' class="form-control" style="float:left; width:100px; margin:0px 10px 0px 10px;" id='callbackEndDate' />
					</li>
			</ul>
		</div>
	</a>
	<ul class='cbp_tmtimeline'>

	@foreach($callbacksModal->select('callbackDate')->distinct()->orderBy('callbackDate', 'ASC')->get() as $c1)

		@if(Carbon\Carbon::createFromFormat('Y-m-d', $c1->callbackDate)->between(Carbon\Carbon::createFromFormat('Y-m-d', $beginDate), Carbon\Carbon::createFromFormat('Y-m-d', $endDate)))
			@php
				$collapseId = str_replace('-', '', stripslashes($c1->callbackDate));
				$count = $callbacksModal->where('callbackDate', $c1->callbackDate)
				->whereHas('prospect', function ($query) {
						$query->where('user_id', Auth::user()->id)->where('request_delete','!=', 1)->whereNull('deleted_at');
				})->count();
			@endphp
			<li>
			@if($count != 0)
				<div class='cbp_tmicon timeline-bg-success '>
					<a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}' aria-expanded='false' aria-controls='{{$collapseId}}'>
						{{$count}}
					</a>
				</div>
				<a data-toggle='collapse' data-target='#{{$collapseId}}' href='#{{$collapseId}}' aria-expanded='false' aria-controls='{{$collapseId}}'>
					<div class='cbp_time'>{{Carbon\Carbon::createFromFormat('Y-m-d', $c1->callbackDate)->format('d/m/Y')}} - <small style='font-size:12px;'>{{Carbon\Carbon::createFromFormat('Y-m-d', $c1->callbackDate)->diffForHumans()}}</small></div>
				</a>
				<div class='collapse' id='{{$collapseId}}'>
					@foreach($callbacksModal->where('callbackDate', $c1->callbackDate)
						->where('callbackTime', '!=','00:00:00')
						->with(['prospect' => function ($query) {
		    			$query->where('user_id', '=', Auth::user()->id)->whereNull('deleted_at');
						}])->orderBy('callbackTime', 'ASC')->groupBy('prospect_id')->get() as $c2)
						@include('callbacks.callback')
					@endforeach

					@foreach($callbacksModal->where('callbackDate', $c1->callbackDate)
						->where('callbackTime', '00:00:00')
						->with(['prospect' => function ($query) {
		    			$query->where('user_id', '=', Auth::user()->id)->whereNull('deleted_at');
						}])->orderBy('callbackTime', 'ASC')->groupBy('prospect_id')->get() as $c2)
						@include('callbacks.callback')
					@endforeach
				</div>
			@endif
		@endif
		</li>
	@endforeach
	</ul>
@endsection
