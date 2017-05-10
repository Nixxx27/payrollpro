<!DOCTYPE html>
<html lang="en" ng-app="fieldApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PayrollPro.PH | Online Payroll Solution">
    <meta name="author" content="Nikko Zabala | www.nikkozabala.com">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PayrollPro.PH | Online Payroll Solution</title>
    <link rel="stylesheet" type="text/css" href="{{url('public/css/payroll_pro_ph_styles.css')}} ">
    @yield('css')
    <link rel="shortcut icon" href="{{ url('public/images/icon/skyicon.ico') }}" type="image/x-icon">
</head>
<body class="no-skin">
    @if ( Auth::check() ) 
	   @include('layouts.top-header')
    
	   @include('layouts.left-menu')
    @endif
	@yield('content')	
</body>
</html>
	<script src="{{url('public/js/payroll_pro_ph_scripts.js')}}"></script>
	<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='public/payroll_themes/jquery.mobile.custom.min.js'>"+"<"+"/script>");
	</script>
@yield('js')
