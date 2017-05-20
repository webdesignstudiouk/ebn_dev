@extends('layouts.admin')

@section('page-title', 'Create Prospect')
@section('page-description', 'Create a prospect.')

@section('content')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li><a href="{{url('admin/prospects')}}">Prospects
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 1)->where('user_id', Auth::user()->id)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
		<li><a href="{{url('admin/prospects_2')}}">Prospects 2
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 2)->where('user_id', Auth::user()->id)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
		<li><a href="{{url('admin/clients')}}">Clients
			<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 3)->where('user_id', Auth::user()->id)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
		<li><a href="{{route('prospects.create')}}">Create Prospect</a></li>
		<li><a href="{{route('prospects.request')}}">Request Prospect</a></li>
	</ul>
</nav>
	{!! form($form) !!}
@endsection
