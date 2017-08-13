@extends('layouts.admin')

@section('page-title', "Suppliers")
@section('page-description', 'List Of Suppliers.')

@section('content')
    <div class="row">
        @foreach($suppliers as $supplier)
            <div class="col-sm-3">
                <a href="{{route('suppliers-hub.supplier', $supplier->id)}}">
                <div class="xe-widget xe-vertical-counter xe-vertical-counter-white">
                    <div class="xe-icon">
                        <img src="{{$supplier->logo_url}}" height="200px" width="200px"/>
                    </div>
                    <div class="xe-label">
                        <strong class="num">{{$supplier->name}}</strong>
                        @role('admin')
                        <span><a href="{{route('suppliers-hub.update', $supplier->id)}}" class="btn btn-sm btn-success">Edit</a></span>
                        @endrole
                    </div>
                </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection