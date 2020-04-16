@extends('admin_layout')

@section('admin_content')
<ul class="breadcrumb">
	<li>
		<i class="icon-home"></i>
		<a href="/dashboard">Home</a>
		<i class="icon-angle-right"></i> 
	</li>
	<li>
		<i class="icon-edit"></i>
		<a href="#">Add Slider</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Slider</h2>
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
			<form class="form-horizontal" method="post" action="/save-slider" enctype="multipart/form-data">
				@csrf
			  <fieldset>
				<div class="control-group">
				  <label class="control-label">Slider Image</label>
				  <div class="controls">
					<input type="file" class="input-xlarge" name="slider_image" required="">
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Publication Status</label>
				  <div class="controls">
					<input type="checkbox" name="publication_status" value="1">
				  </div>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit">Add Slider</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

</div>
@endsection