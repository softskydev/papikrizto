@extends('main')

@section('title')
Data Cabang ({{$product}}) | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Cabang</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('stock.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th width='35%'>Nama Produk</th>  
								<th>Stok</th> 
								<th>Satuan</th> 
								<th>Harga per satuan</th>
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($data as $stock)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{$stock->product}}</td>
								<td>{{$stock->stock}}</td>
								<td>{{$stock->product_stock}}</td>
								<td>{{$stock->price}}</td>
								<td>
									<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('stock.show' , ['stock' => $stock->id ]) }}"> 
										<i class="menu-icon fa fa-pencil "> </i> Edit 
									</a>
									
									<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $stock->id }}')" > 
										<i class="menu-icon fa fa-trash "> </i> Hapus  
									</button>
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
<script src="{{ url('js/product/product.js') }}"></script>
@endsection