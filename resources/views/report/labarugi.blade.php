@extends('main')

@section('title')
Laporan Laba Rugi | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Laba Rugi</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<hr>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped">
						<tbody>
							<tr>
								<td>Penjualan</td>
								<td class="text-right">{{rupiah($penjualan)}}</td>
							</tr>
							<tr>
								<td>HPP</td>
								<td class="text-right">{{rupiah(0)}}</td>
							</tr>
							<tr>
								<th>Laba Kotor</th>
								<th class="text-right">{{rupiah($penjualan)}}</th>
							</tr>
							<tr>
								<td>Biaya</td>
								<td class="text-right">{{rupiah(0)}}</td>
							</tr>
							<tr>
								<th>Laba Sebelum Tax</th>
								<th class="text-right">{{rupiah(0)}}</th>
							</tr>
							<tr>
								<td>Interest</td>
								<td class="text-right">{{rupiah(0)}}</td>
							</tr>
							<tr>
								<td>Tax</td>
								<td class="text-right">{{rupiah(0)}}</td>
							</tr>
							<tr>
								<td>Pendapatan Lain</td>
								<td class="text-right">{{rupiah(0)}}</td>
							</tr>
							<tr>
								<th>Laba Bersih</th>
								<th class="text-right">{{rupiah($penjualan)}}</th>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- /.box-content -->
			</div>
    
        </div>
		
		<!-- /.row -->		
		@include('footer')
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
@endsection

@section('js')
<script src="{{ url('js/account/account.js') }}"></script>
@endsection