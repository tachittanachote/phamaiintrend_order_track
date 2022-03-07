import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'

$(document).ready(() => {
    console.log("Ready!")

    const uploadFeedback = $('#upload-feedback');
    const detailFeedback = $('#detail-feedback');

    const detail = $('#detail')
    const link = $('#link')

    $(detail).on('input', function (e) {
        if (detail.val().length > 0) {
            detail.removeClass("is-invalid")
            detailFeedback.css('display', 'none')
        }
    })

    $(".add-promotion").on("click", function (e) {
        e.preventDefault();

        if (!detail.val()) {
            detail.addClass("is-invalid")
            detailFeedback.css('display', 'block')
        }

        if (!$("#upload").val()) {
            $('#upload').addClass("is-invalid")
            $('#upload-feedback').css('display', 'block')
        }


        if (detail.val() && $("#upload").val()) {
            const formData = new FormData();
            const file = document.querySelector('#upload');

            formData.append("promotion_image", file.files[0]);
            formData.append("detail", detail.val());
            formData.append("link", link.val());

            axios({
                method: 'post',
                url: '/promotion/add',
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

    $(".remove-promotion").on("click", function (e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        axios.post('/promotion/remove', {
            id: id
        }).then((resp) => {
            Swal.fire(
                '',
                'ลบเรียบร้อยแล้ว',
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

})


