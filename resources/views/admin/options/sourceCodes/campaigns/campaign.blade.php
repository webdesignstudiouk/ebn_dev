@extends('layouts.admin')

@section('page-title', 'Source Codes: ')
@section('page-description', 'Source codes.')

@section('content')
<div class='row'>
	<ol class="breadcrumb" style="background:#fff; border-bottom:2px solid #A6CE39;">
		<li><a href="{{url('admin/options')}}">Options</a></li>
		<li><a href="{{url('admin/options#sourceCode')}}">SourceCodes</a></li>
		<li><a href="{{url('admin/options/sourceCodes/'.$sourceCode->id.'/edit')}}">SourceCode: <span>{{$sourceCode->title}}</span></a></li>
		<li><a href="{{url('admin/options/sourceCodes/'.$sourceCode->id.'/edit#campaigns')}}">Campaign</a></li>
		<li><a href="{{url('admin/options/sourceCodes/'.$sourceCode->id.'/campaigns/'.$campaign->id)}}">Campaign <span>{{$campaign->week_number}} / {{$campaign->year}}</span></a></li> 
		<li><a href="#" id="dynamicBreadcrumb">Campaign Details</span></a></li> 
	</ol>
	<div class='col-sm-3'>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#campaignDetails" aria-controls="campaignDetails" role="tab" data-toggle="tab">Campaign Details</a></li>
			<li style="margin-top:40px; background:#A6CE39;"><a href="{{url('admin/options/sourceCodes/'.$sourceCode->id.'/edit')}}">Back to Source Code</a></li>
		</ul>

	</div>
	<div class='col-sm-9'>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="campaignDetails">
				@include('admin.options.sourceCodes.campaigns.updateCampaign')
			</div>
			<div role="tabpanel" class="tab-pane" id="campaigns">
			</div>
		</div>
	</div>
</div>
@endsection 
