@extends('main')

@section('title')
Edit Satuan Stock | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Edit Satuan Stock</h4>
                    <p> Tambahkan Stock anda untuk dikelola </p>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('product_stock.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
                    @php
                        $check  = ($detail->stock_id == 0) ? ' ' : 'checked';
                    @endphp
						<form class="form-horizontal" action="{{ route('product_stock.update' , ['product_stock' => $detail->id]) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Nama Stock</label>
								<div class="col-sm-10">
									<input type="text" value="{{ $detail->nama_stock }}" name="nama_stock" class="form-control" id="inp-type-1" placeholder="Per Box , Per Dus , Per Renteng">
                                </div>
							</div>

							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left"></label>
								<div class="checkbox col-sm-10">
									<input type="checkbox" {{ $check }} id="chxbox" onchange="prevList()"> <label for="chxbox">Rangkap Stock?</label>
								</div>
							</div>
							
							<div id="more_stock" >
								<div class="form-group" >
									<label for="inp-type-1" class="col-sm-2 pull-left">List Stock</label>
									<div class="col-sm-10">
										<select name="satuan_id" id="satuan_id">
											<option value="0" disabled selected> Pilih Stock </option>
											@foreach ($current_stock as $product)
                                                <option @php echo ($product->id == $detail->stock_id)  ? 'selected' : ''; @endphp value="{{ $product->id }}">{{ $product->nama_stock }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Satuan Stock per Item tersebut</label>
									<div class="col-sm-10">
										<input type="number" value="{{ $detail->peritem }}" min='1' name="per_stock" class="form-control" id="inp-type-1" >
									</div>
								</div>
							</div>

							
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('product_stock.index') }}"> Cancel </a>
                                    <button class="btn btn-success" type="submit"> Simpan </button>
                                </div>
                            </div>
							
						</form>
					</div>
					
				</div>
				<!-- /.box-content -->
			</div>
    
        </div>
		
		@include('footer')
		<!-- /.row -->		
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->

@endsection
@section('js')
<script src="{{ url('js/stock/create.js') }}"></script>
@endsection