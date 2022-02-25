@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="row mt-4">
	<div class="col-12">
            <div class="h3 mb-3">รายชื่อลูกค้าทั้งหมดในระบบ</div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label>ชื่อ Facebook</label>
                                <input class="form-control form-control-sm" type="text" id="facebook_name" value="{{$facebookName ? $facebookName : ''}}" autocomplete="a"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-2">
                                <label>ชื่อลูกค้า</label>
                                <input class="form-control form-control-sm" type="text" id="customer_name" value="{{$customerName ? $customerName : ''}}" autocomplete="c"/>
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
                                            <th class="font-weight-semi-bold border-top-0 py-2">Customer ID</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">ชื่อ Facebook</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">ชื่อลูกค้า</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">ที่อยู่</th>
                                            <th class="font-weight-semi-bold border-top-0 py-2">เบอร์โทรศัพท์</th>
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
                                                <div>PM000-{{\App\Customer::where('facebook_name', $order->facebook_name)->first()->id}}</div>
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
                                                {{$order->address}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                {{$order->phone_number}}
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            <div class="d-flex align-items-center">
                                                <a target="_blank" rel="noopener noreferrer" class="btn btn-warning" href="/customer/edit?name={{$order->facebook_name}}" style="color:black">แก้ไขข้อมูล</a>
                                            </div>
                                        </td>
                                        <td class="align-middle py-3">
                                            @if(\App\Customer::where('facebook_name', $order->facebook_name)->first()->line_id)
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-danger logout-line" data-id="{{\App\Customer::where('facebook_name', $order->facebook_name)->first()->id}}">บังคับออกจากระบบ LINE</button>
                                                </div>
                                            @endif
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

        const customerName = $("#customer_name")
        const facebookName = $("#facebook_name")

        var querParams = {}

        if(customerName.val()) {
            Object.assign(querParams, { customer_name: customerName.val()})
        }

        if(facebookName.val()) {
            Object.assign(querParams, { facebook_name: facebookName.val()})
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/customer?${querystring}`

    })
	
	$(document).keypress(function(e) {
	  if(e.which == 13) {
        const customerName = $("#customer_name")
        const facebookName = $("#facebook_name")

        var querParams = {}

        if(customerName.val()) {
            Object.assign(querParams, { customer_name: customerName.val()})
        }

        if(facebookName.val()) {
            Object.assign(querParams, { facebook_name: facebookName.val()})
        }

        const querystring = queryBuilder(querParams);
        window.location.href = `/customer?${querystring}`
	  }
	});
</script>
@endsection