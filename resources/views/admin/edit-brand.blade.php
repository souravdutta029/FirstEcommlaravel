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
		<a href="#">Update Brand</a>
	</li>
</ul>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header" data-original-title>
			<h2><i class="halflings-icon edit"></i><span class="break"></span>Update Brand </h2>
		</div>
		<div class="box-content">
			<form class="form-horizontal" method="post" action="/update-brand/{{ $all_brand_info->brand_id }}">
				@csrf
			  <fieldset>
				<div class="control-group">
				  <label class="control-label">Brand Name</label>
				  <div class="controls">
					<input type="text" class="input-xlarge" name="brand_name" value="{{ $all_brand_info->brand_name }}">
				  </div>
				</div>

				<div class="control-group hidden-phone">
				  <label class="control-label">Brand Description</label>
				  <div class="controls">
					<textarea class="cleditor" name="brand_description" rows="3" >
						{{ $all_brand_info->brand_description }}
					</textarea>
				  </div>
				</div>

				<div class="form-actions">
				  <button type="submit" class="btn btn-primary" name="submit">Update Brand</button>
				  <button type="reset" class="btn">Cancel</button>
				</div>
			  </fieldset>
			</form>   

</div>
@endsection