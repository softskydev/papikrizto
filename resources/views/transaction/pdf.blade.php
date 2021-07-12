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
            <table class="table" width="100%">
            	<thead class="thead-dark">
            		<tr>
						<th colspan="3">
							{{$detail->branch}} Invoice
						</th>
					</tr>
            	</thead>
                <tbody>
                  <tr class="top">
						<td width="50%">
							<table width="100%" class="noborder">
								<tr>								
									<td>Nomor Transaksi</td>
									<td>:</td>
									<td><b>{{$detail->transaction_no}}</b></td>
								</tr>
								<tr>
									<td>Customer</td>
									<td>:</td>
									<td>
										<b>{{$detail->cust_name}}</b><br>
										{{$detail->cust_phone}}
									</td>
								</tr>
							</table>
						</td>
						<td width="50%">
							<table width="100%" class="noborder">
								<tr>									
									<td>Tanggal Transaksi</td>
									<td>:</td>
									<td>
										<b>{{format($detail->date)}}</b><br>
										{{$detail->time}}
									</td>
								</tr>	
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<table class="table table-striped">
								<thead>
									<tr class="heading">
										<th width="40%">
											Item
										</th>
										<th class="text-center">
											Quantity
										</th>
										<th class="text-right">
											Price
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($item AS $i)
									<tr class="item">
										<td>
											{{$i->variant_name}}
										</td>
										<td class="text-center">
											{{$i->quantity}} {{$i->nama_stock}}
										</td>
										<td class="text-right">
											{{rupiah($i->total)}}
										</td>
									</tr>
									@endforeach
									
									<tr class="total">
										<th colspan="2" class="text-right">Total : </th>
										
										<th class="text-right">
										   {{rupiah($detail->total)}}
										</th>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
                </tbody>
              </table>
        </div>
    </div>
</body>
</html>