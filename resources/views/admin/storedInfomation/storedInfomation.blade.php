@extends('admin.system')

@section('page-title', 'Stored Information')
@section('page-description', 'Stored Information.')

@section('extra-breadcrumbs')
	<li><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Information</a></li>
@endsection

@section('sub-content')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li><a href="{{route('storedInfomation', ['type_id' => 1])}}">Prospects 1
			<span class="badge badge-info">{{$count['1']}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 2])}}">Prospects 2
			<span class="badge badge-info">{{$count['2']}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 'personal'])}}">My Clients
			<span class="badge badge-info">{{(isset($count['personal']) ? $count['personal'] : '')}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 3])}}">Clients
			<span class="badge badge-info">{{$count['3']}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 'deleted'])}}">Deleted
			<span class="badge badge-info">{{$count['deleted']}}</span></a>
		</li>
	</ul>
</nav>

<div class="panel panel-default" style="margin-top: 15px;">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">{{$typeTitle}}</h3>
	</div>
	<form method="post" action="{{ route('prospect.moveProspect') }}">
		{{ csrf_field() }}
		<table class="table table-striped ahref sticky-header">
			<thead>
			<tr>
				<th class="col-sm-2">ID / Move<br/>
					<span style="font-weight:100;">
							Latest Requested <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
						</span><br/>
				</th>
				<th class="col-sm-2">Assigned To</th>
				<th class="col-sm-2">Company</th>
				<th class="col-sm-2">Email</th>
				<?php if($type == 'deleted'): ?>
					<th class="col-sm-2">Deleted Reason</th>
				<?php endif; ?>
				<th class="col-sm-2">View Account</th>
			</tr>
			</thead>
			<tbody id="ajax_stored_information_table" data-type="{{$type}}">
			</tbody>
			<tr>
				<td>
					<select class="form-control" name="moveToUser">
						<option></option>
						@foreach(\App\Models\User::all() as $user)
							<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->second_name }}</option>
						@endforeach
					</select>
					<button type="submit" class="btn btn-success" style="width:100%;">Move Prospects/Clients</button>
				</td>
			</tr>
	</table>
	</form>
</div>
@endsection
