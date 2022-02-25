import { Html5QrcodeScanner } from "html5-qrcode"
import axios from 'axios'
import $ from 'jquery'
import Swal from 'sweetalert2'
import * as bootstrap from "bootstrap";

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

const productCode = $("#productCode")
const productName = $("#productName")
const product = $("#product")
const tailor = $("#tailor")
const detail = $("#detail-form")

const productCodeFeedback = $("#productCodeFeedback");
const productNameFeedback = $("#productNameFeedback");
const productFeedback = $("#productFeedback");
const tailorFeedback = $("#tailorFeedback");
const detailFeedback = $("#detailFeedback");


var is_fix = true;

function onScanSuccess(decodedText, decodedResult) {
    // handle the scanned code as you like, for example:

    var fillForm = 0;
    html5QrcodeScanner.pause();

    var url = new URL(decodedText);
    var orderId = url.searchParams.get("order_id");

    if (orderId) {

        $('.edit-detail').empty();

        axios.post('https://order.phamaiintrend.co/order/employee/check', {
            order_id: orderId
        }).then((resp) => {
            if (resp.data.status === "success" && resp.data.order_status !== null) {
                $("#product_code").html(resp.data.result.product_code)
                $("#detail").html(resp.data.result.detail)
                $("#customer_name").html(resp.data.result.customer_name ? resp.data.result.customer_name : "-")
                $("#customer_fb_name").html(resp.data.result.facebook_name)

                const name = resp.data.result.customer_name ? resp.data.result.customer_name : resp.data.result.facebook_name

                detail.val(name + ' (' + resp.data.result.detail + ') ')
                
                $("#confirm").attr('data-id', orderId);
                if (resp.data.edit_details.length > 0) {
                    $('.editlist').css('display', 'block');
                    resp.data.edit_details.forEach((d, index) => {
                        $('.edit-detail').append(`<div class="text-danger">- ${d.detail}</div>`)
                        detail.val(detail.val() + ' ' + d.detail)
                    })
                    
                }
            }
            return resp
        }).then((resp) => {
            if (resp.data.status === "success" && resp.data.order_status !== null) {
                if (resp.data.order_status.status === "processing") {

                    if ($("#role").val() === "seamstress" || $("#role").val() === "admin") {
                        $("#confirm").html("อยู่ระหว่างรอดำเนินการตัด");
                        $("#confirm").attr('disabled', true);
                        $('#confirm').addClass('btn-warning')
                    }
                    else {
                        $("#confirm").html("เริ่มงานตัด");
                        $('#confirm').addClass('btn-success')
                    }

                }
                if (resp.data.order_status.status === "cutting") {
                    if ($("#role").val() === "seamstress" || $("#role").val() === "admin") {
                        $("#confirm").html("อยู่ระหว่างดำเนินการตัด");
                        $("#confirm").attr('disabled', true);
                        $('#confirm').addClass('btn-warning')
                    }
                    else {
                        $("#confirm").html("เสร็จสิ้นงานตัด");
                        $('#confirm').addClass('btn-success')
                    }
                }
                if (resp.data.order_status.status === "cut_completed") {
                    if ($("#role").val() === "tailor" || $("#role").val() === "admin") {
                        $("#confirm").html("งานตัดเรียบร้อยแล้ว");
                        $("#confirm").attr('disabled', true);
                        $('#confirm').addClass('btn-warning')
                    } else {
                        $("#confirm").html("เริ่มงานเย็บ");
                        $('#confirm').addClass('btn-success')
                    }

                }
                if (resp.data.order_status.status === "sewing") {
                    if ($("#role").val() === "tailor" || $("#role").val() === "admin") {
                        $("#confirm").html("งานกำลังเย็บ");
                        $("#confirm").attr('disabled', true);
                        $('#confirm').addClass('btn-warning')
                    } else {


                        axios.post('/tailor/check', {
                            tailor_id: resp.data.last_activity.employee_id,
                        }).then((res) => {
                            console.log(res.data)
                            tailor.val(res.data.id)
                            $('#tailor-label').val(res.data.username)
                        }).catch((err) => {
                            conosole.log(err)
                        })

                        productCode.val(resp.data.result.product_code)
                        productName.val(resp.data.result.product_code)
                        fillForm = 1;

                        $(".add-work-form").css('display', 'block')
                        $("#confirm").html("เสร็จสิ้นงานเย็บ");
                        $('#confirm').addClass('btn-success')
                    }

                }

                if (resp.data.order_status.status === "sew_completed") {
                    if ($("#role").val() === "tailor" || $("#role").val() === "seamstress") {
                        $("#confirm").html("สินค้าตัดและเย็บเรียบร้อยแล้ว");
                        $("#confirm").attr('disabled', true);
                        $('#confirm').addClass('btn-warning')
                    } else {
                        $("#confirm").html("ปรับเป็นสินค้าเตรียมจัดส่งให้ลูกค้า");
                        $('#confirm').addClass('btn-warning')
                    }

                }

                if (resp.data.order_status.status === "prepare_shipping") {
                    $("#confirm").html("สินค้าเตรียมจัดส่ง");
                    $("#confirm").attr('disabled', true);
                    $('#confirm').addClass('btn-warning')
                }

                if (resp.data.order_status.status === "shipped") {
                    $("#confirm").html("สินค้าจัดส่งแล้ว");
                    $("#confirm").attr('disabled', true);
                    $('#confirm').addClass('btn-success')
                }
            }
            return resp
        }).then((resp) => {
            if (resp.data.order_status !== null) {
                $('#order').modal('show')
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    text: 'สินค้าอยู่ระหว่างการดำเนินการส่งงานช่าง'
                }).then(() => {
                    window.location.reload()
                })
            }
        })
    }

    $("#confirm").on("click", function (e) {
        e.preventDefault()

        if (fillForm === 1) {
            if (!productCode.val() || productCode.val().length <= 0) {
                productCode.addClass("is-invalid")
                productCodeFeedback.css('display', 'block')
            }

            if (!productName.val() || productName.val().length <= 0) {
                productName.addClass("is-invalid")
                productNameFeedback.css('display', 'block')
            }

            if (!product.val() || product.val().length <= 0) {
                product.addClass("is-invalid")
                productFeedback.css('display', 'block')
            }

            if ((product.find(':selected').attr('data-fix') === "no" && !tailor.val()) || (product.find(':selected').attr('data-fix') === "no" && tailor.val().length <= 0)) {
                tailor.addClass("is-invalid")
                tailorFeedback.css('display', 'block')
            }

            if (!detail.val() || detail.val().length <= 0) {
                detail.addClass("is-invalid")
                detailFeedback.css('display', 'block')
            }

            console.log(productCode.val(), productName.val(), product.val(), detail.val())

            if (productCode.val() && productCode.val().length > 0 && productName.val() && productName.val().length > 0 && product.val() && product.val().length > 0 && detail.val().length > 0) {

                alert(productCode.val(), productName.val(), product.val(), detail.val())

                axios.post(decodedText, {
                    order_process_status: getWorkState($("#confirm").text()),
                    employee: $("#user_id").val(),
                    employee_name: $("#name").val(),
                }).then((e) => {

                    if ((product.find(':selected').attr('data-fix') === "no" && !tailor.val()) || (product.find(':selected').attr('data-fix') === "no" && tailor.val().length <= 0) && parseFloat($(this).find(':selected').attr('data-tprice')) > 0.00) {
                        return false;
                    }

                    const formData = new FormData();
                    const file = document.querySelector('#upload');

                    formData.append("file", file.files[0]);
                    formData.append("product_code", $("#productCode").val());
                    formData.append("product_name", $("#productName").val());
                    formData.append("product", $("#product").val());
                    formData.append("tailor", is_fix ? $("#tailor").val() : null);
                    formData.append("quantity", 1);
                    formData.append("detail", $("#detail-form").val());

                    axios({
                        method: 'post',
                        url: '/work/upload',
                        data: formData,
                        header: {
                            'Content-Type': 'multipart/form-data',
                        },
                    })
                        .then(function (response) {
                            Swal.fire({
                                icon: response.data.status,
                                text: response.data.result,
                            }).then((e) => {
                                window.location.reload();
                            })
                        })
                        .catch(function (response) {
                            html5QrcodeScanner.resume();
                            Toast.fire({
                                icon: 'error',
                                title: 'ไม่สามารถดำเนินการได้'
                            })
                        });
                }).catch((err) => {
                    html5QrcodeScanner.resume();
                    Swal.fire({
                        icon: 'error',
                        title: '',
                        text: 'ไม่สามารถดำเนินการได้'
                    })
                })
            }
        }
        else {
            axios.post(decodedText, {
                order_process_status: getWorkState($("#confirm").text()),
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
        }
    })

}

function getWorkState(state) {
    switch (state) {
        case "เริ่มงานตัด": {
            return "cutting";
        }
        case "เสร็จสิ้นงานตัด": {
            return "cut_completed";
        }
        case "เริ่มงานเย็บ": {
            return "sewing";
        }
        case "เสร็จสิ้นงานเย็บ": {
            return "sew_completed";
        }
        case "ปรับเป็นสินค้าเตรียมจัดส่งให้ลูกค้า": {
            return "prepare_shipping";
        }
        default: {
            return
        }
    }
}
function onScanFailure(error) {
    //console.warn(`${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: { width: 250, height: 250 } },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);

$(productCode).on('input', function (e) {
    if (productCode.val().length > 0) {
        productCode.removeClass("is-invalid")
        productCodeFeedback.css('display', 'none')
    }
})

$(productName).on('input', function (e) {
    if (productName.val().length > 0) {
        productName.removeClass("is-invalid")
        productNameFeedback.css('display', 'none')
    }
})

$(product).on('change', function (e) {
    if (product.val().length > 0) {
        product.removeClass("is-invalid")
        productFeedback.css('display', 'none')
    }
    if (product.find(':selected').attr('data-fix') === "no") {
        $("#tailor-selection").css('display', 'block');
        is_fix = true
    }
    if ($(this).find(':selected').attr('data-fix') === "yes") {
        $("#tailor-selection").css('display', 'none');
        is_fix = false
    }
    if (parseFloat($(this).find(':selected').attr('data-tprice')) === 0.00) {
        $("#tailor-selection").css('display', 'none');
    }
})

$(tailor).on('change', function (e) {
    if (tailor.val().length > 0) {
        tailor.removeClass("is-invalid")
        tailorFeedback.css('display', 'none')
    }

})

$(detail).on('input', function (e) {
    if (detail.val().length > 0) {
        detail.removeClass("is-invalid")
        detailFeedback.css('display', 'none')
    }
})