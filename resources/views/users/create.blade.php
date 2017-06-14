@extends('layouts.admin')

@section('page-title', 'Create User')
@section('page-description', 'Create a user.')

@section('content')
    <nav class="navbar navbar-default">
        <ul class="nav navbar-nav">
            <li><a href="{{route('users')}}">Users</a></li>
            <li><a href="{{route('users.create')}}">Create User</a></li>
        </ul>
    </nav>
    
	{!! form($form) !!}
@endsection
