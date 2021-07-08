@extends('main')

@section('title')
Data Stok | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Stok Produk</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>

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
									<th>Cabang</th>
									<th width='40%'>Varian Produk</th>  
									<th>Stok diminta</th>
									<th>Action</th> 
								</tr> 
							</thead> 
							<tbody> 
							@php $no = 1; @endphp
							@forelse ($data as $request)
								@if($request->branch_id == $b->id)
								<tr> 
									<th scope="row">{{ $no++ }}</th> 
									<td>{{$request->branch}}</td>
									<td>{{$request->variant}}</td>
									<td>{{$request->stock}} {{$request->satuan}}</td>
									<td>
										<a class="btn btn-xs btn-rounded btn-info" href="/request/{{$request->id}}"> 
											<i class="menu-icon fa fa-check"> </i> Konfirmasi Request
										</a>
									</td> 
								</tr>
								@endif
							@empty
								<tr>
									<td colspan="4" class="text-center">
										Belum ada stok
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

					<table class="table table-striped">
						
						<tbody> 
						
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
@endsection

@section('js')
<script src="{{ url('js/stock/stock.js') }}"></script>
@endsection