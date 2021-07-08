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
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('hutangpiutang.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>
					<hr>

					<ul class="nav nav-tabs" id="myTabs" role="tablist" style="margin-top: 20px;">
						<li role="presentation" class="active"><a href="#tabhutang" id="hutang-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Hutang</a></li>
						<li role="presentation"><a href="#tabpiutang" id="piutang-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Piutang</a></li>
					</ul>
					<!-- /.dropdown js__dropdown -->
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade in active" role="tabpanel" id="tabhutang" aria-labelledby="hutang-tab">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Tanggal</th> 
										<th>Keterangan</th> 
										<th>Nominal</th>
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($data as $hutangpiutang)
									@if($hutangpiutang->type == "Hutang")
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{ format($hutangpiutang->date) }}</td>
										<td>{{ $hutangpiutang->note }}</td>
										<td>{{ rupiah($hutangpiutang->nominal) }}</td>
										<td>
											<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('hutangpiutang.show' , $hutangpiutang->id) }}"> 
												<i class="menu-icon fa fa-pencil "> </i> Edit 
											</a>
											
											<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $hutangpiutang->id }}')" > 
												<i class="menu-icon fa fa-trash "> </i> Hapus  
											</button>
										</td> 
									</tr> 
									@endif
								@empty
									<tr>
										<td colspan="4" class="text-center">
											Belum ada Hutang
										</td>
									</tr>
								@endforelse 
								</tbody> 
							</table>
						</div>
							<div class="tab-pane fade in" role="tabpanel" id="tabpiutang" aria-labelledby="piutang-tab">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Tanggal</th> 
										<th>Keterangan</th> 
										<th>Nominal</th>
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($data as $hutangpiutang)
									@if($hutangpiutang->type == "Piutang")
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{ format($hutangpiutang->date) }}</td>
										<td>{{ $hutangpiutang->note }}</td>
										<td>{{ rupiah($hutangpiutang->nominal) }}</td>
										<td>
											<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('hutangpiutang.show' , $hutangpiutang->id) }}"> 
												<i class="menu-icon fa fa-pencil "> </i> Edit 
											</a>
											
											<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $hutangpiutang->id }}')" > 
												<i class="menu-icon fa fa-trash "> </i> Hapus  
											</button>
										</td> 
									</tr> 
									@endif
								@empty
									<tr>
										<td colspan="4" class="text-center">
											Belum ada Piutang
										</td>
									</tr>
								@endforelse 
								</tbody> 
							</table>
						</div>
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

@section('js')
<script src="{{ url('js/account/hutangpiutang.js') }}"></script>
@endsection