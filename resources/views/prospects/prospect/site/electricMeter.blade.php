@extends('layouts.admin_navigation')

@section('page-title', 'Prospects: '.$prospect->company)
@section('page-description', substr($prospect->prospectType->title, 0, -1). ' ID: '.$prospect->id)

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Agent</a></li>
<li><a href="{{route($prospect->prospectType->route)}}">{{$prospect->prospectType->title}}</a></li>
<li><a href="{{route('prospects.edit', $prospect->id)}}">{{ $prospect->typeTitle() }}: <span>{{$prospect->company}}</span></a></li>
<li><a href="{{route('prospect.sites', $prospect->id)}}">Sites</a></li>
<li><a href="{{route('sites.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Site : <span>{{$site->street_1}}, {{$site->street_2}}</span></a></li>
<li><a href="{{route('site.electricMeters', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}"><b>Electric Meters</b></a></li>
<li><a href="{{route('electricMeters.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'electricMeter_id'=>$electricMeter->id])}}">Electric Meter: <span>{{$electricMeter->mpan_1}}</span></a></li>
@yield('extra-breadcrumbs')
@endsection

@section('sidebar')
<li class="{{active('electricMeters.edit')}}"><a href="{{route('electricMeters.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'electricMeter_id'=>$electricMeter->id])}}" >Electric Meter Details</a></li>
<li class="{{active('electricMeter.delete')}}"><a href="{{route('electricMeter.delete', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'electricMeter_id'=>$electricMeter->id])}}">Delete Meter</a></li>
@endsection

@section('content')
<div class="tab-content">
	@yield('sub-content')
</div>
@endsection
