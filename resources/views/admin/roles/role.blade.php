@extends('layouts.admin_navigation')

@section('page-title', $role->name)
@section('page-description', 'role')

@section('breadcrumbs')
    <li><a href="{{route('dashboard')}}">Agent</a></li>
    <li><a href="{{route('options')}}">System Options</a></li>
    <li><a href="{{route('roles')}}">Roles</a></li>
    <li><a href="{{route('roles.edit', $role->id)}}">Role: {{$role->name}}</a></li>
    @yield('extra-breadcrumbs')
@endsection

@section('sidebar')
    <li class="{{active('roles.edit')}}"><a href="{{route('roles.edit', $role->id)}}">Details</a></li>
    <li class="{{active('roles.permissions')}}"><a href="{{route('roles.permissions', $role->id)}}">Permissions</a></li>
@endsection

@section('content')
    <div class="tab-content">
        @yield('sub-content')
    </div>
@endsection
