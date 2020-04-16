@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/dashboard">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="#">All Shop Details</a>
	</li>
</ul>

<div class="row-fluid sortable">		
<div class="box span12">
<div class="box-header" data-original-title>
	<h2><i class="halflings-icon user"></i><span class="break"></span>All Shop Details</h2>
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
			  <th>Shop ID</th>
			  <th>Shop Title</th>
			  <th>Shop Tagline</th>
			  <th>Shop Description</th>
			  <th>Publication Status</th>
			  <th>Actions</th>
			</tr>
		  </thead>   
		  <tbody>
		  	@foreach($all_shop_info as $shop_info)
			<tr>
				<td>{{ $shop_info->shop_id }}</td>
				<td class="center">{{ $shop_info->shop_title }}</td>
				<td class="center">{{ $shop_info->shop_tagline }}</td>
				<td class="center">{{ $shop_info->shop_description }}</td>
				<td class="center">
					@if( $shop_info->publication_status == "1" )
						<span class="label label-success">Active</span>
					@else
						<span class="label label-danger">Inactive</span>
					@endif
				</td>
				<td class="center">
						
					@if( $shop_info->publication_status == "1" )
						<a class="btn btn-secondary" href="/inactive-shop/{{ $shop_info->shop_id }}">
							<i class="halflings-icon white thumbs-down"></i>  
						</a>
					@else
						<a class="btn btn-success" href="/active-shop/{{ $shop_info->shop_id }}">
							<i class="halflings-icon white thumbs-up"></i>  
						</a>
					@endif
						
					<a class="btn btn-info" href="/edit-shop/{{ $shop_info->shop_id }}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a class="btn btn-danger" href="/delete-shop/{{ $shop_info->shop_id }}" id="delete">
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