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
          <table class="table table-striped">
	          	<thead class="thead-dark">
	        		<tr>
						<th colspan="7">
							Laporan Stock ({{$branch}})
							@if($start != 0 || $end != 0)
								<br>
								<label style="font-size: 18px !important;">Periode : {{format($start)}}-{{format($end)}}</label>
							@endif
						</th>
					</tr>
	        	</thead>
				<thead>
					<tr>
						<th>#</th>
						<th>Tanggal</th>
						<th>Kode Produk</th>
						<th>Varian Produk</th>
						<th>Masuk</th>
						<th>Keluar</th>
						<th>Satuan</th>
					</tr> 
				</thead>  
				<tbody> 
				@php $no = 1; @endphp
				@forelse ($stock as $s)
					<tr> 
						<th scope="row">{{ $no++ }}</th> 
						<td>{{f_datestamp($s->created_at)}}</td>
						<td>{{$s->product_code}}</td>
						<td>{{$s->variant_name}}</td>
						<td>{{$s->status=='masuk'?$s->quantity:'-'}}</td>
						<td>{{$s->status=='keluar'?$s->quantity:'-'}}</td>
						<td>{{$s->nama_stock}}</td>
					</tr>
				@empty
					<tr>
						<td colspan="4" class="text-center">
							Belum ada stok
						</td>
					</tr>
				@endforelse 
				</tbody> 
			</table>
	    </div>
	</div>
</body>
</html>