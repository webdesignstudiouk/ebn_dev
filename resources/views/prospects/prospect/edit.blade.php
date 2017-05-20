@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospects.edit', $prospect->id)}}">Prospect Details</span></a></li>
@endsection

@section('sub-content')
{!! form($updateForm) !!}
@endsection
