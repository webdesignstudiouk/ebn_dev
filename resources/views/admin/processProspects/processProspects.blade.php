@extends('layouts.admin_navigation')

@section('page-title', "Process Prospects")
@section('page-description', 'Process prospects into the database.')

@section('breadcrumbs')
	<li><a href="{{route('dashboard')}}">Admin</a></li>
	<li><a href="{{route('process-prospects')}}">Process Prospects</a></li>
@endsection

@section('sidebar')
	<li class="{{ active(['admin/stored-infomation/*', 'admin/stored-infomation']) }}"><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Infomation</a></li>
	<li class="{{ active(['admin/source-codes/*', 'admin/source-codes']) }}"><a href="{{route('source-codes')}}">Source Codes</a></li>
	<li class="{{ active(['admin/process-prospects/*', 'admin/process-prospects']) }}"><a href="{{route('process-prospects')}}">Process Prospects</a></li>
@endsection

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
			
			<div class="form-group"> 
				<label class="col-sm-2 control-label">Type</label>
				<div class="col-sm-10">
					<select class="form-control" name="type" id="type">
						<option value="0">-Select The Prospects Type-</option>
						<option value="3">Opener</option>
						<option value="2">Clickers</option>
					</select>
				</div>
			</div>
			<button class="btn btn-success" type="submit" style="width:100%;">Process Prospects</button>
		</form>
		</div> 
	</div>
@endsection