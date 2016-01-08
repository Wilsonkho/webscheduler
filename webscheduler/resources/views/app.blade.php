<!DOCTYPE html>
<html lang="en">
<head>
	
	<link rel='stylesheet' href='/fullcalendar/dist/fullcalendar.css' />
	<link rel="stylesheet" href="/jquery-ui-1.11.4.custom/jquery-ui.css">

	<link rel='stylesheet' href='/jquery.timepicker.css' />


	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<!-- 	// <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	// <script src='/jquery/jquery-ui.custom.min.js'></script> -->

	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src='/jquery.timepicker.min.js'></script>

	<script src='/moment/min/moment.min.js'></script>
	<script src='/fullcalendar/dist/fullcalendar.js'></script>
	<script src='/fullcalendar/dist/gcal.js'></script>


	@yield('Scripts')


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web Scheduler</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Web Scheduler</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::check())							
					<li><a href="{{ url('/dayOff') }}">Request Days Off</a></li>
					@if ($user->position == 'Manager')
					<li><a href="{{ url('/summary') }}">Summary</a></li>			
					<li><a href="{{ url('/employees') }}">Manage Employees</a></li>
					@endif
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

</body>
</html>
