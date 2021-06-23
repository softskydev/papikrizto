@extends('main')

@section('title')
Data Transaksi | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Transaksi</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('transaction.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No.</th>
								<th>No. Transaksi</th>
								<th width='30%'>Cabang</th>  
								<th>Tanggal</th> 
								<th>Total</th>
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($data as $transaction)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{$transaction->transaction_no}}</td>
								<td>{{$transaction->name}}</td>
								<td>{{format($transaction->date)}}</td>
								<td>{{rupiah($transaction->total)}}</td>
								<td>
									<a class="btn btn-xs btn-rounded btn-info" href="{{ route('transaction.show' , $transaction->id) }}"> 
										<i class="menu-icon fa fa-pencil "> </i> Lihat Invoice 
									</a>
									
									<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $transaction->id }}')" > 
										<i class="menu-icon fa fa-trash "> </i> Hapus  
									</button>
								</td> 
							</tr> 
						@empty
							<tr>
								<td colspan="4" class="text-center">
									Belum ada Transaksi
								</td>
							</tr>
						@endforelse 
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
<script src="{{ url('js/transaction/transaction.js') }}"></script>
@endsection