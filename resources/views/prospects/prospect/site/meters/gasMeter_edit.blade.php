@extends('prospects.prospect.site.gasMeter')

@section('extra-breadcrumbs')
<li><a href="{{route('gasMeters.edit', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'gasMeter_id'=>$gasMeter->id])}}">Gas Meter Details</span></a></li>
@endsection

@section('sub-content')
{!! form($updateGasMeterForm) !!}
@endsection
