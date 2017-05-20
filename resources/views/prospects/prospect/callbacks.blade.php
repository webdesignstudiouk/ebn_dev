@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.callbacks', $prospect->id)}}">Callbacks</span></a></li>
@endsection

@section('sub-content')
<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Callbacks</h3>
	</div>
	<div id="scrollContainer" style="max-height:400px; overflow-y:scroll;">
	<div class="cbp_time">
			<ul style="list-style-type: none; display: inline; font-size:16px; ">
				<li style="float: left;">
					<span style="float: left; margin-top:4px;"><i class="fa fa-circle" style="color:#8dc63f;"></i> Latest Callback Set</span>
				</li>
			</ul>
		</div>
		<table class="table" >
		  <thead>
			<tr>
			  <th class='col-sm-2'>ID</th>
				<th class='col-sm-2'>Created By</th>
			  <th class='col-sm-2'>Date</th>
			  <th class='col-sm-2'>Time</th>
			  <th class='col-sm-2'>Created At</th>
			</tr>
		  </thead>
		  <tbody>
			@foreach($prospect->callbacksWithTrashed as $c)
			@if($c->trashed())
				<tr id="callback_{{$c->id}}" style="border-top:4px solid #eee;">
			@else
				<tr id="callback_{{$c->id}}" style="border-left:10px solid #8dc63f; border-top:4px solid #eee;">
			@endif
			  <td>{{$c->id}}</td>
				<td>{{$c->author->first_name}} {{$c->author->second_name}}</td>
			  <td>{!! Carbon\Carbon::parse($c->callbackDate)->format('d/m/Y')!!}</td>
			  <td>{{$c->callbackTime}}</td>
			  <td>{!! Carbon\Carbon::parse($c->created_at)->format('d/m/Y')!!}</td>
			</tr>
			@if($c->trashed())
				<tr id="callback_{{$c->id}}">
			@else
				<tr id="callback_{{$c->id}}" style="border-left:10px solid #8dc63f;">
			@endif
				<td colspan=5>
         <center><b>{{$c->note}}</b></center>
        </td>
			</tr>
			@endforeach
		  </tbody>
		</table>
	</div>
</div>

@include('prospects.prospect.view_sections.contacts')

{!! form($createCallbackForm) !!}
@endsection
