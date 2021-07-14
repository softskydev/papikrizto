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
					<h4 class="box-title">Edit Admin </h4>
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
						<form class="form-horizontal" action="{{ route('admin.update' , $detail->id) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
                                <div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Cabang</label>
									<div class="col-sm-10">
										<select class="form-control" name="branch_id">
											@foreach($branch AS $b)
											<option {{($detail->branch_id==$b->id?"selected":"")}} value="{{$b->id}}">{{$b->name}}</option>
											@endforeach
										</select>
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Username</label>
									<div class="col-sm-10">
										<input type="text" name="username" class="form-control" placeholder="Username" required="" value="{{$detail->username}}">
	                                </div>
								</div>
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('admin.index') }}"> Cancel </a>
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
