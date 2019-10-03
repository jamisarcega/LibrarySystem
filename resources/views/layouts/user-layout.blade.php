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
		@if (\Session::has('error'))
    <div class="col-md-12">
        <div class="alert bg-danger" role="alert"><em class="fas fa-lg fa-exclamation-triangle">
            &nbsp;</em> {!! \Session::get('error') !!} <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    </div>
    @endif
    @if (\Session::has('success'))
    <div class="col-md-12">
        <div class="alert bg-success" role="alert"><em class="far fa-lg fa-check-square">
            &nbsp;</em> {!! \Session::get('success') !!} <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    </div>
    @endif
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<!-- <li><a href="index.html"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li> -->
			<li><a href="{{ route('user.books') }}"><em class="fa fa-calendar">&nbsp;</em> Library</a></li>
			<li><a href="{{ route('user.history') }}"><em class="fas fa-history">&nbsp;</em> Borrow History</a></li>
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;<span> Sub Item 3
					</a></li>
				</ul>
			</li> -->
			<li><a href="" data-toggle="modal" data-target="#userModal"><em class="fas fa-user-alt">&nbsp;</em> Account Settings</a></li>
			<li><a href="{{ route('auth.logout') }}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
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
	<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Account Details</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('user.userUpdate') }}" method="POST">
            @csrf
        	<label for="name">First Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->first_name }}" required>
			<label for="middle_name">Middle Name</label>
            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ Auth::user()->middle_name }} " required>
			<label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ Auth::user()->last_name }}" required>
			<label for="extension">Extension Name</label>
            <input type="text" name="extension" id="extension" class="form-control" value="{{ Auth::user()->extension }}" required>
			
			<label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}" required>
			<label for="current">Current Password</label>
            <input type="password" name="current" id="current" class="form-control" >
			<label for="new">New Password</label>
            <input type="password" name="new" id="current" class="form-control" >
			<label for="new">Retype New Password</label>
            <input type="password" name="new" id="new" class="form-control" >
			<br><br>
			<button class="btn btn-success form-control">Save Changes</button>
        
		</form> 
      </div>
    </div>
  </div>
</div>

	<script src="{{ asset('js/js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ asset('js/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/js/chart.min.js') }}"></script>
	<script src="{{ asset('js/js/chart-data.js') }}"></script>
	<script src="{{ asset('js/js/easypiechart.js') }}"></script>
	<script src="{{ asset('js/js/bootstrap-datepicker.js') }}"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	@yield('customScript')
	<script src="{{ asset('js/js/custom.js') }}"></script>
	
</body>
</html>
