@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/dashboard">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="#">All Products</a>
	</li>
</ul>

<div class="row-fluid sortable">		
<div class="box span12">
<div class="box-header" data-original-title>
	<h2><i class="halflings-icon user"></i><span class="break"></span>All Products</h2>
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
			  <th>Product ID</th>
			  <th>Product Name</th>
			  <th>Product Image</th>
			  <th>Product Price</th>
			  <th>Category Name</th>
			  <th>Brand Name</th>
			  <th>Pub Status</th>
			  <th>Actions</th>
			</tr>
		  </thead>   
		  <tbody>
		  	@foreach($all_product_info as $product_info)
			<tr>
				<td>{{ $product_info->product_id }}</td>
				<td class="center">{{ $product_info->product_name }}</td>
				<td><img src="{{ URL::to($product_info->product_image) }}" style="height: 80px; width: 80px;" alt="product images"></td>
				<td class="center">INR {{ $product_info->product_price }}</td>
				<td class="center">{{ $product_info->category_name }}</td>
				<td class="center">{{ $product_info->brand_name }}</td>
				<td class="center">
					@if( $product_info->publication_status == 1 )
						<span class="label label-success">Active</span>
					@else
						<span class="label label-danger">Inactive</span>
					@endif
				</td>
				<td class="center">
						
					@if( $product_info->publication_status == 1 )
						<a class="btn btn-secondary" href="{{URL::to('/inactive-product/'.$product_info->product_id)}}">
							<i class="halflings-icon white thumbs-down"></i>  
						</a>
					@else
						<a class="btn btn-success" href="{{URL::to('/active-product/'.$product_info->product_id)}}">
							<i class="halflings-icon white thumbs-up"></i>  
						</a>
					@endif
						
					<a class="btn btn-info" href="/edit-product/{{ $product_info->product_id }}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a class="btn btn-danger" href="{{URL::to('/delete-product/'.$product_info->product_id)}}" id="delete">
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