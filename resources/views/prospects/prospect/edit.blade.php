@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }} Details</span></a></li>
@endsection

@section('sub-content')
{!! form($updateForm) !!}
@endsection
