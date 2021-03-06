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
					<h4 class="box-title">Sales</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('sales.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>

					<!-- /.dropdown js__dropdown -->

					<ul class="nav nav-tabs" id="myTabs" role="tablist" style="margin-top: 20px;">
						@php $tno = 1 @endphp
						@foreach($branch AS $b)
							@if(Session::get('branch_id') == 1 || Session::get('branch_id') == $b->id)
								<li role="presentation" {!!$tno==1?'class="active"':''!!}><a href="#tab{{$b->id}}" id="{{strtolower($b->name)}}-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">{{$b->name}}</a></li>
								@php $tno++ @endphp
							@endif
						@endforeach
					</ul>
					<!-- /.nav-tabs -->
					<div class="tab-content" id="myTabContent">
					@php $tno = 1 @endphp
					@foreach($branch AS $b)
						@if(Session::get('branch_id') == 1 || Session::get('branch_id') == $b->id)
						<div class="tab-pane fade in {!!$tno==1?'active':''!!}" role="tabpanel" id="tab{{$b->id}}" aria-labelledby="{{strtolower($b->name)}}-tab">
							<!-- /.dropdown js__dropdown -->
							<table class="table table-striped data-tables">
								<thead>
									<tr>
										<th>#</th>
										<th>Nama Sales</th>
										<th>Email</th>
										<th>Telepon</th>
										<th>Jenis Kelamin</th> 
										<th>Status</th>
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($data as $sales)
									@if($sales->branch_id == $b->id)
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{ $sales->name }}</td>
										<td>{{ $sales->email }}</td>
										<td>{{ $sales->phone }}</td>
										<td>{{ $sales->gender }}</td>
										<td>{{ ucfirst($sales->status) }}</td>
										<td>
											<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('sales.show' , $sales->id) }}"> 
												<i class="menu-icon fa fa-pencil"> </i> Edit 
											</a>
											
											@if($sales->status=="aktif")
											<a class="btn btn-xs btn-rounded btn-danger" href="/sales/status/{{$sales->id}}/nonaktif"> 
												<i class="menu-icon fa fa-remove"> </i> Nonaktifkan  
											</a>
											@else
											<a class="btn btn-xs btn-rounded btn-success" href="/sales/status/{{$sales->id}}/aktif"> 
												<i class="menu-icon fa fa-check"> </i> Aktifkan  
											</a>
											@endif

											<button class="btn btn-xs btn-rounded btn-info" data-toggle="modal" data-target="#ktpmodal" onclick="change_ktp('{{$sales->ktp}}')"><i class="menu-icon fa fa-file-text"></i> Lihat KTP</button>
										</td> 
									</tr>
									@endif
								@empty
									<tr>
										<td colspan="4" class="text-center">
											Belum ada Sales
										</td>
									</tr>
								@endforelse 
								</tbody> 
							</table>
						</div>
						@php $tno++ @endphp
						@endif
						@endforeach
						</div>

					<table class="table table-striped data-tables">
						
						<tbody> 
						@php $no = 1; @endphp
						
						</tbody> 
					</table>
				</div>
				<!-- /.box-content -->
			</div>
    
        </div>
		
		<!-- /.row -->		
		@include('footer')
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->

<div class="modal fade" id="ktpmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Scan KTP</h4>
			</div>
			<div class="modal-body">
				<img src="" id="ktpimg">
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
<script src="{{ url('js/sales/sales.js') }}"></script>
@endsection