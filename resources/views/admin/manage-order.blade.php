@extends('admin_layout')

@section('admin_content')
	<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/dashboard">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="#">Order Details</a>
	</li>
</ul>

<div class="row-fluid sortable">		
<div class="box span12">
<div class="box-header" data-original-title>
	<h2><i class="halflings-icon user"></i><span class="break"></span>Order Details</h2>
</div>
<p class="alert-success">
		<?php
			$message = Session::get('message');
			if($message){
				echo $message;
				Session::put('message', null);
			}
		?>
	</p>
<div class="box-content">
	<table class="table table-striped table-bordered bootstrap-datatable datatable">
		 <thead>
			<tr>
			  <th>Order Id</th>
			  <th>Customer Name</th>
			  <th>Order Total</th>
			  <th>Status</th>
			  <th>Actions</th>
			</tr>
		  </thead>   
		  <tbody>
		  	@foreach($all_order_info as $order_info)
			<tr>
				<td>{{ $order_info->order_id }}</td>
				<td class="center">{{ $order_info->customer_name }}</td>
				<td class="center">INR {{ $order_info->order_total }}</td>
				<td class="center">{{ $order_info->order_status }}</td>
				
				<td class="center">
						
					@if( $order_info->order_status == "pending" )
						<a class="btn btn-secondary" href="/inactive-order/{{ $order_info->order_id }}">
							<i class="halflings-icon white thumbs-down"></i>  
						</a>
					@else
						<a class="btn btn-success" href="/active-order/{{ $order_info->order_id }}">
							<i class="halflings-icon white thumbs-up"></i>  
						</a>
					@endif
						
					<a class="btn btn-info" href="/view-order/{{ $order_info->order_id }}">
						<i class="fa fa-eye"></i>  
					</a>
					<a class="btn btn-danger" href="{{URL::to('/delete-order/'.$order_info->order_id)}}" id="delete">
						<i class="halflings-icon white trash"></i> 
					</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	  </table>            
	</div>
</div><!--/span-->

</div><!--/row-->
@endsection