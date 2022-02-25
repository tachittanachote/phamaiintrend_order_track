@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">

        <div class="h3 mb-3">เพิ่มข้อมูลลูกค้า</div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="facebook_name">ชื่อ Facebook ลูกค้า</label>
                    <input type="text" class="form-control" id="facebook_name" placeholder="">
                    <div id="facebook_name-feedback" class="invalid-feedback">
                                        โปรดระบุชื่อผู้ใช้งานให้ครบถ้วน
                                    </div>
                </div>
                <div class="form-group">
                    <label for="real_name">ชื่อ-นามสกุลลูกค้า</label>
                    <input type="text" class="form-control" id="real_name" placeholder="">
                    <div id="real_name-feedback" class="invalid-feedback">
                                        โปรดระบุชื่อผู้ใช้งานให้ครบถ้วน
                                    </div>
                </div>
                <div class="form-group">
                    <label for="address">ที่อยู่</label>
                    <input type="text" class="form-control" id="address" placeholder="">
                    <div id="address-feedback" class="invalid-feedback">
                                        โปรดระบุชื่อผู้ใช้งานให้ครบถ้วน
                                    </div>
                </div>
                <div class="form-group">
                    <label for="phone_number">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" id="phone_number" placeholder="">
                    <div id="phone_number-feedback" class="invalid-feedback">
                                        โปรดระบุชื่อผู้ใช้งานให้ครบถ้วน
                                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary add-customer">เพิ่มข้อมูลลูกค้า</button>
                </div>
            <div>
        </div>
	</div>
        
</div>
@endsection

@section('modal')

@endsection

@section('scripts')
<script src="{{ mix('js/add-customer.js') }}" defer></script>
@endsection