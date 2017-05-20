@extends('prospects.prospect.contact')

@section('extra-breadcrumbs')
<li><a href="{{route('contacts.edit', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id])}}">Contact Details</span></a></li>
@endsection

@section('sub-content')
{!! form($updateForm) !!}
@endsection
