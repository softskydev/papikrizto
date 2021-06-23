<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home</title>
	<link rel="stylesheet" href="/app-assets/styles/style.min.css">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="/app-assets/plugin/waves/waves.min.css">

</head>

<body>

<div id="single-wrapper">
	<form action="{{action('LoginController@admin_process')}}" class="frm-single" method="post">
		@csrf
		<div class="inside">
			<div class="title">Tanam-Tanam <strong>Ubi</strong></div>
			<!-- /.title -->
			<div class="frm-title">Login Admin</div>
			<!-- /.frm-title -->
			<div class="frm-input"><input type="text" placeholder="Username" name="username" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>
			<!-- /.frm-input -->
			<div class="frm-input"><input type="password" placeholder="Password" name="password" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>
			<!-- /.clearfix -->
			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
			<div class="frm-footer">NinjaAdmin © 2016.</div>
			<!-- /.footer -->
		</div>
		<!-- .inside -->
	</form>
	<!-- /.frm-single -->
</div><!--/#single-wrapper -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/app-assets/script/html5shiv.min.js"></script>
		<script src="/app-assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="/app-assets/scripts/jquery.min.js"></script>
	<script src="/app-assets/scripts/modernizr.min.js"></script>
	<script src="/app-assets/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="/app-assets/plugin/nprogress/nprogress.js"></script>
	<script src="/app-assets/plugin/waves/waves.min.js"></script>

	<script src="/app-assets/scripts/main.min.js"></script>
</body>
</html>