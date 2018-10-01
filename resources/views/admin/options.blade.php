@extends('layouts.admin')

@section('page-title', 'Options')
@section('page-description', 'Site options.')

@section('content')
<div class='row'>

	<ol class="breadcrumb">
		<li><a href="{{url('admin/options/')}}">Options</a></li>
		<li><a href="#" id="dynamicBreadcrumb">Stored Information</a></li>
	</ol>
			
	<div class='col-sm-3'>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#reports" aria-controls="storedInfomation" role="tab" data-toggle="tab">Stored Infomation</a></li>
			<li role="presentation" class="active"><a href="#storedInfomation" aria-controls="storedInfomation" role="tab" data-toggle="tab">Stored Information</a></li>
			<li role="presentation"><a href="#sourceCode" aria-controls="sourceCode" role="tab" data-toggle="tab">Source Codes <span class="badge badge-info pull-right">{{$sourceCodes->count()}}</span></a></li>
			<li role="presentation"><a href="#subscriptions" aria-controls="subscriptions" role="tab" data-toggle="tab">Subscriptions</a></li>
			<li role="presentation"><a href="#roles" aria-controls="subscriptions" role="tab" data-toggle="tab">Roles</a></li>
		</ul>

	</div>
	<div class='col-sm-9'>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="storedInfomation">
				@include('admin.options.storedInfomation.storedInfomation')
			</div>
			<div role="tabpanel" class="tab-pane" id="sourceCode">
				@include('admin.options.sourceCodes.sourceCodes')
				@include('admin.options.sourceCodes.createSourceCode')
			</div>
			<div role="tabpanel" class="tab-pane" id="subscriptions">
				@include('admin.options.subscriptions.subscriptions')
			</div>
		</div>
	</div>
</div>
@endsection 
