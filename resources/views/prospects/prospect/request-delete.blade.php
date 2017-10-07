@extends('prospects.prospect')

@section('extra-breadcrumbs')
    <li><a href="{{route('prospect.delete', $prospect->id)}}">Request Delete</a></li>
@endsection

@section('sub-content')
    {!! form($deleteForm) !!}
@endsection
