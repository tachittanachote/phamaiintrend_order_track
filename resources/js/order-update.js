import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import Splide from '@splidejs/splide';

$(document).ready(() => {
    console.log("Ready!")

    var splide = new Splide('.splide', {
        padding: '1rem',
    });
	
	splide.on( 'pagination:mounted', function( data ) {
	  // data.items contains all dot items
	  data.items.forEach( function( item ) {
		item.button.textContent = String( item.page + 1 );
	  } );
	} );

    splide.mount();

    $(".save").on('click', function(e) {
        var orderId = $("#orderId")
        var shirtSize = $("#shirtSize")
        var waistSize = $("#waistSize")
        var sellDate = $("#sellDate")
        var shirtDetail = $("#shirtDetail")
        var waistDetail = $("#waistDetail")
        var deliveryDate = $("#deliveryDate")
        var sarongwaistSize = $("#sarong-waistSize")
        var saronghipSize = $("#sarong-hipSize")
        var saronglongSize = $("#sarong-longSize")
        var sarongwaistDetail = $("#sarong-waistDetail")
        var saronghipDetail = $("#sarong-hipDetail")
        var saronglongDetail = $("#sarong-longDetail")
        var customerName = $("#customer_name")

        axios.post('/order/detail/update', {
            order_id: orderId.val(),
            shirtSize: shirtSize.val(),
            waistSize: waistSize.val(),
            sellDate: sellDate.val(),
            shirtDetail: shirtDetail.val(),
            waistDetail: waistDetail.val(),
            deliveryDate: deliveryDate.val(),
            sarongwaistSize: sarongwaistSize.val(),
            saronghipSize: saronghipSize.val(),
            saronglongSize: saronglongSize.val(),
            sarongwaistDetail: sarongwaistDetail.val(),
            saronghipDetail: saronghipDetail.val(),
            saronglongDetail: saronglongDetail.val(),
            customer_name: customerName.text(),
        }).then((resp) => {
            Swal.fire({
                icon: resp.data.status,
                text: resp.data.result,
            }).then((e) => {
                window.location.reload();
            })
        }).catch((err) => {
            Swal.fire({
                icon: "error",
                text: "ไม่สามารถดำเนินการได้กรุณาลองใหม่อีกครั้ง",
            })
        })
    })

    $(".apply-customer").on('click', function (e) {

        var orderId = $(this).attr('data-id')
        var shirtSize = $("#shirt_shirt_size-customer")
        var waistSize = $("#shirt_waist_size-customer")

        var sarongwaistSize = $("#sarong_waist_size-customer")
        var saronghipSize = $("#sarong_hip_size-customer")
        var saronglongSize = $("#sarong_long_size-customer")

        var customerName = $("#customer_name-customer")

        axios.post('/order/detail/apply', {
            order_id: orderId,
            shirtSize: shirtSize.val(),
            waistSize: waistSize.val(),
            sarongwaistSize: sarongwaistSize.val(),
            saronghipSize: saronghipSize.val(),
            saronglongSize: saronglongSize.val(),
            customer_name: customerName.text(),
        }).then((resp) => {
            Swal.fire({
                icon: resp.data.status,
                text: resp.data.result,
            }).then((e) => {
                window.location.reload();
            })
        }).catch((err) => {
            Swal.fire({
                icon: "error",
                text: "ไม่สามารถดำเนินการได้กรุณาลองใหม่อีกครั้ง",
            })
        })
    })

    $(".apply").on('click', function (e) {

        var orderId = $(this).attr('data-id')
        var shirtSize = $("#shirt_shirt_size")
        var waistSize = $("#shirt_waist_size")
        var shirtDetail = $("#shirt_shirt_detail")
        var waistDetail = $("#shirt_waist_detail")
        var sarongwaistSize = $("#sarong_waist_size")
        var saronghipSize = $("#sarong_hip_size")
        var saronglongSize = $("#sarong_long_size")
        var sarongwaistDetail = $("#sarong_waist_detail")
        var saronghipDetail = $("#sarong_hip_detail")
        var saronglongDetail = $("#sarong_long_detail")
        var customerName = $("#customer_name")

        axios.post('/order/detail/apply', {
            order_id: orderId,
            shirtSize: shirtSize.val(),
            waistSize: waistSize.val(),
            shirtDetail: shirtDetail.val(),
            waistDetail: waistDetail.val(),
            sarongwaistSize: sarongwaistSize.val(),
            saronghipSize: saronghipSize.val(),
            saronglongSize: saronglongSize.val(),
            sarongwaistDetail: sarongwaistDetail.val(),
            saronghipDetail: saronghipDetail.val(),
            saronglongDetail: saronglongDetail.val(),
            customer_name: customerName.text(),
        }).then((resp) => {
            Swal.fire({
                icon: resp.data.status,
                text: resp.data.result,
            }).then((e) => {
                window.location.reload();
            })
        }).catch((err) => {
            Swal.fire({
                icon: "error",
                text: "ไม่สามารถดำเนินการได้กรุณาลองใหม่อีกครั้ง",
            })
        })
    })
    

    $(".del-btn").on("click",function(e) {
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

    $(".remove").on("click", function (e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        axios.post('/order/editdetail/remove', {
            id: id
        }).then((resp) => {
            Swal.fire(
                '',
                'ลบรายการการแก้ไขเรียบร้อยแล้ว',
                'success'
            ).then((e) => {
                window.location.reload();
            })
        }).catch((err) => {
            Swal.fire(
                '',
                'ไม่สามารถดำเนินการได้',
                'error'
            )
        })
    })

    $('#add-edit').on("click", function(e) {
        const detail = $('#detail');
        const id = $(this).attr('data-id');

        if(!detail.val()) {
            $(detail).addClass("is-invalid")
            $('#detail-feedback').css('display', 'block')
            return;
        }

        axios.post('/order/editdetail/add', {
            id: id,
            detail: detail.val()
        }).then((resp) => {
            Swal.fire({
                text: resp.data.result,
                icon: resp.data.status
            }).then((e) => {
                window.location.reload();
            })
        }).catch((err) => {
            Swal.fire(
                '',
                'ไม่สามารถดำเนินการได้',
                'error'
            )
        })
    })

    $(detail).on("input", function(e){
        if($(detail).val() <= 0) {
            $(detail).addClass("is-invalid")
            $('#detail-feedback').css('display', 'block')
        }else {
            $(detail).removeClass("is-invalid")
            $('#detail-feedback').css('display', 'none')
        }
    })

})


