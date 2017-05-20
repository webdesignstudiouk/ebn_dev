@extends('layouts.admin_navigation')

@section('page-title', 'Source Codes: ')
@section('page-description', 'Source codes.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Admin</a></li>
<li><a href="{{route('source-codes')}}">SourceCodes</a></li>
<li><a href="{{route('source-codes.edit', $campaign->source_id)}}">SourceCode: <span>{{$sourceCode->title}}</span></a></li>
<li><a href="{{route('source-codes.edit', ['soruce_code'=>$campaign->source_id, 'tab'=>'campaigns'])}}">Campaign</a></li>
<li><a href="{{route('campaigns.edit', ['source_id' => $campaign->source_id, 'campaign_id' => $campaign->id])}}">Campaign <span>{{$campaign->week_number}} / {{$campaign->year}}</span></a></li>
<li><a href="#" id="dynamicBreadcrumb">Campaign Details</span></a></li>
@endsection

@section('sidebar')
<li role="presentation" class="active"><a href="#campaignDetails" aria-controls="campaignDetails" role="tab" data-toggle="tab">Campaign Details</a></li>
<li style="margin-top:40px; background:#A6CE39;"><a href="{{route('source-codes.edit', $campaign->source_id)}}">Back to Source Code</a></li>
@endsection

@section('content')
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="campaignDetails">
		@include('admin.options.sourceCodes.campaigns.updateCampaign')
	</div>
	<div role="tabpanel" class="tab-pane" id="campaigns">
	</div>
</div>
@endsection
