<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>{{ config('app.name', 'PeerEvaluationSystem') }} | Home</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet"/>
	<link href="{{ asset('css/documentation.css') }}" rel="stylesheet" />

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>

	<style>
		pre.prettyprint{
		    background-color: #eee;
		    border: 0px;
		    margin-bottom: 60px;
		    margin-top: 30px;
		    padding: 20px;
		    text-align: left;
		}
		.atv, .str{
		    color: #05AE0E;
		}
		.tag, .pln, .kwd{
		    color: #3472F7;
		}
		.atn{
		    color: #2C93FF;
		}
		.pln{
		    color: #333;
		}
		.com{
		    color: #999;
		}
		.space-top{
		    margin-top: 50px;
		}
		.area-line{
		    border: 1px solid #999;
		    border-left: 0;
		    border-right: 0;
		    color: #666;
		    display: block;
		    margin-top: 20px;
		    padding: 8px 0;
		    text-align: center;
		}
		.area-line a{
		    color: #666;
		}
		.container-fluid{
		    padding-right: 15px;
		    padding-left: 15px;
		}
		.cover {
			background-image: url("{{ asset('img/cover3.jpg') }}"); 
		}

	</style>
</head>

<body class="components-page">
<!--
<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll" >
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display 
    <div class="navbar-header">
      <button id="menu-toggle" type="button" class="navbar-toggle">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar bar1"></span>
        <span class="icon-bar bar2"></span>
        <span class="icon-bar bar3"></span>
      </button>
    </div>

     Collect the nav links, forms, and other content for toggling 
    <div class="collapse navbar-collapse">

		<ul  class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
            @else
            <li><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="dropdown">                    
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="material-icons">person</i> {{ Auth::user()->name }}
                    <p class="hidden-lg hidden-md">Profile</p>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        {{ Form::open(['route' => 'logout', 'id' => 'logout-form', 'style' => 'display: none;'])}}
                        	{{ Form::token()}}
                        {{ Form::close() }}
                    </li>
                </ul>
            </li>
            @endif
    	</ul>

    </div><!-- /.navbar-collapse 
  </div><!-- /.container-fluid 
</nav>
-->

	<div class="page-header header-filter cover">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h1 class="title text-center">Welcome to {{ config('app.name', 'Laravel') }}</h1>
				</div>
			</div>
		</div>
	</div>

    <div class="main main-raised">
        <div class="section">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

			<!-- User Type Selection -->
			<div class="tim-row tim-row-first" id="usertype">
				<h2 class="text-center">Which user you are?</h2>
				<legend></legend>
				<div class="row">
					<div class="col text-center">
						<div class="btn-group btn-group-lg">
							<a href="/login/lecturer" class="btn btn-primary filter-button">Lecturer</a> 
						</div> 
						<div class="btn-group btn-group-lg">	
							<a href="/login/student" class="btn btn-primary filter-button">Student</a>
						</div> 
					</div>
				</div>            
			</div>

			</div> <!-- end container -->
		 </div> <!--  end col-md-8 -->
	 </div> <!-- end row -->
 </div> <!-- end first container-->
</div> <!-- end section -->

</body>
	<!--   Core JS Files   -->
	<script src="{{ asset('js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('js/chartist.min.js') }}"></script>

	<!--  Notifications Plugin    -->
	<script src="{{ asset('js/bootstrap-notify.js') }}"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="{{ asset('js/material-dashboard.js') }}"></script>

</html>
