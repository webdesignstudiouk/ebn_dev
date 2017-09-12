@extends('layouts.admin_navigation')

@section('page-title', "Suppliers")
@section('page-description', 'List Of Suppliers.')

@section('sidebar')
    <li class="active"><a href="{{route('suppliers-hub')}}">Suppliers</a></li>
    @role('admin')
    <li class=""><a href="{{route('suppliers-hub.create')}}">Create New Supplier</a></li>
    @endrole
@endsection

@section('breadcrumbs')
    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li><a href="{{route('suppliers-hub')}}">Suppliers Hub</a></li>
@endsection

@section('content')
    <div class="row">
        @foreach($suppliers as $supplier)
            <div class="col-sm-4">
                <a href="{{route('suppliers-hub.supplier', $supplier->id)}}">
                <div class="xe-widget xe-vertical-counter xe-vertical-counter-white">
                    <div class="xe-icon">
                        @if($supplier->logo_url == "")
                            <img src="https://trackdays4fun.com/assets/production/placeholder-avatar-58c4482fa64bba19469f85c821abea837c1d036541b67ef58bc514531b6ba8d6.png" height="200px" width="200px"/>
                        @else
                            <img src="{{$supplier->logo_url}}" height="200px" width="200px"/>
                        @endif
                    </div>
                    <div class="xe-label">
                        <strong class="num">{{$supplier->name}}</strong>
                        @role('admin')
                        <span><a href="{{route('suppliers-hub.update', $supplier->id)}}" class="btn btn-sm btn-success">Edit</a>
                            <a href="{{route('suppliers-hub.delete', $supplier->id)}}" class="btn btn-sm btn-danger">Delete</a></span>
                        </span>
                        @endrole
                    </div>
                </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection