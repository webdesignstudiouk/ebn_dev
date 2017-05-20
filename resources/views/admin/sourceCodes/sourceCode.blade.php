@extends('layouts.admin_navigation')

@section('page-title', 'Source Codes: ')
@section('page-description', 'Source codes.')

@section('breadcrumbs')
<li><a href="{{route('dashboard')}}">Admin</a></li>
<li><a href="{{route('source-codes')}}">SourceCodes</a></li>
<li><a href="{{route('source-codes.edit', $sourceCode->id)}}">SourceCode: <span>{{$sourceCode->title}}</span></a></li>
<li><a href="#" id="dynamicBreadcrumb">Source Code Details</span></a></li>
@endsection

@section('sidebar')
<li role="presentation"><a href="#sourceCodeDetails" aria-controls="sourceCodeDetails" role="tab" data-toggle="tab">Source Code Details</a></li>
<li role="presentation"><a href="#campaigns" aria-controls="campaigns" role="tab" data-toggle="tab">Campaigns</a></li>
<li style="margin-top:40px; background:#A6CE39;"><a href="{{route('source-codes')}}">Back to Source Codes</a></li>
@endsection

@section('content')
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="sourceCodeDetails">
		@include('admin.sourceCodes.updateSourceCode')
	</div>
	<div role="tabpanel" class="tab-pane" id="campaigns">
		@include('admin.sourceCodes.campaigns.campaigns')
		@include('admin.sourceCodes.campaigns.createCampaign')
	</div>
</div>
@endsection
