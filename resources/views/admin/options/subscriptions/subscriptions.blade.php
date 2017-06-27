<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li role="presentation" class="active"><a href="#prospects" aria-controls="prospects" role="tab" data-toggle="tab">Prospects 1
			<span class="badge badge-info">{{App\Models\Prospects::where('subscribed', 1)->where('email','!=','')->where('type_id', 1)->where('user_id','!=','2')->orderBy('company', 'asc')->count()}} / {{App\Models\Prospects::where('type_id', 1)->where('user_id','!=','2')->orderBy('company', 'asc')->count()}}</span></a>
		</li>
		<li role="presentation"><a href="#prospects2" aria-controls="prospects2" role="tab" data-toggle="tab">Prospects 2
			<span class="badge badge-info">{{App\Models\Prospects::where('subscribed', 1)->where('email','!=','')->where('type_id', 2)->where('user_id','!=','2')->orderBy('company', 'asc')->count()}}</span></a>
		</li>
		<li role="presentation" ><a href="#clients" aria-controls="clients" role="tab" data-toggle="tab">Clients
			<span class="badge badge-info" >{{App\Models\Prospects::where('subscribed', 1)->where('email','!=','')->where('type_id', 3)->where('user_id','!=','2')->orderBy('company', 'asc')->count()}}</span></a>
		</li>
		<li role="presentation" ><a href="#deleted" aria-controls="deleted" role="tab" data-toggle="tab">Deleted
			<span class="badge badge-info">{{App\Models\Prospects::withTrashed()->where('subscribed', 1)->where('email','!=','')->where('deleted_at', '!=', null)->where('user_id','!=','2')->orderBy('company', 'asc')->count()}}</span></a>
		</li>
		<li role="presentation" ><a href="#unsubscribed" aria-controls="unsubscribed" role="tab" data-toggle="tab">Unsubscribed
			<span class="badge badge-info">{{App\Models\Prospects::withTrashed()->where('subscribed', NULL)->where('email','!=','')->where('user_id','!=','2')->orderBy('company', 'asc')->count()}}</span></a>
		</li>
	</ul>
</nav>

<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="prospects">
	<div class="panel panel-default" style="margin-top: 15px;">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">Prospects 1 with a subscription</h3>
		</div>

		<table class="table table-striped ahref">
			<thead>
				<tr>
					<th class="col-sm-2">ID</th>
					<th class="col-sm-4">Company</th>
					<th class="col-sm-4">Email</th>
					<th class="col-sm-2">View Account</th>
				</tr>
			</thead>
			<tbody>
				@foreach(App\Models\Prospects::where('subscribed', 1)
				->where('email','!=','')
				->where('type_id', 1)
				->where('user_id','!=','2')
				->orderBy('company', 'asc')
				->get() as $prospect)
				<tr>
					<td>{{$prospect->id}}</td>
					<td>{{$prospect->company}}</td>
					<td>{{$prospect->email}}</td>
					<td><a href="http://webdesignstudiouk.com/hosting/ebn_dev/admin/prospects/{{$prospect->id}}/edit">View Account</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div role="tabpanel" class="tab-pane" id="prospects2">
	<div class="panel panel-default" style="margin-top: 15px;">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">Prospects 2 with a subscription</h3>
		</div>

		<table class="table table-striped ahref">
			<thead>
				<tr>
					<th class="col-sm-2">ID</th>
					<th class="col-sm-4">Company</th>
					<th class="col-sm-4">Email</th>
					<th class="col-sm-2">View Account</th>
				</tr>
			</thead>
			<tbody>
				@foreach(App\Models\Prospects::where('subscribed', 1)
				->where('email','!=','')
				->where('type_id', 2)
				->where('user_id','!=','2')
				->orderBy('company', 'asc')
				->get() as $prospect)
				<tr>
					<td>{{$prospect->id}}</td>
					<td>{{$prospect->company}}</td>
					<td>{{$prospect->email}}</td>
					<td><a href="http://webdesignstudiouk.com/hosting/ebn_dev/admin/prospects/{{$prospect->id}}/edit">View Account</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div role="tabpanel" class="tab-pane" id="clients">
	<div class="panel panel-default" style="margin-top: 15px;">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">Clients with a subscription</h3>
		</div>

		<table class="table table-striped ahref">
			<thead>
				<tr>
					<th class="col-sm-2">ID</th>
					<th class="col-sm-4">Company</th>
					<th class="col-sm-4">Email</th>
					<th class="col-sm-2">View Account</th>
				</tr>
			</thead>
			<tbody>
				@foreach(App\Models\Prospects::where('subscribed', 1)
				->where('email','!=','')
				->where('type_id', 3)
				->where('user_id','!=','2')
				->orderBy('company', 'asc')
				->get() as $prospect)
				<tr>
					<td>{{$prospect->id}}</td>
					<td>{{$prospect->company}}</td>
					<td>{{$prospect->email}}</td>
					<td><a href="http://webdesignstudiouk.com/hosting/ebn_dev/admin/prospects/{{$prospect->id}}/edit">View Account</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div role="tabpanel" class="tab-pane" id="deleted">
	<div class="panel panel-default" style="margin-top: 15px;">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">Deleted Prospects / Clients with a subscription</h3>
		</div>

		<table class="table table-striped ahref">
			<thead>
				<tr>
					<th class="col-sm-2">ID</th>
					<th class="col-sm-4">Company</th>
					<th class="col-sm-4">Email</th>
				</tr>
			</thead>
			<tbody>
				@foreach(App\Models\Prospects::withTrashed()
				->where('subscribed', 1)
				->where('email','!=','')
				->where('deleted_at', '!=', null)
				->where('user_id','!=','2')
				->orderBy('company', 'asc')->get() as $prospect)
				<tr>
					<td>{{$prospect->id}}</td>
					<td>{{$prospect->company}}</td>
					<td>{{$prospect->email}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div role="tabpanel" class="tab-pane" id="unsubscribed">
	<div class="panel panel-default" style="margin-top: 15px;">
		<div class="panel-heading" style="margin-bottom:20px;">
			<h3 class="panel-title">Prospects / Clients that have unsubscribed</h3>
		</div>

		<table class="table table-striped ahref">
			<thead>
				<tr>
					<th class="col-sm-2">ID</th>
					<th class="col-sm-4">Company</th>
					<th class="col-sm-4">Email</th>
				</tr>
			</thead>
			<tbody>
				@foreach(App\Models\Prospects::withTrashed()
				->where('subscribed', NULL)
				->where('email','!=','')
				->where('user_id','!=','2')
				->orderBy('company', 'asc')->get() as $prospect)
				<tr>
					<td>{{$prospect->id}}</td>
					<td>{{$prospect->company}}</td>
					<td>{{$prospect->email}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

</div>
