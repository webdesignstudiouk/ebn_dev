<!DOCTYPE html>
<html lang='en'>
<head>
	<!-- META -->
	<meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
	<meta charset='utf-8'>
	<meta content='IE=edge' http-equiv='X-UA-Compatible'>
	<meta content='width=device-width, initial-scale=1.0' name='viewport'>
	<meta content='Energy Buyers Network Admin Panel' name='description'>
	<meta name='viewport' content="width=device-width, initial-scale=1">
	<meta id="token" name="token" content="{ { csrf_token() } }">

	<!-- TITLE -->
	<title>Energy Buyers Network</title>

	<!-- CSS -->
	<link href='http://www.webdesignstudiouk.com/hosting/ebn2/assets/css/font-awesome.css' rel='stylesheet'>
	<link href='http://fonts.googleapis.com/css?family=Arimo:400,700,400italic' id='style-resource-1' rel='stylesheet'>
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
	<link href='http://www.webdesignstudiouk.com/hosting/ebn2/assets/css/bootstrap.css' id='style-resource-4' rel='stylesheet'>
	<link href='http://www.webdesignstudiouk.com/hosting/ebn2/assets/css/xenon-core.css' id='style-resource-5' rel='stylesheet'>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<link href='http://www.webdesignstudiouk.com/hosting/ebn2/assets/css/xenon-forms.css' id='style-resource-6' rel='stylesheet'>
	<link href='http://www.webdesignstudiouk.com/hosting/ebn2/assets/css/xenon-components.css' id='style-resource-7' rel='stylesheet'>
	<link href='http://www.webdesignstudiouk.com/hosting/ebn2/assets/css/xenon-skins.css' id='style-resource-8' rel='stylesheet'>
	<link href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css' rel='stylesheet'/>
	<link href='{{url("css/datetime_picker.css")}}' rel='stylesheet'/>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

	<!-- JS -->
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>	
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src='{{url("js/moment.js")}}'></script>
	<link rel="stylesheet" href='{{url("css/nouislider.css")}}'/>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	{!! Charts::assets() !!}
	<script src='{{url("js/nouislider.js")}}'></script>

	<style>
		table thead {
			background-color: #fff;
		}
		nav.navbar .navbar-nav li active>a {
			background-color: #A6CE39;
			color: #fff;
		}
	</style>


	<script>
	function prospectCount($t, $v){
		if($v!=0){
			$.ajax({
				type:'POST',
				url:'{{route("ajax.prospectCount")}}',
				data:'type='+$t+'&campaign='+$v,
				success:function(data){
					if($t == 2){
						$("#clickerCount").html(data.msg);
					}else if($t == 3){
						$("#openerCount").html(data.msg);
					}
				},
				error:function(data){
					console.log(data);
				}
			});
		}
	}
	</script>
	@yield('ajax')

	<style>
	.row {
		margin-left: 0px;
		margin-right: 0px;
	}
	.nav.nav-tabs>li {
		width:100%;
	}

	.nav.nav-tabs>li.active>a {
		background-color: #A6CE39;
		color:#fff;
	}

	</style>
</head>

<body class='page-body' onload='onload()'>
	<div class='page-container'>
