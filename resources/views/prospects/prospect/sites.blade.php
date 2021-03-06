@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.sites', $prospect->id)}}">Sites</span></a></li>
@endsection

@section('sub-content')
@permission('sites.view')
	<div class="panel panel-default">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">Sites</h3>
			<div class="panel-options">
				<a class="btn btn-sm btn-success" style="color: #fff;" href="{{route('site.export_sitelist', array($prospect->id))}}">
					Export
				</a>
			</div>
		</div>
		<table class="table table-striped ahref">
		  <thead>
			<tr>
			  <th>ID</th>
			  <th>Site Name</th>
			  <th>Address</th>
			  <th>Post Code</th>
			  <th>ELEC Count</th>
			  <th>CED</th>
			  <th>GAS Count</th>
			  <th>CED</th>
			  <th>View Account</th>
			</tr>
		  </thead>
		  <tbody>
			@foreach($prospect->sites as $s)
			<tr>
			  <td>{{$s->id}}</td>
			  <td>{{$s->name}}</td>
			  <td>
				@if($s->street_1 != "")
					{{$s->street_1}},
				@endif
				@if($s->street_2 != "")
					{{$s->street_2}},
				@endif
				@if($s->street_3 != "")
					{{$s->street_3}},
				@endif
				@if($s->street_4 != "")
					{{$s->street_4}}
				@endif
			  </td>
			  <td>{{$s->post_code}}</td>
			  <td>{{$s->electricMeters->count()}}</td>
			   <td>
				@if (count($s->electricMeters))
					{!! Carbon\Carbon::parse($s->electricMeters->last()->contractEndDate)->format('d/m/Y')!!}
				@endif
			  </td>

			  <td>{{$s->gasMeters->count()}}</td>
			  <td>
				@if (count($s->gasMeters))
					{!! Carbon\Carbon::parse($s->gasMeters->last()->contractEndDate)->format('d/m/Y')!!}
				@endif
			  </td>
			  <td><a href="{{url('admin/prospects/'.$prospect->id.'/sites/'.$s->id.'/edit')}}">View Account</a></td>
			</tr>
			@endforeach
		  </tbody>
		</table>
	</div>
	@permission('sites.create')
		@include('sites.create')
	@endpermission
@else
	{{render_permission_error()}}
@endpermission
@endsection
