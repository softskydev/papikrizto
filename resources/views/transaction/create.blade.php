@extends('main')

@section('title')
Data Transaction | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Tambah Transaction</h4>
                    <p> Tambahkan transaction anda untuk dikelola </p>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('transaction.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        	<div class="col-md-4">
                        		<label>Cabang : </label>
								<select class="form-control" name="branch_id" required="">
									@foreach($branch AS $b)
									<option value="{{$b->id}}">{{$b->name}}</option>
									@endforeach
								</select>
                        	</div>
                        	<div class="col-md-4">
                        		<label>Nomor Transaksi : </label>
                                <div class="input-group margin-bottom-20">
									<div class="input-group-btn"><label for="ig-1" class="btn btn-default">SO/</label></div>
									<!-- /.input-group-btn -->
									<input id="ig-1" type="text" name="transaction_no" class="form-control" placeholder="Nomor Transaksi" value="{{$transaction_no}}" required="">
								</div>
                        	</div>
                        	<div class="col-md-4">
                        		<label>Tanggal Transaksi : </label>
								<input type="date" class="form-control" name="date" placeholder="Tanggal Transaksi" required="">
                        	</div>
                        	
                            <hr>

                            <table class="table">
                            	<thead>
                            		<tr>
                            			<th width="19%">Produk</th>
                            			<th width="19%">Stok</th>
                            			<th width="19%">Harga Satuan</th>
                            			<th width="19%">Kuantitas</th>
                            			<th width="19%">Total</th>
                            			<th width="5%"></th>
                            		</tr>
                            	</thead>
                            	<tbody id="tbody">
                            		<tr id="tr1">
                            			<td>
                            				<select name="product_id1" class="form-control" onchange="get_stock(1)">
                            					<option value="0">-Pilih Produk-</option>
                            					@foreach($product AS $p)
                            					<option value="{{$p->id}}">{{$p->name}}</option>
                            					@endforeach
                            				</select>
                            			</td>
                            			<td>
                            				<select name="stock_id1" class="form-control" onchange="set_price(1)">
                        						
                            				</select>
                            			</td>
                            			<td>
                            				<input type="number" class="form-control" disabled id="price1" value="0">
                            			</td>
                            			<td>
                            				<input type="number" min="0" value="0" name="quantity1" class="form-control" onchange="set_price(1)">
                            			</td>
                            			<td>
                            				<input type="hidden" name="hidden_total1" value="0">
                            				<input type="text" class="form-control" disabled name="total1" value="0">
                            			</td>
                            			<td>
                            				<a class="btn btn-danger" onclick="remove_product(1)"><i class="fa fa-remove"></i></a>
                            			</td>
                            		</tr>
                            	</tbody>
								<tfoot>
									<tr>
										<input type="hidden" name="count" id="count" value="2">
										<input type="hidden" name="total" id="total">
										<th><a onclick="add_product()" class="btn btn-primary">Tambah Produk</a></th>
										<th colspan="3"><h4 class="text-right">Total :</h4></th>
										<th><h4 id="grandtotal">Rp. 0</h4></th>
									</tr>
								</tfoot>
                            </table>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('transaction.index') }}"> Cancel </a>
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
<script src="{{ url('js/transaction/transaction.js') }}"></script>
@endsection