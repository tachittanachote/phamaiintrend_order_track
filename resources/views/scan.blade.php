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

    </style>
  </head>
<body>
    <div class="container">
        <div style="margin-top: 10%;display: flex;align-items: center; justify-content: center; flex-direction:column;">
            <div class="h5">ตรวจสอบเช็คสถานะงาน</div>
            <div id="reader"></div>
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
        </div>
        <button onclick="history.back()" type="button" class="btn btn-danger w-100 mb-5">ย้อนกลับ</button>
    </div>
  </div>
</div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="{{ mix('js/scan.js') }}" defer></script>   
</html>