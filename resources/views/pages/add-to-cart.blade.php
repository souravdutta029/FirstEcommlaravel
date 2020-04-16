@extends('layout')

@section('content')
<section id="cart_items">
<div class="container col-sm-12">
	<div class="breadcrumbs">
		<ol class="breadcrumb">
		  <li><a href="#">Home</a></li>
		  <li class="active">Shopping Cart</li>
		</ol>
	</div>
	
	<div class="table-responsive cart_info">
		<?php
			$contents = Cart::content();
			// echo "<pre>";
			// print_r($contents);
			// exit();
		?>
		<table class="table table-condensed">
			<thead>
				<tr class="cart_menu">
					<td class="image">Item</td>
					<td class="description">Name</td>
					<td class="price">Price</td>
					<td class="quantity">Quantity</td>
					<td class="total">Total</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				@if($contents ->isEmpty())
			 		<h4 align="center" class="alert alert-danger">The Cart is empty.</h4>
				@else
					@foreach($contents as $content)
				<tr>
					<td class="cart_product">
						<a href=""><img src="{{$content->options->image}}" style="height: 80px; width: 60px;" alt=""></a>
					</td>
					<td class="cart_description">
						<h4><a href="">{{substr($content->name, 0,20)}}...</a></h4>
					</td>
					<td class="cart_price">
						<p>INR {{$content->price}}</p>
					</td>
					<td class="cart_quantity">
						<div class="cart_quantity_button">
							<form action="{{url('/update-cart')}}" method="post">
								@csrf
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$content->qty}}" autocomplete="off" size="2">
								<input type="hidden" name="rowId" value="{{$content->rowId}}">
								<input type="submit" name="submit" value="update" class="btn btn-sm btn-default" >
							</form>
						</div>
					</td>
					<td class="cart_total">
						<p class="cart_total_price">INR {{$content->total}}</p>
					</td>
					<td class="cart_delete">
						<a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$content->rowId)}}"><i class="fa fa-times"></i></a>
					</td>
				</tr>
			</tbody>
			@endforeach
			@endif
		</table>
		
</div>
</section> <!--/#cart_items-->

<section id="do_action">
<div class="container col-sm-12">
	<div class="row">
	</div>
<div class="col-sm-8">
	<h4 class="cart_description">Summary</h4>
		<div class="total_area">
			<ul>
				<li>Cart Sub Total <span>INR {{Cart::subtotal()}}</span></li>
				<li>Eco Tax <span>{{Cart::tax()}}</span></li>
				<li>Shipping Cost <span>Free</span></li>
				<li>Total <span>INR {{Cart::total()}}</span></li>
			</ul>
				<a class="btn btn-default update" href="">Update</a>

				<?php
					$customer_id = Session::get('customer_id');
				?>
				@if($customer_id)
					<a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
				@else
					<a class="btn btn-default check_out" href="{{url('/login-check')}}">Check Out</a>
				@endif
		</div>
	</div>
</div>
</div>
</section><!--/#do_action-->
@endsection