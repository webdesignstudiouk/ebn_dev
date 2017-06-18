@extends('prospects.prospect')

@section('extra-breadcrumbs')
<li><a href="{{route('prospect.uploads', $prospect->id)}}">Uploads</span></a></li>
@endsection

@section('sub-content')
	@permission('uploads.view')
		@permission('uploads.loa.view')
			<div class="panel panel-default">
				<div class="panel-heading" style="margin-bottom:20px;">
					<h3 class="panel-title">LOA</h3>
				</div>
				<div id="scrollContainer" style="max-height:400px; overflow-y:scroll;">
					<table class="table table-striped ahref" >
						<thead>
						<tr>
							<th class="col-sm-9">Name</th>
							<th class="col-sm-3">File Options</th>
						</tr>
						</thead>
						<tbody>
						@foreach($loa_files as $file)
							@if(substr(basename($file), 0, 1 ) != ".")
								@php
									$url = Storage::url('app/public/prospects/'.$prospect->id.'/'.$file);
								@endphp
								<tr>
									<td class="col-sm-9"> {{ basename($file) }}</td>
									<td>
										<a href="{{url('storage/app/public/prospects/'.$prospect->id.'/loa/'.basename($file))}}">
											<i class='fa fa-search btn btn-icon btn-success'></i>
										</a>
										<a href="{{url('storage/app/public/prospects/'.$prospect->id.'/loa/'.basename($file))}}" style="color:#8dc63f;" download>
											<i class='fa fa-download btn btn-icon btn-info'></i>
										</a>
										<a href="{{ route('delete_file') }}" onclick="event.preventDefault(); document.getElementById('delete-loa-file-{{$loop->index}}').submit();" style="color:#8dc63f;">
											<i class='fa fa-times btn btn-icon btn-red'></i>
										</a>
										<form id="delete-loa-file-{{$loop->index}}" action="{{ route('delete_file') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
											<input type="hidden" name="prospect_id" value="{{$prospect->id}}"/>
											<input type="hidden" name="file_type" value="loa"/>
											<input type="hidden" name="file_name" value="{{basename($file)}}"/>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endpermission

		@permission('uploads.signedcontracts.view')
			<div class="panel panel-default">
				<div class="panel-heading" style="margin-bottom:20px;">
					<h3 class="panel-title">Signed Contracts</h3>
				</div>
				<div id="scrollContainer" style="max-height:400px; overflow-y:scroll;">
					<table class="table table-striped ahref" >
						<thead>
						<tr>
							<th class="col-sm-9">Name</th>
							<th class="col-sm-3">File Options</th>
						</tr>
						</thead>
						<tbody>

						@foreach($signedContracts_files as $file)
							@if(substr(basename($file), 0, 1 ) != ".")
								@php
									$url = Storage::url('app/public/prospects/'.$prospect->id.'/'.$file);
								@endphp
								<tr>
									<td class="col-sm-9"> {{ basename($file) }}</td>
									<td>
										<a href="{{url('storage/app/public/prospects/'.$prospect->id.'/signedContracts/'.basename($file))}}">
											<i class='fa fa-search btn btn-icon btn-success'></i>
										</a>
										<a href="{{url('storage/app/public/prospects/'.$prospect->id.'/signedContracts/'.basename($file))}}" style="color:#8dc63f;" download>
											<i class='fa fa-download btn btn-icon btn-info'></i>
										</a>
										<a href="{{ route('delete_file') }}" onclick="event.preventDefault(); document.getElementById('delete-signedContracts-file-{{$loop->index}}').submit();" style="color:#8dc63f;">
											<i class='fa fa-times btn btn-icon btn-red'></i>
										</a>
										<form id="delete-signedContracts-file-{{$loop->index}}" action="{{ route('delete_file') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
											<input type="hidden" name="prospect_id" value="{{$prospect->id}}"/>
											<input type="hidden" name="file_type" value="signedContracts"/>
											<input type="hidden" name="file_name" value="{{basename($file)}}"/>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endpermission

		@permission('uploads.supportingdocumnets.view')
			<div class="panel panel-default">
				<div class="panel-heading" style="margin-bottom:20px;">
					<h3 class="panel-title">Supporting Documents</h3>
				</div>
				<div id="scrollContainer" style="max-height:400px; overflow-y:scroll;">
					<table class="table table-striped ahref" >
						<thead>
						<tr>
							<th class="col-sm-9">Name</th>
							<th class="col-sm-3">File Options</th>
						</tr>
						</thead>
						<tbody>

						@foreach($supportingDocuments_files as $file)
							@if(substr(basename($file), 0, 1 ) != ".")
								@php
									$url = Storage::url('app/public/prospects/'.$prospect->id.'/'.$file);
								@endphp
								<tr>
									<td class="col-sm-9"> {{ basename($file) }}</td>
									<td>
										<a href="{{url('storage/app/public/prospects/'.$prospect->id.'/supportingDocuments/'.basename($file))}}">
											<i class='fa fa-search btn btn-icon btn-success'></i>
										</a>
										<a href="{{url('storage/app/public/prospects/'.$prospect->id.'/supportingDocuments/'.basename($file))}}" style="color:#8dc63f;" download>
											<i class='fa fa-download btn btn-icon btn-info'></i>
										</a>
										<a href="{{ route('delete_file') }}" onclick="event.preventDefault(); document.getElementById('delete-supportingDocuments-file-{{$loop->index}}').submit();" style="color:#8dc63f;">
											<i class='fa fa-times btn btn-icon btn-red'></i>
										</a>
										<form id="delete-supportingDocuments-file-{{$loop->index}}" action="{{ route('delete_file') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
											<input type="hidden" name="prospect_id" value="{{$prospect->id}}"/>
											<input type="hidden" name="file_type" value="supportingDocuments"/>
											<input type="hidden" name="file_name" value="{{basename($file)}}"/>
										</form>
									</td>
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		@endpermission

		@permission('uploads.create')
			{!! form($uploadFile)!!}
		@endpermission
	@else
		{{render_permission_error()}}
	@endpermission

@endsection
