import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import select2 from 'select2'

$(document).ready(() => {
    console.log("Ready!")
    

    $('#product').select2();

    var product = $("#product")
    getProductImage($(product).val())

    product.on('change', function (e){
        getProductImage($(product).val())
    })

    $("#upload-image").on("click", function (e) {
        e.preventDefault();
        if(!product.val()) {
            Swal.fire({
                icon: "warning",
                text: "โปรดเลือกข้อมูลสินค้า",
            })
        }

        if (!$("#upload").val()) {
            $('#upload').addClass("is-invalid")
            $('#upload-feedback').css('display', 'block')
        }

        if (product.val() && $("#upload").val()) {
            const data = new FormData();
            const file = document.querySelector('#upload');

            data.append("product_image", file.files[0]);
            data.append("product", product.val());

            axios({
                method: 'post',
                url: '/product-image/add',
                data: data,
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

    });

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


    function getProductImage(code){
        $("#image-list").empty();
        axios.post('/product/image', {
            product_code: code
        }).then((resp) => {

            if(resp.data.status === "success") {
                
                if(resp.data.result.length > 0) {
                    $("#img-list").css('display', 'block')
                    resp.data.result.forEach((value, index) => {
                        $("#image-list").append(`
                            <div class="col-2">
                                <div class="del-btn" data-id="${value.id}"><i class="far fa-trash-alt"></i></div>
                                <img src="https://order.phamaiintrend.co/storage/upload/${value.image_url}" class="img-fluid">
                            </div>
                        `)
                    })
                } else {
                    $("#img-list").css('display', 'block')
                    $("#image-list").append(`
                            <div class="col-12">
                                <div class="alert alert-warning" role="alert">ไม่พบรายการรูปภาพ</div>
                            </div>
                        `)
                }
                
            }
        }).catch((err) => {
            console.log(err)
        })
    }

    $(document).on("click", '.del-btn', function (e) {
        e.preventDefault();

        var id = $(this).attr('data-id');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            text: "ยืนยันการลบรูปภาพสินค้า?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            reverseButtons: true,
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                axios.post('/product-image/remove', {
                    id: id
                }).then((resp) => {
                    swalWithBootstrapButtons.fire(
                        '',
                        'ลบรูปสินค้าเรียบร้อยแล้ว',
                        'success'
                    ).then((e) => {
                        window.location.reload();
                    })
                }).catch((err) => {
                    console.log(err)
                })
            }
        })
    })

})


