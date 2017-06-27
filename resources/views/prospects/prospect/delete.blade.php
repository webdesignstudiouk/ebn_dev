@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.delete', $prospect->id)}}">Delete</span></a></li>
@endsection

@section('sub-content')
{!! form($deleteForm) !!}
@endsection
