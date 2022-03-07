import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import DataTable from'datatables.net'

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

$(document).ready(() => {
    console.log("Ready!")

    $('table').DataTable({
        responsive: true
    });

    const usernameFeedback = $('#username-feedback');
    const passwordFeedback = $('#password-feedback');

    const username = $('#username')
    const password = $('#password')

    $("#login").on('click', function (e) {
        e.preventDefault();

        if (!username.val() || username.val().length <= 0) {
            username.addClass("is-invalid")
            usernameFeedback.css('display', 'block')
        }

        if (!password.val() || password.val().length <= 0) {
            password.addClass("is-invalid")
            passwordFeedback.css('display', 'block')
        }

        if (username.val() && username.val().length > 0 && password.val() && password.val().length > 0) {
            axios.post('/login', {
                username: username.val(),
                password: password.val(),
                remember_me: $('#remember_me').is(":checked")
            }).then((resp) => {
                Toast.fire({
                    icon: resp.data.status,
                    title: resp.data.result
                })
                if (resp.data.status === "success") {
                    window.location.href = "/home"
                }

            }).catch((err) => {
                Toast.fire({
                    icon: 'error',
                    title: 'ไม่สามารถดำเนินการได้'
                })
            })
        }

    })

    $(username).on('input', function (e) {
        if (username.val().length > 0) {
            username.removeClass("is-invalid")
            usernameFeedback.css('display', 'none')
        }
    })

    $(password).on('input', function (e) {
        if (password.val().length > 0) {
            password.removeClass("is-invalid")
            passwordFeedback.css('display', 'none')
        }
    })


    const upload = $('#upload');
    const uploadFeedback = $('#uploadFeedback');

    $("#upload-btn").on('click', function (e) {

        
        e.preventDefault();


        if (upload.val()) {
            $(this).html("กำลังอัพโหลด ...")
            $(this).attr('disabled', true)

            upload.removeClass("is-invalid")
            uploadFeedback.css('display', 'none')

            const formData = new FormData();
            const file = document.querySelector('#upload');

            formData.append("file", file.files[0]);

            axios({
                method: 'post',
                url: '/upload',
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
                    $(this).html("ยืนยันอัพโหลด")
                    $(this).attr('disabled', false)
                })
                .catch(function (response) {
                    Toast.fire({
                        icon: 'error',
                        title: 'ไม่สามารถดำเนินการได้'
                    })
                    $(this).html("ยืนยันอัพโหลด")
                    $(this).attr('disabled', false)
                });


        }else {
            upload.addClass("is-invalid")
            uploadFeedback.css('display', 'block')
        }

    })


    $('input[class=custom-file-input]').on("change", function (e) {
        const filename = e.target.files[0].name
        if (e.target.id === "upload") {
            $("#upload-label").html(filename)
        }

        if(!e.target.value) {
            upload.addClass("is-invalid")
            uploadFeedback.css('display', 'block')
        }
    });

    $(".remove-order").on("click", function(e) {
        e.preventDefault();

        const orderId = $(this).attr('data-id');
        axios.post('/order/remove', {
            id: orderId
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

    $(".logout-line").on("click", function (e) {
        e.preventDefault();

        const id = $(this).attr('data-id');
        axios.post('/logout-line', {
            id: id
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


