@extends('main')

@section('title')
Data stock | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Edit Stok Anda </h4>
                    <p> Tambahkan stock anda untuk dikelola </p>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('stock.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('stock.update' , $detail->id) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
                                <div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Nama Produk Anda</label>
									<div class="col-sm-10">
										<select class="form-control" name="product_id">
											@foreach($product_data AS $product)
											<option value="{{$product->id}}" {{$detail->product_id==$product->id?"selected":""}}>{{$product->name}}</option>
											@endforeach
										</select>
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Satuan Produk</label>
									<div class="col-sm-10">
										<select class="form-control" name="product_stock_id">
											@foreach($product_stock_data AS $product_stock)
											<option value="{{$product_stock->id}}"  {{$detail->product_stock_id==$product_stock->id?"selected":""}}>{{$product_stock->nama_stock}}</option>
											@endforeach
										</select>
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Harga Satuan</label>
									<div class="col-sm-10">
										<input type="number" name="price" class="form-control" placeholder="Harga Satuan" value="{{$detail->price}}">
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Stok</label>
									<div class="col-sm-10">
										<input type="number" name="stock" class="form-control" placeholder="Stok" value="{{$detail->stock}}">
	                                </div>
								</div>
	                            <hr>
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('stock.index') }}"> Cancel </a>
                                    <button class="btn btn-success" type="submit"> Simpan </button>
                                </div>
                            </div>
							
						</form>
					</div>
					
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
