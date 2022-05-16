@extends('layouts.grain')

@section('title', 'หน้าแรก')

@section('content')

<div class="mb-3 mb-md-4">
	<div class="h3 mb-0 animate__animated animate__fadeInLeft">หน้าแรก</div>
    <div class="h3 py-2 font-weight-bold animate__animated animate__fadeInLeft animate__slow">ยินดีตอนรับคุณ {{ auth()->user()->name }}!</div>
</div>

<div class="row mt-4">
    <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
		<!-- Widget -->
		<a target="_blank" rel="noopener noreferrer" href="{{route('scan')}}">
			<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
				<div class="icon icon-lg bg-secondary rounded-circle mr-3">
					<i class="fas fa-qrcode text-white"></i>
				</div>
				<div>
					<h6 class="mb-0">ติดตามสแกนงาน</h6>
				</div>
			</div>
		</a>
		<!-- End Widget -->
	</div>

	<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
		<!-- Widget -->
		<a target="_blank" rel="noopener noreferrer" href="{{route('order.pending')}}">
			<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
				<div class="icon icon-lg bg-secondary rounded-circle mr-3">
					<i class="fas fa-list-ol text-white"></i>
				</div>
				<div>
					<h6 class="mb-0">รายการยังไม่ได้ส่งช่าง</h6>
				</div>
			</div>
		</a>
		<!-- End Widget -->
	</div>

	    <div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
		<!-- Widget -->
		<a target="_blank" rel="noopener noreferrer" href="{{route('order.delivery')}}">
			<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
				<div class="icon icon-lg bg-secondary rounded-circle mr-3">
					<i class="fas fa-tshirt text-white"></i>
				</div>
				<div>
					<h6 class="mb-0">สินค้าค้างส่งทั้งหมด</h6>
				</div>
			</div>
		</a>
		<!-- End Widget -->
	</div>

</div>

<div class="row mt-2">


		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
			<!-- Widget -->
			<a target="_blank" rel="noopener noreferrer" href="{{route('customerlist')}}">
				<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
					<div class="icon icon-lg bg-secondary rounded-circle mr-3">
						<i class="fas fa-users text-white"></i>
					</div>
					<div>
						<h6 class="mb-0">ลูกค้าทั้งหมด</h6>
					</div>
				</div>
			</a>
			<!-- End Widget -->
		</div>

		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
			<!-- Widget -->
			<a target="_blank" rel="noopener noreferrer" href="{{route('approvework')}}">
				<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
					<div class="icon icon-lg bg-secondary rounded-circle mr-3">
						<i class="fas fa-clipboard-check text-white mb-2"></i>
					</div>
					<div>
						<h6 class="mb-0">QC ตรวจงาน</h6>
					</div>
				</div>
			</a>
			<!-- End Widget -->
		</div>

		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">
			<!-- Widget -->
			<a target="_blank" rel="noopener noreferrer" href="{{route('upload-track')}}">
				<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
					<div class="icon icon-lg bg-secondary rounded-circle mr-3">
						<i class="fas fa-box text-white"></i>
					</div>
					<div>
						<h6 class="mb-0">จัดการข้อมูลการส่งพัสดุ</h6>
					</div>
				</div>
			</a>
			<!-- End Widget -->
		</div>

</div>

<!-- <div class="row mt-2">


		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">

			<a target="_blank" rel="noopener noreferrer" href="{{route('orderpending')}}">
				<div class="card flex-row align-items-center p-3 p-md-4 animate__animated animate__fadeInUp clickable">
					<div class="icon icon-lg bg-secondary rounded-circle mr-3">
					<i class="far fa-clock text-white"></i>
					</div>
					<div>
						<h6 class="mb-0">ตรวจสอบระยะเวลาออเดอร์</h6>
					</div>
				</div>
			</a>

		</div>

		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">

		</div>

		<div class="col-md-6 col-xl-4 mb-3 mb-xl-4">

		</div>

</div> -->

@endsection

@section('modal')

@endsection

@section('scripts')

@endsection