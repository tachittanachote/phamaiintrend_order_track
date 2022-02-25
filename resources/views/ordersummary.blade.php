<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>สรุปรายการจัดส่งสินค้าร้านผ้าไหมอินเทรนด์</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>

        html, body {
            background-color: #f3f3f3;
            font-family: 'Prompt', sans-serif;
            color: #565656;
        }

        .btn:focus,.btn:active {
            outline: none !important;
            box-shadow: none;
        }
        
        .btn-pm {
            background-color: #a28579;
            color:aliceblue;
        }

        .btn-pm:hover {
            background-color: #91756a;
            color:aliceblue;
        }

        textarea:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="datetime"]:focus,
        input[type="datetime-local"]:focus,
        input[type="date"]:focus,
        input[type="month"]:focus,
        input[type="time"]:focus,
        input[type="week"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="color"]:focus,
        .uneditable-input:focus {   
        border-color: #dfc4b8;
        box-shadow: 0 1px 1px rgba(218, 218, 218, 0.075) inset, 0 0 8px #dfc4b8;
        outline: 0 none;
        }

        th, td {
                padding: 10px;
        }
    </style>
</head>
<body>

    @php
		$count_no = 0;
        $count_ok = 0;
	@endphp

    <div class="container mt-5" id="canvas">
        <div class="row">
            <div class="col">
                <div class="h5 text-center">
                    สรุปรายการออเดอร์
                </div>
                <div class="text-center">ร้านผ้าไหมอินเทรนด์</div>
                <div class="text-center">รายการออเดอร์วันที่ {{\Carbon\Carbon::parse($startAt)->format('d/m/Y')}}</div>
            </div>
        </div>
        <table class="w-100 mt-3" border="1">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <p class="font-weight-bold">ผู้จัดส่ง: </p>
                        <div>ร้านผ้าไหมอินเทรนด์</div>
                        <div>221 หมู่2 ต.ห้วยแก อ.ชนบท จ.ขอนแก่น</div>
                        <div>40180</div>
                        <div>เบอร์โทรศัพท์ 088-8215969</div>
                    </td>
                    <td style="width: 50%;">
                        @php
                            $user = \App\OrderList::where('facebook_name', $customerName)->first();
                        @endphp
                        <p class="font-weight-bold">ผู้รับ: </p>
                        <div>หมายเลขลูกค้า: PM000-{{\App\Customer::where('facebook_name', $customerName)->first()->id}}</div>
                        <div>คุณ{{$user->customer_name}} (Facebook: {{$customerName}})</div>
                        <div>{{$user->address}}</div>
                        <div>เบอร์โทรศัพท์ {{$user->phone_number}}</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3">

            @php
                $completeCount = 0;
                foreach($result as $r) {
                    $orderStatus = \App\OrderStatus::where('order_id', $r->id)->orderBy('id', 'desc')->first();
                    if($orderStatus) {
                        if($orderStatus->status == "prepare_shipping") {
                            $completeCount = $completeCount + 1;
                        }
                        if($orderStatus->status == "shipping") {
                            $completeCount = $completeCount + 1;
                        }
                    }
                }
            @endphp
            @if($completeCount > 0)
            <div class="mb-3">
                <div class="mb-1">รายการที่จัดส่ง</div>
                <table class="w-100" border="1">
                    <thead>
                        <tr>
                            <th style="width: 10%;">ลำดับ</th>
                            <th>รายการสินค้า</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $r)
                            @php
                                $orderStatus = \App\OrderStatus::where('order_id', $r->id)->orderBy('id', 'desc')->first();
                            @endphp
                            <tr>
                                @if($orderStatus)
                                    @if($orderStatus->status == "prepare_shipping")
										@php $count_ok = $count_ok + 1; @endphp
                                        <input class="ready" value="{{$r->id}}" hidden>
                                        <td>{{$count_ok}}</td>
                                        <td>{{$r->detail}}</td>
                                    @endif
                                    @if($orderStatus->status == "shipping")
										@php $count_ok = $count_ok + 1; @endphp
                                        <input class="ready" value="{{$r->id}}" hidden>
                                        <td>{{$count_ok}}</td>
                                        <td>{{$r->detail}}</td>
                                    @endif
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @php
                $progressCount = 0;
                foreach($result as $r) {
                    $orderStatus = \App\OrderStatus::where('order_id', $r->id)->orderBy('id', 'desc')->first();
                    if($orderStatus) {
                        if($orderStatus->status == "prepare_shipping" || $orderStatus->status == "shipping") {
                            
                        }
                        else {
                            $progressCount = $progressCount + 1;
                        }
                    }
                    if(!$orderStatus) {
                         $progressCount = $progressCount + 1;
                    }
                }
            @endphp

            @if($progressCount > 0)
            <div>
                <div class="mb-1">รายการค้างจัดส่ง</div>
                <table class="w-100" border="1">
                    <thead>
                        <tr>
                            <th style="width: 10%;">ลำดับ</th>
                            <th>รายการสินค้า</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($result as $r)
                        @php
                            $orderStatus = \App\OrderStatus::where('order_id', $r->id)->orderBy('id', 'desc')->first();
                        @endphp
                        <tr>
                            @if($orderStatus)
                                @if($orderStatus->status == "pending" || $orderStatus->status == "processing" || $orderStatus->status == "cutting" || $orderStatus->status == "cut_completed" || $orderStatus->status == "sewing" || $orderStatus->status == "sew_completed")
                                    @php $count_no = $count_no + 1; @endphp
									<td>{{$count_no}}</td>
                                    <td>{{$r->detail}}</td>
                                @endif
                            @endif
                            @if(!$orderStatus)
								@php $count_no = $count_no + 1; @endphp
                                <td>{{$count_no}}</td>
                                <td>{{$r->detail}}</td>
                            @endif
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>

    <div class="container mt-2">
        <input id="customer_id" value="{{\App\Customer::where('facebook_name', $customerName)->first()->id}}" hidden/>
        <input id="order_progress" value="{{$count_no}}" hidden/>
        <input id="order_completed" value="{{$count_ok}}" hidden/>

        @if(Auth::check())
        <div class="row flex-row-reverse mt-2 mb-5">
            <div class="col">
                <div class="d-flex flex-row-reverse">
                    <button type="button" class="btn btn-danger" id="back" onclick="history.back()">กลับหน้าเดิม</button>
                    <button type="button" class="btn btn-success mr-2" id="print">ปริ้น</button>
                </div>
            </div>
        </div>
        @endif

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
@if(Auth::check())
<script src="{{ mix('js/printcustomer.js') }}" defer></script>
@endif
</html>