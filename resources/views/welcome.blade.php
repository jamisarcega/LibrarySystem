<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Regional Trial Court Library</title>
  <link href="{{ asset('css/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link href="{{ asset('css/datatable-styling.css') }}" rel="stylesheet">
	<link href="{{ asset('css/css/datepicker3.css') }}" rel="stylesheet">
	<link href="{{ asset('css/css/dropzone.css') }}" rel="stylesheet">
	<link href="{{ asset('css/css/styles.css') }}" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
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
		 <!-- <img class="img-responsive" src="{{ asset('images/angeles-logo.png') }}" style="width: 60px;">
          <a class="navbar-brand" href="#">REGIONALTRIALCOURTLIBRARY</a> -->
          <ul class="nav navbar-nav navbar-right">
       
          </ul>
				
			</div>
		</div><!-- /.container-fluid -->
  </nav>

  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Carousel indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>   
    <!-- Wrapper for carousel items -->
    <div class="carousel-inner">
        <div class="item active">
           <center><img class="img-responsive" src="{{ asset('images/banner.png') }}" alt="First Slide"></center> 
        </div>
        <div class="item">
           <center> <img class="img-responsive" src="{{ asset('images/ed.png') }}" alt="Second Slide"></center>
        </div>
        <div class="item">
		<center> <img class="img-responsive" src="{{ asset('images/hall.jpg') }}" alt="Third Slide"></center>
        </div>
    </div>
    <!-- Carousel controls -->
    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
</div>
	<center><h1>About Us</h1>
	<h5>We’ve been building unique Community that help each other to be successful.</h5></center>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<img class="img-responsive" src="{{ asset('images/edpam.jpg') }}" >
				<br>
				<h2>Atty. Edgardo D. Pamintuan</h2>
				<p>City Mayor</p>
			</div>
			<div class="col-md-3">
				<img class="img-responsive" src="{{ asset('images/bry.jpg') }}" >
				<br>
				<h2>Atty. Bryan Matthew C. Nepomuceno</h2>
				<p>City Vice Mayor</p>
			</div>
			<div class="col-md-3">
				<img class="img-responsive" src="{{ asset('images/aguas.jpg') }}" >
				<br>
				<h2>Jericho G. Aguas</h2>
				<p>First Councilor</p>
			</div>
			<div class="col-md-3">
				<img class="img-responsive" src="{{ asset('images/edjr.jpg') }}" >
				<br>
				<h2>Edgardo D. Pamintuan, Jr.</h2>
				<p>Second Councilor</p>
			</div>
		</div>
	</div>

	<center>
		<h1>Our Vision</h1><br>
		<p>Isang pamahalaang may gawaing tama, marangal, at pinagkakatiwalaan ng taong bayan, </p><p>tapat at mabilis na
		 serbisyo at may pagkalinga sa kapwa tao, at nagbibigay ng abot kaya at kalidad </p><p>na edukasyon Isang pamayanang mapayapa at maayos, 
		 yumabong ang kalikasan at malinis na kapaligiran, at umuunlad</p><p> ang ekonomiya at kabuhayan, maging sa laranga ng pangdaigdigang kalakalan.</p>
		 <br><br>
		 <h1>Our Mission</h1><br>
		<p>Isang pamahalaang may gawaing tama, marangal, at pinagkakatiwalaan ng taong bayan, </p><p>tapat at mabilis na
		 serbisyo at may pagkalinga sa kapwa tao, at nagbibigay ng abot kaya at kalidad </p><p>na edukasyon Isang pamayanang mapayapa at maayos, 
		 yumabong ang kalikasan at malinis na kapaligiran, at umuunlad</p><p> ang ekonomiya at kabuhayan, maging sa laranga ng pangdaigdigang kalakalan.</p>
	</center>







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