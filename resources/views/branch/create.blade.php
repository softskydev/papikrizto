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
								<label for="inp-type-1" class="col-sm-2 pull-left">Nama Kepala Cabang</label>
								<div class="col-sm-10">
									<input type="text" name="branch_head" class="form-control" placeholder="Nama Kepala Cabang">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Alamat Cabang</label>
								<div class="col-sm-10">
									<textarea name="branch_address" class="form-control" placeholder="Alamat Cabang"></textarea>
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
									<input type="password" name="password" class="form-control" placeholder="Password" id="p1" onchange="checkPassword()">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Ulangi Password</label>
								<div class="col-sm-10">
									<input type="password" name="re-password" class="form-control" placeholder="Ulangi Password" id="p2" onchange="checkPassword()">
                                </div>
							</div>
							<label style="color: red" id="warningLabel">Password tidak cocok</label>
							<hr>
							<div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('branch.show', $product_id) }}"> Cancel </a>
                                    <button class="btn btn-success" id="submit" type="submit"> Simpan </button>
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
	$('#warningLabel').hide();
    function checkPassword(){
       var p1 = $('#p1').val();
       var p2 = $('#p2').val();
       if (p1 != p2) {
          $('#warningLabel').show();
          $('#submit').prop("disabled", true);
       }else{
          $('#warningLabel').hide();
          $('#submit').prop("disabled", false);
       }
    }
</script>
@endsection
