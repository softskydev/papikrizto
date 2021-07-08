@extends('main')

@section('title')
Data Hutang & Piutang | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Hutang & Piutang</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="{{ route('hutangpiutang.index') }}">Back</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
                    <hr>
					<!-- /.dropdown js__dropdown -->
                    <div class="card-content">
						<form class="form-horizontal" action="{{ route('hutangpiutang.update' ,$detail->id) }}" method="POST">
                        @csrf
                            <input type="hidden" name='_method' value="PUT">
                               <div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Hutang/Piutang</label>
									<div class="col-sm-10">
										<select class="form-control" name="type" required="">
											<option {{($detail->type=="Hutang"?"selected":"")}}>Hutang</option>
											<option {{($detail->type=="Piutang"?"selected":"")}}>Piutang</option>
										</select>
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Nominal</label>
									<div class="col-sm-10">
										<input type="text" name="nominal" class="form-control" id="inp-type-1" placeholder="Nominal" value="{{$detail->nominal}}">
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Tanggal</label>
									<div class="col-sm-10">
										<input type="date" name="date" class="form-control" id="inp-type-1" placeholder="Tanggal" value="{{$detail->date}}">
	                                </div>
								</div>
								<div class="form-group">
									<label for="inp-type-1" class="col-sm-2 pull-left">Keterangan</label>
									<div class="col-sm-10">
										<input type="text" name="note" class="form-control" id="inp-type-1" placeholder="Keterangan" value="{{$detail->note}}">
	                                </div>
								</div>
                            <hr>

                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <div class="pull-right">
                                    <a class="btn btn-danger" type="button" href="{{ route('hutangpiutang.index') }}"> Cancel </a>
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
