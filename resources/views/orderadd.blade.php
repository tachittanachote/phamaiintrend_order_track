@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">

        <div class="h3 mb-3">อัพโหลดเอกข้อมูลสาร</div>

        <div class="card">
            <div class="card-body">
				
				@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{session('success')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					{{session('error')}}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
			
				<form action="/order/add" method="POST">
					<div class="form-group">
						<label for="order_id">หมายเลขออเดอร์</label>
						<input type="text" class="form-control" name="order_id" id="order_id" placeholder="" required>
					</div>
					<div class="form-group">
						<label for="customer_name">ลูกค้า</label>
						<select class="form-control" id="customer_name" name="customer_name">
							@foreach($customers as $customer)
							<option value="{{$customer->facebook_name}}" data-name="{{$customer->real_name}}">{{$customer->facebook_name}} (ชื่อจริง: {{$customer->real_name}})</option>
							@endforeach
							@foreach($users as $customer)
							<option value="{{$customer->facebook_name}}" data-name="{{$customer->customer_name}}">{{$customer->facebook_name}} (ชื่อจริง: {{$customer->customer_name}})</option>
							@endforeach
						</select>             
					</div>
					<div class="form-group">
						<label for="product">สินค้า</label>
						<select class="form-control" id="product" name="product">
							@foreach($products as $product)
							<option value="{{$product->product_code}}">{{$product->product_code}}</option>
							@endforeach
							@foreach($productsm as $product)
							<option value="{{$product->product_code}}">{{$product->product_code}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="address">ที่อยู่</label>
						<input type="text" class="form-control" id="address" name="address" required>
					</div>
					<div class="form-group">
						<label for="phone_number">เบอร์โทรศัพท์</label>
						<input type="text" class="form-control" id="phone_number" name="phone_number" required>
					</div>
					<div class="form-group">
						<label for="quantity">จำนวนสินค้า</label>
						<input type="number" class="form-control" id="quantity" min="0" name="quantity" required>
					</div>
					<div class="form-group">
						<label for="product_price">ราคาสินค้า</label>
						<input type="number" class="form-control" id="product_price" min="0" name="product_price" required>
					</div>
					<div class="form-group">
						<label for="total_price">ราคารวม</label>
						<input type="number" class="form-control" id="total_price" min="0" name="total_price" required>
					</div>
					<div class="form-group">
						<label for="detail">รายละเอียด</label>
						<input type="text" class="form-control" id="detail" name="detail" required>
					</div>
					<div class="form-group">
						<label for="order_date">วันที่สั่ง</label>
						<input type="date" class="form-control" id="order_date" name="order_date" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">เพิ่มออเดอร์</button>
					</div>
				</form>
            <div>
        </div>
	</div>
        
</div>
@endsection

@section('modal')

@endsection

@section('scripts')
<script src="{{ mix('js/add-order.js') }}" defer></script>
@endsection