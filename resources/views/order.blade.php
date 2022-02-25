@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="row mt-4">
	<div class="col-12">

                    <div class="h3 mb-3">รายการงานในระบบ</div>
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
                                <label>สถานะออเดอร์</label>
                                <select class="form-control form-control-sm" id="order_completed">
                                    <option {{!isset($orderCompleted) || $orderCompleted != "1" || $orderCompleted != "0" ? 'selected': ''}} value="3">ไม่ได้ระบุ</option>
                                    <option {{isset($orderCompleted) && $orderCompleted == "0" ? 'selected': ''}} value="0">อยู่ระหว่างดำเนินการ</option>
                                    <option {{isset($orderCompleted) && $orderCompleted == "1" ? 'selected': ''}} value="1">ดำเนินการเสร็จสิ้น</option>
                                </select>
                            </div>
                        </div>

                        <div class="row" id="delivery_time_block" style="display: none;">
                            <div class="col-12 mb-2">
                                <label>ระบุช่วงเวลาสถานะออเดอร์</label>
                                <input class="form-control" id="deli" type="text">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-12 mb-2">
                                <label>สถานะการส่งงานลูกค้า</label>
                                <select class="form-control form-control-sm" id="delivery_status">
                                    <option {{!isset($deliveryStatus) || $deliveryStatus != "1" || $deliveryStatus != "0" ? 'selected': ''}} value="3">ไม่ได้ระบุ</option>
                                    <option {{isset($deliveryStatus) && $deliveryStatus == "0" ? 'selected': ''}} value="0">ยังไม่ได้ส่ง</option>
                                    <option {{isset($deliveryStatus) && $deliveryStatus == "1" ? 'selected': ''}} value="1">ส่งแล้ว</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12 mb-2">
                                <label> </label>
                                <div class="form-check" id="customerTimeCheckDisplay" style="display: none;">
                                    <input class="form-check-input" type="checkbox" value="" id="customerTimeCheck">
                                    <label class="form-check-label" for="customerTimeCheck">
                                        ระบุเวลา
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 mb-2">

                                <div style="display: none;" id="customerTimePickDisplay">
                                    <label>เวลา</label>
                                    <input class="form-control form-control-sm" type="text" name="daterange" readonly id="customerTimePick"/>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-12 mb-2">
                                <label>สถานะการส่งงานช่าง</label>
                                <select class="form-control form-control-sm" id="print_status">
                                    <option {{!isset($printStatus) || $printStatus != "1" || $printStatus != "0" ? 'selected': ''}} value="3">ไม่ได้ระบุ</option>
                                    <option {{isset($printStatus) && $printStatus == "0" ? 'selected': ''}} value="0">ยังไม่ได้ปริ้น</option>
                                    <option {{isset($printStatus) && $printStatus == "1" ? 'selected': ''}} value="1">ปริ้นส่งงานแล้ว</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12 mb-2">
                                <label> </label>
                                <div class="form-check" id="workTimeCheckDisplay" style="display: none;">
                                    <input class="form-check-input" type="checkbox" value="" id="workTimeCheck">
                                    <label class="form-check-label" for="workTimeCheck">
                                        ระบุเวลา
                                    </label>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-12 mb-2">
                                <div style="display: none;" id="workTimePickDisplay">
                                    <label>เวลา</label>
                                    <input class="form-control form-control-sm" type="text" name="daterange" readonly id="workTimePick"/>
                                </div>
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
                                            <th class="font-weight-semi-bold border-top-0 py-2">รหัสสินค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะการส่งลูกค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะการส่งงานช่าง</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">สถานะงาน</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">รูปภาพ</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">ข้อมูลออเดอร์</th>
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
                                                <a target="_blank" rel="noopener noreferrer" href="/order/detail?facebook_name={{$order->facebook_name}}&startAt={{$startAt}}&endAt={{$endAt}}">{{$order->facebook_name}}</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" href="/order/detail?facebook_name={{$order->facebook_name}}&startAt={{$startAt}}&endAt={{$endAt}}">{{$order->customer_name}}</a>
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
                                                <a target="_blank" rel="noopener noreferrer" href="/order/detail?facebook_name={{$order->facebook_name}}&startAt={{$startAt}}&endAt={{$endAt}}" class="btn btn-secondary btn-sm"><i class="fas fa-external-link-alt"></i> จัดการออเดอร์</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-danger btn-sm remove-order" data-id="{{$order->id}}"><i class="far fa-trash-alt"></i> ลบ</button>
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
        <div class="modal-body">
            @php
                $productImage = \App\ProductImage::where('product_code', $order->product_code)->first();
            @endphp
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
@endsection

