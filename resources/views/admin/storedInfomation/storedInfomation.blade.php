@extends('admin.system')

@section('page-title', 'Stored Infomation')
@section('page-description', 'Stored Infomation.')

@section('extra-breadcrumbs')
	<li><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Infomation</a></li>
@endsection

@section('sub-content')
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

		<li><a href="#" stule="float:right;">Untouched
				<span class="badge badge-info">{{ $untouched }}</span></a>
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
					<th class="col-sm-3">Company</th>
					<th class="col-sm-3">Email</th>
					<th class="col-sm-2">View Account</th>
				</tr>
			</thead>
			<tbody>
				@foreach($prospects as $prospect)
				<tr>
					<td>
						{{$prospect->id}}
						@role('admin')
						<input type="checkbox" name="prospectToMove[]" value="{{ $prospect->id }}" style="float:right;"/>
						@endrole
					</td>
					<td>{{$prospect->user->first_name}} {{$prospect->user->second_name}}</td>
					<td>{{$prospect->company}}</td>
					<td>{{$prospect->email}}</td>
					<td><a href="http://webdesignstudiouk.com/hosting/ebn_dev/admin/prospects/{{$prospect->id}}/edit">View Account</a></td>
				</tr>
				@endforeach
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
			</tbody>
			<center>{{$prospects->links()}}</center>
		</table>
	</form>
	<center>{{$prospects->links()}}</center>
</div>
@endsection
