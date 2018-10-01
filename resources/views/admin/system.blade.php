@extends('layouts.admin_navigation')

@section('page-title', 'System Options.')
@section('page-description', 'System Options.')

@section('breadcrumbs')
    <li><a href="{{route('dashboard')}}">Agent</a></li>
    <li><a href="{{route('options')}}">System Options</a></li>
    @yield('extra-breadcrumbs')
@endsection

@section('sidebar')
    <li class="{{active('reports')}}"><a href="{{route('reports')}}">Reports</a></li>
    <li class="{{active('users')}} {{active('users.create')}}"><a href="{{route('users')}}">Users</a></li>
    <li class="{{active('storedInfomation')}}"><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Information</a></li>
    <li class="{{active('source-codes')}}"><a href="{{route('source-codes')}}">Source Codes <span class="badge badge-info pull-right"></span></a></li>
    <li class="{{active('roles')}}"><a href="{{route('roles')}}">Roles</a></li>
    <li class="{{active('process-prospects')}}"><a href="{{route('process-prospects')}}">Import Data</a></li>
@endsection

@section('content')
    <div class="tab-content">
        @yield('sub-content')
    </div>
@endsection
