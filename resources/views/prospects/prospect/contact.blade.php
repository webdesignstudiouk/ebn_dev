@extends('layouts.admin_navigation')

@section('page-title', 'Prospects: '.$prospect->company)
@section('page-description', 'This prospects details.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Agent</a></li>
<li><a href="{{route($prospect->prospectType->route)}}">{{$prospect->prospectType->title}}</a></li>
<li><a href="{{route('prospects.edit', $prospect->id)}}">Prospect: <span>{{$prospect->company}}</span></a></li>
<li><a href="{{route('prospect.contacts', $prospect->id)}}">Contacts</a></li>
<li><a href="{{route('contacts.edit', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id])}}">Contact : <span>{{$contact->first_name}}, {{$contact->second_name}}</span></a></li>
@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
<li class="{{active('contacts.edit')}}"><a href="{{route('contacts.edit', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id])}}">Contact Details</a></li>
<li class="{{active('contact.delete')}}"><a href="{{route('contact.delete', ['prospect_id'=>$prospect->id, 'contact_id'=>$contact->id])}}">Delete Contact</a></li>
@endsection

@section('content')
<div class="tab-content">
	@yield('sub-content')
</div>
@endsection
