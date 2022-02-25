@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">

        <div class="h3 mb-3">อัพโหลดเอกข้อมูลสาร</div>

        <div class="card">
            <div class="card-body">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload">
                        <label class="custom-file-label" for="upload" id="upload-label">เลือกเอกสารอัพโหลด</label>
                    </div>
                </div>
                <div id="uploadFeedback" class="invalid-feedback mb-2">โปรดระบุข้อมูลให้ครบถ้วน</div>
                <div class="input-group mt-2">
                    <button type="button" class="btn btn-primary w-100" id="upload-btn">ยืนยันอัพโหลด</button>
                </div>
            <div>
        </div>
	</div>
        
</div>
@endsection

@section('modal')

@endsection

@section('scripts')

@endsection