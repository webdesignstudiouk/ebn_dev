@extends('layouts.admin')

@section('page-title', 'Callbacks')
@section('page-description', 'List Of all callbacks.')

@section('content')
	<table class="table table-striped ahref">
	  <thead>
		<tr>
		  <th>ID</th>
		  <th>Callback Date</th>
		  <th>Callback Time</th>
		</tr>
	  </thead>
	  <tbody>
		@foreach($callbacks as $c)
		<tr>
		  <td>{{$c->id}}</td>
		  <td>{{$c->callbackDate}}</td>
		  <td>{{$c->callbackTime}}</td>
		</tr>
		@endforeach
	  </tbody>
	</table>
@endsection
