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
		<a href="#">Update Product</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Product</h2>
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
			<form class="form-horizontal" method="post" action="/save-product" enctype="multipart/form-data">
				@csrf
			  <fieldset>
				<div class="control-group">
				  <label class="control-label">Product Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="product_name" value="{{ $product_info->product_name }}">
				  </div>
				</div>

				<div class="control-group">
					<label class="control-label" for="selectError3">Product Category</label>
					<div class="controls">
					  <select id="selectError3" name="category_id">
						<option selected="">Choose Category</option>
						<?php
							$published_category = DB::table('tbl_category')
												->where('publication_status', 1)
												->get();
							foreach($published_category as $category){
						?>
						<option value="{{ $product_info->category_id }}">{{ $product_info->category_name }}</option>
					<?php } ?>
					  </select>
					</div>
				  </div>

				  <div class="control-group">
					<label class="control-label" for="selectError3">Brand Name</label>
					<div class="controls">
					  <select id="selectError3" name="brand_id">
						<option selected="">Choose Brand Name</option>
						<?php
							$published_brand = DB::table('tbl_brand')
											 ->where('publication_status', 1)
											 ->get();

							foreach($published_brand as $brand){	
						?>
						<option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
					<?php } ?>
					  </select>
					</div>
				  </div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Product Short Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="product_short_description" rows="3" required=""></textarea>
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Product Long Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="product_long_description" rows="3" required=""></textarea>
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label">Product Price</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="product_price" required="">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label">Product Image</label>
				  <div class="controls">
					<input type="file" class="input-xlarge" name="product_image" required="">
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label">Product Size</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="product_size" >
				  </div>
				</div>

				<div class="control-group">
				  <label class="control-label">Product Color</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="product_color" >
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Publication Status</label>
				  <div class="controls">
					<input type="checkbox" name="publication_status" value="1">
				  </div>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit">Update Product</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

</div>
@endsection