import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'

$(document).ready(() => {
    console.log("Ready!")

    $('.mark-ready').on('click', function(e) {
        axios.post('/order/update', {
            order_id: $(this).attr('data-id'),
            order_process_status: "prepare_shipping",
            employee: $("#user_id").val(),
            employee_name: $("#name").val(),
        }).then((resp) => {
            Swal.fire({
                icon: resp.data.status,
                title: '',
                text: resp.data.result
            }).then(() => {
                window.location.reload()
            })
        }).catch((err) => {
            html5QrcodeScanner.resume();
            Swal.fire({
                icon: 'error',
                title: '',
                text: 'ไม่สามารถดำเนินการได้'
            })
        })
    })
	
	$('.mark-unready').on('click', function(e) {
        axios.post('/order/update', {
            order_id: $(this).attr('data-id'),
            order_process_status: "pending",
            employee: $("#user_id").val(),
            employee_name: $("#name").val(),
        }).then((resp) => {
            Swal.fire({
                icon: resp.data.status,
                title: '',
                text: resp.data.result
            }).then(() => {
                window.location.reload()
            })
        }).catch((err) => {
            html5QrcodeScanner.resume();
            Swal.fire({
                icon: 'error',
                title: '',
                text: 'ไม่สามารถดำเนินการได้'
            })
        })
    })

})


