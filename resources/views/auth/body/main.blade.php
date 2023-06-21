<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login</title>
	<!-- core:css -->
	<link rel="stylesheet" href="{{asset('backend')}}//vendors/core/core.css">
	<!-- endinject -->
  <!-- plugin css for this page -->
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="{{asset('backend')}}//fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{asset('backend')}}//vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="{{asset('backend')}}//css/demo_1/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{asset('backend')}}//images/favicon.png" />
</head>
<body>
	<div class="main-wrapper">
		@yield('body')
	</div>

	<!-- core:js -->
	<script src="{{asset('backend')}}//vendors/core/core.js"></script>
	<!-- endinject -->
	<!-- inject:js -->
	<script src="{{asset('backend')}}//vendors/feather-icons/feather.min.js"></script>
	<script src="{{asset('backend')}}//js/template.js"></script>
	<!-- endinject -->
</body>
</html>