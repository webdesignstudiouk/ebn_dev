@extends('layouts.admin')

@section('page-title', "Process Prospects")
@section('page-description', 'Process prospects into the database.')

@section('content')
	<div class="panel panel-default"> 
		<div class="panel-heading"> 
			<h3 class="panel-title">Process Prospects</h3>
		</div> 
		<div class="panel-body"> 
			<form action="{{route('process-prospects.process')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}

			<div class="form-group"> 
				<label class="col-sm-2 control-label">Prospects File</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="prospects" name="prospects">
				</div> 
			</div>
			
			<div class="form-group"> 
				<label class="col-sm-2 control-label">Campaign</label>
				<div class="col-sm-10">
					<select class="form-control" name="campaign_id" id="campaign_id">
						<option value="0">-Select Your Campaign-</option>
						@foreach(\App\Models\ProspectsSourcesCampaigns::where('source_id', 6)->get() as $campaign)
						<option value="{{$campaign->id}}">{{$campaign->week_number}} / {{$campaign->year}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<button class="btn btn-success" type="submit" style="width:100%;">Process Prospects</button>
		</form>
		</div> 
	</div>
@endsection