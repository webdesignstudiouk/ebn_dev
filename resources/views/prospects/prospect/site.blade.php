@extends('layouts.admin_navigation')

@section('page-title', 'Prospects: '.$prospect->company)
@section('page-description', 'This prospects details.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Agent</a></li>
<li><a href="{{route($prospect->prospectType->route)}}">{{$prospect->prospectType->title}}</a></li>
<li><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }}: <span>{{$prospect->company}}</span></a></li>
<li><a href="{{route('prospect.sites', $prospect->id)}}">Sites</a></li>
<li><a href="{{route('sites.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Site : <span>{{$site->street_1}}, {{$site->street_2}}</span></a></li>
@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
<li class="{{active('sites.edit')}}"><a href="{{route('sites.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Site Details</a></li>
<li class="{{active('site.electricMeters')}}"><a href="{{route('site.electricMeters', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Electric Meters <span class="badge badge-info pull-right">{{$site->electricMeters->count()}}</span></a></li>
<li class="{{active('site.gasMeters')}}"><a href="{{route('site.gasMeters', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Gas Meters <span class="badge badge-info pull-right">{{$site->gasMeters->count()}}</span></a></li>
<li class="{{active('site.delete')}}"><a href="{{route('site.delete', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Delete Site</a></li>
@endsection

@section('content')
<div class="tab-content">
	@yield('sub-content')
</div>
@endsection
