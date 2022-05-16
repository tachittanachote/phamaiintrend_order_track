@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="row mt-4">
	<div class="col-12">

                    <div class="h3 mb-3">รายการออเดอร์ของ {{$customerName}}</div>
                    <input id="name" value="{{Auth::user()->name}}" hidden>
                    <input id="user_id" value="{{Auth::user()->id}}" hidden>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-9 col-md-6 col-sm-12 mb-2">
                                <label>หมายเลขออเดอร์</label>
                                <input class="form-control form-control-sm" type="text" id="order_id" value="{{$orderId ? $orderId : ''}}" autocomplete="x"/>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                                <label>ระบุวันที่</label>
                                <input class="form-control form-control-sm" type="text" name="daterange" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <label>สถานะกาส่ง</label>
                                <select class="form-control form-control-sm" id="delivery_status">
                                    <option {{!isset($deliveryStatus) || $deliveryStatus != "1" || $orderCompleted != "0" ? 'selected': ''}} value="3">ไม่ได้ระบุ</option>
                                    <option {{isset($deliveryStatus) && $deliveryStatus == "0" ? 'selected': ''}} value="0">ยังไม่ได้ส่ง</option>
                                    <option {{isset($deliveryStatus) && $deliveryStatus == "1" ? 'selected': ''}} value="1">ส่งแล้ว</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <label>สถานะการปริ้น</label>
                                <select class="form-control form-control-sm" id="print_status">
                                    <option {{!isset($printStatus) || $printStatus != "1" || $printStatus != "0" ? 'selected': ''}} value="3">ไม่ได้ระบุ</option>
                                    <option {{isset($printStatus) && $printStatus == "0" ? 'selected': ''}} value="0">ยังไม่ได้ปริ้น</option>
                                    <option {{isset($printStatus) && $printStatus == "1" ? 'selected': ''}} value="1">ปริ้นแล้ว</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                                <label>สถานะออเดอร์</label>
                                <select class="form-control form-control-sm" id="order_completed">
                                    <option {{!isset($orderCompleted) || $orderCompleted != "1" || $orderCompleted != "0" ? 'selected': ''}} value="3">ไม่ได้ระบุ</option>
                                    <option {{isset($orderCompleted) && $orderCompleted == "0" ? 'selected': ''}} value="0">อยู่ระหว่างดำเนินการ</option>
                                    <option {{isset($orderCompleted) && $orderCompleted == "1" ? 'selected': ''}} value="1">ดำเนินการเสร็จสิ้น</option>
                                </select>
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
                                <button type="button" class="btn btn-primary btn-sm w-100" id="search"><i class="fas fa-search"></i> ค้นหา</button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <a target="_blank" rel="noopener noreferrer" href="/ordersummary?facebook_name={{$customerName}}&startAt={{$startAt}}&endAt={{$endAt}}" class="btn btn-warning btn-sm w-100" style="color:black"> สรุปรายการออเดอร์</a>
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
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะการส่งลูกค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะการส่งงานช่าง</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะงาน</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">รูปภาพ</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2"></th>
                                            <th class="font-weight-semi-bold border-top-0 py-2"></th>
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
                                                {{$order->facebook_name}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->customer_name}}
                                            </div>
                                        </td>
                                       
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->detail}}
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
                                                @if($order->printed == 0)
                                                    <span class="badge badge-danger">ยังไม่ปริ้นส่งงานช่าง</span>
                                                @else
                                                    <span class="badge badge-success">ปริ้นส่งงานแล้ว</span>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" href="/timeline?order_id={{$order->id}}">
                                                @php
                                                    $orderStatus = \App\OrderStatus::getOrderStatusByOrderId($order->id);
                                                    $status = \App\OrderStatus::getOrderStatus($orderStatus ? $orderStatus->status : null);
                                                @endphp
                                                @if($orderStatus)
                                                    @if($orderStatus->status == "pending")
                                                        <span class="badge badge-danger">{{$status}}</span>
                                                    @elseif($orderStatus->status == "processing")
                                                        <span class="badge badge-warning">{{$status}}</span>
                                                    @elseif($orderStatus->status == "cutting")
                                                        <span class="badge badge-info">{{$status}}</span>
                                                    @elseif($orderStatus->status == "cut_completed")
                                                        <span class="badge badge-info"><span class="text-red">*</span> {{$status}}</span>
                                                    @elseif($orderStatus->status == "sewing")
                                                        <span class="badge badge-success">{{$status}}</span>
                                                    @elseif($orderStatus->status == "sew_completed")
                                                        <span class="badge badge-success"><span class="text-red">*</span> {{$status}}</span>
                                                    @elseif($orderStatus->status == "shipping")
                                                        <span class="badge badge-green">{{$status}}</span>
                                                    @elseif($orderStatus->status == "prepare_shipping")
                                                        <span class="badge badge-greenlight">{{$status}}</span>
                                                    @elseif($orderStatus->status == "shipped")
                                                        <span class="badge badge-greenlight">{{$status}}</span>
                                                    @else
                                                        <span class="badge badge-danger">{{$status}}</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-danger">{{$status}}</span>
                                                @endif
                                                </a>
                                            </div>
                                        </td>

                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $productImage = \App\ProductImage::where('product_code', $order->product_code)->first();
                                                @endphp
                                                @if($productImage)
                                                    <button class="btn btn-secondary btn-sm w-100" data-toggle="modal" data-target="#image-{{$order->id}}"><i class="far fa-eye"></i> ดู</button>
                                                @else
                                                    <a target="_blank" rel="noopener noreferrer" href="/add-product-image" class="btn btn-secondary btn-sm w-100"><i class="fas fa-plus"></i> เพิ่มรูปภาพ</a>
                                                @endif
                                            </div>
                                        </td>

                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
												@php
                                                    $orderStatus = \App\OrderStatus::getOrderStatusByOrderId($order->id);
                                                    $status = \App\OrderStatus::getOrderStatus($orderStatus ? $orderStatus->status : null);
                                                @endphp
												@if($status == "สินค้าส่งแล้ว" || $status == "สินค้าเตรียมจัดส่ง")
													<button class="btn btn-warning mark-unready btn-sm" style="color: black !important;" data-id="{{$order->id}}"><i class="fas fa-redo"></i> ยกเลิกพร้อมส่ง</button>
												@else
													<button class="btn btn-info mark-ready btn-sm" data-id="{{$order->id}}"><i class="fas fa-check"></i> สินค้าพร้อมส่ง</button>
												@endif
                                            </div>
                                        </td>

                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" class="btn btn-success btn-sm make-sheet" href="/order/check?order_id={{$order->id}}"><i class="far fa-file-alt"></i> สร้างใบส่งช่าง</a>
                                            </div>
                                        </td>
                                        
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-danger btn-sm remove-order" data-id="{{$order->id}}"><i class="far fa-trash-alt"></i> ลบ</button>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-success line-btn btn-sm" data-toggle="modal" data-target="#notify-{{$order->id}}"><i class="fab fa-line"></i> แจ้งตามงาน</button>
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

