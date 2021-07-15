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
					<form class="form-group" method="post" action="{{action('ReportController@stock')}}">
						@csrf
						<label class="control-label col-sm-2">Periode : </label>
						<div class="col-sm-4">
							<div class="input-daterange input-group" id="date-range" data-date-format='yyyy-mm-dd'>
								<input type="text" class="form-control input-sm" name="start" required="" placeholder="Tanggal Awal" {{$start!=0?"value='".$start."'":""}} />
								<span class="input-group-addon bg-default">-</span>
								<input type="text" class="form-control input-sm" name="end" required="" placeholder="Tanggal Akhir" {{$end!=0?"value='".$end."'":""}} />
							</div>
						</div>
						<div class="col-sm-2">
							<button class="btn btn-info btn-xs btn-block" type="submit">Filter</button>
						</div>
						<div class="col-sm-2">
							<a href="/report/stock" class="btn btn-default btn-xs btn-block">Tampilkan Semua</a>
						</div>
						
						<div class="col-sm-12">
							<hr>
						</div>
					</form>

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
										<th>Tanggal</th>
										<th>Kode Produk</th>
										<th>Varian Produk</th>
										<th>Masuk</th>
										<th>Keluar</th>
										<th>Satuan</th>
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($stock as $s)
									@if($s->branch_id == $b->id)
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{f_datestamp($s->created_at)}}</td>
										<td>{{$s->product_code}}</td>
										<td>{{$s->variant_name}}</td>
										<td>{{$s->status=='masuk'?$s->quantity:'-'}}</td>
										<td>{{$s->status=='keluar'?$s->quantity:'-'}}</td>
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
								<a href="/report/stock/print/{{$b->id}}/{{$start}}/{{$end}}" class="btn btn-primary waves-effect waves-light"><i class='fa fa-download'></i> Download PDF</a>
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
<script src="{{ url('js/report/report.js') }}"></script>
@endsection