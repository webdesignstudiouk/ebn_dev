@extends('layouts.admin')

@section('page-title', "Search")
@section('page-description', 'Search')

@section('ajax')
	<script>
	
	function refreshSearch(){
		var value = document.getElementById('search_query').value;
		search(value)
	}

	function search($v){
		if($v.length >= 2){
			if($v!=0){
				var foo = document.getElementById('search_type');
				var search_type = foo.options[foo.selectedIndex].value;
				$.ajax({
					type:'POST',
					url:'{{route("search")}}',
					data:'&search_query='+$v+'&search_type='+search_type,
					success:function(data){
						$("#results_prospects").html('');
						$.each(data.results_prospects,function(index,item){
							tr = $('<tr/>');
							tr.append("<td class='col-sm-3'>" + item.id + "</td>");
							tr.append("<td class='col-sm-3'>" + item.company + "</td>");
							
							if(item.user_id == 4){
								tr.append("<td class='col-sm-3'>Ian Glasson</td>");
							}else if(item.user_id == 5){
								tr.append("<td class='col-sm-3'>John Nisbett</td>");
							}else{
								tr.append("<td class='col-sm-3'>Other</td>");
							}

							tr.append("<td class='col-sm-3'><a href='admin/prospects/" + item.id + "/edit'>View Account</a></td>");
							$('#results_prospects').append(tr);
							var src_str = $("#test").html();
						});
						$("#prospects_counter").html(data.prospects_count);
						
						$("#results_contacts").html('');
						$.each(data.results_contacts,function(index,item){
							tr = $('<tr/>');
						tr.append("<td class='col-sm-3'>" + item.id + "</td>");
						tr.append("<td class='col-sm-3'>" + item.first_name + "</td>");
						tr.append("<td class='col-sm-3'>" + item.second_name + "</td>");
							tr.append("<td class='col-sm-3'><a href='admin/prospects/" + item.prospect_id + "/edit'>View Account</a></td>");
							$('#results_contacts').append(tr);
							var src_str = $("#test").html();
						});
						$("#contacts_counter").html(data.contacts_count);
						
						
						$("#errors").html(data.errors);
						$("#query").html("- "+data.search_query);


						var term = data.search_query;
						term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
						var pattern = new RegExp("("+term+")", "gi");
						var src_str = $("#results_prospects").html();
						src_str = src_str.replace(pattern, "<mark style='background-color:rgba(166, 206, 57,0.5);'>$1</mark>");
						src_str = src_str.replace(/(<mark style='background-color:rgba(166, 206, 57,0.5);'>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");
						$("#results_prospects").html(src_str);
						
						var term = data.search_query;
						term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
						var pattern = new RegExp("("+term+")", "gi");
						var src_str1 = $("#results_contacts").html();
						src_str1 = src_str1.replace(pattern, "<mark style='background-color:rgba(166, 206, 57,0.5);'>$1</mark>");
						src_str1 = src_str1.replace(/(<mark style='background-color:rgba(166, 206, 57,0.5);'>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");
						$("#results_contacts").html(src_str1);
					},
					error:function(data){
						console.log(data);
					}
				});
			}
		}
	}
	</script>
@endsection


@section('content')

	<form>
		{{ csrf_field() }}
		<div class="col-sm-10">
			<input type="text" class="form-control input-lg" placeholder="Search..." name="search_query" id="search_query" onKeyUp="search(value)">
		</div>
		<div class="col-sm-2">
			<div class="form-group">
				<select class="form-control input-lg" id="search_type" name="search_type" onChange="refreshSearch()">
					<option value="0">My Data</option>
					@role('admin')
					<option value="1">Site Data</option>
					@endrole
				</select>
			</div>
		</div>
		<button type="submit" class="btn-unstyled"></button>
	</form>

	<div class="panel panel-default">
		<div id="errors"></div>
		
		<div class="panel-heading" style="margin-bottom:10px; margin-top:10px;">
			<h4 class="panel-title" style="width:100%">
				<b>Prospects / Clients</b><span class="badge badge-info" id="prospects_counter" style="float:right">0</span>
			</h4>
		</div>
		<table class="table table-striped" style="margin-bottom:10px; margin-top:10px;">
			<tbody id="results_prospects">
			</tbody>
		</table>
		
		<div class="panel-heading" style="margin-bottom:10px; margin-top:10px;">
			<h4 class="panel-title" style="width:100%">
				<b>Contacts</b><span class="badge badge-info" id="contacts_counter" style="float:right">0</span>
			</h4>
		</div>
		<table class="table table-striped">
			<tbody id="results_contacts">
			</tbody>
		</table>
	</div>
@endsection
