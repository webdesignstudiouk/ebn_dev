@extends('layouts.admin_navigation')

@section('page-title', 'System Options.')
@section('page-description', 'System Options.')

@section('breadcrumbs')
    <li><a href="{{route('dashboard')}}">Agent</a></li>
    <li><a href="#}">System Options</a></li>
    @yield('extra-breadcrumbs')
@endsection

@section('sidebar')
    <li class="{{active('storedInfomation')}}"><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Infomation</a></li>
    <li class="{{active('source-codes')}}"><a href="{{route('source-codes')}}">Source Codes <span class="badge badge-info pull-right"></span></a></li>
    <li class="{{active('roles')}}"><a href="{{route('roles')}}">Roles</a></li>
@endsection

@section('content')
    <div class="tab-content">
        @yield('sub-content')
    </div>
@endsection
