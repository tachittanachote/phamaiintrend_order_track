import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import select2 from 'select2'

$(document).ready(() => {
    console.log("Ready!")

    $('#product').select2();
    $('#customer_name').select2();

    $('#add_order').on('click', function(e) {
        axios.post('/order/add', {
            order_timestamp: $('#order_date').val()
        }).then((resp) => {
            Swal.fire({
                icon: resp.data.status,
                text: resp.data.result,
            }).then((e) => {
                window.location.reload();
            })
        }).catch((err) => {
            console.log(err)
        })
    })

})


