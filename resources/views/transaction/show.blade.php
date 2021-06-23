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
				<table>
					<tr class="top">
						<td colspan="2">
							<table>
								<tr>									
									<td>
										Cabang : <b>{{$detail->branch}}</b><br>
										Nomor Transaksi : <b>#{{$detail->transaction_no}}</b><br>
										Tanggal : <b>{{format($detail->date)}}</b><br>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					
					{{-- <tr class="information">
						<td colspan="2">
							<table>
								<tr>
									<td>
										Next Step Webs, Inc.<br>
										12345 Sunny Road<br>
										Sunnyville, TX 12345
									</td>
									
									<td>
										Acme Corp.<br>
										John Doe<br>
										john@example.com
									</td>
								</tr>
							</table>
						</td>
					</tr> --}}
					
					<tr class="heading">
						<td>
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
						<td colspan="2"></td>
						
						<td>
						   Total: {{rupiah($detail->total)}}
						</td>
					</tr>
				</table>
				<div class="text-right margin-top-20">
					<ul class="list-inline">
						<li><button type="button" class="btn btn-primary waves-effect waves-light"><i class='fa fa-print'></i> Print</button></li>
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
