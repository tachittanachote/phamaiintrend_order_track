@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">

        <div class="h3 mb-3">อัพโหลดรูปภาพสินค้า</div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>เลือกสินค้าที่ต้องการเพิ่ม</label>
                    <select class="form-control" id="product">
                        @foreach($products as $product)
                        <option value="{{$product->product_code}}">{{$product->product_code}}</option>
                        @endforeach
                        @foreach($productsCode as $product)
                        <option value="{{$product->product_code}}">{{$product->product_code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload">
                        <label class="custom-file-label" for="upload" id="upload-label">เลือกเอกสารอัพโหลด</label>
                    </div>
                </div>
                <div id="uploadFeedback" class="invalid-feedback mb-2">โปรดระบุข้อมูลให้ครบถ้วน</div>
                <div class="input-group mt-2">
                    <button type="button" class="btn btn-primary w-100" id="upload-image">ยืนยันอัพโหลด</button>
                </div>
            <div>
        </div>
	</div>
        
</div>

<div class="row mt-4" id="img-list" style="display: none;">
	<div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="form-group text-center">
                    <label>รูปภาพรหัสสินค้า</label>
                    
                    <div class="row justify-content-center" id="image-list" >
                        
                    </div>
            <div>
        </div>
	</div>
        
</div>
@endsection

@section('modal')

@endsection

@section('scripts')
<script src="{{ mix('js/add-product-image.js') }}" defer></script>
@endsection