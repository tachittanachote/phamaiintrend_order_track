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
        <title>แบบฟอร์มส่งงานช่างตัด</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@300;400;500;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        
        
        <style>
            .oldfont {
                font-size: 24px;
            }
        </style>
   
    </head>
    <body>




        <div class="pl-5 pr-5 pb-3" id="canvas">
        <div class="container mt-2" >


            @php
            try {
                $productImages = \App\ProductImage::where('product_code', $order->product_code)->get();
            }
            catch (Exception $e) {
            }

            @endphp
            
                <div class="row mt-3">
                    <div style="border: 1px solid #000;height: auto; width: 100%;">
                        <div class="p-3">
                        <div class="row mt-3">
                            <div class="col-lg-2 col-md-5">
                                <div class="h5 text-center">
                                    ใบส่งงานช่าง
                                </div>
                                <div class="text-center">ร้านผ้าไหมอินเทรนด์</div>
                            </div>
                            <div class="col-lg-4 col-md-5">
                                <div>ออเดอร์วันที่: {{isset($order->order_date) ? $order->order_date : "ไม่ได้ระบุ"}}</div>
                                <div>ชื่อลูกค้า: {{isset($order->customer_name) ? $order->customer_name : "ไม่ได้ระบุ"}}</div>
                                <div>Facebook: {{isset($order->facebook_name) ? $order->facebook_name : "ไม่ได้ระบุ"}}</div>
                                <div>วันที่ขาย: {{isset($orderDetail->sell_date) ? $orderDetail->sell_date : "ไม่ได้ระบุ" }}</div>
                                <div>วันที่นัดส่ง: {{isset($orderDetail->delivery_date) ? $orderDetail->delivery_date : "ไม่ได้ระบุ"}}</div>
                            </div>
                            <div class="col-lg-4 col-md-5">
                                <div>หมายเลขสินค้า: {{isset($order->product_code) ? $order->product_code : "-" }}</div>
                                <div>หมายเลขออเดอร์: {{isset($order->order_number) ? $order->order_number : "-" }}</div>
                                <div>รายละเอียด: {{isset($order->detail) ? $order->detail : "-" }}</div>
                            </div>
                            <div class="col-lg-2 col-md-2">
                                <div id="qrcode"></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            <div class="row mt-3">
                <div style="border: 1px solid #000;height: auto; width: 100%;">
                    <div class="p-3">
                        <div class="row">
                            <div class="col">
                                <div class="h5 text-center"><u>ข้อมูลเสื้อ</u></div>
                            </div>
                            <div class="col">
                                <div class="h5 text-center"><u>ข้อมูลผ้าถุง</u></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <input type="text" class="form-control" id="orderId" value="{{$order->id}}" hidden>
                                    <div class="col-lg-2 col-md-2 col-sm-12">
                                        <div><strong>ไซส์เสื้อ:</strong> <span class="oldfont">{{isset($orderDetail->shirt_shirt_size) ? $orderDetail->shirt_shirt_size : "-"}}</span></div>
                                        <div><strong>ไซส์เอว:</strong> <span class="oldfont">{{isset($orderDetail->shirt_waist_size) ? $orderDetail->shirt_waist_size : "-"}}</span></div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div><strong>:</strong> <span class="oldfont">{{isset($orderDetail->shirt_shirt_detail) ? $orderDetail->shirt_shirt_detail : "-"}}</span></div>
                                        <div><strong>:</strong> <span class="oldfont">{{isset($orderDetail->shirt_waist_detail) ? $orderDetail->shirt_waist_detail : "-"}}</span></div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div><strong>ไซส์เอวผ้าถุง:</strong> <span class="oldfont">{{isset($orderDetail->sarong_waist_size) ? $orderDetail->sarong_waist_size : "-"}}</span></div>
                                        <div><strong>ไซส์สะโพกผ้าถุง:</strong> <span class="oldfont">{{isset($orderDetail->sarong_hip_size) ? $orderDetail->sarong_hip_size : "-"}}</span></div>
                                        <div><strong>ความยาวผ้าถุง:</strong> <span class="oldfont">{{isset($orderDetail->sarong_long_size) ? $orderDetail->sarong_long_size : "-"}}</span></div>

                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div><strong>:</strong> <span class="oldfont">{{isset($orderDetail->sarong_waist_detail) ? $orderDetail->sarong_waist_detail : "-"}}</span></div>
                                        <div><strong>:</strong> <span class="oldfont">{{isset($orderDetail->sarong_hip_detail) ? $orderDetail->sarong_hip_detail : "-"}}</span></div>
                                        <div><strong>:</strong> <span class="oldfont">{{isset($orderDetail->sarong_long_detail) ? $orderDetail->sarong_long_detail : "-"}}</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                        @if(count($productImages) > 0) 
                                            @foreach($productImages as $productImage)
												@if($loop->index == 0)
                                                <img class="img-fluid" style="max-width:150px;" src="/storage/upload/{{$productImage->image_url}}" alt="{{$productImage->product_code}}">
												@endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                        @if(count($productImages) > 0) 
                                            @foreach($productImages as $productImage)
                                                @if($loop->index == 1)
                                                <img class="img-fluid" style="max-width:150px;" src="/storage/upload/{{$productImage->image_url}}" alt="{{$productImage->product_code}}">
												@endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        </div>
        <div class="pl-5 pr-5 ">
        <div class="container">
        <div class="row flex-row-reverse mb-5">
                
                <button type="button" class="btn btn-danger" id="back" onclick="history.back()">กลับหน้าเดิม</button>
                <button type="button" class="btn btn-secondary mr-2" id="print">สร้างใบส่งงานช่าง</button>
                <button type="button" class="btn btn-success mr-2" id="save_image" data-name="{{date("Y-m-d")}}_{{$order->facebook_name}}_{{$order->product_code}}">ดาวน์โหลดเป็นรูปภาพ</button>
            </div>

        </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>        
    <script src="{{ mix('js/printassign.js') }}" defer></script>      

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        const qrcode = new QRCode("qrcode", {
            width: 128,
            height: 128,
        });

        qrcode.clear();
        qrcode.makeCode(`${window.location.protocol}//${window.location.hostname}/order/update?order_id={{$order->id}}`);

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $("#save_image").on('click', function(e) {
            html2canvas(document.querySelector("#canvas")).then(canvas => {
                saveAs(canvas.toDataURL(), `${$(this).attr('data-name')}.png`);
            });
        })

        function saveAs(uri, filename) {

            var link = document.createElement('a');

            if (typeof link.download === 'string') {

                link.href = uri;
                link.download = filename;

                //Firefox requires the link to be in the body
                document.body.appendChild(link);

                //simulate click
                link.click();

                //remove the link when done
                document.body.removeChild(link);

            } else {

                window.open(uri);

            }
        }
    </script>
</html>
