<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		*{
			font-size: 14px;
		}
		.thead-dark{
			font-size: 24px !important;
		}
		table.noborder,table.noborder *{
			border: none !important;
		}
		.total{
			font-size: 16px !important;
		}
	</style>
</head>
<body>
	<div class="container">
        <div class="row">
          <table class="table table-bordered">
	          	<thead class="thead-dark">
	        		<tr>
						<th colspan="2">
							Laporan Neraca
						</th>
					</tr>
	        	</thead>
				<tbody>
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
										<td>{{rupiah($biaya)}}</td>
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
							<td width="50%">
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
							<td width="50%">
								<table width="100%" class="table table-striped">
									<tr>
										<td>Laba Ditahan</td>
										<td>{{rupiah($labaditahan)}}</td>
									</tr>
									<tr>
										<td>Laba Berjalan</td>
										<td>{{rupiah($lababerjalan)}}</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
			</table>
	    </div>
	</div>
</body>
</html>