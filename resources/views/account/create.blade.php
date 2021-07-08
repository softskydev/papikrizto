@extends('main')

@section('title')
Data Akun | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Tambah Akun Baru</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('account.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('account.store') }}" method="POST">
                        @csrf
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Nama Akun</label>
								<div class="col-sm-10">
									<input type="text" name="name" class="form-control" id="inp-type-1" placeholder="Nama Akun">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Saldo</label>
								<div class="col-sm-10">
									<input type="text" name="saldo" class="form-control" id="inp-type-1" placeholder="Saldo">
                                </div>
							</div>
							
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('account.index') }}"> Cancel </a>
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
