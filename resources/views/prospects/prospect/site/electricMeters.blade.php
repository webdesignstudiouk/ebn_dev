@extends('prospects.prospect.site')

@section('extra-breadcrumbs')
<li><a href="{{route('site.electricMeters', ['prospect_id'=>$prospect->id, 'site_id'=>$site->id])}}">Electric Meters</span></a></li>
@endsection

@section('sub-content')
<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Electric Meters</h3>
	</div>

	<table class="table table-striped ahref">
	  <thead>
		<tr>
		  <th>ID</th>
		  <th>Mpan</th>
		  <th>Contract End Date</th>
		  <th>View Account</th>
		</tr>
	  </thead>
	  <tbody>
		@foreach($site->electricMeters as $e)
		<tr>
		  <td>{{$e->id}}</td>
		  <td>{{$e->mpan_1}} {{$e->mpan_2}} {{$e->mpan_3}} {{$e->mpan_4}} {{$e->mpan_5}} {{$e->mpan_6}} {{$e->mpan_7}}</td>
		  <td>{!! Carbon\Carbon::parse($e->contractEndDate)->format('d/m/Y') !!}</td>
		  <td><a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$site->id.'/electricMeters/'.$e->id.'/edit')}}">View Account</a></td>
		</tr>
		@endforeach
	  </tbody>
	</table>
</div>
{!! form($createElectricMeter)!!}
@endsection
