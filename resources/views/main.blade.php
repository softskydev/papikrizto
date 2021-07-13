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

	<!-- DateRangepicker -->
	<link rel="stylesheet" href="{{url('app-assets/plugin/daterangepicker/daterangepicker.css')}}">

    <script src="{{ url('app-assets/scripts/jquery.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
	<script>
		const global_url = '{{ url("") }}';
		const token = '{{ csrf_token() }}';
	</script>

	{{-- Datatatable --}}
	<link rel="stylesheet" href="{{url('app-assets/plugin/datatables/media/css/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('app-assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css')}}">

	<!-- Datepicker -->
	<link rel="stylesheet" href="{{url('app-assets/plugin/datepicker/css/bootstrap-datepicker.min.css')}}">
</head>
<body>
<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo"><i class="ico ti-money"></i>Admin ({{Session::get('branch_name')}})</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li {!!(Request::segment(1)=='dashboard'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ url('/dashboard') }}"><i class="menu-icon ti-dashboard"></i><span>Dashboard</span></a>
				</li>
				@if(Session::get('branch_id') == 1)
				<li {!!(Request::segment(1)=='branch'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('branch.index') }}"><i class="menu-icon ti-layout-grid2"></i><span>Cabang</span></a>
				</li>
				<li {!!(Request::segment(1)=='admin'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('admin.index') }}"><i class="menu-icon ti-user"></i><span>Admin</span></a>
				</li>
                <li {!!(Request::segment(1)=='product_stock'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('product_stock.index') }}"><i class="menu-icon ti-import"></i><span>Product Satuan</span></a>
				</li>
				@endif
				<li {!!(Request::segment(1)=='variant'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('variant.index') }}"><i class="menu-icon ti-gift"></i><span>Product Variant</span></a>
				</li>
				<li {!!(Request::segment(1)=='stock'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('stock.index') }}"><i class="menu-icon ti-package"></i><span>Stock</span></a>
				</li>
				<li {!!(Request::segment(1)=='sales'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('sales.index') }}"><i class="menu-icon ti-comments-smiley"></i><span>Sales</span></a>
				</li>
				<li {!!(Request::segment(1)=='transaction'?'class="current active"':'')!!}>
					<a class="waves-effect" href="{{ route('transaction.index') }}"><i class="menu-icon ti-receipt"></i><span>Transaksi</span></a>
				</li>
				@if(Session::get('branch_id') == 1)
				<li {!!((Request::segment(1)=='account')||(Request::segment(1)=='asset')||(Request::segment(1)=='hutangpiutang')?'class="current active"':'')!!}>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-money"></i><span>Finance</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('account.index')}}">Akun</a></li>
						<li><a href="{{route('asset.index')}}">Aset</a></li>
						<li><a href="{{route('hutangpiutang.index')}}">Hutang/Piutang</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				<li {!!(Request::segment(1)=='report'?'class="current active"':'')!!}>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-money"></i><span>Report</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="/report/stock">Laporan Stok</a></li>
						<li><a href="/report/hutang/bank">Hutang Bank</a></li>
						<li><a href="/report/hutang/pihak_ketiga">Hutang Pihak Ketiga</a></li>
						<li><a href="/report/hutang/pemegang_saham">Hutang Pemegang Saham</a></li>
						<li><a href="/report/labarugi">Laba Rugi</a></li>
						<li><a href="/report/neraca">Neraca</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				@else
				<li {!!(Request::segment(1)=='report'?'class="current active"':'')!!}>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon ti-money"></i><span>Report</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="/report/stock">Laporan Stok</a></li>
						<li><a href="/report/labarugi">Laba Rugi</a></li>
					</ul>
					<!-- /.sub-menu js__content -->
				</li>
				@endif
			</ul>
			<div style="margin-top: 40px;"></div>
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
		<a href="#" class="ico-item ti-bell notice-alarm js__toggle_open" data-target="#notification-popup"></a>
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
	<h2 class="popup-title">Request Stock</h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			@if(Session::get('branch_id') == 1)
				@forelse($req AS $notif)
					<li>
						<a href="{{route('request.show', $notif->id)}}">
							<span class="avatar bg-primary"><i class="menu-icon ti-package"></i></span>
							<span class="name">{{$notif->branch}}</span>
							<span class="desc">Request : {{$notif->variant}} ({{$notif->stock}} {{$notif->satuan}})</span>
							{{-- <span class="time">10 min</span> --}}
						</a>
					</li>
				@empty
				<li class="text-center">Tidak ada notifikasi.</li>
				@endforelse
			@else
				@forelse($notification AS $notif)
					@if($notif->branch_id == Session::get('branch_id'))
					<li>
						<a href="{{$notif->routes}}{{$notif->source_id}}">
							<span class="avatar bg-primary"><i class="menu-icon ti-package"></i></span>
							<span class="name">{{$notif->title}}</span>
							<span class="desc">{{$notif->subtitle}}</span>
							{{-- <span class="time">10 min</span> --}}
						</a>
					</li>
					@endif
				@empty
				<li class="text-center">Tidak ada notifikasi.</li>
				@endforelse
			@endif
		</ul>
		<!-- /.notice-list -->
		<a href="{{route('request.index')}}" class="notice-read-more">Tampilkan semua <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#notification-popup -->

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

	<!-- Data Tables -->
	<script src="{{url('app-assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{url('app-assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{url('app-assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{url('app-assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>

	<!-- Datepicker -->
	<script src="{{url('app-assets/plugin/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
	{{-- <script src="{{url('app-assets/scripts/datatables.demo.min.js')}}"></script> --}}

</body>
</html>