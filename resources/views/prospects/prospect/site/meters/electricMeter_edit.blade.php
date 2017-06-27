@extends('prospects.prospect.site.electricMeter')

@section('extra-breadcrumbs')
<li><a href="{{route('electricMeters.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'electricMeter_id'=>$electricMeter->id])}}">Electric Meter Details</span></a></li>
@endsection

@section('sub-content')
{!! form($updateElectricMeterForm) !!}
@endsection
