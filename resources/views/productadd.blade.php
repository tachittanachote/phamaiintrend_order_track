@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">

        <div class="h3 mb-3">เพิ่มข้อมูลสินค้าใหม่</div>

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="product_code">รหัสสินค้า</label>
                    <input type="text" class="form-control" id="product_code" placeholder="">
                    <div id="product_code-feedback" class="invalid-feedback">
                        โปรดระบุข้อมูลให้ครบถ้วน
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_price">ราคา</label>
                    <input type="number" class="form-control" id="product_price" min="0">
                    <div id="product_price-feedback" class="invalid-feedback">
                        โปรดระบุข้อมูลให้ครบถ้วน
                    </div>
                </div>
                <div class="form-group">
                    <label for="product_detail">ราคา</label>
                    <input type="text" class="form-control" id="product_detail">
                    <div id="product_detail-feedback" class="invalid-feedback">
                        โปรดระบุข้อมูลให้ครบถ้วน
                    </div>
                </div>
                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload">
                        <label class="custom-file-label" for="upload" id="upload-label">เลือกอัพโหลดรูปภาพ</label>
                    </div>
                    <div id="upload-feedback" class="invalid-feedback">
                        โปรดระบุข้อมูลให้ครบถ้วน
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary add-product">เพิ่มข้อมูลสินค้า</button>
                </div>
            <div>
        </div>
	</div>
        
</div>

<div class="row mt-4">
	<div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="form-group text-center">
                    <label>รายการรหัสสินค้าเพื่มล่าสุด</label>
                
                    @php
                        $products = \App\Product::orderBy('created_at', 'DESC')->limit(15)->get();
                    @endphp

                <div class="table-responsive">
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th scope="col">รหัสสินค้า</th>
                                <th scope="col">รูปภาพ</th>
                                <th scope="col">รายละเอียด</th>
                                <th scope="col">เวลา</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{$product->product_code}}</td>
                                <td>
                                    @php
                                        $productImage = \App\ProductImage::where('product_code', $product->product_code)->first();
                                    @endphp
                                    @if($productImage)
                                        <button class="btn btn-secondary btn-sm w-100" data-toggle="modal" data-target="#image-{{$product->id}}"><i class="far fa-eye"></i> ดู</button>
                                    @else
                                        <a target="_blank" rel="noopener noreferrer" href="/add-product-image" class="btn btn-secondary btn-sm w-100"><i class="fas fa-plus"></i> เพิ่มรูปภาพ</a>
                                    @endif
                                </td>
                                <td>{{$product->detail}}</td>
                                <td>{{$product->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <div>
        </div>
	</div>
        
</div>
@endsection

@section('modal')
@if(count($products) > 0)
    @foreach($products as $product)
    <div class="modal fade" id="image-{{$product->id}}" tabindex="-1" aria-labelledby="image-{{$product->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="image-{{$product->id}}">รูปภาพหมายเลขสินค้า</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @php
                $productImage = \App\ProductImage::where('product_code', $product->product_code)->first();
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
<script src="{{ mix('js/add-product.js') }}" defer></script>
@endsection