@section('modal')
    @if(count($result) > 0)
        @foreach($result as $order)
        <div class="modal fade" id="image-{{$order->id}}" tabindex="-1" aria-labelledby="image-{{$order->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="image-{{$order->id}}">รูปภาพหมายเลขสินค้า</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
                try {
                    $productImage = \App\ProductImage::where('product_code', $order->product_code)->first();
                }
                catch (Exception $e) {

                }
            @endphp
            <div class="modal-body">
                @if($productImage)
                <img class="img-fluid" src="/storage/upload/{{$productImage->image_url}}" alt="{{$productImage->product_code}}">
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100" class="close" data-dismiss="modal" aria-label="Close">ตกลง</button>
            </div>
            </div>
        </div>
        </div>
        @endforeach
    @endif


    @if(count($result) > 0)
        @foreach($result as $order)
        <div class="modal fade" id="notify-{{$order->id}}" tabindex="-1" aria-labelledby="notify-{{$order->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ระบุข้อความแจ้งติดตามงานช่าง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                $orderTracking = \App\OrderTrack::where('order_id', $order->id)->orderBy('id', 'desc')->first();
                $notifies = \App\Notify::where('order_id', $order->id)->get();
                @endphp
                
                <div class="mb-2">ผู้รับผิดชอบงานขณะนี้: {{isset($orderTracking->employee) ? $orderTracking->employee : "ไม่มีผู้รับผิดชอบขณะนี้"}}</div>

                <div class="mb-2">รายการสถานะการแจ้งเตือนติดตาม:</div>
                <ul class="list-group">
                    @if(count($notifies) > 0) 
                        @foreach($notifies as $n)
                            <li class="list-group-item">ประเภท: {{$n->type == "broadcast" ? "บอร์ดแคส" : "แจ้งเตือนส่วนตัว"}} แจ้งให้: {{$n->type == "broadcast" ? "ทุกคน" : $n->detail}} สถานะการแจ้งเตือน: {{$n->status == "pending" ? "กำลังทำงาน" : "ยกเลิกแล้ว"}}<a href="/notify/remove/{{$n->id}}"><span class="badge bg-danger text-white">ลบการแจ้งเตือน</span></a></li>
                        @endforeach
                    @else
                    <li class="list-group-item">ไม่พบรายการการแจ้งติดตามงาน</li>
                    @endif
                </ul>

                <hr class="mb-4"/>
                <label>ข้อความ</label>
                <input class="form-control form-control-sm" type="text" name="notify_message-{{$order->id}}" id="notify_message-{{$order->id}}" />
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success w-100 notify" data-id="{{$order->id}}">แจ้ง</button>
                <button type="button" class="btn btn-primary w-100" class="close" data-dismiss="modal" aria-label="Close">ยกเลิก</button>
            </div>
            </div>
        </div>
        </div>
        @endforeach
    @endif

