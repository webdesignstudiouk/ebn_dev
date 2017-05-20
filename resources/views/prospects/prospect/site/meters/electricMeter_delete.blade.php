@extends('prospects.prospect.site.electricMeter')

@section('extra-breadcrumbs')
<li><a href="{{route('electricMeter.delete', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'electricMeter_id'=>$electricMeter->id])}}">Delete Meter</span></a></li>
@endsection

@section('sub-content')
{!! form($deleteElectricForm)!!}
@endsection
