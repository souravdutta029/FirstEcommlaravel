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
		</table>
		
</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<form action="{{url('/order-place')}}" method="post">
		@csrf
	<fieldset class="form-group">
    <div class="row">
      <div class="col-form-label col-sm-2 pt-0">Select Payment Method</div>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_gateway"value="cash on delivery" checked>
          <label class="form-check-label" for="gridRadios1"><img src="{{asset('frontend/images/payment/cod.png')}}" style="height: 60px; width: 80px;"></label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment_gateway" value="debit cards">
          <label class="form-check-label" for="gridRadios2">  <img src="{{asset('frontend/images/payment/mas.png')}}" style="height: 50px; width: 70px;"></label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="payment_gateway" value="paytm">
          <label class="form-check-label" for="gridRadios3">
            <img src="{{asset('frontend/images/payment/paytm.jpg')}}" style="height: 60px; width: 80px;">
          </label>
        </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group">
		<input type="submit" name="submit" value="Done" class="btn btn-success pull-left btn-fyi">
	</div>
	</form>
	
</section>
@endsection