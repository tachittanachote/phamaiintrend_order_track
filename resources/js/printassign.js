import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'

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
            text: "ปริ้นใบสั่งงานเรียบร้อยแล้วใช่หรือไม่?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ปริ้นแล้ว',
            cancelButtonText: 'ยังไม่ได้ปริ้น',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('/print/confirm', {
                    id: $("#orderId").val()
                }).then((resp) => {
                    swalWithBootstrapButtons.fire(
                        '',
                        'ยืนยันการปริ้นข้อมูลเรียบร้อยแล้ว',
                        'success'
                    )
                }).catch((err) => {
                    console.log(err)
                })

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
        })
    }

    $("#print").on("click", function (e) {
        var printButton = document.getElementById("print");
        var backButton = document.getElementById("back");
		var saveImage = document.getElementById("save_image");

        printButton.style.visibility = 'hidden';
        backButton.style.visibility = 'hidden';
		saveImage.style.visibility = 'hidden';
		

        window.print()

        printButton.style.visibility = 'visible';
        backButton.style.visibility = 'visible';
		saveImage.style.visibility = 'visible';
    })
})


