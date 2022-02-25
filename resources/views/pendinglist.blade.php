@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="row mt-4">
	<div class="col-12">

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
                                            <th class="font-weight-semi-bold border-top-0 py-2">รหัสสินค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะการส่งงานช่าง</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2"></th>
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
                                                <a href="/order/detail?facebook_name={{$order->facebook_name}}">{{$order->facebook_name}}</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a href="/order/detail?facebook_name={{$order->facebook_name}}">{{$order->customer_name}}</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->product_code}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                @if($order->printed == 0)
                                                    <span class="badge badge-danger">ยังไม่ปริ้นส่งงานช่าง</span>
                                                @else
                                                    <span class="badge badge-success">ปริ้นส่งงานแล้ว</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" class="btn btn-success btn-sm" href="/order/check?order_id={{$order->id}}">จัดการ</a>
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
        window.location.href = `/order?${querystring}`

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
        window.location.href = `/order?${querystring}`
	  }
	});
</script>
@endsection