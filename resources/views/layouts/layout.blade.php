<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Regional Trial Court Library</title>
	<link href="{{ asset('css/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="{{ asset('css/datatable-styling.css') }}" rel="stylesheet">
	<link href="{{ asset('css/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/css/dropzone.css') }}" rel="stylesheet">
	<link href="{{ asset('css/css/styles.css') }}" rel="stylesheet">


	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->	

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
					<div class="row">
				<div class="col-md-1">
					<img class="img-responsive" src="{{ asset('images/angeles-logo.png') }}" style="width: 60px;">
				</div>
				<div class="col-md-3">
					<a class="navbar-brand" href="#">REGIONALTRIALCOURTLIBRARY</a>
				</div>
			 </div>
				
					
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">@yield('user')</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<!-- <li><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li> -->
			<li><a href="{{ route('admin.index') }}"><em class="fa fa-calendar">&nbsp;</em> Inventory</a></li>
			<li><a href="{{ route('admin.users') }}"><em class="fas fa-user">&nbsp;</em> Users</a></li>
			<li><a href="{{ route('admin.transactions') }}"><em class="fas fa-exchange-alt">&nbsp;</em> Transactions</a></li>
			<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
			<form id="logout-form" action="{{ 'App\Admin' == Auth::getProvider()->getModel() ? route('admin.logout') : route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="{{ URL::previous() }}">
					Back
				</a></li>
				<li class="active">@yield('page')</li>
				@yield('liSection')
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">@yield('header')</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
		 @yield('content')

		</div><!--/.row-->
	</div>	<!--/.main-->
	  

	<script src="{{ asset('js/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('js/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/js/dropzone.js') }}"></script>
	<script src="{{ asset('js/js/chart.min.js') }}"></script>
	<script src="{{ asset('js/js/chart-data.js') }}"></script>
	<script src="{{ asset('js/js/easypiechart.js') }}"></script>
	<script src="{{ asset('js/js/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	@yield('customScript')
	<script src="{{ asset('js/js/custom.js') }}"></script>
	
</body>
</html>
