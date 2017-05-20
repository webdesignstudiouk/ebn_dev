@extends('layouts.admin')

@section('page-title', 'Options')
@section('page-description', 'Site options.')

@section('content')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li class="active"><a href="#storedInfomation_prospects" aria-controls="storedInfomation_prospects" role="tab" data-toggle="tab">Prospects 1
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 1)->where('user_id', '!=', 2)->count()}}</span></a>
		</li>
		<li><a href="#storedInfomation_prospects2" aria-controls="storedInfomation_prospects2" role="tab" data-toggle="tab">Prospects 2
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 2)->where('user_id', '!=', 2)->count()}}</span></a>
		</li>
		<li role="presentation"><a href="#storedInfomation_clients" aria-controls="storedInfomation_clients" role="tab" data-toggle="tab">Clients
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 3)->where('user_id', '!=', 2)->count()}}</span></a>
		</li>
		<li role="presentation"><a href="#storedInfomation_deleted" aria-controls="storedInfomation_deleted" role="tab" data-toggle="tab">Deleted
			<span class="badge badge-info">{{App\Models\Prospects::withTrashed()->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->count()}}</span></a>
		</li>
	</ul>
</nav>

<div class="panel panel-default" style="margin-top: 15px;">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Prospects 1 (ALL)</h3>
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
	</table>
</div>
@endsection 
