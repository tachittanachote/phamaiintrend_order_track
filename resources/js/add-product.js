import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'

$(document).ready(() => {
    console.log("Ready!")

    const productCodeFeedback = $('#product_code-feedback');
    const productPriceFeedback = $('#product_price-feedback');

    const productCode = $('#product_code')
    const productPrice = $('#product_price')

    $(productCode).on('input', function (e) {
        if (productCode.val().length > 0) {
            productCode.removeClass("is-invalid")
            productCodeFeedback.css('display', 'none')
        }
    })

    $(productPrice).on('input', function (e) {
        if (productPrice.val().length > 0) {
            productPrice.removeClass("is-invalid")
            productPriceFeedback.css('display', 'none')
        }
    })

    
    $(".add-product").on("click", function (e) {
        e.preventDefault();

        if (!productCode.val()){
            productCode.addClass("is-invalid")
            productCodeFeedback.css('display', 'block')
        }

        if (!productPrice.val()) {
            productPrice.addClass("is-invalid")
            productPriceFeedback.css('display', 'block')
        }

        if (!$("#upload").val()) {
            $('#upload').addClass("is-invalid")
            $('#upload-feedback').css('display', 'block')
        }


        if (productCode.val() && productPrice.val() && $("#upload").val()) {
            const formData = new FormData();
            const file = document.querySelector('#upload');

            formData.append("product_image", file.files[0]);
            formData.append("product_code", productCode.val());
            formData.append("product_price", productPrice.val());

            axios({
                method: 'post',
                url: '/product/add',
                data: formData,
                header: {
                    'Content-Type': 'multipart/form-data',
                },
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
        }

    })
    

    const upload = $('#upload');
    const uploadFeedback = $('#upload-feedback');

    $('input[class=custom-file-input]').on("change", function (e) {
        const filename = e.target.files[0].name
        if (e.target.id === "upload") {
            $("#upload-label").html(filename)
            upload.removeClass("is-invalid")
            uploadFeedback.css('display', 'none')
        }

        if (!e.target.value) {
            upload.addClass("is-invalid")
            uploadFeedback.css('display', 'block')
        }
    });

})


