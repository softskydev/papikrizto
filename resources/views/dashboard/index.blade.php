@extends('main')

@section('title')
Data Dashboard | Ubiku Dashboard

@endsection

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">
			<div class="col-lg-3 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico ti-shopping-cart text-inverse"></i>
						<h2 class="counter text-inverse">{{ number_format($total_transactions->total_transction) }}</h2>
						<p class="text">Total Transaksi</p>
					</div>
					<!-- .statistics-box .with-icon -->
				</div>
				<!-- /.box-content -->

				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico ti-user text-success"></i>
						<h2 class="counter text-success">{{ ($total_customers->total_cust) }}</h2>
						<p class="text">Total Customers</p>
					</div>
					<!-- .statistics-box .with-icon -->
				</div>
				<!-- /.box-content -->

				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico ti-user text-primary"></i>
						<h2 class="counter text-primary">283</h2>
						<p class="text">Members</p>
					</div>
					<!-- .statistics-box .with-icon -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-3 col-xs-12 -->
			<div class="col-lg-9 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Transaksi Penjualan ({{ session('name') }})</h4>
				
					<canvas id="myChart" width="400" height="170"></canvas>
					<!-- /#svg-animation-chartist-chart.chartist-chart -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-9 col-xs-12 -->
		</div>
		<!-- /.row small-spacing -->

		

		<div class="row small-spacing">
		
			<!-- /.col-lg-4 col-xs-12 -->

			<div class="col-lg-12 col-xs-12">
				<div class="box-content">
					<h4 class="box-title">Last Transaction</h4>
					<!-- /.box-title -->
					<div class="dropdown js__drop_down">
						<a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
						<ul class="sub-menu">
							<li><a href="#">Product</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else there</a></li>
							<li class="split"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
						<!-- /.sub-menu -->
					</div>
					<!-- /.dropdown js__dropdown -->
					<table class="table table-striped margin-bottom-10">
						<thead>
							<tr>
								<th style="width:40%;">Product</th>
								<th>Price</th>
								<th>Date</th>
								<th>State</th>
								<th style="width:5%;"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Amaza Themes</td>
								<td>$71</td>
								<td>Nov 12,2016</td>
								<td class="text-success">Completed</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Macbook</td>
								<td>$142</td>
								<td>Nov 10,2016</td>
								<td class="text-danger">Cancelled</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Samsung TV</td>
								<td>$200</td>
								<td>Nov 01,2016</td>
								<td class="text-warning">Pending</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Ninja Admin</td>
								<td>$200</td>
								<td>Oct 28,2016</td>
								<td class="text-warning">Pending</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Galaxy Note 5</td>
								<td>$200</td>
								<td>Oct 28,2016</td>
								<td class="text-success">Completed</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>CleanUp Themes</td>
								<td>$71</td>
								<td>Oct 22,2016</td>
								<td class="text-success">Completed</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Facebook WP Plugin</td>
								<td>$10</td>
								<td>Oct 15,2016</td>
								<td class="text-success">Completed</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Iphone 7</td>
								<td>$100</td>
								<td>Oct 12,2016</td>
								<td class="text-warning">Pending</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Nova House</td>
								<td>$100</td>
								<td>Oct 12,2016</td>
								<td class="text-warning">Pending</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							<tr>
								<td>Repair Cars</td>
								<td>$35</td>
								<td>Oct 12,2016</td>
								<td class="text-warning">Pending</td>
								<td><a href="#"><i class="fa fa-plus-circle"></i></a></td>
							</tr>
							
						</tbody>
					</table>
					<!-- /.table -->
				</div>
				<!-- /.box-content -->
			</div>
			<!-- /.col-lg-6 col-xs-12 -->
		</div>
		<!-- /.row -->		
		<footer class="footer">
			<ul class="list-inline">
				<li>2016 © NinjaAdmin.</li>
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</footer>
	</div>
	
	<!-- /.main-content -->
</div><!--/#wrapper -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
			
			@foreach($transactions as $rowz)
				'{{ format($rowz->date) }}' ,
			@endforeach
		],
        datasets: [{
            label: 'Penjualan per Hari',
            data: [
				@foreach($transactions as $row)
					{{ $row->total_transaction . ', ' }} 
				@endforeach
			],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>
@endsection
<!-- <script src="{{ url('js/chartjs.js') }}"></script> -->
