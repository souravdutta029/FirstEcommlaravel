@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/dashboard">Home</a> 
		<i class="icon-angle-right"></i>
	</li>
	<li>
		<a href="#">All Categories</a>
	</li>
</ul>

<div class="row-fluid sortable">		
<div class="box span12">
<div class="box-header" data-original-title>
	<h2><i class="halflings-icon user"></i><span class="break"></span>All Categories</h2>
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
			  <th>Category ID</th>
			  <th>Category Name</th>
			  <th>Description</th>
			  <th>Publication Status</th>
			  <th>Actions</th>
			</tr>
		  </thead>   
		  <tbody>
		  	@foreach($all_category_info as $category_info)
			<tr>
				<td>{{ $category_info->category_id }}</td>
				<td class="center">{{ $category_info->category_name }}</td>
				<td class="center">{{ $category_info->category_description }}</td>
				<td class="center">
					@if( $category_info->publication_status == "1" )
						<span class="label label-success">Active</span>
					@else
						<span class="label label-danger">Inactive</span>
					@endif
				</td>
				<td class="center">
						
					@if( $category_info->publication_status == "1" )
						<a class="btn btn-secondary" href="/inactive-category/{{ $category_info->category_id }}">
							<i class="halflings-icon white thumbs-down"></i>  
						</a>
					@else
						<a class="btn btn-success" href="/active-category/{{ $category_info->category_id }}">
							<i class="halflings-icon white thumbs-up"></i>  
						</a>
					@endif
						
					<a class="btn btn-info" href="/edit-category/{{ $category_info->category_id }}">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a class="btn btn-danger" href="{{URL::to('/delete-category/'.$category_info->category_id)}}" id="delete">
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