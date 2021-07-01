@extends('main')

@section('title')
Data Admin | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Tambah Admin</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('admin.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('admin.store') }}" method="POST">
                        @csrf
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Cabang</label>
								<div class="col-sm-10">
									<select class="form-control" name="branch_id">
										@foreach($branch AS $b)
										<option value="{{$b->id}}">{{$b->name}}</option>
										@endforeach
									</select>
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Username</label>
								<div class="col-sm-10">
									<input type="text" name="username" class="form-control" placeholder="Username" required="">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left">Password</label>
								<div class="col-sm-10">
									<input type="password" name="password" class="form-control" placeholder="Password" id="p1" onchange="checkPassword()" required="">
                                </div>
							</div>
							<div class="form-group">
								<label for="inp-type-1" class="col-sm-2 pull-left" required="">Ulangi Password</label>
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
