@extends('layouts.admin_navigation')

@section('page-title', 'Options')
@section('page-description', 'Site options.')

@section('breadcrumbs')
	<li><a href="{{route('dashboard')}}">Admin</a></li>
	<li><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Infomation</a></li>
@endsection

@section('sidebar')
	<li class="{{ active(['admin/stored-infomation/*', 'admin/stored-infomation']) }}"><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Infomation</a></li>
	<li class="{{ active(['admin/source-codes/*', 'admin/source-codes']) }}"><a href="{{route('source-codes')}}">Source Codes</a></li>
	<li class="{{ active(['admin/process-prospects/*', 'admin/process-prospects']) }}"><a href="{{route('process-prospects')}}">Process Prospects</a></li>
@endsection

@section('content')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li><a href="{{route('storedInfomation', ['type_id' => 1])}}">Prospects 1
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 1)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count()}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 2])}}">Prospects 2
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 2)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count()}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 3])}}">Clients
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 3)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count()}}</span></a>
		</li>
		<li><a href="{{route('storedInfomation', ['type_id' => 'deleted'])}}">Deleted
			<span class="badge badge-info">{{App\Models\Prospects::withTrashed()->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->where('user_id', '!=', 100)->count()}}</span></a>
		</li>
	</ul>
</nav>

<div class="panel panel-default" style="margin-top: 15px;">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">{{$typeTitle}}</h3>
	</div>

	<table class="table table-striped ahref">
		<thead>
			<tr>
				<th class="col-sm-1">ID</th>
				<th class="col-sm-2">Assigned To</th>
				<th class="col-sm-3">Company</th>
				<th class="col-sm-4">Email</th>
				<th class="col-sm-2">View Account</th>
			</tr>
		</thead>
		<tbody>
			@foreach($prospects as $prospect)
			<tr>
				<td>{{$prospect->id}}</td>
				<td>{{$prospect->user->first_name}} {{$prospect->user->second_name}}</td>
				<td>{{$prospect->company}}</td>
				<td>{{$prospect->email}}</td>
				<td><a href="http://webdesignstudiouk.com/hosting/ebn_dev/admin/prospects/{{$prospect->id}}/edit">View Account</a></td>
			</tr>
			@endforeach
		</tbody>
		<center>{{$prospects->links()}}</center>
	</table>
	<center>{{$prospects->links()}}</center>
</div>
@endsection
