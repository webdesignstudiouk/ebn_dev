@extends('layouts.admin_navigation')

@section('page-title', 'Prospects: '.$prospect->company)
@section('page-description', 'This prospects details.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Agent</a></li>
<li><a href="{{route($prospect->prospectType->route)}}">{{$prospect->prospectType->title}}</a></li>
<li><a href="{{route('prospects.edit', $prospect->id)}}">Prospect: <span>{{$prospect->company}}</span></a></li>
@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
<li class="{{active('prospects.edit')}}"><a href="{{route('prospects.edit', $prospect->id)}}">Prospect Details</a></li>
<li class="{{active('prospect.callbacks')}}"><a href="{{route('prospect.callbacks', $prospect->id)}}">Callbacks <span class="badge badge-info pull-right">{{$prospect->callbacksWithTrashed->count()}}</span></a></li>
<li class="{{active('prospect.sites')}}"><a href="{{route('prospect.sites', $prospect->id)}}">Sites <span class="badge badge-info pull-right">{{$prospect->sites->count()}}</span></a></li>
<li class="{{active('prospect.contacts')}}"><a href="{{route('prospect.contacts', $prospect->id)}}" >Contacts <span class="badge badge-info pull-right">{{$prospect->contacts->count()}}</span></a></li>
<li class="{{active('prospect.uploads')}}"><a href="{{route('prospect.uploads', $prospect->id)}}">Uploads</a></li>
<li class="{{active('prospect.delete')}}"><a href="{{route('prospect.delete', $prospect->id)}}">Delete Prospect</a></li>

@if($prospect->type_id == 1)
	<li class="" style="margin-top:20px;"><a href="{{route('prospect.progress', $prospect->id)}}">Progress To Prospect 2</a></li>
@elseif($prospect->type_id == 2)
	<li class=""  style="margin-top:20px;"><a href="{{route('prospect.progress', $prospect->id)}}">Progress To Client</a></li>
@endif
@endsection

@section('content')
<div class="tab-content">
	@yield('sub-content')
</div>
@endsection
