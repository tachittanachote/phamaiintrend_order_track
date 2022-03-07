import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import select2 from 'select2'

$(document).ready(async () => {
    console.log("Ready!")

    $('#product').select2();
    $('#customer_name').select2();

    var product = $("#product");

    var productDetail = await getProductDetail(product.val())

    $("#product_price").val(productDetail.price)
    $("#detail").val(productDetail.product_detail)

    $("#product").on('change', async function(e) {
        var productDetail = await getProductDetail($(this).val())
        $("#product_price").val(productDetail.price)
        $("#detail").val(productDetail.product_detail)
    })
})

function getProductDetail(product_code) {
    return new Promise((resolve, reject) => {
        axios.post('/product/detail', {
            product_code: product_code
        }).then((resp) => {
            resolve(resp.data.result)
        }).catch((err) => {
            reject(err)
        })
    })
}


