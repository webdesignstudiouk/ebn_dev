@extends('users.user')

@section('extra-breadcrumbs')
<li><a href="{{route('user.prospects', $user->id)}}">User Prospects</a></li>
@endsection 

@section('sub_content')
<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Prospects</h3>
	</div>

	<table class='table table-striped'>
		<thead>
			<tr>
				<th>ID</th>
				<th>Company</th>
				<th>View Account</th>
			</tr>
		</thead>
		@foreach($user->prospects as $p)
		<tr>
			<td>{{$p->id}}</td>
			<td>{{$p->company}}</td>
			<td><a href="{{route('prospects.edit',$p->id)}}">View Account</a></td>
		</tr>
		@endforeach
	</table>
</div>
@endsection
