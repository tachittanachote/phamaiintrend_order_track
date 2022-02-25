@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">
        <div class="h4 mb-3">ข้อมูลรายละเอียดออเดอร์ที่ {{$order->order_number}}</div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-body text-center">
                                @php
                                try {
                                    $images = \App\ProductImage::where('product_code',$order->product_code)->get();
                                } catch (Exception $e) {

                                }
                                @endphp
                                <div id="image-slider" class="splide">
                                    <div class="splide__track">
                                            <ul class="splide__list">
                                                @foreach($images as $image)
                                                <li class="splide__slide">
                                                    <div class="relative">
                                                        <div><img class="img-fluid mb-3" style="max-height: 375px;" src="/storage/upload/{{$image->image_url}}" alt="{{$image->product_code}}"/></div>
                                                        <div class="del-btn" data-id="{{$image->id}}"><i class="far fa-trash-alt"></i></div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                    </div>
                                </div>
                                @if(count($images) <= 0)
                                    <div style="margin-top: 130px;">ไม่พบรูปภาพ</div>
                                    <div class="mt-5 mb-2"><a href="/add-product-image" class="btn btn-secondary btn-sm"><i class="fas fa-plus"></i> เพิ่มรูปภาพ</a></div>
                                @endif
                                
                                <div class="h5">{{$order->product_code}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="card">
                            
                            <div class="card-body">
                                <div class="h5 card-title">ข้อมูลลูกค้า</div>
                                <div>ชื่อลูกค้า: {{$order->customer_name}}</div>
                                <div>ชื่อ Facebook: <span id="customer_name">{{$order->facebook_name}}</span></div>
                                <div>เบอร์โทรศัพท์: {{$order->phone_number}}</div>
                                <div>ที่อยู่: {{$order->address}}</div>
                                <div>หมายเหตุ: {{$order->note ? $order->note : "-"}}</div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="h5 card-title">ข้อมูลออเดอร์</div>
                                <div>รหัสสินค้า: {{$order->product_code}}</div>
                                <div>รายละเอียด: {{$order->detail}}</div>
                                <div>จำนวน: {{$order->quantity}}</div>
                                <div>คอมเม้น: {{$order->comment}}</div>
                                <div>โอนจ่ายแล้ว: {{$order->transfer_amount}}</div>
                                <div>วันที่สั่ง: {{$order->order_date}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>


<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="border-divide">
                            <div class="row">
                                <input type="text" class="form-control" id="orderId" value="{{$order->id}}" hidden>
                                @php
                                    $orderDetail = \App\OrderDetail::where('order_id', $order->id)->first();
                                @endphp
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="h5 card-title">รายละเอียดตัวเสื้อ</div>
                                            <div class="form-group">
                                                <label for="shirtSize">ไซส์เสื้อ</label>
                                                <input type="text" class="form-control" id="shirtSize" value="{{isset($orderDetail->shirt_shirt_size) ? $orderDetail->shirt_shirt_size : ""}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="waistSize">ไซส์เอวเสื้อ</label>
                                                <input type="text" class="form-control" id="waistSize" value="{{isset($orderDetail->shirt_waist_size) ? $orderDetail->shirt_waist_size : ""}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="sellDate">วันที่ขาย</label>
                                                <input type="date" class="form-control" id="sellDate" value="{{isset($orderDetail->sell_date) ? $orderDetail->sell_date : ""}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="h5 card-title">รายละเอียดเพิ่มเติม</div>
                                            <div class="form-group">
                                                <label for="shirtDetail">รายละเอียดไซส์เสื้อ</label>
                                                <input type="text" class="form-control" id="shirtDetail" value="{{isset($orderDetail->shirt_shirt_detail) ? $orderDetail->shirt_shirt_detail : ""}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="waistDetail">รายละเอียดเอวเสื้อ</label>
                                                <input type="text" class="form-control" id="waistDetail" value="{{isset($orderDetail->shirt_waist_detail) ? $orderDetail->shirt_waist_detail : ""}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="deliveryDate">วันที่นัดส่ง</label>
                                                <input type="date" class="form-control" id="deliveryDate" value="{{isset($orderDetail->delivery_date) ? $orderDetail->delivery_date : ""}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="border-divide">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="h5 card-title">รายละเอียดผ้าถุง</div>
                                        <div class="form-group">
                                            <label for="sarong-waistSize">ไซส์เอวผ้าถุง</label>
                                            <input type="text" class="form-control" id="sarong-waistSize" value="{{isset($orderDetail->sarong_waist_size) ? $orderDetail->sarong_waist_size : ""}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sarong-hipSize">ไซส์สะโพกผ้าถุง</label>
                                            <input type="text" class="form-control" id="sarong-hipSize" value="{{isset($orderDetail->sarong_hip_size) ? $orderDetail->sarong_hip_size : ""}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sarong-longSize">ความยาวผ้าถุง</label>
                                            <input type="text" class="form-control" id="sarong-longSize" value="{{isset($orderDetail->sarong_long_size) ? $orderDetail->sarong_long_size : ""}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="h5 card-title">รายละเอียดเพิ่มเติม</div>
                                        <div class="form-group">
                                            <label for="sarong-waistDetail">รายละเอียดเอวผ้าถุง</label>
                                            <input type="text" class="form-control" id="sarong-waistDetail" value="{{isset($orderDetail->sarong_waist_detail) ? $orderDetail->sarong_waist_detail : ""}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sarong-hipDetail">รายละเอียดสะโพกผ้าถุง</label>
                                            <input type="text" class="form-control" id="sarong-hipDetail" value="{{isset($orderDetail->sarong_hip_detail) ? $orderDetail->sarong_hip_detail : ""}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="sarong-longDetail">รายละเอียดยาวผ้าถุง</label>
                                            <input type="text" class="form-control" id="sarong-longDetail" value="{{isset($orderDetail->sarong_long_detail) ? $orderDetail->sarong_long_detail : ""}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button type="button" class="btn btn-primary w-100 save">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@php
    $status = \App\OrderDetail::where('customer_name', $order->facebook_name)->first();
@endphp


<div class="row mt-3">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <input type="text" class="form-control" placeholder="เพิ่มรายละเอียดการแก้ไข" id="detail">
                        <div id="detailFeedback" class="invalid-feedback mb-2">โปรดระบุข้อมูลให้ครบถ้วน</div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-secondary w-100" id="add-edit" data-id={{$order->id}}>เพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@php
$customerSize = \App\CustomerSize::where('customer_name', $order->facebook_name)->groupBy('customer_name')->first();
@endphp

@if($customerSize)
<div class="row mt-3">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="font-weight-bold mb-4">ข้อมูลไซส์จากลูกค้ากำหนด</div>
                <div class="row mb-3">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="sarong-waistDetail">ไซส์เสื้อ</label>
                        <input type="text" class="form-control" id="shirt_shirt_size-customer" value="{{$customerSize->shirt_shirt_size}}" readonly>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <label for="sarong-waistDetail">ไซส์เอวเสื้อ</label>
                        <input type="text" class="form-control" id="shirt_waist_size-customer" value="{{$customerSize->shirt_waist_size}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-4 col-md-6 col-sm-4">
                        <label for="sarong-waistDetail">ไซส์เอวผ้าถุง</label>
                        <input type="text" class="form-control" id="sarong_waist_size-customer" value="{{$customerSize->sarong_waist_size}}" readonly>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-4">
                        <label for="sarong-waistDetail">ไซส์สะโพกผ้าถุง</label>
                        <input type="text" class="form-control" id="sarong_hip_size-customer" value="{{$customerSize->sarong_hip_size}}" readonly>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-4">
                        <label for="sarong-waistDetail">ความยาวผ้าถุง</label>
                        <input type="text" class="form-control" id="sarong_long_size-customer" value="{{$customerSize->sarong_long_size}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary w-100 apply-customer" data-id="{{$order->id}}">นำข้อมูลไปใช้</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="font-weight-bold mb-3">ข้อมูลไซส์ที่ใช้งานล่าสุด</div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="border-divide">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="h5 card-title">รายละเอียดตัวเสื้อ</div>
                                            <div class="form-group">
                                                <label for="shirtSize">ไซส์เสื้อ</label>
                                                <input type="text" class="form-control" id="shirt_shirt_size" value="{{optional(\App\OrderDetail::select('shirt_shirt_size')->whereNotNull('shirt_shirt_size')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->shirt_shirt_size}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="waistSize">ไซส์เอวเสื้อ</label>
                                                <input type="text" class="form-control" id="shirt_waist_size" value="{{optional(\App\OrderDetail::select('shirt_waist_size')->whereNotNull('shirt_waist_size')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->shirt_waist_size}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="h5 card-title">รายละเอียดเพิ่มเติม</div>
                                            <div class="form-group">
                                                <label for="shirtDetail">รายละเอียดไซส์เสื้อ</label>
                                                <input type="text" class="form-control" id="shirt_shirt_detail" value="{{optional(\App\OrderDetail::select('shirt_shirt_detail')->whereNotNull('shirt_shirt_detail')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->shirt_shirt_detail}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="waistDetail">รายละเอียดเอวเสื้อ</label>
                                                <input type="text" class="form-control" id="shirt_waist_detail" value="{{optional(\App\OrderDetail::select('shirt_waist_detail')->whereNotNull('shirt_waist_detail')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->shirt_waist_detail}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="border-divide">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="h5 card-title">รายละเอียดผ้าถุง</div>
                                            <div class="form-group">
                                                <label for="sarong-waistSize">ไซส์เอวผ้าถุง</label>
                                                <input type="text" class="form-control" id="sarong_waist_size" value="{{optional(\App\OrderDetail::select('sarong_waist_size')->whereNotNull('sarong_waist_size')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->sarong_waist_size}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="sarong-hipSize">ไซส์สะโพกผ้าถุง</label>
                                                <input type="text" class="form-control" id="sarong_hip_size" value="{{optional(\App\OrderDetail::select('sarong_hip_size')->whereNotNull('sarong_hip_size')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->sarong_hip_size}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="sarong-longSize">ความยาวผ้าถุง</label>
                                                <input type="text" class="form-control" id="sarong_long_size" value="{{optional(\App\OrderDetail::select('sarong_long_size')->whereNotNull('sarong_long_size')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->sarong_long_size}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="h5 card-title">รายละเอียดเพิ่มเติม</div>
                                            <div class="form-group">
                                                <label for="sarong-waistDetail">รายละเอียดเอวผ้าถุง</label>
                                                <input type="text" class="form-control" id="sarong_waist_detail" value="{{optional(\App\OrderDetail::select('sarong_waist_detail')->whereNotNull('sarong_waist_detail')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->sarong_waist_detail}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="sarong-hipDetail">รายละเอียดสะโพกผ้าถุง</label>
                                                <input type="text" class="form-control" id="sarong_hip_detail" value="{{optional(\App\OrderDetail::select('sarong_hip_detail')->whereNotNull('sarong_hip_detail')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->sarong_hip_detail}}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="sarong-longDetail">รายละเอียดยาวผ้าถุง</label>
                                                <input type="text" class="form-control" id="sarong_long_detail" value="{{optional(\App\OrderDetail::select('sarong_long_detail')->whereNotNull('sarong_long_detail')->where('customer_name', $order->facebook_name)->orderBy('updated_at', 'desc')->first())->sarong_long_detail}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col">
                        <button type="button" class="btn btn-secondary w-100 apply" data-id="{{$order->id}}">นำข้อมูลไปใช้</button>
                    </div>
                </div>
            </div>
        </div>

	</div>
</div>

@if(count($editDetails) > 0)
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="font-weight-bold mb-3">รายการการแก้ไข</div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">รายละเอียด</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($editDetails as $edit)
                            <tr>
                                <td>{{$edit->detail}}</td>
                                <td><i class="fas fa-trash-alt clickable-btn remove" data-id="{{$edit->id}}"></i></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row mt-3">
    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-row-reverse">
        <a target="_blank" rel="noopener noreferrer" href="/print/assign?order_id={{$order->id}}" class="btn btn-primary w-100">สร้างใบส่งงานตัด</a>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-row-reverse">
        <button onclick="history.back()" type="button" class="btn btn-danger w-100">ย้อนกลับ</button>
    </div>
</div>

@endsection

@section('modal')

@endsection

@section('scripts')
<script src="{{ mix('js/order-update.js') }}" defer></script>
@endsection