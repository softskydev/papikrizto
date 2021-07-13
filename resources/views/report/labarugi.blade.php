@extends('main')

@section('title')
Laporan Laba Rugi | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Laba Rugi</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<hr>

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
						<form method="post" action="{{action('ReportController@labarugi_print', $b->id)}}" class="tab-pane fade in {!!$tno==1?'active':''!!}" role="tabpanel" id="tab{{$b->id}}" aria-labelledby="{{strtolower($b->name)}}-tab">
							@csrf
							<table class="table table-striped">
								<tbody>
									<tr>
										<td>Penjualan</td>
										<td class="text-right">{{rupiah($penjualan[$b->id])}}</td>
									</tr>
									<tr>
										<td>Pendapatan Lain</td>
										<td class="text-right">Rp. <input type="number" class="form-control input-sm" name="pendapatanlain" value="0" style="width: 100px; float: right;"></td>
									</tr>
									<tr>
										<th>Laba Kotor</th>
										<th class="text-right">{{rupiah(0)}}</th>
									</tr>
									<tr>
										<td>HPP</td>
										<td class="text-right">Rp. <input type="number" class="form-control input-sm" name="hpp" value="0" style="width: 100px; float: right;"></td>
									</tr>
									<tr>
										<td>Biaya</td>
										<td class="text-right">Rp. <input type="number" class="form-control input-sm" name="biaya" value="0" style="width: 100px; float: right;"></td>
									</tr>
									<tr>
										<th>Laba Sebelum Tax</th>
										<th class="text-right">{{rupiah(0)}}</th>
									</tr>
									<tr>
										<td>Interest</td>
										<td class="text-right">Rp. <input type="number" class="form-control input-sm" name="interest" value="0" style="width: 100px; float: right;"></td>
									</tr>
									<tr>
										<td>Tax</td>
										<td class="text-right">Rp. <input type="number" class="form-control input-sm" name="tax" value="0" style="width: 100px; float: right;"></td>
									</tr>
									<tr>
										<th>Laba Bersih</th>
										<th class="text-right">{{rupiah(0)}}</th>
									</tr>
								</tbody>
							</table>
							<div class="text-right">
								<button type="submit" class="btn btn-primary waves-effect waves-light"><i class='fa fa-download'></i> Download PDF</button>
							</div>
						</form>
						@php $tno++ @endphp
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
<script src="{{ url('js/account/account.js') }}"></script>
@endsection