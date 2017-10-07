@extends('layouts.admin_navigation')

@section('page-title', $prospect->typeTitle(). ': '.$prospect->company)
@section('page-description', 'This '.$prospect->typeTitle().'s details.')

@section('breadcrumbs')
	<li><a href="{{route('dashboard')}}">Agent</a></li>
	<li><a href="{{route($prospect->prospectType->route)}}">{{$prospect->prospectType->title}}</a></li>
	<li><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }}: <span>{{$prospect->company}}</span></a></li>
	@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
	<li class="{{active('prospects.edit')}}"><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }} Details</a></li>
	@permission('callbacks.view')
		<li class="{{active('prospect.callbacks')}}"><a href="{{route('prospect.callbacks', $prospect->id)}}">Callbacks <span class="badge badge-info pull-right">{{$prospect->callbacksWithTrashed->count()}}</span></a></li>
	@endpermission
	@permission('sites.view')
		<li class="{{active('prospect.sites')}}"><a href="{{route('prospect.sites', $prospect->id)}}">Sites <span class="badge badge-info pull-right">{{$prospect->sites->count()}}</span></a></li>
	@endpermission
	@permission('contacts.view')
		<li class="{{active('prospect.contacts')}}"><a href="{{route('prospect.contacts', $prospect->id)}}" >Contacts <span class="badge badge-info pull-right">{{$prospect->contacts->count()}}</span></a></li>
	@endpermission
	@permission('uploads.view')
		<li class="{{active('prospect.uploads')}}"><a href="{{route('prospect.uploads', $prospect->id)}}">Uploads</a></li>
	@endpermission

	@if($prospect->type_id == 1)
		@permission('prospects1.delete')
			<li class="{{active('prospect.delete')}}"><a href="{{route('prospect.delete', $prospect->id)}}">Delete {{ $prospect->typeTitle() }}</a></li>
		@endpermission
		@permission('prospects1.request.delete')
			<li class="{{active('prospect.delete')}}"><a href="{{route('prospect.request_delete', $prospect->id)}}">Request Delete {{ $prospect->typeTitle() }}</a></li>
		@endpermission
		@permission('prospects1.progress')
			<li class="" style="margin-top:20px;"><a href="{{route('prospect.progress', $prospect->id)}}">Progress To Prospect 2</a></li>
		@endpermission
	@elseif($prospect->type_id == 2)
		@permission('prospects2.delete')
			<li class="{{active('prospect.delete')}}"><a href="{{route('prospect.delete', $prospect->id)}}">Delete {{ $prospect->typeTitle() }}</a></li>
		@endpermission
		@permission('prospects2.request.delete')
		<li class="{{active('prospect.delete')}}"><a href="{{route('prospect.request_delete', $prospect->id)}}">Request Delete {{ $prospect->typeTitle() }}</a></li>
		@endpermission
		@permission('prospects2.progress')
			<li class=""  style="margin-top:20px;"><a href="{{route('prospect.progress', $prospect->id)}}">Progress To Client</a></li>
		@endpermission
	@elseif($prospect->type_id == 3)
		@permission('prospects2.delete')
			<li class="{{active('prospect.delete')}}"><a href="{{route('prospect.delete', $prospect->id)}}">Delete {{ $prospect->typeTitle() }}</a></li>
		@endpermission
	@endif
@endsection

@section('content')
	<div class="tab-content">
		@yield('sub-content')
	</div>
@endsection