@endsection

@section('scripts')
<script src="{{ mix('js/detail.js') }}" defer></script>
<script>

    var startAt = null;
    var endAt = null;

    $('input[name="daterange"]').daterangepicker({
        "startDate": moment("{{isset($startAt) ? $startAt : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
        "endDate": moment("{{isset($endAt) ? $endAt : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
        opens: 'center',
        "locale": {
                "format": "DD/MM/YYYY",
                "separator": " ถึง ",
                "applyLabel": "ตกลง",
                "cancelLabel": "ยกเลิก",
                "fromLabel": "จาก",
                "toLabel": "ถึง",
                "customRangeLabel": "Custom",
                "weekLabel": "W",
                "daysOfWeek": [
                    "อา",
                    "จ",
                    "อ",
                    "พ",
                    "พฤ",
                    "ศ",
                    "ส"
                ],
                "monthNames": [
                    "มกราคม",
                    "กุมภาพันธ์",
                    "มีนาคม",
                    "เมษายน",
                    "พฤษภาคม",
                    "มิถุนายน",
                    "กรกฎาคม",
                    "สิงหาคม",
                    "กันยายน",
                    "ตุลาคม",
                    "พฤศจิกายน",
                    "ธันวาคม"
                ],
                "firstDay": 1
            },
    }, function(start, end, label) {
        startAt = start.format("YYYY-MM-DD")
        endAt = end.format("YYYY-MM-DD")
    });

    function queryBuilder(data) {
        const ret = [];
        for (let d in data)
            ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
        return ret.join('&');
    }

    $("#search").on("click", function(e) {
        e.preventDefault();

        const orderId = $("#order_id")
        const printStatus = $("#print_status")
        const deliveryStatus = $("#delivery_status")
        const productCode = $("#product_code")
        const orderCompleted = $("#order_completed")

        const querParams = { 
            'facebook_name': `{{$customerName}}`, 
        };
		
		if(startAt && endAt) {         
			Object.assign(querParams, { 
				'startAt': `${startAt}`, 
				'endAt': `${endAt}`, 
			})
		}

        if(orderId.val()) {
            Object.assign(querParams, { order_id: orderId.val()})
        }

        if(productCode.val()) {
            Object.assign(querParams, { product_code: productCode.val()})
        }

        if(printStatus.val()) {
            Object.assign(querParams, { print_status: printStatus.val()})
        }

        if(deliveryStatus.val()) {
            Object.assign(querParams, { delivery_status: deliveryStatus.val()})
        }

        if(orderCompleted.val()) {
            Object.assign(querParams, { order_completed: orderCompleted.val()})
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/order/detail?${querystring}`

    })
	
	$(document).keypress(function(e) {
	  if(e.which == 13) {
        const orderId = $("#order_id")
        const printStatus = $("#print_status")
        const deliveryStatus = $("#delivery_status")
        const productCode = $("#product_code")
        const orderCompleted = $("#order_completed")

        const querParams = { 
            'facebook_name': `{{$customerName}}`, 
        };
		
		if(startAt && endAt) {         
			Object.assign(querParams, { 
				'startAt': `${startAt}`, 
				'endAt': `${endAt}`, 
			})
		}

        if(orderId.val()) {
            Object.assign(querParams, { order_id: orderId.val()})
        }

        if(productCode.val()) {
            Object.assign(querParams, { product_code: productCode.val()})
        }

        if(printStatus.val()) {
            Object.assign(querParams, { print_status: printStatus.val()})
        }

        if(deliveryStatus.val()) {
            Object.assign(querParams, { delivery_status: deliveryStatus.val()})
        }

        if(orderCompleted.val()) {
            Object.assign(querParams, { order_completed: orderCompleted.val()})
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/order/detail?${querystring}`
	  }
	});
</script>
@endsection