@section('scripts')
<script>

    var print_startDate = "{{isset($print_startDate) ? $print_startDate : $current->format('Y-m-d')}}"
    var print_endDate = "{{isset($print_endDate) ? $print_endDate : $current->format('Y-m-d')}}"

    var delivery_startDate = "{{isset($delivery_startDate) ? $delivery_startDate : $current->format('Y-m-d')}}"
    var delivery_endDate = "{{isset($delivery_endDate) ? $delivery_endDate : $current->format('Y-m-d')}}"

    @if($deliveryStatus)
        $("#customerTimeCheckDisplay").css('display', 'block')
    @endif

    @if($printStatus)
        $("#workTimeCheckDisplay").css('display', 'block')
    @endif

    @if($printCheck)
        $("#workTimeCheck").prop('checked', true);
        $("#workTimeCheckDisplay").css('display', 'block')
        $("#workTimePickDisplay").css('display', 'block')
    @endif

    @if($deliveryCheck)
        $("#customerTimeCheck").prop('checked', true);
        $("#customerTimeCheckDisplay").css('display', 'block')
        $("#customerTimePickDisplay").css('display', 'block')
    @endif

    $("#print_status").on('change', function() {
        if($(this).val() == 1) {
            $("#workTimeCheckDisplay").css('display', 'block')
        }else {
            $("#workTimeCheckDisplay").css('display', 'none')
            $("#workTimePickDisplay").css('display', 'none')
            $("#workTimeCheck").prop('checked', false); 
        }
    })

    $("#delivery_status").on('change', function() {
        if($(this).val() == 1) {
            $("#customerTimeCheckDisplay").css('display', 'block')
        }else {
            $("#customerTimeCheckDisplay").css('display', 'none')
            $("#customerTimePickDisplay").css('display', 'none')
            $("#customerTimeCheck").prop('checked', false); 
        }
    })

    $("#customerTimeCheck").on('change', function() {
        if($(this).is(":checked")) {
            $("#customerTimePickDisplay").css('display', 'block')
        }else {
            $("#customerTimePickDisplay").css('display', 'none')
        }
    });

    $("#workTimeCheck").on('change', function() {
        if($(this).is(":checked")) {
            $("#workTimePickDisplay").css('display', 'block')
        } else {
            $("#workTimePickDisplay").css('display', 'none')
        }
    });

    $('#workTimePick').daterangepicker({
        "startDate": moment("{{isset($print_startDate) ? $print_startDate : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
        "endDate": moment("{{isset($print_endDate) ? $print_endDate : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
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
        print_startDate = start.format("YYYY-MM-DD")
        print_endDate = end.format("YYYY-MM-DD")
    });

    $('#customerTimePick').daterangepicker({
        "startDate": moment("{{isset($delivery_startDate) ? $delivery_startDate : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
        "endDate": moment("{{isset($delivery_endDate) ? $delivery_endDate : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
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
        delivery_startDate = start.format("YYYY-MM-DD")
        delivery_endDate = end.format("YYYY-MM-DD")
    });

    var startAt = null
    var endAt = null

    var deli_startDate = "{{isset($deli_startDate) ? $deli_startDate : $current->format('Y-m-d')}}"
    var deli_endDate = "{{isset($deli_endDate) ? $deli_endDate : $current->format('Y-m-d')}}"

    @if(isset($orderCompleted) && $orderCompleted != "3")
    $("#delivery_time_block").css('display', 'block')
    @endif

    $('#deli').daterangepicker({
        "startDate": moment("{{isset($deli_startDate) ? $deli_startDate : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
        "endDate": moment("{{isset($deli_endDate) ? $deli_endDate : $current->format('Y-m-d')}}").format("DD/MM/YYYY"),
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
        deli_startDate = start.format("YYYY-MM-DD")
        deli_endDate = end.format("YYYY-MM-DD")
    });

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

    $("#order_completed").on('change', function(e) {
        if($(this).val() == 0 || $(this).val() == 1) {
            $("#delivery_time_block").css('display', 'block')
        } else {
            $("#delivery_time_block").css('display', 'none')
        }
        if($(this).val() == 3) {
            deli_startDate = null
            deli_endDate = null
        }
    })

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

        const querParams = {};

        if(startAt && endAt) {
            Object.assign(querParams, { 
                'startAt': `${startAt}`, 
                'endAt': `${endAt}`, 
            })
        }

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

        if(orderCompleted.val() != 3) {
            Object.assign(querParams, { order_completed: orderCompleted.val()})
        }

        if(printStatus.val() == 0) {
            Object.assign(querParams, { print_status: printStatus.val()})
        }

        if(deliveryStatus.val() == 0) {
            Object.assign(querParams, { delivery_status: deliveryStatus.val()})
        }

        if(printStatus.val() == 1) {
            if(!$("#workTimeCheck").is(":checked")) {
                Object.assign(querParams, { 
                    print_status: printStatus.val()
                })
            }
            if($("#workTimeCheck").is(":checked")) {
                Object.assign(querParams, { 
                    print_status: printStatus.val(),
                    print_check: "true",
                    print_startDate: print_startDate,
                    print_endDate: print_endDate
                })
            }
        }

        if(deliveryStatus.val() == 1) {
            
            if(!$("#customerTimeCheck").is(":checked")) {
                Object.assign(querParams, { 
                    delivery_status: deliveryStatus.val()
                })
            }
            if($("#customerTimeCheck").is(":checked")) {
                Object.assign(querParams, { 
                    delivery_status: deliveryStatus.val(),
                    delivery_check: "true",
                    delivery_startDate: delivery_startDate,
                    delivery_endDate: delivery_endDate
                })
            }
        }

        if(deli_startDate && deli_endDate) {
            Object.assign(querParams, { 
                'deli_startDate': `${deli_startDate}`, 
                'deli_endDate': `${deli_endDate}`, 
            })
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

        const querParams = {};

        if(startAt && endAt) {
            Object.assign(querParams, { 
                'startAt': `${startAt}`, 
                'endAt': `${endAt}`, 
            })
        }

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

        if(deli_startDate && deli_endDate) {
            Object.assign(querParams, { 
                'deli_startDate': `${deli_startDate}`, 
                'deli_endDate': `${deli_endDate}`, 
            })
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/order?${querystring}`
	  }
	});
</script>
@endsection