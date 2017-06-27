<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li role="presentation" class="active"><a href="#prospectsEmails" aria-controls="prospectsEmails" role="tab" data-toggle="tab">Prospects 1
			<span class="badge badge-info">{{App\Models\Prospects::where('email', '!=', "")->where('type_id', 1)->where('user_id', '!=', 2)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
		<li role="presentation" ><a href="#prospects2Emails" aria-controls="prospects2Emails" role="tab" data-toggle="tab">Prospects 2
			<span class="badge badge-info">{{App\Models\Prospects::where('email', '!=', "")->where('type_id', 2)->where('user_id', '!=', 2)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
		<li role="presentation" ><a href="#clientsEmails" aria-controls="clientsEmails" role="tab" data-toggle="tab">Clients
			<span class="badge badge-info">{{App\Models\Prospects::where('email', '!=', "")->where('type_id', 3)->where('user_id', '!=', 2)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
		<li role="presentation" ><a href="#deletedEmails" aria-controls="deletedEmails" role="tab" data-toggle="tab">Deleted
			<span class="badge badge-info">{{App\Models\Prospects::withTrashed()->where('email', '!=', "")->where('deleted_at', '!=', NULL)->where('user_id', '!=', 2)->orderBy('company', 'desc')->count()}}</span></a>
		</li>
	</ul>
</nav>

			  <!-- Tab panes -->
			  <div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="prospectsEmails">
					<div class="panel panel-default" style="margin-top: 15px;">
						<div class="panel-heading" style="margin-bottom:20px;">
							<h3 class="panel-title">Prospects 1 with an email address</h3>
						</div>

						<table class="table table-striped ahref">
							<thead>
								<tr>
									<th>ID</th><th>Company</th><th>Email</th><th>View Account</th>
								</tr>
							</thead>
							<tbody>
								@foreach(App\Models\Prospects::where('email', '!=', "")->where('type_id', 1)->where('user_id', '!=', 2)->orderBy('company', 'desc')->get() as $prospect)
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
				<div role="tabpanel" class="tab-pane" id="prospects2Emails">
					<div class="panel panel-default" style="margin-top: 15px;">
						<div class="panel-heading" style="margin-bottom:20px;">
							<h3 class="panel-title">Prospects 2 with an email address</h3>
						</div>

						<table class="table table-striped ahref">
							<thead>
								<tr>
									<th>ID</th><th>Company</th><th>Email</th><th>View Account</th>
								</tr>
							</thead>
							<tbody>
								@foreach(App\Models\Prospects::where('email', '!=', "")->where('type_id', 2)->where('user_id', '!=', 2)->orderBy('company', 'desc')->get() as $prospect)
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
				<div role="tabpanel" class="tab-pane" id="clientsEmails">
					<div class="panel panel-default" style="margin-top: 15px;">
						<div class="panel-heading" style="margin-bottom:20px;">
							<h3 class="panel-title">Clients with an email address</h3>
						</div>

						<table class="table table-striped ahref">
							<thead>
								<tr>
									<th>ID</th><th>Company</th><th>Email</th><th>View Account</th>
								</tr>
							</thead>
							<tbody>
								@foreach(App\Models\Prospects::where('email', '!=', "")->where('type_id', 3)->where('user_id', '!=', 2)->orderBy('company', 'desc')->get() as $prospect)
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
				<div role="tabpanel" class="tab-pane" id="deletedEmails">
					<div class="panel panel-default" style="margin-top: 15px;">
						<div class="panel-heading" style="margin-bottom:20px;">
							<h3 class="panel-title">Deleted Prospects with an email address</h3>
						</div>

						<table class="table table-striped ahref">
							<thead>
								<tr>
									<th>ID</th><th>Company</th><th>Email</th>
								</tr>
							</thead>
							<tbody>
								@foreach(App\Models\Prospects::withTrashed()->where('email', '!=', "")->where('deleted_at', '!=', null)->where('user_id', '!=', 2)->orderBy('company', 'desc')->get() as $prospect)
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
