@extends('main')

@section('title')
Data Jenis Stock | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Jenis Stock Anda</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('product_stock.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped data-tables">
						<thead>
							<tr>
								<th>#</th>
								<th width='70%'>Nama Satuan</th> 
								<th width='15%'>Stock Rangkap </th> 
								<th width='15%'>Per Satuan</th> 
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($data as $product)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{ $product->nama_stock }}</td>
								<td>{{ ($product->stock_id != 0) ? $product->satuan : ' -- '  }}</td>
								<td>{{ ($product->peritem != 0 ) ? $product->peritem : ' -- '  }}</td>
								<td>
									@if($product->id == 1) 
										Tidak bisa di Edit / Hapus
									@else
									<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('product_stock.show' , ['product_stock' => $product->id ]) }}"> 
										<i class="menu-icon fa fa-pencil "> </i> Edit 
									</a>
									
									<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $product->id }}')" > 
										<i class="menu-icon fa fa-trash "> </i> Hapus  
									</button>
									@endif
								</td> 
							</tr> 
						@empty
							<tr>
								<td colspan="4" class="text-center">
									Belum ada Produk
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
<script src="{{ url('js/product_stock/product_stock.js') }}"></script>
@endsection