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
		  <td>{{date('M d', strtotime($c->year.'W'.$c->week_number))}}</td>
		  <td><a href="{{url('admin/options/sourceCodes/'.$sourceCode->id.'/campaigns/'.$c->id)}}">View Account</a></td>
		</tr>
		@endforeach
	  </tbody>
	</table>
</div>