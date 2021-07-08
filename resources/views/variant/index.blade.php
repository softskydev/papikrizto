@extends('main')

@section('title')
Data Varian Produk | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Varian Produk</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					@if(Session::get('branch_id') == 1)
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('variant.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>
					@endif

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
										<th width='40%'>Nama Varian</th>
										<th>Status</th>
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($data as $variant)
									@if($variant->branch_id == $b->id)
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{$variant->variant_name}}</td>
										<td>{{ucfirst($variant->status)}}</td>
										<td>
											<a class="btn btn-xs btn-rounded btn-warning" href="/variant/{{$variant->id}}"> 
												<i class="menu-icon fa fa-pencil "> </i> Edit 
											</a>
											
											@if($variant->status=="aktif")
											<a class="btn btn-xs btn-rounded btn-danger" href="/variant/status/{{$variant->id}}/nonaktif"> 
												<i class="menu-icon fa fa-remove"> </i> Nonaktifkan  
											</a>
											@else
											<a class="btn btn-xs btn-rounded btn-success" href="/variant/status/{{$variant->id}}/aktif"> 
												<i class="menu-icon fa fa-check"> </i> Aktifkan
											</a>
											@endif
										</td> 
									</tr> 
									@php $tno++ @endphp
									@endif
								@empty
									<tr>
										<td colspan="4" class="text-center">
											Belum ada variant
										</td>
									</tr>
								@endforelse 
								</tbody> 
							</table>
						</div>
						@endif
						@endforeach
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
<script src="{{ url('js/variant/variant.js') }}"></script>
@endsection