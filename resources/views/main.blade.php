<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>@yield('title')</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="{{ url('app-assets/styles/style.min.css') }}">
	
	<!-- Themify Icon -->
	<link rel="stylesheet" href="{{ url('app-assets/fonts/themify-icons/themify-icons.css') }}">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="{{ url('app-assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css') }}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{ url('app-assets/plugin/waves/waves.min.css') }}">

	<!-- Percent Circle -->
	<link rel="stylesheet" href="{{ url('app-assets/plugin/percircle/css/percircle.css') }}">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="{{ url('app-assets/plugin/chart/chartist/chartist.min.css') }}">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="{{ url('app-assets/plugin/fullcalendar/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ url('app-assets/plugin/fullcalendar/fullcalendar.print.css') }}" media='print'>


	<!-- Seven Toastr -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

	<!-- Selectbox selectpicker -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

	
	<!-- SWeet alert -->
	<link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <script src="{{ url('app-assets/scripts/jquery.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script>
		const global_url = '{{ url("") }}';
		const token = '{{ csrf_token() }}';
	</script>
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo"><i class="ico ti-rocket"></i>SpaceX</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect" href="{{ url('/dashboard') }}"><i class="menu-icon ti-dashboard"></i><span>Dashboard</span></a>
				</li>
				<li>
					<a class="waves-effect" href="{{ route('product.index') }}"><i class="menu-icon ti-layout-grid2"></i><span>Product</span></a>
				</li>
                <li>
					<a class="waves-effect" href="{{ route('product_stock.index') }}"><i class="menu-icon ti-import"></i><span>Product Satuan</span></a>
				</li>
				<li>

					<a class="waves-effect" href="{{ route('stock.index') }}"><i class="menu-icon ti-package"></i><span>Stocks</span></a>
				</li>
				{{-- <li>
					<a class="waves-effect" href="{{ route('sales.index') }}"><i class="menu-icon ti-comments-smiley"></i><span>Sales</span></a>
				</li> --}}
				<li>
					<a class="waves-effect" href="{{ route('transaction.index') }}"><i class="menu-icon ti-money"></i><span>Transaction</span></a>
				</li>
			</ul>
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">{{ config('app.name') }}</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		
		<!-- /.ico-item -->
		
		<div class="ico-item">
			<i class="ti-user"></i>
			<ul class="sub-ico-item">
                <form id="do_logout" action="{{ route('logout') }}" method="POST">
				    <li><a class="" href="#" onclick="event.preventDefault();document.getElementById('do_logout').submit();" >Log Out</a></li>
                    @csrf
                </form>
			</ul>
			<!-- /.sub-ico-item -->
		</div>
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="notification-popup" class="notice-popup js__toggle" data-space="75">
	<h2 class="popup-title">Your Notifications</h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Anna William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-warning"><i class="fa fa-warning"></i></span>
					<span class="name">Update Status</span>
					<span class="desc">Failed to get available update data. To ensure the please contact us.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Michael Zenaty</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">50 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Simon</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">1 hour</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-violet"><i class="fa fa-flag"></i></span>
					<span class="name">Account Contact Change</span>
					<span class="desc">A contact detail associated with your account has been changed.</span>
					<span class="time">2 hours</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Helen 987</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Yesterday</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Denise Jenny</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">Oct, 28</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Thomas William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Oct, 27</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#notification-popup -->

<div id="message-popup" class="notice-popup js__toggle" data-space="75">
	<h2 class="popup-title">Recent Messages<a href="#" class="pull-right text-danger">New message</a></h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Harry Halen</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Thomas Taylor</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Helen Candy</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Anna Cavan</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 hour ago</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-success"><i class="fa fa-user"></i></span>
					<span class="name">Jenny Betty</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 day ago</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Denise Peterson</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 year ago</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#message-popup -->
@yield('content')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="{{ url('app-assets/script/html5shiv.min.js') }}"></script>
		<script src="{{ url('app-assets/script/respond.min.js') }}"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	@yield('js')


	@if ( Session::get('status') )
		<script>
			toastr.{{ Session::get('status') }}("{{ Session::get('msg') }}");
		</script>
	@endif
	@if ( @$_GET['del_suc'] )
		<script>
			toastr.error("Data berhasil di hapus");
		</script>
	@endif
	<script src="{{ url('app-assets/scripts/modernizr.min.js') }}"></script>
	<script src="{{ url('app-assets/plugin/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('app-assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ url('app-assets/plugin/nprogress/nprogress.js') }}"></script>
	<script src="{{ url('app-assets/plugin/waves/waves.min.js') }}"></script>
	<!-- Sparkline Chart -->
	<script src="{{ url('app-assets/plugin/chart/sparkline/jquery.sparkline.min.js') }}"></script>
	<script src="{{ url('app-assets/scripts/chart.sparkline.init.min.js') }}"></script>

	<!-- Percent Circle -->
	<script src="{{ url('app-assets/plugin/percircle/js/percircle.js') }}"></script>

	<!-- Google Chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js') }}"></script>

	<!-- Chartist Chart -->
	<script src="{{ url('app-assets/plugin/chart/chartist/chartist.min.js') }}"></script>
	<script src="{{ url('app-assets/scripts/jquery.chartist.init.min.js') }}"></script>

	<!-- FullCalendar -->
	<script src="{{ url('app-assets/plugin/moment/moment.js') }}"></script>
	<script src="{{ url('app-assets/plugin/fullcalendar/fullcalendar.min.js') }}"></script>
	<script src="{{ url('app-assets/scripts/fullcalendar.init.js') }}"></script>

	<script src="{{ url('app-assets/scripts/main.min.js') }}"></script>
</body>
</html>