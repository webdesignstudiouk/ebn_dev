@extends('prospects.prospect.contact')

@section('extra-breadcrumbs')
<li><a href="{{route('contact.delete', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id])}}">Delete Contact</span></a></li>
@endsection

@section('sub-content')
{!! form($deleteForm) !!}
@endsection
