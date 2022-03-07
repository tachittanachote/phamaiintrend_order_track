@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">
        <div class="h3 mb-3">เพิ่มข้อมูลโปรโมชั่น</div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="upload">รูปภาพประกอบ</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="upload">
                                <label class="custom-file-label" for="upload" id="upload-label">เลือกอัพโหลดรูปภาพ</label>
                            </div>
                            <div id="upload-feedback" class="invalid-feedback">
                                โปรดระบุข้อมูลให้ครบถ้วน
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="detail">รายละเอียด</label>
                            <textarea type="text" class="form-control" id="detail" rows="5"></textarea>
                            <div id="detail-feedback" class="invalid-feedback">
                                โปรดระบุชื่อผู้ใช้งานให้ครบถ้วน
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link">ลิงค์โปรโมชั่น</label>
                            <input type="text" class="form-control" id="link" />
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary add-promotion">เพิ่มข้อมูลโปรโมชั่น</button>
                        </div>
                    <div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row mt-3">
    <div class="col-12">
                    @php
                        $count = 0;
                    @endphp

                    @if(count($result) > 0)
                    @php
                        $count = 1;
                    @endphp
                    <div class="row mt-3">
                        @foreach($result as $r)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    @if($r->link)<a href="">@endif
                                    <img class="img-fluid mb-3" src="/storage/upload/{{$r->image_url}}" />
                                    @if($r->link)</a>@endif
                                    <div>รายละเอียด: {{$r->detail}}</div>
                                    <div>สร้างเมื่อ: {{$r->created_at}}</div>
                                    <button class="btn-sm btn btn-danger remove-promotion w-100 mt-3" data-id="{{$r->id}}">นำออก</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
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
<script src="{{ mix('js/promotion.js') }}" defer></script>
@endsection