@extends('layouts.admin')

@section('page-title', 'Users')
@section('page-description', 'List Of all users.')

@section('content')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li><a href="{{route('users')}}">Users</a></li>
		<li><a href="{{route('users.create')}}">Create User</a></li>
	</ul>
</nav>

<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">
			<b>Users</b>
		</h3>
	</div>
	<table class="table table-striped ahref">
	  <thead>
		<tr>
		  <th class="col-sm-2">ID</th>
		  <th class="col-sm-2">Name</th>
			<th class="col-sm-2">Prospect 1<br/>
				<span style="font-weight:100;">
					Has Prospect 1's <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
				</span><br/>
				<span style="font-weight:100;">
					No Prospect 1's <i class="fa fa-circle" style="color:#cc3f44; float:right;"></i>
				</span>
			</th>
			<th class="col-sm-2">Prospect 2<br/>
				<span style="font-weight:100;">
					Has Prospect 2's <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
				</span><br/>
				<span style="font-weight:100;">
					No Prospect 2's <i class="fa fa-circle" style="color:#cc3f44; float:right;"></i>
				</span>
			</th>
			<th class="col-sm-2">Clients<br/>
				<span style="font-weight:100;">
					Has Clients <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
				</span><br/>
				<span style="font-weight:100;">
					No Clients <i class="fa fa-circle" style="color:#cc3f44; float:right;"></i>
				</span>
			</th>
		  <th class="col-sm-2">View Account</th>
		</tr>
	  </thead>
	  <tbody>
		@foreach($users as $user)
			@if($user->id != 100)
				<tr>
				  <td>{{$user->id}} <span style="float:right; width:70%;" class="badge badge-warning badge-roundless">{{$user->group->name}}</span></td>
				  <td>{{$user->first_name}} {{$user->second_name}}</td>
					<td> View
						@if($user->prospects1->count() == 0)
							<span class="badge badge-danger badge-roundless" style="width:50%; float:right;">{{$user->prospects1->count()}}</span>
						@else
							<span class="badge badge-success badge-roundless" style="width:50%; float:right;">{{$user->prospects1->count()}}</span>
						@endif
					</td>
					<td> View
						@if($user->prospects2->count() == 0)
							<span class="badge badge-danger badge-roundless" style="width:50%; float:right;">{{$user->prospects2->count()}}</span>
						@else
							<span class="badge badge-success badge-roundless" style="width:50%; float:right;">{{$user->prospects2->count()}}</span>
						@endif
					</td>
					<td> View
						@if($user->clients->count() == 0)
							<span class="badge badge-danger badge-roundless" style="width:50%; float:right;">{{$user->clients->count()}}</span>
						@else
							<span class="badge badge-success badge-roundless" style="width:50%; float:right;">{{$user->clients->count()}}</span>
						@endif
					</td>
				  <td><a href="{{url('admin/users/'.$user->id.'/edit')}}">View Account</a></td>
				</tr>
			@endif
		@endforeach
	  </tbody>
	</table>
	</div>
@endsection
