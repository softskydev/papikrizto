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
					<h4 class="box-title">Detail Request Stok </h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('request.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('request.update' , $detail->id) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
                            <div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Varian Produk</label>
								<div class="col-sm-10">
									<input type="hidden" name="variant_id" value="{{$variant->id}}">
									<input type="text" disabled="" readonly="" class="form-control" value="{{$variant->variant_name}}">
								</div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Stok</label>
								<div class="col-sm-10">
									<input type="number" name="stock" class="form-control" placeholder="Stok" value="{{$detail->stock}}" readonly="">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Satuan Produk</label>
								<div class="col-sm-10">
									<input type="hidden" name="product_stock_id" value="{{$detail->product_stock_id}}">
									<select class="form-control" disabled="">
										@foreach($product_stock_data AS $product_stock)
										<option value="{{$product_stock->id}}" {{$product_stock->id==$detail->product_stock_id?"selected":""}}>{{$product_stock->nama_stock}}</option>
										@endforeach
									</select>
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Harga Satuan</label>
								<div class="col-sm-10">
									<input type="number" name="price" class="form-control" placeholder="Harga Satuan">
                                </div>
							</div>
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('request.index') }}"> Cancel </a>
                                    <button class="btn btn-success" type="submit"> Konfirmasi</button>
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
