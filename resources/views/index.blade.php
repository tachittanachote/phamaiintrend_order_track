<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#2e2e2e">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#2e2e2e">
        <title>Phamai Intrend - เข้าสู่ระบบ</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            html, body {
                background: url('/images/bgshine.svg');
                height: 100vh;
                font-family: 'Zen Kaku Gothic New', sans-serif;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            .card {
                border-radius: 0px !important;
                background-color: #c2b9b0 !important;
            }

            .btn {
                font-family: 'Zen Kaku Gothic New', sans-serif;
            }

            .btn-phamai {
                color: #2e2e2e !important;
                background-color: #ffe39a !important;
                border-color: #ffe39a !important;
                border-radius: 0px !important;
            }

            .btn-phamai:hover {
                color: #181818 !important;
                background-color: #ffd85a !important;
                border-color: #f3e485 !important;
            }

            a:hover {
                text-decoration: none !important;
            }

            .input-group-text {
                background-color: #f9f5f4 !important;
                border: 1px solid #cdb2a9 !important;
            }

            .form-control:focus {
                border-color: #cdb2a9 !important;
                box-shadow: 0 0 0 0.2rem rgb(189 166 156) !important;
            }

            .btn-register {
                color: #ffffff !important;
                background-color: #795548 !important;
                border-color: #795548 !important;
            }

        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>
    <body>
            <div class="container d-flex h-100 justify-content-center align-items-center">
                <div class="row w-100" style="max-width: 480px;">
                    <div class="col"> 
                        <div class="card">
                            <div class="card-body">

                                <div class="text-center mt-3 mb-4 animate__animated animate__fadeInDown">
                                    <img src="{{asset('/images/logo.png')}}" alt="Phamai Intrend" class="img-fluid">
                                    <div class="font-weight-bold mt-2" style="color: #3c2e23;">ระบบติดตามออเดอร์ร้านผ้าไหมอินเทรนด์</div>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" aria-label="Username" aria-describedby="basic-addon1" id="username" autocomplete="off">
                                    <div id="username-feedback" class="invalid-feedback">
                                        โปรดระบุชื่อผู้ใช้งานให้ครบถ้วน
                                    </div>
                                </div>
                                <div class="input-group mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="รหัสผ่าน" aria-label="Password" aria-describedby="basic-addon2" id="password" autocomplete="off">
                                    <div id="password-feedback" class="invalid-feedback">
                                        โปรดระบุรหัสผ่านให้ครบถ้วน
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="w-100">
                                        <input type="checkbox" id="remember_me">
                                        <label class="form-check-label" for="remember_me">จดจำฉันไว้ในระบบ</label>
                                    </div>   
                                </div>   
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-phamai w-100" id="login"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</button>
                                </div>
                                <!-- <div class="input-group mb-3">
                                    <a href="/register" class="btn btn-register w-100">สมัครสมาชิก</a>
                                </div> -->
                            </div>
                            <!-- <div class="card-footer text-center">
                                <a href="https://www.facebook.com/221supper">ติดต่อผู้ดูแลระบบ?</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>        
</html>
