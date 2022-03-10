<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>สรุปรายการหมายเลขติดตามพัสดุร้านผ้าไหมอินเทรนด์</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>

        html, body {
            background-color: #f3f3f3;
            font-family: 'Prompt', sans-serif;
            color: #565656;
        }

        .btn:focus,.btn:active {
            outline: none !important;
            box-shadow: none;
        }
        
        .btn-pm {
            background-color: #a28579;
            color:aliceblue;
        }

        .btn-pm:hover {
            background-color: #91756a;
            color:aliceblue;
        }

        textarea:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="datetime"]:focus,
        input[type="datetime-local"]:focus,
        input[type="date"]:focus,
        input[type="month"]:focus,
        input[type="time"]:focus,
        input[type="week"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="color"]:focus,
        .uneditable-input:focus {   
        border-color: #dfc4b8;
        box-shadow: 0 1px 1px rgba(218, 218, 218, 0.075) inset, 0 0 8px #dfc4b8;
        outline: 0 none;
        }

        th, td {
                padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @php
        $d = \Carbon\Carbon::parse($date);
        @endphp
        <div style="margin-bottom: 20px;">
            เลขที่พัสดุประจำวันที่ {{$d->format('d')}} {{\App\Delivery::formatMonth($d->format('F'))}} {{$d->format('Y') + 543 }}  จำนวน {{count($deliveries)}} ท่าน พี่ๆสามารถคลิกที่ลิ้งค์หลังชื่อพี่ๆได้เลย โดยไม่ต้องกรอกเลขที่พัสดุ โดยระบบจะอัพเดทสถานะให้ทันที ขอบพระคุณพี่ๆทุกท่านที่อุดหนุนสินค้าร้านผ้าไหมอินเทรนด์ รับชุดแล้วอย่าลืมรีวิวสวยๆมาให้กำลังใจทีมงาน และฝากติดตามชมไลฟ์สดทุกวันเสาร์และอาทิตย์ด้วยนะคะ
        </div>
        @foreach($deliveries as $item)
            <div>{{ $loop->index + 1}}. {{$item->customer_name}} https://track.thailandpost.co.th/?trackNumber={{$item->tracking_id}}</div>
        @endforeach
    </div>
</body>
</html>