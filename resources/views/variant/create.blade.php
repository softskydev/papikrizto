@extends('main')

@section('title')
Data Varian Produk | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Tambah Produk Baru</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('variant.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<div class="card-content">
						<form class="form-horizontal" action="{{ route('variant.store') }}" method="POST">
                        @csrf
                        	<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Kode Produk</label>
								<div class="col-sm-10">
									<input type="text" name="product_code" class="form-control" placeholder="Kode Produk" required="">
                                </div>
							</div>
							<div class="form-group">
								@if(Session::get('branch_id') == 1)
								<label for="inp-type-1" class="col-sm-2 pull-left">Cabang</label>
								<div class="col-sm-10">
									<select class="form-control" name="branch_id">
										@foreach($branch AS $b)
										<option value="{{$b->id}}">{{$b->name}}</option>
										@endforeach
									</select>
                                </div>
                                @else
                                <input type="hidden" name="branch_id" value="{{Session::get('branch_id')}}">
                                @endif
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Nama Varian</label>
								<div class="col-sm-10">
									<input type="text" name="variant_name" class="form-control" placeholder="Nama Varian" required="">
                                </div>
							</div>
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('admin.index') }}"> Cancel </a>
                                    <button class="btn btn-success" type="submit" id="submit"> Simpan </button>
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
