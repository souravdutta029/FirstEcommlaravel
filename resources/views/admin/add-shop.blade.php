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
		<a href="#">Add Shop Details</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Shop Details</h2>
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
			<form class="form-horizontal" method="post" action="/save-shop">
				@csrf
			  <fieldset>
				<div class="control-group">
				  <label class="control-label">Shop Title</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="shop_title" required="">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label">Shop Tagline</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="shop_tagline" required="">
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Shop Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="shop_description" rows="3" required=""></textarea>
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Publication Status</label>
				  <div class="controls">
					<input type="checkbox" name="publication_status" value="1">
				  </div>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit">Insert Details</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

</div>
@endsection