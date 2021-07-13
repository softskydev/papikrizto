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
						<th colspan="5">
							Laporan Stock ({{$branch}})
						</th>
					</tr>
	        	</thead>
				<thead>
					<tr>
						<th>#</th>
						<th>Kode Produk</th>
						<th width='30%'>Varian Produk</th>  
						<th>Stok</th>
						<th>Satuan</th>
					</tr> 
				</thead> 
				<tbody> 
				@php $no = 1; @endphp
				@forelse ($stock as $s)
					<tr> 
						<th scope="row">{{ $no++ }}</th> 
						<td>{{$s->product_code}}</td>
						<td>{{$s->variant}}</td>
						<td>{{$s->stock}}</td>
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