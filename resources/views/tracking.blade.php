<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ระบบติดตามออเดอร์ของร้านผ้าไหมอินเทรนด์</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
            <div class="col-lg-8 col-md-8 col-sm-12">

                <div class="text-center mb-2">
                    <img src="/images/logo.png" alt="Phamai Intrend" class="img-fluid">
                </div>

                <div class="h2 text-center">ระบบติดตามออเดอร์ <span>ร้านผ้าไหมอินเทรนด์</span></div>
                <div class="text-center">กรอกหมายเลขออเดอร์เพื่อดูสถานะรายการออเดอร์ทั้งหมดของคุณ</div>

                <div class="mt-5">
                    <form post='/tracking' method='post'>
                     <div class="form-group">
                        <label for="order_number">หมายเลขออเดอร์</label>
                        <input type="number" class="form-control" id="order_number" required>
                    </div>
                    <div><button type="submit" class="btn w-100 btn-pm">ตรวจสอบ</button></div>
                    </form>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12"></div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</html>