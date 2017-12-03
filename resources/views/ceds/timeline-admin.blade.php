@extends('layouts.admin_navigation')

@section('page-title', 'Contract End Dates')
@section('page-description', 'List Of all ceds.')

@section('breadcrumbs')
    <li><a href="{{route('dashboard')}}">Agent</a></li>
    <li><a href="{{route('ced.timeline')}}">CED</a></li>
    @yield('extra-breadcrumbs')
@endsection

@section('sidebar')
    @permission('prospects1.view|prospects2.view|clients.view')
        @permission('prospects1.view')
            <li class="{{active('*contract-end-dates/1*')}}"><a href="{{route('ced.timeline', 1)}}">Prospect 1</a></li>
        @endpermission
        @permission('prospects2.view')
            <li class="{{active('*contract-end-dates/2*')}}"><a href="{{route('ced.timeline', 2)}}">Prospect 2</a></li>
        @endpermission
        @permission('clients.view')
            <li class="{{active('*contract-end-dates/3*')}}"><a href="{{route('ced.timeline', 3)}}">Client</a></li>
        @endpermission
    @endpermission
@endsection

@section('content')
    <div class="tab-content">
        @yield('sub-content')
    </div>
@endsection