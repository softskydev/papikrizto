@extends('main')

@section('title')
Data Transaksi | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

 		<div class="col-xs-12">
			<div class="invoice-box">
				<table width="100%">
					<tr>
						<td colspan="3" style="border-bottom: 1px solid #e1e1e1">
							<h2 style="margin: 0px;">{{$detail->branch}} Invoice</h2>
						</td>
					</tr>
					<tr class="top">
						<td>
							<table>
								<tr>									
									<td>Nomor Transaksi</td>
									<td>:</td>
									<td><b>#{{$detail->transaction_no}}</b></td>
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
						<td></td>
						<td>
							<table>
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
					
					<tr class="heading">
						<td width="40%">
							Item
						</td>
						<td class="text-center">
							Quantity
						</td>
						<td class="text-right">
							Price
						</td>
					</tr>
					@foreach($item AS $i)
					<tr class="item">
						<td>
							{{$i->name}}
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
						<td colspan="2" class="text-right">Total : </td>
						
						<td>
						   {{rupiah($detail->total)}}
						</td>
					</tr>
				</table>
				<div class="text-right margin-top-20">
					<ul class="list-inline">
						<li><button type="button" class="btn btn-primary waves-effect waves-light"><i class='fa fa-print'></i> Print</button></li>
						<li><a href="{{route('transaction.index')}}" class="btn btn-default waves-effect waves-light"><i class='fa fa-chevron-left'></i> Kembali</a></li>
					</ul>
				</div>
			</div>
			<!-- /.invoice-box -->
		</div>
		<!-- /.col-xs-12 -->       
    
        </div>
		
		<!-- /.row -->		
        @include('footer')
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->

@endsection
