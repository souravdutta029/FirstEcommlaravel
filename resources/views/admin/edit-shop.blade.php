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
		<a href="#">Update Shop Details</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Shop Details</h2>
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
			<form class="form-horizontal" method="post" action="/update-shop/{{ $all_shop_info->shop_id }}">
				@csrf
			  <fieldset>
				<div class="control-group">
				  <label class="control-label">Shop Title</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="shop_title" value="{{ $all_shop_info->shop_title }}">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label">Shop Tagline</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="shop_tagline" value="{{ $all_shop_info->shop_tagline }}">
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Shop Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="shop_description" rows="3" >
						{{ $all_shop_info->shop_description }}
					</textarea>
				  </div>
				</div>


				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit">Update Details</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

</div>
@endsection