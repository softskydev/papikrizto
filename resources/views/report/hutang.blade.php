@extends('main')

@section('title')
Laporan {{$category}} | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">{{$category}}</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<form class="form-group" method="post" action="{{action('ReportController@hutang', Request::segment(3))}}">
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
							<a href="/report/hutang/{{Request::segment(3)}}" class="btn btn-default btn-xs btn-block">Tampilkan Semua</a>
						</div>
						
						<div class="col-sm-12">
							<hr>
						</div>
					</form>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped" width="100%">
						<thead>
							<tr>
								<th>No.</th>
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th class="text-right">Total</th>
							</tr>
						</thead>
						<tbody>
							@php $no = 0 @endphp
							@foreach($hutang AS $h)
							<tr>
								<td>{{++$no}}</td>
								<td>{{format($h->date)}}</td>
								<td>{{$h->note}}</td>
								<td class="text-right">{{rupiah($h->nominal)}}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3" class="text-right">Total Hutang : </th>
								<th class="text-right">{{rupiah($total)}}</th>
							</tr>
						</tfoot>
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
<script src="{{ url('js/report/report.js') }}"></script>
@endsection