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
						<th colspan="2">
							Laporan Laba Rugi ({{$branch}})
						</th>
					</tr>
	        	</thead>
				<tbody>
					<tr>
						<td>Penjualan</td>
						<td class="text-right">{{rupiah($penjualan)}}</td>
					</tr>
					<tr>
						<td>Pendapatan Lain</td>
						<td class="text-right">{{rupiah($pendapatanlain)}}</td>
					</tr>
					<tr>
						<th>Laba Kotor</th>
						@php $labakotor = $penjualan + $pendapatanlain @endphp
						<td class="text-right">{{rupiah($labakotor)}}</td>
					</tr>
					<tr>
						<td>Biaya</td>
						<td class="text-right">{{rupiah($biaya)}}</td>
					</tr>
					<tr>
						<th>Laba Sebelum Tax</th>
						@php
							$labasebelumtax = $labakotor - $biaya;
						@endphp
						<td class="text-right">{{rupiah($labasebelumtax)}}</td>
					</tr>
					<tr>
						<td>Interest</td>
						<td class="text-right">{{rupiah($interest)}}</td>
					</tr>
					<tr>
						<td>Tax</td>
						<td class="text-right">{{rupiah($tax)}}</td>
					</tr>
					<tr>
						<th>Laba Bersih</th>
						@php
							$lababersih = $labasebelumtax - ($interest + $tax);
						@endphp
						<td class="text-right">{{rupiah($lababersih)}}</td>
					</tr>
				</tbody>
			</table>
	    </div>
	</div>
</body>
</html>