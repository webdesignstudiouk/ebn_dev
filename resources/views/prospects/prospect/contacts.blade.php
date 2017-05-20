@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.contacts', $prospect->id)}}">Contacts</span></a></li>
@endsection

@section('sub-content')
@include('prospects.prospect.view_sections.contacts')
{!! form($createContactForm) !!}
@endsection
