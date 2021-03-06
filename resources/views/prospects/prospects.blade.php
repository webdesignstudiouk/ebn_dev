@extends('layouts.admin')

@section('page-title', $title)
@section('page-description', 'List Of '.$title.' assigned to you.')

@section('content')
<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		@permission('prospects1.view')
			<li><a href="{{url('admin/prospects')}}">Prospects
				<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 1)->where('request_delete','!=', 1)->where('user_id', Auth::user()->id)->orderBy('company', 'desc')->count()}}</span></a>
			</li>
		@endpermission
		@permission('prospects2.view')
			<li><a href="{{url('admin/prospects_2')}}">Prospects 2
				<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 2)->where('request_delete','!=', 1)->where('user_id', Auth::user()->id)->orderBy('company', 'desc')->count()}}</span></a>
			</li>
		@endpermission
		@permission('clients.view')
			<li><a href="{{url('admin/clients')}}">My Clients
				<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 3)->where('request_delete','!=', 1)->where('user_id', Auth::user()->id)->orderBy('company', 'desc')->count()}}</span></a>
			</li>
			@role('admin')
		<li><a href="{{route('prospects.all_clients')}}">All Clients
				<span class="badge badge-info">{{App\Models\Prospects::where('type_id', 3)->where('request_delete','!=', 1)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
			@endrole
		@endpermission
		@permission('prospectsystem.create')
			<li><a href="{{route('prospects.create')}}">Create Prospect</a></li>
		@endpermission
		@permission('prospectsystem.request')
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Request Prospect <span class="caret"></span></a>
				<ul class="dropdown-menu">
					@role('admin')
					    <li>
                            <a href="{{route('prospects.request')}}">
                                Request Prospect (Any Pot)
                            </a>
                        </li>
					    <li role="separator" class="divider"></li>
					@endrole
					@if(Auth::user()->id == '4' || Auth::user()->id == '1' )
						<li>
                            <a href="{{route('prospects.request_ch')}}">
                                Request Prospect (Care Homes Unrequested Pot)
                                <span class="badge badge-warning"> {{App\Models\Prospects::where('user_id','=','100')->where('deleted_reason', '!=', 'ian_delete')->where('businessType','like','%Care%')->count()}} </span>
                            </a>
                        </li>
						<li>
                            <a href="{{route('prospects.request_ch_deleted')}}">
                                Request Prospect (Care Homes Deleted Pot)
                                <span class="badge badge-warning"> {{App\Models\Prospects::withTrashed()->whereNotNull('deleted_at')->where('deleted_reason', '!=', 'ian_delete')->where('businessType','like','%Care%')->count()}} </span>
                            </a>
                        </li>
						<li role="separator" class="divider"></li>
					@endif
					<li>
                        <a href="{{route('prospects.request_agent')}}">
                            Request Prospect (Agent Pot)
							<span class="badge badge-warning"> {{App\Models\Prospects::where('user_id', 100)->where('campaign_id', 31)->count()}} </span>
                        </a>
					</li>
				</ul>
			</li>
		@endpermission

	</ul>
</nav>

<center>{{ $prospects->links() }}</center>

@permission('prospects1.view|prospects2.view|clients.view')
<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">
			<b>{{$title}}</b>
		</h3>
	</div>
	<form method="post" action="{{ route('prospect.moveProspect') }}">
	{{ csrf_field() }}
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID / Move {{ $title }}<br/>
					<span style="font-weight:100;">
						Latest Requested {{ $title }} <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
					</span><br/>
				</th>
				@if($title == 'All Clients')
					<th>Agent's Name</th>
				@endif
				<th>Company</th>
				<th>Brochure Sent</th>
				<th>Contract End Date<br/>
					<span style="font-weight:100;">
						Future CED <i class="fa fa-circle" style="color:#40bbea; float:right;"></i>
					</span><br/>
					<span style="font-weight:100;">
						Past CED <i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
					</span><br/>
					<span style="font-weight:100;">
						No CED <i class="fa fa-circle" style="color:#cc3f44; float:right;"></i>
					</span>
				</th>
				<th>Latest Callback<br/>
					<span style="font-weight:100;">
						Future Callback Created <i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
					</span><br/>
					<span style="font-weight:100;">
						No Future Callback <i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
					</span>
				</th>
				<th>View Account</th>
			</tr>
		</thead>
		<tbody>
			@foreach($prospects as $prospect)
			@php
			$difference = null;
			@endphp
			<tr>
				<td>
					@if (isset($newly_requested_prospect))
						@if($prospect->id == $newly_requested_prospect)
							<span class="badge badge-success badge-roundless upper">{{$prospect->id}}</span>
							@else
							{{$prospect->id}}
						@endif
					@else
						{{$prospect->id}}
					@endif
					@role('admin')
					<input type="checkbox" name="prospectToMove[]" value="{{ $prospect->id }}" style="float:right;"/>
					@endrole
				</td>
				@if($title == 'All Clients')
					<td>{{$prospect->user->first_name}} {{$prospect->user->second_name}}</td>
				@endif
				<td style="border-left:1px solid #eee;">{{$prospect->company}}</td>
				<td style="border-left:1px solid #eee;">{{ (isset($prospect->brochure_sent_date) && $prospect->brochure_sent_date != '' ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $prospect->brochure_sent_date)->format('d/m/Y') : '')}}</td>
				<td style="border-left:1px solid #eee;">
					{{$prospect->verbalCED}}
					@if(isset($prospect->verbalCED))
						@php
						$difference = Carbon\Carbon::now()->diffInMonths(Carbon\Carbon::createFromFormat('d/m/Y', $prospect->verbalCED), true)." Months";
						@endphp
						@if(Carbon\Carbon::createFromFormat('d/m/Y', $prospect->verbalCED) > Carbon\Carbon::now())
							<span class="badge badge-info badge-roundless upper" style="margin-left:10px; width:80px; float:right;">{{$difference}}</span>
						@else
							<span class="badge badge-warning badge-roundless upper" style="margin-left:10px; width:80px; float:right;">{{$difference}}</span>
						@endif
					@else
						<span class="badge badge-danger badge-roundless upper" style="margin-left:10px;  width:80px; float:right;">No CED </span>
					@endif
				</td>
				<td style="border-left:1px solid #eee;">
					@if (count($prospect->callbacks))
					{!! Carbon\Carbon::parse($prospect->callbacks->first()->callbackDate)->format('d/m/Y')!!}
					@if ($prospect->callbacks->first()->callbackDate <=  Carbon\Carbon::now())
					<i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
					@else
					<i class="fa fa-circle" style="color:#8dc63f; float:right;"></i>
					@endif
					@endif
				</td>
				<td style="border-left:1px solid #eee;"><a href="{{url('admin/prospects/'.$prospect->id.'/edit')}}">View Account</a></td>
			</tr>
			@endforeach
			@role('admin')
		<tr>
			<td>
				<label>Choose a destination</label>
				<select class="form-control" name="moveToUser">
					<option></option>
					@foreach(\App\Models\User::all() as $user)
						<option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->second_name }}</option>
					@endforeach
				</select>
				<button type="submit" class="btn btn-success" style="width:100%;">Move Prospects/Clients</button>
			</td>

		</tr>
		@endrole
		</tbody>
	</table>
	</form>
</div>
@else
	{{render_permission_error()}}
@endpermission

<center>{{ $prospects->links() }}</center>
@endsection
