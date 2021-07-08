@extends('main')

@section('title')
Data Akun | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Akun</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('account.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Add Data 
					</a>
					<hr>

					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Nama Akun</th> 
								<th>Saldo</th> 
								<th>Action</th> 
							</tr> 
						</thead> 
						<tbody> 
						@php $no = 1; @endphp
						@forelse ($data as $account)
							<tr> 
								<th scope="row">{{ $no++ }}</th> 
								<td>{{ $account->name }}</td>
								<td>{{ rupiah($account->saldo) }}</td>
								<td>
									<a class="btn btn-xs btn-rounded btn-warning" href="{{ route('account.show' , $account->id) }}"> 
										<i class="menu-icon fa fa-pencil "> </i> Edit 
									</a>
									
									<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $account->id }}')" > 
										<i class="menu-icon fa fa-trash "> </i> Hapus  
									</button>
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
<script src="{{ url('js/account/account.js') }}"></script>
@endsection