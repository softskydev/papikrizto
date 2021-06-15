@extends('main')

@section('title')
Data Sales | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Edit Sales </h4>
                    <p> Tambahkan sales anda untuk dikelola </p>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('sales.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('sales.update' , $detail->id) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
                                <div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Nama Sales</label>
									<div class="col-sm-10">
										<input type="text" name="name" class="form-control" id="inp-type-1" placeholder="Nama Sales" value="{{$detail->name}}">
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Tanggal Lahir</label>
									<div class="col-sm-10">
										<input type="date" name="birth_day" class="form-control" id="inp-type-1" placeholder="Tanggal Lahir" value="{{$detail->birth_day}}">
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Jenis Kelamin</label>
									<div class="col-sm-10">
										<div class="radio">
											<input type="radio" name="gender" class="radio" id="r1" value="Laki-Laki" {{$detail->gender=="Laki-Laki"?"checked":""}}>
											<label for="r1">Laki-Laki</label>
										</div>
										<div class="radio">
											<input type="radio" name="gender" class="radio" id="r2" value="Perempuan" {{$detail->gender=="Perempuan"?"checked":""}}>
											<label for="r2">Perempuan</label>
										</div>
											
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
