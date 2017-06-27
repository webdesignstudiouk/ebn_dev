@extends('layouts.admin')

@section('page-title', 'Source Codes: ')
@section('page-description', 'Source codes.')

@section('content')
<div class='row'>
	<ol class="breadcrumb" style="background:#fff; border-bottom:2px solid #A6CE39;">
		<li><a href="{{route('source-codes'])}}">SourceCodes</a></li>
		<li><a href="{{route('source-codes.edit', ['id', $sourceCode->id])}}">SourceCode: <span>{{$sourceCode->title}}</span></a></li>
		<li><a href="#" id="dynamicBreadcrumb">Source Code Details</span></a></li>
	</ol>

	<div class='col-sm-3'>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#sourceCodeDetails" aria-controls="sourceCodeDetails" role="tab" data-toggle="tab">Source Code Details</a></li>
			<li role="presentation"><a href="#campaigns" aria-controls="campaigns" role="tab" data-toggle="tab">Campaigns</a></li>
			<li style="margin-top:40px; background:#A6CE39;"><a href="{{route('source-codes')}}">Back to Source Codes</a></li>
		</ul>

	</div>
	<div class='col-sm-9'>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="sourceCodeDetails">
				@include('admin.options.sourceCodes.updateSourceCode')
			</div>
			<div role="tabpanel" class="tab-pane" id="campaigns">

				@include('admin.options.sourceCodes.campaigns.campaigns')
				@include('admin.options.sourceCodes.campaigns.createCampaign')
			</div>
		</div>
	</div>
</div>
@endsection
