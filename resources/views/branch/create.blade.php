@extends('main')

@section('title')
Data Cabang | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Tambah Cabang</h4>
                    <p> Tambahkan Cabang anda untuk dikelola </p>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('branch.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('branch.store') }}" method="POST">
                        @csrf
                        	<input type="hidden" name="product_id" value="{{$product_id}}">
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Nama Cabang</label>
								<div class="col-sm-10">
									<input type="text" name="name" class="form-control" placeholder="Nama Cabang">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Username</label>
								<div class="col-sm-10">
									<input type="text" name="username" class="form-control" placeholder="Username">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Password</label>
								<div class="col-sm-10">
									<input type="password" name="password" class="form-control" placeholder="Password">
                                </div>
							</div>
							<hr>
							<div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('branch.show', $product_id) }}"> Cancel </a>
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