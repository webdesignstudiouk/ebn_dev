@extends('layouts.admin_navigation')

@section('page-title', 'Users: '.$user->first_name." ".$user->second_name)
@section('page-description', 'This users details.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Admin</a></li>
<li><a href="{{route('users')}}">Users</a></li>
<li><a href="{{route('users.edit', $user->id)}}">User: <span>{{$user->first_name}} {{$user->second_name}}</span></a></li>
@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
<li class='{{ active('users.edit') }}'><a href="{{route('users.edit', $user->id)}}">User Details</a></li>
<li class='{{ active('user.prospects') }}'><a href="{{ route('user.prospects', $user->id) }}">User Prospects</a></li>
<li class='{{ active('user.delete') }}'><a href="{{ route('user.delete', $user->id) }}">Delete User</a></li>
@endsection

@section('content')
	@yield('sub_content')
@endsection
