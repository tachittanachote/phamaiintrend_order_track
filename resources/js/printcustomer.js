import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import html2canvas from 'html2canvas'

$(document).ready(() => {
    console.log("Ready!")
    window.onafterprint = function (e) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            text: "ปริ้นใบส่งงานลูกค้าเรียบร้อยแล้วใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ปริ้นแล้ว',
            cancelButtonText: 'ยังไม่ได้ปริ้น',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {


                var orders = $(".ready");

                var orderList = [];
                for (var i = 0; i < orders.length; i++) {
                    orderList.push($(orders[i]).val());
                }

                return orderList

            }
            // else if (
            //     result.dismiss === Swal.DismissReason.cancel
            // ) {
            //     swalWithBootstrapButtons.fire(
            //         'Cancelled',
            //         'Your imaginary file is safe :)',
            //         'error'
            //     )
            // }
        }).then((orderList) => {

            html2canvas(document.querySelector("#canvas")).then(canvas => {
                axios.post('/print/customerorder/confirm', {
                    orderList: orderList,
                    complete_count: $("#order_completed").val(),
                    progress_count: $("#order_progress").val(),
                    customer_id: $("#customer_id").val(),
                    url: 'https://order.phamaiintrend.co/ordersummary/view',
                    image: canvas.toDataURL('image/png')
                }).then((resp) => {
                    swalWithBootstrapButtons.fire(
                        '',
                        'ยืนยันการปริ้นข้อมูลเรียบร้อยแล้ว',
                        'success'
                    )
                }).catch((err) => {
                    console.log(err)
                })
            });
        })
    }

    $("#print").on("click", function (e) {
        var printButton = document.getElementById("print");
        var backButton = document.getElementById("back");

        printButton.style.visibility = 'hidden';
        backButton.style.visibility = 'hidden';

        window.print()

        printButton.style.visibility = 'visible';
        backButton.style.visibility = 'visible';
    })
})


