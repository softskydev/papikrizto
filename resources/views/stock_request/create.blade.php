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
					<h4 class="box-title">{{(Session::get('branch_id')==1?'Tambah Stok':'Request Stok')}}</h4>
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
						<form class="form-horizontal" action="{{ route('stock.store') }}" method="POST">
                        @csrf
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
									<input type="number" name="stock" class="form-control" placeholder="Stok" required="">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Satuan Produk</label>
								<div class="col-sm-10">
									<select class="form-control" name="product_stock_id">
										@foreach($product_stock_data AS $product_stock)
										<option value="{{$product_stock->id}}">{{$product_stock->nama_stock}}</option>
										@endforeach
									</select>
                                </div>
							</div>
							@if(Session::get('branch_id') == 1)
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Harga per Satuan</label>
								<div class="col-sm-10">
									<input type="number" name="price" class="form-control" placeholder="Harga Satuan" required="">
                                </div>
							</div>
                            <hr>
                            @endif

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
		
		@include('footer')
		<!-- /.row -->		
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->

@endsection

@section('js')
<script type="text/javascript">
	function set_variant(){
		var branch_id = $('#branch').val();

        $.ajax({
            type: "GET", 
            url: "/stock/json_variant/"+branch_id,
            dataType: "json",
            beforeSend: function(e) {
              if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
              }
            },
            success: function(response){
                $('#variant').empty();
                $('#variant').append("<option value='0'>-Pilih Varian Produk-</option>");
                $.each(response, function(i, variant){
                    var html = "<option value='"+variant['id']+"'>"+variant['variant_name']+"</option>";
                    $('#variant').append(html);
                });

                set_price(no);
            },
            error: function (xhr, ajaxOptions, thrownError) { 
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); 
            }
        });
	}
</script>
@endsection