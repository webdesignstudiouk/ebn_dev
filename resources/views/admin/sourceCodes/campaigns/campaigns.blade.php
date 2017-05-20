<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Campaigns</h3>
	</div>

	<table class="table table-striped ahref">
	  <thead>
		<tr>
		  <th>ID</th>
		  <th>Week Number</th>
		  <th>Year</th>
		  <th>Campaign Type</th>
		  <th>Start Date</th>
		  <th>View Account</th>
		</tr>
	  </thead>
	  <tbody>
		@foreach($sourceCode->campaigns as $c)
		<tr>
		  <td>{{$c->id}}</td>
		  <td>{{$c->week_number}}</td>
		  <td>{{$c->year}}</td>
		  <td>{{$c->type}}</td>
		  <td>{{date('M d', strtotime($c->year.'W'.$c->week_number))}}</td>
		  <td><a href="{{route('campaigns.edit', ['source_id' => $c->source_id, 'campaign_id' => $c->id])}}">View Account</a></td>
		</tr>
		@endforeach
	  </tbody>
	</table>
</div>
