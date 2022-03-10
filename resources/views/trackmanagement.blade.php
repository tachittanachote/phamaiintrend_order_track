@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')
<div class="row mt-4">
	<div class="col-12">
        <div class="h3 mb-3">จัดการข้อมูลการส่งพัสดุ</div>
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
                    <button type="button" class="btn btn-primary w-100" id="upload-btn-delivery">ยืนยันอัพโหลด</button>
                </div>
            <div>
        </div>
	</div>
</div>

<div class="row mt-4">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="mb-2 font-weight-bold">ระบุวันที่ที่ต้องการสรุป</div>
                <form action="/summarydelivery">
                    <div><input name="date" class="form-control mb-2" type="date"></div>
                    <button class="btn btn-warning w-100" style="color:black" type="submit"><i class="fas fa-list-ol"></i> สรุปรายการจัดส่งหมายเลขพัสดุ</button>
                </form>
            </div>
        </div>
    </div>
	<div class="col-12">

        <div class="card">
            <div class="card-body">
                <div class="form-group text-center">
                <label class="mb-4">รายการการจัดส่งพัสดุ</label>

                <form method="get">
                    <div><input name="date" class="form-control mb-2" type="date"></div>
                    <div><button class="btn btn-primary w-100" type="submit"><i class="fas fa-search"></i> ค้นหา</button></div>
                </form>

                <div class="table-responsive">
                    <table class="table mt-2">

                        <thead>
                            <tr>
                                <th scope="col">วันที่ส่งพัสดุ</th>
                                <th scope="col">ชื่อลูกค้า</th>
                                <th scope="col">หมายเลขติดตามพัสดุ</th>
                                <th scope="col">จัดส่งโดย</th>
                                <th scope="col">วันนี้อัพโหลด</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($result as $item)
                            <tr>
                                <td>{{$item->delivery_date}}</td>
                                <td>{{$item->customer_name}}</td>
                                <td><a target="_blank" href="https://track.thailandpost.co.th/?trackNumber={{$item->tracking_id}}">{{$item->tracking_id}}</a></td>
                                <td>{{$item->carrier}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                {{$result}}
                </div>
            <div>
        </div>
	</div>
        
</div>
@endsection

@section('modal')
@endsection

@section('scripts')
<script src="{{ mix('js/add-product.js') }}" defer></script>
@endsection