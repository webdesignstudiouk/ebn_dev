<div class="panel panel-default">
	<div class="panel-heading" style="margin-bottom:20px;">
		<h3 class="panel-title">Contacts</h3>
	</div>

	<table class="table table-striped ahref">
	  <thead>
		<tr>
		  <th>ID<br/>
				<span style="font-weight:100;">
					Favourite Contact <i class="fa fa-circle" style="color:#ffba00; float:right;"></i>
				</span></th>
		  <th>Job Title</th>
		  <th>Name</th>
		  <th>Email</th>
		  <th>Phone Number</th>
		  <th>Mobile Number</th>
		  <th>Type</th>
		  <th>View Account</th>
		</tr>
	  </thead>
	  <tbody>
		@foreach($prospect->contacts as $c)
		<tr>
		  <td>
				@if($c->favourite != NULL)
  			<span class="badge badge-warning badge-roundless upper" style="margin-left:10px;">{{$c->id}}</span>
				@else
				{{$c->id}}
  		  @endif
			</td>
			<td>{{$c->job_title}}</td>
		  <td>{{$c->title}} {{$c->first_name}} {{$c->second_name}}</td>
		  <td>{{$c->email}}</td>
		  <td>{{$c->phonenumber}}</td>
		  <td>{{$c->mobile_number}}</td>
		  <td>{{$c->type->title}}</td>
		  <td><a href="{{route('contacts.edit', ['prospect_id'=>$prospect->id, 'contact_id'=>$c->id])}}">View Account</a></td>
		</tr>
		@endforeach
	  </tbody>
	</table>
</div>
