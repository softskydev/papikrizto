@extends('main')

@section('title')
Data Cabang | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Cabang</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped" id="example">
						<thead>
							<tr>
								<th>#</th>
								<th width='25%'>Nama Cabang</th> 
								<th width='25%'>Kepala Cabang</th> 
								<th width='30%'>Alamat</th> 
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($data as $branch)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{ $branch->name }}</td>
								<td>{{ $branch->branch_head }}</td>
								<td>{{ $branch->branch_address }}</td>
								<td>
									<a class="btn btn-xs btn-rounded btn-primary" href="{{ route('branch.show', $branch->id) }}"> 
										<i class="menu-icon fa fa-gear"> </i> Setting
									</a>
									{{-- <a class="btn btn-xs btn-rounded btn-info" href="/variant/{{$branch->id}}"> 
										<i class="menu-icon fa fa-coffee"> </i> Varian
									</a>
									<a class="btn btn-xs btn-rounded btn-warning" href="/admin/{{$branch->id}}"> 
										<i class="menu-icon fa fa-user"> </i> Admin
									</a> --}}
								</td> 
							</tr> 
						@empty
							<tr>
								<td colspan="4" class="text-center">
									Belum ada Produk
								</td>
							</tr>
						@endforelse 
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
@endsection

@section('js')
<script src="{{ url('js/admin/admin.js') }}"></script>
@endsection