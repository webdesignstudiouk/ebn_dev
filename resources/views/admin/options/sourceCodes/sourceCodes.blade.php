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
		  <td><a href="{{url('admin/options/sourceCodes/'.$sC->id.'/edit')}}">View Account</a></td>
		</tr>
		@endforeach
	  </tbody>
	</table>
</div>