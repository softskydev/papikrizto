@extends('main')

@section('title')
Laporan Neraca | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <form class="col-lg-12 col-xs-12" method="post" action="{{action('ReportController@neraca_print')}}">
        	@csrf
				<div class="box-content">
					<h4 class="box-title">Neraca</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<hr>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-bordered">
						<tr>
							<td width="50%">
								<table width="100%" class="table table-striped">
									<tr>
										<td>Kas</td>
										<td>{{rupiah($kas)}}</td>
									</tr>
									<tr>
										<td>Piutang</td>
										<td>{{rupiah($piutang)}}</td>
									</tr>
									<tr>
										<td>Stok</td>
										<td>{{rupiah($stock)}}</td>
									</tr>
									<tr>
										<td>Biaya dibayar di muka</td>
										<td>Rp.<input type="number" name="biaya" class="form-control input-sm" value="0" style="width:150px;float:right;"></td>
									</tr>
								</table>
							</td>
							<td width="50%">
								<table width="100%" class="table table-striped">
									<tr>
										<td>Hutang Bank</td>
										<td>{{rupiah($hutang_bank)}}</td>
									</tr>
									<tr>
										<td>Hutang Pihak Ketiga</td>
										<td>{{rupiah($hutang_pihak_ketiga)}}</td>
									</tr>
									<tr>
										<td>Hutang Pemegang Saham</td>
										<td>{{rupiah($hutang_pemegang_saham)}}</td>
									</tr>
									<tr>
										<th>Total Hutang</th>
										<th>{{rupiah($hutang)}}</th>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<label>Aset</label>
								<table width="100%" class="table table-striped">
									<tr>
										<th>Barang</th>
										<th>Jumlah</th>
										<th>Harga</th>
										<th>Total</th>
									</tr>
									@foreach($asset AS $a)
									<tr>
										<td>{{$a->name}}</td>
										<td>{{$a->quantity}}</td>
										<td>{{rupiah($a->price)}}</td>
										<td>{{rupiah($a->quantity*$a->price)}}</td>
									</tr>
									@endforeach
								</table>
							</td>
							<td>
								<table width="100%" class="table table-striped">
									<tr>
										<td>Laba Ditahan</td>
										<td>Rp.<input type="number" name="labaditahan" class="form-control input-sm" value="0" style="width:150px;float:right;"></td>
									</tr>
									<tr>
										<td>Laba Berjalan</td>
										<td>Rp.<input type="number" name="lababerjalan" class="form-control input-sm" value="0" style="width:150px;float:right;"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div>
				<!-- /.box-content -->
				<div class="text-right">
					<button type="submit" class="btn btn-primary waves-effect waves-light"><i class='fa fa-download'></i> Download PDF</button>
				</div>
			</form>
    
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