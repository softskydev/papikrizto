@extends('main')

@section('title')
Data Aset | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Aset</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('asset.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>
					<hr>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Aset</th> 
								<th>Kuantitas</th> 
								<th>Harga</th> 
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($data as $asset)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{ $asset->name }}</td>
								<td>{{ $asset->quantity }}</td>
								<td>{{ rupiah($asset->price) }}</td>
								<td>
									<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('asset.show' , $asset->id) }}"> 
										<i class="menu-icon fa fa-pencil "> </i> Edit 
									</a>
									
									<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $asset->id }}')" > 
										<i class="menu-icon fa fa-trash "> </i> Hapus  
									</button>
								</td> 
							</tr> 
						@empty
							<tr>
								<td colspan="4" class="text-center">
									Belum ada Aset
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
<script src="{{ url('js/asset/asset.js') }}"></script>
@endsection