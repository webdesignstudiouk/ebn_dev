@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.callbacks', $prospect->id)}}">Callbacks</span></a></li>
@endsection

@section('sub-content')
	@permission('callbacks.view')
		<div class="panel panel-default">
			<div class="panel-heading" style="margin-bottom:20px;">
				<h3 class="panel-title">Callbacks</h3>
			</div>
			<div id="scrollContainer" style="max-height:400px; overflow-y:scroll;">
				<table class="table" >
				  <thead>
					<tr>
					  <th class='col-sm-2'>ID</th>
						<th class='col-sm-2'>Created By</th>
					  <th class='col-sm-2'>Callback Set For</th>
					  <th class='col-sm-2'>Time</th>
					  <th class='col-sm-2'>Created</th>
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
						@if(isset($c->author->first_name))
						<td>{{$c->author->first_name}} {{$c->author->second_name}}</td>
						@else
							<td>** Deleted User **</td>
						@endif
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

		@permission('callbacks.create')
			@include('prospects.prospect.view_sections.contacts')
			{!! form($createCallbackForm) !!}
		@endpermission
	@else
		{{render_permission_error()}}
	@endpermission

@endsection
