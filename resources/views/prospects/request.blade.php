@extends('layouts.admin')

@section('page-title', $title)
@section('page-description', 'Request a Prospect')


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

	<div class="panel panel-default">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">
				<b>Request a Prospect</b>
			</h3>
		</div>
		<div class="row">
			<form action="{{route('prospect.requestProspect')}}" method="POST">
				{{ csrf_field() }}

				<div class="col-sm-4" style="border-right:1px solid #f4f4f4;">
					<h3>Original
						<span class="badge badge-info pull-right">
							{{\App\Models\Prospects::where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','')->count()}}
						</span>
					</h3>
					<div class="radio">
						<label>
							<input type="radio" name="request_type" id="radio_original" value="0" checked>
							Request out of the original prospect pot.
						</label>
					</div>
				</div>

				<div class="col-sm-3" style="border-right:1px solid #f4f4f4; display:none;">
					<h3>M/L Lead
						<span id="leadCount" class="badge badge-info pull-right">
							{{\App\Models\Prospects::where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','1')->count()}}
						</span>
					</h3>
					<div class="radio" style="text-align:center;">
						<label>
							<input type="radio" name="request_type" id="radio_lead" value="1">
							Request out of the lead prospect pot.
						</label>
					</div>
					<div id="lead_div">
						<h4 style="border-top: 2px solid #A6CE39; text-align:center; padding-top:10px; margin-top:20px;">Select Source Code & Campaign</h4>
						<a href="{{route('source-codes')}}" style="color:#A6CE39;"><center>Create a missing source code</center></a>
						<select class="form-control" name="request_type_source_lead" id="request_type_source_lead" >
							<option value="0">-Select Your Source-</option>
							@foreach($sources as $source)
							<option value="{{$source->id}}">{{$source->title}}</option>
							@endforeach
						</select>
						<div class="campaigns_selector_lead">
							@foreach($sources as $source)
							<div class="l_{{$source->id}}">
								<a href="{{route('source-codes.edit', $source->id)}}?tab=campaigns" style="color:#A6CE39;"><center>Create a missing campaign</center></a>
								<select class="form-control" name="request_type_campaign_lead_{{$source->id}}" id="request_type_campaign_lead_{{$source->id}}" onChange="prospectCount('1', value)">
									<option value="0">-Select Your Campaign-</option>
									@foreach($sourcesCampaigns->where('source_id', $source->id)->get() as $campaign)
									<option value="{{$campaign->id}}">{{$campaign->week_number}} / {{$campaign->year}}</option>
									@endforeach
								</select>
							</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="col-sm-4" style="border-right:1px solid #f4f4f4;">
					<h3>M/L Clickers
						<span id="clickerCount" class="badge badge-info pull-right">
							{{\App\Models\Prospects::where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','2')->count()}}
						</span>
					</h3>
					<div class="radio">
						<label>
							<input type="radio" name="request_type" id="radio_clicker" value="2">
							Request out of the clickers prospect pot.
						</label>
					</div>
					<div id="clicker_div">
						<h4 style="border-top: 2px solid #A6CE39; text-align:center; padding-top:10px; margin-top:20px;">Select Source Code & Campaign</h4>
						<a href="{{route('source-codes')}}" style="color:#A6CE39;"><center>Create a missing source code</center></a>
						<select class="form-control" name="request_type_source_clicker" id="request_type_source_clicker">
							<option value="0">-Select Your Source-</option>
							@foreach($sources as $source)
							<option value="{{$source->id}}">{{$source->title}}</option>
							@endforeach
						</select>
						<div class="campaigns_selector_clicker">
							@foreach($sources as $source)
							<div class="c_{{$source->id}}">
								<a href="{{route('source-codes.edit', $source->id)}}?tab=campaigns" style="color:#A6CE39;"><center>Create a missing campaign</center></a>
								<select class="form-control" name="request_type_campaign_clicker_{{$source->id}}" id="request_type_campaign_clicker_{{$source->id}}" onChange="prospectCount('2', value)">
									<option value="0">-Select Your Campaign-</option>
									@foreach($sourcesCampaigns->where('source_id', $source->id)->get() as $campaign)
									<option value="{{$campaign->id}}">{{$campaign->week_number}} / {{$campaign->year}}</option>
									@endforeach
								</select>
							</div>
							@endforeach
						</div>
					</div>
				</div>

				<div class="col-sm-4" style="border-right:1px solid #f4f4f4;">
					<h3>M/L Openers
						<span id="openerCount" class="badge badge-info pull-right">
							{{\App\Models\Prospects::where('type_id','!=','2')->where('type_id','!=','3')->where('user_id','=','100')->where('lead_type','3')->count()}}
						</span>
					</h3>
					<div class="radio">
						<label>
							<input type="radio" name="request_type" id="radio_opener" value="3">
							Request out of the openers prospect pot.
						</label>
					</div>
					<div id="opener_div">
						<h4 style="border-top: 2px solid #A6CE39; text-align:center; padding-top:10px; margin-top:20px;">Select Source Code & Campaign</h4>
						<a href="{{route('source-codes')}}" style="color:#A6CE39;"><center>Create a missing source code</center></a>
						<select class="form-control" name="request_type_source_opener" id="request_type_source_opener">
							<option value="0">-Select Your Source-</option>
							@foreach($sources as $source)
							<option value="{{$source->id}}">{{$source->title}}</option>
							@endforeach
						</select>
						<div class="campaigns_selector_opener">
							@foreach($sources as $source)
							<div class="o_{{$source->id}}">
								<a href="{{route('source-codes.edit', $source->id)}}?tab=campaigns" style="color:#A6CE39;"><center>Create a missing campaign</center></a>
								<select class="form-control" name="request_type_campaign_opener_{{$source->id}}" id="request_type_campaign_opener_{{$source->id}}" onChange="prospectCount('3', value)">
									<option value="0">-Select Your Campaign-</option>
									@foreach($sourcesCampaigns->where('source_id', $source->id)->get() as $campaign)
									<option value="{{$campaign->id}}">{{$campaign->week_number}} / {{$campaign->year}}</option>
									@endforeach
								</select>
							</div>
							@endforeach
						</div>
					</div>
				</div>

				<button class="btn btn-success" type="submit" style="width:100%; margin-top:20px;">Request Prospect</button>
			</div>
		</div>
	</form>

	<script>
	$(document).ready(function() {
		//lead
		$('#request_type_source_lead').bind('change', function() {
			var elements = $('div.campaigns_selector_lead').children().hide(); // hide all the elements
			var value = $(this).val();

			if (value.length) { // if somethings' selected
			elements.filter('.' + value).show(); // show the ones we want
		}
	}).trigger('change');

//opener
$('#request_type_source_opener').bind('change', function() {
	var elements = $('div.campaigns_selector_opener').children().hide(); // hide all the elements
	var value = $(this).val();

	if (value.length) { // if somethings' selected
	elements.filter('.o_' + value).show(); // show the ones we want
}
}).trigger('change');

//clicker
$('#request_type_source_clicker').bind('change', function() {
	var elements = $('div.campaigns_selector_clicker').children().hide(); // hide all the elements
	var value = $(this).val();

	if (value.length) { // if somethings' selected
	elements.filter('.c_' + value).show(); // show the ones we want
}
}).trigger('change');

$('#lead_div').hide();
$('#clicker_div').hide();
$('#opener_div').hide();

$('input[name="request_type"]').click(function() {
	if(this.id == 'radio_lead') {
		$('#clicker_div').hide();
		$('#opener_div').hide();
		$('#lead_div').show();
	}else if(this.id == 'radio_clicker'){
		$('#lead_div').hide();
		$('#opener_div').hide();
		$('#clicker_div').show();
	}else if(this.id == 'radio_opener'){
		$('#lead_div').hide();
		$('#clicker_div').hide();
		$('#opener_div').show();
	}else if(this.id == 'radio_original'){
		$('#lead_div').hide();
		$('#clicker_div').hide();
		$('#opener_div').hide();
	}
});
});
</script>
@endsection
