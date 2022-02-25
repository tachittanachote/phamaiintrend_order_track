import { Html5QrcodeScanner } from "html5-qrcode"
import axios from 'axios'
import $ from 'jquery'
import Swal from 'sweetalert2'
import * as bootstrap from "bootstrap";

$('.resume').css('display', 'none')
$('.timeline').css('display', 'none')

function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
    html5QrcodeScanner.pause();

    var url = new URL(decodedText);
    var orderId = url.searchParams.get("order_id");

    if (orderId) {
        $(".outer").empty();
        $(".product").empty();
        $(".edit").empty();
        axios.post('/check', {
            order_id: orderId
        }).then((resp) => {
            $('#reader').css('display', 'none')
            $('.product').css('display', 'block')
            $('.timeline').css('display', 'block')

            $('.product').append(`
                <div class="text-center">หมายเลขออเดอร์: ${resp.data.order_detail.order_number}</div>
                <div class="text-center">Facebook: ${resp.data.order_detail.facebook_name}</div>
                ${!resp.data.order_detail.customer_name ? '' : `<div class="text-center">ชื่อลูกค้า: ${resp.data.order_detail.customer_name}</div>`}
                <div class="text-center">รหัสสินค้า: ${resp.data.order_detail.product_code}</div>
                <div class="font-weight-bold text-center mt-2">รายละเอียด</div>
                <div class="text-center">${resp.data.order_detail.detail}</div>
                <button type="button" class="btn btn-warning w-100 resume mt-2 btn-sm">สแกนอีกครั้ง</button>
            `)

            if (resp.data.result.length > 0) {
                $(".outer").append(`
                    <div class="card">
                        <div class="info">
                            <div class="title"><span style="color: gray;">สินค้ากำลังรอการดำเนินการ</span></div>
                        </div>
                    </div>
                `)
                resp.data.result.forEach((value, index) => {
                    $(".outer").append(`
                        <div class="card">
                            <div class="info">
                                <div class="title"><span style="color: gray;">${formatState(value.status)} โดย</span> ${value.employee}</div>
                                <div>เมื่อเวลา ${value.created_at}</div>
                            </div>
                        </div>
                    `)
                })

            }
            if (resp.data.result.length <= 0) {
                $(".outer").append(`
                    <div class="card">
                        <div class="info">
                            <div class="title"><span style="color: gray;">สินค้ากำลังรอการดำเนินการ</span></div>
                        </div>
                    </div>
                `)
            }
            return resp
        }).then((resp) => {
            if (resp.data.result.length > 0) {
                $('.edit-detail').css('display', 'block')
                resp.data.edit_details.forEach((detail, index) => {
                    $('.edit').append(`<div class="text-danger">- ${detail.detail}</div>`)
                })
            }

            $('.resume').css('display', 'block')
        })
    }
    
}

$(".product").on("click", ".resume", function(e) {
    $('#reader').css('display', 'block')
    $(".outer").empty();
    $(".product").empty();
    $('.product').css('display', 'none')
    $('.timeline').css('display', 'none')
    $('.edit-detail').css('display', 'none')
    html5QrcodeScanner.resume()
})

function formatState(state) {
    switch (state) {
        case "pending": {
            return "รอดำเนินการ";
        }
        case "processing": {
            return "เตรียมส่งงานช่าง";
        }
        case "cutting": {
            return "กำลังตัด";
        }
        case "cut_completed": {
            return "ตัดเสร็จแล้ว";
        }
        case "sewing": {
            return "กำลังเย็บ";
        }
        case "sew_completed": {
            return "เย็บเสร็จแล้ว";
        }
        case "shipping": {
            return "กำลังจัดส่งสินค้า";
        }
        case "prepare_shipping": {
            return "สินค้าเตรียมจัดส่ง";
        }
        case "shipped": {
            return "สินค้าส่งแล้ว";
        }
        case null: {
            return "รอดำเนินการ";
        }
        default: {
            return $status;
        }
    }
}

function onScanFailure(error) {
  //console.warn(`${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);