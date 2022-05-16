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
  margin-top: 30px;
  background: white;
  border-radius: 20px;
}

.edit-detail {
  background: white;
  border-radius: 20px;
}

html, body {
        background: #c7c7c7;
      }

    </style>
  </head>
<body>
    <div class="container">
        <div style="margin-top: 10%;display: flex;align-items: center; justify-content: center; flex-direction:column;">
            <div class="h5">ตรวจสอบเช็คสถานะงาน</div>
            <div class="product w-100 p-3 mb-1">
                <div class="text-center">หมายเลขออเดอร์: {{$order_detail->id}}</div>
                <div class="text-center">Facebook: {{$order_detail->facebook_name}}</div>
                {!! $order_detail->customer_name ? '<div class="text-center">ชื่อลูกค้า: '.$order_detail->customer_name.' </div>' : '' !!}
                <div class="text-center">รหัสสินค้า: {{$order_detail->product_code}}</div>
                <div class="font-weight-bold text-center mt-2">รายละเอียด</div>
                <div class="text-center">{{$order_detail->detail}}</div>
            </div>

            @if(count($order_edit_details) > 0)
            <div class="edit-detail w-100 p-3">
              <div class="font-weight-bold">รายการการสั่งแก้ไข</div>
              <div class="edit mt-2 mb-2">
                @foreach($order_edit_details as $detail)
                <div class="text-danger">- {{$detail->detail}}</div>
                @endforeach
              </div>

            </div>
            @endif

        </div>
        <div class="timeline">
          <div class="outer">


            
            @if(count($order_statuses) > 0)

            <div class="card">
                        <div class="info">
                            <div class="title"><span style="color: gray;">สินค้ากำลังรอการดำเนินการ</span></div>
                        </div>
                   </div>

              @foreach($order_statuses as $status)
                  <div class="card">
                    <div class="info">
                      <div class="title"><span style="color: gray;">{{\App\OrderStatus::getOrderStatus($status->status)}} โดย</span> {{$status->employee}}</div>
                      <div>เมื่อเวลา {{$status->created_at}}</div>
                    </div>
                  </div>
              @endforeach
            @else

                  <div class="card">
                        <div class="info">
                            <div class="title"><span style="color: gray;">สินค้ากำลังรอการดำเนินการ</span></div>
                        </div>
                   </div>
            @endif

          </div>
        </div>
        <button type="button" class="btn btn-warning w-100 mb-2" id="remove-recent" data-id="{{$order_detail->id}}">ลบสถานนะงานล่าสุด</button>
          <button type="button" class="btn btn-warning w-100 mb-2" id="reset" data-id="{{$order_detail->id}}">รีเซ็ตสถานะงาน</button>
        <button onclick="history.back()" type="button" class="btn btn-danger w-100 mb-5">ย้อนกลับ</button>
    </div>
  </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.4/dist/sweetalert2.all.min.js" integrity="sha256-COxwIctJg+4YcOK90L6sFf84Z18G3tTmqfK98vtnz2Q=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

      <script>
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
      </script>
    </html>
