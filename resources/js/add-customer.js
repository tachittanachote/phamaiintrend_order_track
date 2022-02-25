import $ from 'jquery'
import axios from 'axios'
import Swal from 'sweetalert2'
import select2 from 'select2'

$(document).ready(() => {
    console.log("Ready!")

    $('#product').select2();

    const fbName = $('#facebook_name')
    const realName = $('#real_name')
    const address = $('#address')
    const phone_number = $('#phone_number')

    const fbNameFeedback = $('#facebook_name-feedback')
    const realNameFeedback = $('#real_name-feedback')
    const addressFeedback = $('#address-feedback')
    const phone_numberFeedback = $('#phone_number-feedback')

    $(fbName).on('input', function (e) {
        if (fbName.val().length > 0) {
            fbName.removeClass("is-invalid")
            fbNameFeedback.css('display', 'none')
        }
    })

    $(realName).on('input', function (e) {
        if (realName.val().length > 0) {
            realName.removeClass("is-invalid")
            realNameFeedback.css('display', 'none')
        }
    })

    $(address).on('input', function (e) {
        if (address.val().length > 0) {
            address.removeClass("is-invalid")
            addressFeedback.css('display', 'none')
        }
    })

    $(phone_number).on('input', function (e) {
        if (phone_number.val().length > 0) {
            phone_number.removeClass("is-invalid")
            phone_numberFeedback.css('display', 'none')
        }
    })


    $('.add-customer').on('click', function(e) {
        e.preventDefault();

        if (!fbName.val()) {
            fbName.addClass("is-invalid")
            fbNameFeedback.css('display', 'block')
        }

        if (!realName.val()) {
            realName.addClass("is-invalid")
            realNameFeedback.css('display', 'block')
        }

        if (!address.val()) {
            address.addClass("is-invalid")
            addressFeedback.css('display', 'block')
        }

        if (!phone_number.val()) {
            phone_number.addClass("is-invalid")
            phone_numberFeedback.css('display', 'block')
        }

        if (fbName.val() && realName.val() && address.val() && phone_number.val()) {
            axios.post('/customer/add', {
                facebook_name: fbName.val(),
                real_name: realName.val(),
                address: address.val(),
                phone_number: phone_number.val()
            }).then((resp) => {
                Swal.fire({
                    icon: resp.data.status,
                    text: resp.data.result,
                }).then((e) => {
                    window.location.reload();
                })
            }).catch((err) => {
                Toast.fire({
                    icon: 'error',
                    title: 'ไม่สามารถดำเนินการได้'
                })
            })
        }

    })

})


