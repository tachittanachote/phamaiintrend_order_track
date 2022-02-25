@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="row mt-4">
	<div class="col-12">
    
        <div class="h3 mb-3">ข้อมูลลูกค้า {{$customer->facebook_name}}</div>
                
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
                <form action="/customer/edit" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="facebook_name">ชื่อ Facebook ลูกค้า</label>
                        <input type="text" class="form-control" placeholder="{{$customer->facebook_name}}" value="{{$customer->facebook_name}}" disabled>
                        <input type="text" class="form-control" name="facebook_name" placeholder="{{$customer->facebook_name}}" value="{{$customer->facebook_name}}" hidden>
                    </div>
                    <div class="form-group">
                        <label for="real_name">ชื่อ-นามสกุลลูกค้า</label>
                        <input type="text" class="form-control" name="real_name" placeholder="{{$customer->customer_name}}" value="{{$customer->customer_name}}">
                    </div>
                    <div class="form-group">
                        <label for="address">ที่อยู่</label>
                        <input type="text" class="form-control" name="address" placeholder="{{$customer->address}}" value="{{$customer->address}}">
                    </div>
                    <div class="form-group">
                        <label for="phone_number">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" name="phone_number" placeholder="{{$customer->phone_number}}" value="{{$customer->phone_number}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary add-customer">บันทึก</button>
                    </div>
                </form>
            <div>
        </div>


	</div> 
</div>
@endsection

@section('scripts')
@endsection