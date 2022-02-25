@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="row mt-4">
	<div class="col-12">

                    <div class="h3 mb-3">รายการการส่งสินค้าทั้งหมด</div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label>หมายเลขออเดอร์</label>
                                <input class="form-control form-control-sm" type="text" id="order_id" value="{{$orderId ? $orderId : ''}}" autocomplete="x"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label>ชื่อลูกค้า</label>
                                <input class="form-control form-control-sm" type="text" id="customer_name" value="{{$customerName ? $customerName : ''}}" autocomplete="c"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label>ชื่อ Facebook</label>
                                <input class="form-control form-control-sm" type="text" id="facebook_name" value="{{$facebookName ? $facebookName : ''}}" autocomplete="a"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label>รหัสสินค้า</label>
                                <input class="form-control form-control-sm" type="text" id="product_code" value="{{$productCode ? $productCode : ''}}" autocomplete="c"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <label>สถานะกาส่งงานลูกค้า</label>
                                <select class="form-control form-control-sm" id="delivery_status">
                                    <option {{isset($deliveryStatus) && $deliveryStatus == "0" ? 'selected': ''}} value="0">ยังไม่ได้ส่ง</option>
                                    <option {{isset($deliveryStatus) && $deliveryStatus == "1" ? 'selected': ''}} value="1">ส่งแล้ว</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <button type="button" class="btn btn-primary btn-sm w-100" id="search"><i class="fas fa-search"></i> ค้นหา</button>
                            </div>
                        </div>
                    </div>
                    <!-- Users -->
                    @php
                        $count = 0;
                    @endphp

                    @if(count($result) > 0)
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-semi-bold border-top-0 py-2">เลขที่ Order</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">วันที่</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">ชื่อ Facebook</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">ชื่อลูกค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">รายละเอียด</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">รหัสสินค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะการส่งลูกค้า</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($result as $order)
                                    @php
                                    $count = $count + 1
                                    @endphp
                                    <tr>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->order_number}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->order_date}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" href="/order/detail?facebook_name={{$order->facebook_name}}">{{$order->facebook_name}}</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" href="/order/detail?facebook_name={{$order->facebook_name}}">{{$order->customer_name}}</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->detail}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->product_code}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                @if($order->deliveried == 0)
                                                    <span class="badge badge-danger">ยังไม่ได้ส่ง</span>
                                                @else
                                                    <span class="badge badge-success">ส่งแล้ว</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" class="btn btn-success btn-sm" href="/order/detail?facebook_name={{$order->facebook_name}}">จัดการ</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            {{$result}}
                        </div>
                    </div>
                    @endif

                    @if($count == 0)
                        <div class="card">
                            <div class="card-body pt-0">
                                <div class="mt-3 alert alert-warning" role="alert">
                                ไม่พบรายการข้อมูลในขณะนี้
                                </div>
                            </div>
                        </div>
                    @endif
		</div>
        
</div>
@endsection

@section('scripts')
<script>

    function queryBuilder(data) {
        const ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');
    }

    $("#search").on("click", function(e) {
        e.preventDefault();

        const orderId = $("#order_id")
        const customerName = $("#customer_name")
        const facebookName = $("#facebook_name")
        const phoneNumber = $("#phone_number")
        const productCode = $("#product_code")
        const printStatus = $("#print_status")
        const deliveryStatus = $("#delivery_status")
        const orderCompleted = $("#order_completed")

        const querParams = { 
        };

        if(orderId.val()) {
            Object.assign(querParams, { order_id: orderId.val()})
        }

        if(customerName.val()) {
            Object.assign(querParams, { customer_name: customerName.val()})
        }

        if(facebookName.val()) {
            Object.assign(querParams, { facebook_name: facebookName.val()})
        }

        if(productCode.val()) {
            Object.assign(querParams, { product_code: productCode.val()})
        }

        if(orderCompleted.val()) {
            Object.assign(querParams, { order_completed: orderCompleted.val()})
        }

        if(printStatus.val()) {
            Object.assign(querParams, { print_status: printStatus.val()})
        }

        if(deliveryStatus.val()) {
            Object.assign(querParams, { delivery_status: deliveryStatus.val()})
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/order/delivery?${querystring}`

    })
	
	$(document).keypress(function(e) {
	  if(e.which == 13) {
		const orderId = $("#order_id")
        const customerName = $("#customer_name")
        const facebookName = $("#facebook_name")
        const phoneNumber = $("#phone_number")
        const productCode = $("#product_code")
        const printStatus = $("#print_status")
        const deliveryStatus = $("#delivery_status")
        const orderCompleted = $("#order_completed")

        const querParams = { 
        };

        if(orderId.val()) {
            Object.assign(querParams, { order_id: orderId.val()})
        }

        if(customerName.val()) {
            Object.assign(querParams, { customer_name: customerName.val()})
        }

        if(facebookName.val()) {
            Object.assign(querParams, { facebook_name: facebookName.val()})
        }

        if(productCode.val()) {
            Object.assign(querParams, { product_code: productCode.val()})
        }

        if(orderCompleted.val()) {
            Object.assign(querParams, { order_completed: orderCompleted.val()})
        }

        if(printStatus.val()) {
            Object.assign(querParams, { print_status: printStatus.val()})
        }

        if(deliveryStatus.val()) {
            Object.assign(querParams, { delivery_status: deliveryStatus.val()})
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/order/delivery?${querystring}`
	  }
	});
</script>
@endsection