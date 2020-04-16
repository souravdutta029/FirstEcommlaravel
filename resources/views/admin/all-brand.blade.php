@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/dashboard">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="#">All Brands</a>
	</li>
</ul>

<div class="row-fluid sortable">		
<div class="box span12">
<div class="box-header" data-original-title>
	<h2><i class="halflings-icon user"></i><span class="break"></span>All Brands</h2>
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
			  <th>Brand ID</th>
			  <th>Brand Name</th>
			  <th>Description</th>
			  <th>Publication Status</th>
			  <th>Actions</th>
			</tr>
		  </thead>   
		  <tbody>
		  	@foreach($all_brand_info as $brand_info)
			<tr>
				<td>{{ $brand_info->brand_id }}</td>
				<td class="center">{{ $brand_info->brand_name }}</td>
				<td class="center">{{ $brand_info->brand_description }}</td>
				<td class="center">
					@if( $brand_info->publication_status == "1" )
						<span class="label label-success">Active</span>
					@else
						<span class="label label-danger">Inactive</span>
					@endif
				</td>
				<td class="center">
						
					@if( $brand_info->publication_status == "1" )
						<a class="btn btn-secondary" href="/inactive-brand/{{ $brand_info->brand_id }}">
							<i class="halflings-icon white thumbs-down"></i>  
						</a>
					@else
						<a class="btn btn-success" href="/active-brand/{{ $brand_info->brand_id }}">
							<i class="halflings-icon white thumbs-up"></i>  
						</a>
					@endif
						
					<a class="btn btn-info" href="/edit-brand/{{ $brand_info->brand_id }}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a class="btn btn-danger" href="{{URL::to('/delete-brand/'.$brand_info->brand_id)}}" id="delete">
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