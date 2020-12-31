<!DOCTYPE html>
<html>
<head>
	<title>@yield('title','My laravel store')</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lumen/bootstrap.min.css" integrity="sha384-GzaBcW6yPIfhF+6VpKMjxbTx6tvR/yRd/yJub90CqoIn2Tz4rRXlSpTFYMKHCifX" crossorigin="anonymous">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="{{asset('/admin/css/main.css')}}">



</head>
<body>

		@include('admin.partials.nav')
		@if(\Session::has('message'))
		@include('admin.partials.message')
		@endif


			<div class="container wrapper">
				@yield('content')
 

			</div>

	     @include('admin.partials.footer')

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	@stack('scripts')

<!--bostrap min--->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="{{asset('admin/js/main.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
        <script type="text/javascript" src="jscript/graph.js"></script>

</body>
</html>