<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phamaiintrend Scanner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>

      :root {
  --primary-color: #f6f2ef; /* try #212121 also for dark mode */
  --background-color: #cfc7bc;
  --font: 'Prompt', sans-serif;
}

* {
  margin: 0;
  padding: 0;
}

body {
  background: var(--background-color);
  font-family: var(--font);
  display: flex;
  justify-content: center;
}

/* Timeline Container */
.timeline {
  background: var(--primary-color);
  margin: 20px auto;
  padding: 20px;
}

/* Outer Layer with the timeline border */
.outer {
  border-left: 2px solid #333;
}

/* Card container */
.card {
  position: relative;
  margin: 0 0 20px 20px;
  padding: 10px;
  background: #fff;
  color: gray;
  border-radius: 8px;
}

/* Information about the timeline */
.info {
  display: flex;
  flex-direction: column;
  gap: 10px;
  position: relative;
}

/* Title of the card */
.title {
  color: #ffbc00;
  position: relative;
}

/* Timeline dot  */
.title::before {
  content: "";
  position: absolute;
  width: 20px;
  height: 20px;
  background: white;
  border-radius: 999px;
  left: -42px;
  border: 3px solid #ffbc00;
}

.timestamp {
    font-size: 14px;
    position: absolute;
    right: 5px;
    font-weight: 600;
}

.product {
  display: none;
  margin-top: 30px;
  background: white;
  border-radius: 20px;
}

.edit-detail {
  background: white;
  display: none;
  border-radius: 20px;
}

html, body {
        background: #c7c7c7;
      }

            .video {
          max-width: 100%;
      }

    </style>
  </head>
