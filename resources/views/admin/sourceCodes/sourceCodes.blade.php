@extends('layouts.admin_navigation')

@section('page-title', 'Source Codes')
@section('page-description', 'Source Codes.')

@section('breadcrumbs')
		<li><a href="{{route('dashboard')}}">Admin</a></li>
		<li><a href="{{route('source-codes')}}">SourceCodes</a></li>
@endsection

@section('sidebar')
	<li class="{{ active(['admin/stored-infomation/*', 'admin/stored-infomation']) }}"><a href="{{route('storedInfomation', ['type_id' => 1])}}">Stored Infomation</a></li>
	<li class="{{ active(['admin/source-codes/*', 'admin/source-codes']) }}"><a href="{{route('source-codes')}}">Source Codes</a></li>
	<li class="{{ active(['admin/process-prospects/*', 'admin/process-prospects']) }}"><a href="{{route('process-prospects')}}">Process Prospects</a></li>
@endsection

@section('content')
<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Source Codes</h3>
	</div>

	<table class="table table-striped ahref">
	  <thead>
		<tr>
		  <th>ID</th>
		  <th>Title</th>
		  <th>Description</th>
		  <th>View Account</th>
		</tr>
	  </thead>
	  <tbody>
		@foreach($sourceCodes as $sC)
		<tr>
		  <td>{{$sC->id}}</td>
		  <td>{{$sC->title}}</td>
		  <td>{{$sC->description}}</td>
		  <td><a href="{{route('source-codes.edit', $sC->id)}}">View Account</a></td>
		</tr>
		@endforeach
	  </tbody>
	</table>
	
</div>


@include('admin.sourceCodes.createSourceCode')

@endsection
