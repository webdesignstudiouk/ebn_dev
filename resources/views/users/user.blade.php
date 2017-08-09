@extends('layouts.admin_navigation')

@section('page-title', 'Users: '.$user->first_name." ".$user->second_name)
@section('page-description', 'This users details.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Agent</a></li>
<li><a href="{{route('options')}}">System Options</a></li>
<li><a href="{{route('users')}}">Users</a></li>
<li><a href="{{route('users.edit', $user->id)}}">User: <span>{{$user->first_name}} {{$user->second_name}}</span></a></li>
@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
<li class='{{ active('users.edit') }}'><a href="{{route('users.edit', $user->id)}}">User Details</a></li>
<li class='{{ active('user.delete') }}' style="margin-bottom: 20px;"><a href="{{ route('user.delete', $user->id) }}">Delete User</a></li>

<li class='{{ active('*/prospects1') }}'><a href="{{ route('user.prospects', array($user->id, 'prospects1')) }}">User Prospects</a></li>
<li class='{{ active('*/prospects2') }}'><a href="{{ route('user.prospects', array($user->id, 'prospects2')) }}">User Prospects 2</a></li>
<li class='{{ active('*/clients') }}'><a href="{{ route('user.prospects', array($user->id, 'clients')) }}">User Clients</a></li>

@endsection

@section('content')
	@yield('sub_content')
@endsection
