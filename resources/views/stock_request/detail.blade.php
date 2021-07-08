@extends('main')

@section('title')
Data Stok | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Detail Stok Produk</h4>

					<a href="{{ route('stock.index') }}" class="btn btn-xs btn-rounded btn-default"><i class="menu-icon fa fa-chevron-left"></i> Kembali</a>
					<a href="{{ route('stock.create', $variant_id) }}" class="btn btn-xs btn-rounded btn-primary"><i class="menu-icon fa fa-plus"></i> {{(Session::get('branch_id')==1?'Tambah Stok':'Request Stok')}}</a>

					<hr>

					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>

					<!-- /.dropdown js__dropdown -->

					<table class="table table-striped data-tables">
						<thead>
							<tr>
								<th>#</th>
								<th>Kode Produk</th>  
								<th width='30%'>Varian Produk</th>
								<th>Harga Satuan</th>
								<th>Stok</th>
								<th>Satuan</th>
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($detail as $stock)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{$stock->product_code}}</td>
								<td>{{$stock->variant}}</td>
								<td>{{rupiah($stock->price)}}</td>
								<td>{{$stock->stock}}</td>
								<td>{{$stock->product_stock}}</td>
								<td>
									<a class="btn btn-xs btn-rounded btn-warning" href="{{route('stock.show', $stock->id)}}"> 
										<i class="menu-icon fa fa-edit "> </i> Edit Stok
									</a>
									<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $stock->id }}')"><i class="menu-icon fa fa-trash"></i> Hapus Stok</button>
								</td> 
							</tr>
						@empty
							<tr>
								<td colspan="4" class="text-center">
									Stok kosong
								</td>
							</tr>
						@endforelse 
						</tbody> 
					</table>
					</div>

					<table class="table table-striped">
						
						<tbody> 
						
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
<script src="{{ url('js/stock/stock.js') }}"></script>
@endsection