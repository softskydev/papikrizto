@extends('main')

@section('title')
Data Product | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Edit Produk Anda </h4>
                    <p> Tambahkan produk anda untuk dikelola </p>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('product.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('product.update' , ['product' => $detail->id]) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
                                <div class="form-group">
                                    <label for="inp-type-1" class="col-sm-2 pull-left">Nama Produk Anda</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $detail->name }}" name="nama_product" class="form-control" id="inp-type-1" placeholder="Ubiku , Batata , Dsb. ">
                                    </div>
                                </div>
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('product.index') }}"> Cancel </a>
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