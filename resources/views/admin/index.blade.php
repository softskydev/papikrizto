@extends('main')

@section('title')
Data Admin | Ubiku Dashboard
@endsection

@section('content')

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

        <div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Admin</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							
						</ul>
						<!-- /.sub-menu -->
					</div>
					<a class="btn btn-xs btn-rounded btn-info " href="{{ route('admin.create') }}">
						<i class="menu-icon fa fa-plus ">
						</i> Tambah Data 
					</a>

					<ul class="nav nav-tabs" id="myTabs" role="tablist" style="margin-top: 20px;">
						@foreach($branch AS $b)
						<li role="presentation" {!!$b->id==1?'class="active"':''!!}><a href="#tab{{$b->id}}" id="{{strtolower($b->name)}}-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">{{$b->name}}</a></li>
						@endforeach
					</ul>
					<!-- /.nav-tabs -->
					<div class="tab-content" id="myTabContent">
						@foreach($branch AS $b)
						<div class="tab-pane fade in {!!$b->id==1?'active':''!!}" role="tabpanel" id="tab{{$b->id}}" aria-labelledby="{{strtolower($b->name)}}-tab">
							<!-- /.dropdown js__dropdown -->
							<table class="table table-striped data-tables">
								<thead>
									<tr>
										<th>#</th>
										<th width='50%'>Username</th>
										<th>Action</th> 
									</tr> 
								</thead> 
								<tbody> 
								@php $no = 1; @endphp
								@forelse ($data as $admin)
									@if($admin->branch_id == $b->id)
									<tr> 
										<th scope="row">{{ $no++ }}</th> 
										<td>{{$admin->username}}</td>
										<td>
											<a class="btn btn-xs btn-rounded btn-warning" href="/admin/{{$admin->id}}"> 
												<i class="menu-icon fa fa-pencil "> </i> Edit 
											</a>
											
											<button class="btn btn-xs btn-rounded btn-danger" onclick="doDelete('{{ $admin->id }}')" > 
												<i class="menu-icon fa fa-trash "> </i> Hapus  
											</button>
										</td> 
									</tr> 
									@endif
								@empty
									<tr>
										<td colspan="4" class="text-center">
											Belum ada admin
										</td>
									</tr>
								@endforelse 
								</tbody> 
							</table>
						</div>
						@endforeach
					</div>
					<!-- /.tab-content -->
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