@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">

        <div class="h3 mb-3">รายการสินค้า</div>

                <div class="card">
                    <div class="card-body">

                        @foreach($orderList as $order) 
                        {{\Carbon\Carbon::parse($order->created_at)->diffInMonths(\Carbon\Carbon::now())}}
                        @endforeach

                        {{$orderList}}
                    <div>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection

@section('modal')

@endsection

@section('scripts')

@endsection