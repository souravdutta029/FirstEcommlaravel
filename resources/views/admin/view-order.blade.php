@extends('admin_layout')
@section('admin_content')
	<div class="row-fluid sortable">
			<div class="box span6">
				<div class="box-header">
					<h2><i class="fa fa-align-justify"></i><span class="break">Customer Details</span></h2>
				</div>
				<div class="box-content">
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Customer Name</th>
							<th>Mobile Number</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $all_order_info->customer_name }}</td>
							<td>{{ $all_order_info->mobile_number }}</td>
						</tr>
					</tbody>					
				</table>
			</div>
		</div>
		<div class="box span6">
				<div class="box-header">
					<h2><i class="fa fa-align-justify"></i><span class="break">Shipping Details</span></h2>
				</div>
				<div class="box-content">
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Shipment To</th>
							<th>Address</th>
							<th>Contact No</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{{ $all_order_info->shipping_first_name }}</td>
							<td>{{ $all_order_info->shipping_address }}</td>
							<td>{{ $all_order_info->shipping_mobile }}</td>
						</tr>
					</tbody>					
				</table>
			</div>
		</div>
	</div>

	<div class="row-fluid sortable">
		<div class="box span12">
				<div class="box-header">
					<h2><i class="fa fa-align-justify"></i><span class="break">Order Details</span></h2>
				</div>
				<div class="box-content">
					<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Product Name</th>
							<th>Product Price</th>
							<th>Product Sales Quantity</th>
							<th>Product Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>					
				</table>
			</div>
		</div>
	</div>
@endsection