<body>
    
    <div class="container">
        <video id="qr-video" class="video"></video>
        <div style="margin-top: 10%;display: flex;align-items: center; justify-content: center; flex-direction:column;">
            <div class="h5">ตรวจสอบเช็คสถานะงาน</div>
            <div class="product w-100 p-3 mb-1">
              
            </div>

            <div class="edit-detail w-100 p-3">
              <div class="font-weight-bold">รายการการสั่งแก้ไข</div>
              <div class="edit mt-2 mb-2"></div>
            </div>

        </div>
        <div class="timeline">
          <div class="outer">
          </div>

          <button type="button" class="btn btn-warning w-100 mb-2" id="remove-recent">ลบสถานนะงานล่าสุด</button>
          <button type="button" class="btn btn-warning w-100 mb-2" id="reset">รีเซ็ตสถานะงาน</button>
        </div>
        <button onclick="history.back()" type="button" class="btn btn-danger w-100 mb-5">ย้อนกลับ</button>
    </div>
  </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js" integrity="sha256-COxwIctJg+4YcOK90L6sFf84Z18G3tTmqfK98vtnz2Q=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="{{ mix('js/scan.js') }}" defer></script>   

    <script type="module">

      import QrScanner from "https://cdnjs.cloudflare.com/ajax/libs/qr-scanner/1.4.1/qr-scanner.min.js";
      $('.resume').css('display', 'none')
      $('.timeline').css('display', 'none')

      const video = document.getElementById('qr-video');
      const scanner = new QrScanner(video, result => setResult(result), {
          preferredCamera: 'environment',
          highlightScanRegion: true,
      });

      scanner.start()

      function setResult(result) {
          onScanSuccess(result.data)
          scanner.stop()
      }

      function onScanSuccess(decodedText) {

          var orderId = decodedText.replace(/\D/g, '');

          $("#reset").attr("data-id", orderId)
          $("#remove-recent").attr("data-id", orderId)

          $(".outer").empty();
          $(".product").empty();
          $(".edit").empty();
          axios.post('/check', {
              order_id: orderId
          }).then((resp) => {
              $('#reader').css('display', 'none')
              $('.product').css('display', 'block')
              $('.timeline').css('display', 'block')

              $('.product').append(`
                      <div class="text-center">หมายเลขออเดอร์: ${resp.data.order_detail.order_number}</div>
                      <div class="text-center">Facebook: ${resp.data.order_detail.facebook_name}</div>
                      ${!resp.data.order_detail.customer_name ? '' : `<div class="text-center">ชื่อลูกค้า: ${resp.data.order_detail.customer_name}</div>`}
                      <div class="text-center">รหัสสินค้า: ${resp.data.order_detail.product_code}</div>
                      <div class="font-weight-bold text-center mt-2">รายละเอียด</div>
                      <div class="text-center">${resp.data.order_detail.detail}</div>
                      <button type="button" class="btn btn-warning w-100 resume mt-2 btn-sm">สแกนอีกครั้ง</button>
                  `)

              if (resp.data.result.length > 0) {
                  $(".outer").append(`
                          <div class="card">
                              <div class="info">
                                  <div class="title"><span style="color: gray;">สินค้ากำลังรอการดำเนินการ</span></div>
                              </div>
                          </div>
                      `)
                  resp.data.result.forEach((value, index) => {
                      $(".outer").append(`
                              <div class="card">
                                  <div class="info">
                                      <div class="title"><span style="color: gray;">${formatState(value.status)} โดย</span> ${value.employee} <span style="color: red;">${formatState(value.status) === "ตัดเสร็จแล้ว" ? "(รอเย็บ)" : ""}</span></div>
                                      <div>เมื่อเวลา ${value.created_at}</div>
                                  </div>
                              </div>
                          `)
                  })

              }
              if (resp.data.result.length <= 0) {
                  $(".outer").append(`
                          <div class="card">
                              <div class="info">
                                  <div class="title"><span style="color: gray;">สินค้ากำลังรอการดำเนินการ</span></div>
                              </div>
                          </div>
                      `)
              }
              return resp
          }).then((resp) => {
              if (resp.data.edit_details.length > 0) {
                  $('.edit-detail').css('display', 'block')
                  resp.data.edit_details.forEach((detail, index) => {
                      $('.edit').append(`<div class="text-danger">- ${detail.detail}</div>`)
                  })
              }

              $('.resume').css('display', 'block')
          })

      }

      $("#remove-recent").on("click", function(e) {
          const id = $(this).attr("data-id");
          axios.post('/order/tracking/remove-recent', {
                order_id: id
            }).then((resp) => {
                Swal.fire({
                    icon: resp.data.status,
                    title: resp.data.result
                })
                if (resp.data.status === "success") {
                    window.location.reload();
                }

            }).catch((err) => {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่สามารถดำเนินการได้'
                })
            })
      })

      $("#reset").on("click", function(e) {
          const id = $(this).attr("data-id");
          axios.post('/order/tracking/reset', {
                order_id: id
            }).then((resp) => {
                Swal.fire({
                    icon: resp.data.status,
                    title: resp.data.result
                }).then(() => {
                    window.location.reload();
                })
            }).catch((err) => {
                Swal.fire({
                        icon: 'error',
                        text: 'ไม่สามารถดำเนินการได้',
                    })
            })
      })

      $(".product").on("click", ".resume", function (e) {

          scanner.start()

          $('#reader').css('display', 'block')
          $(".outer").empty();
          $(".product").empty();
          $('.product').css('display', 'none')
          $('.timeline').css('display', 'none')
          $('.edit-detail').css('display', 'none')
      })

      function formatState(state) {
          switch (state) {
              case "pending": {
                  return "รอดำเนินการ";
              }
              case "processing": {
                  return "เตรียมส่งงานช่าง";
              }
              case "cutting": {
                  return "กำลังตัด";
              }
              case "cut_completed": {
                  return "ตัดเสร็จแล้ว";
              }
              case "sewing": {
                  return "กำลังเย็บ";
              }
              case "sew_completed": {
                  return "เย็บเสร็จแล้ว";
              }
              case "shipping": {
                  return "กำลังจัดส่งสินค้า";
              }
              case "prepare_shipping": {
                  return "สินค้าเตรียมจัดส่ง";
              }
              case "shipped": {
                  return "สินค้าส่งแล้ว";
              }
              case null: {
                  return "รอดำเนินการ";
              }
              default: {
                  return $status;
              }
          }
      }
    </script>
</html>