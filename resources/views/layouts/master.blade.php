<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- pagination & filter & search -->
<!-- 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css"/>
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->


    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet"  href="{{asset('assets/css/bootstrap.min.css')}}">
  	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/simple-sidebar.css')}}">
  	<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
  	
  	<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  	<!-- <script scr="{{asset('doc/js/jq.min.js')}}"></script> -->
  	<script scr="{{asset('assets/js/popper.js')}}"></script>
  	<!-- <script scr="{{asset('assets/js/boutstrap.min.js')}}"></script> -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
  	<style type="text/css">
  		.dropdown-menu{
  			top: 118%;
  			left: 8px;
  		}
  		body{
  			height: 2000px;
  		}
      #sidebar-wrapper .list-group>ul{
        list-style: none;
        padding: 0px;
        margin: 0px;
      }
      #sidebar-wrapper .list-group>ul>.btn{
        border-radius: 0px;
      }
  	</style>

</head>
<body>

	@include('layouts.header')
  @yield('content')

</body>
</html>