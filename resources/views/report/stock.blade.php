@extends('main')

@section('title')
Laporan Stock | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Laporan Stock</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>

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
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Kode Produk</th>
										<th width='40%'>Varian Produk</th>  
										<th>Stok</th>
										<th>Satuan</th>
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($stock as $s)
									@if($s->branch_id == $b->id)
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{$s->product_code}}</td>
										<td>{{$s->variant}}</td>
										<td>{{$s->stock}}</td>
										<td>{{$s->nama_stock}}</td>
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
							<div class="text-right">
								<a href="/report/stock/print/{{$b->id}}" type="button" class="btn btn-primary waves-effect waves-light"><i class='fa fa-download'></i> Download PDF</a>
							</div>
						</div>
						@php $tno++ @endphp
					@endif
					@endforeach
					</div>

					<!-- /.dropdown js__dropdown -->
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
<script src="{{ url('js/stock/stock.js') }}"></script>
@endsection