@extends('prospects.prospect.site.gasMeter')

@section('extra-breadcrumbs')
<li><a href="{{route('gasMeter.delete', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id, 'gasMeter_id'=>$gasMeter->id])}}">Delete Meter</span></a></li>
@endsection

@section('sub-content')
{!! form($deleteGasForm)!!}
@endsection
