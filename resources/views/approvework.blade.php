<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Phamaiintrend Scanner</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
      .editlist {
        display: none;
      }

      html, body {
        background: #c7c7c7;
      }

      .add-work-form {
        display: none;
      }
    </style>
  </head>
<body>
    <div class="container">
        <div style="height: 100vh;display: flex;align-items: center; justify-content: center; flex-direction:column;">
            <div id="reader"></div>
            <input id="role" value="admin" hidden/>
            <input id="user_id" value="{{Auth::user()->id}}" hidden/>
            <input id="name" value="{{Auth::user()->name}}" hidden/>
            <div>
                @if(Auth::user()->role != "admin")
                <a href="/" class="btn btn-warning">ไปหน้าเพิ่มงาน</a>
                @endif
                <a href="/" class="btn btn-danger mt-3 mb-3 mr-3">ย้อนกลับ</a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order" tabindex="-1" aria-labelledby="orderDetail" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderDetail">รายละเอียดงาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>ลูกค้า: <span id="customer_fb_name"></span> (<span id="customer_name"></span>)</div>
        <div>หมายเลขสินค้า: <span id="product_code"></span></div>
        <div>รายละเอียด: <span id="detail"></span></div>

        <div class="editlist mt-2">
          <div class="font-weight-bold">รายการสั่งการแก้ไขสินค้า</div>
          <div class="edit-detail"></div>
        </div>

        <div class="add-work-form mt-3">
          <div class="card mb-3 mb-md-4">

                <div class="card-body">


                    <div class="mb-3 mb-md-4 d-flex justify-content-between">
                        <div class="h3 mb-0">เพิ่มข้อมูลงานลงระบบ</div>
                    </div>

                    <div>
                            <div class="form-row" style="display: none;">
                                <div class="form-group col-12">
                                    <label for="productCode">รหัสสินค้า</label>
                                    <input type="text" class="form-control" id="productCode" name="productCode" placeholder="รหัสสินค้า" autocomplete="off" hidden>
                                    <div id="productCodeFeedback" class="invalid-feedback">
                                        โปรดระบุข้อมูลให้ครบถ้วน
                                    </div>
                                </div>
                            </div>
                            <div class="form-row" style="display: none;">
                                <div class="form-group col-12">
                                    <label for="productName">ชื่อสินค้า</label>
                                    <input type="text" class="form-control" id="productName" name="productName" placeholder="ชื่อสินค้า" autocomplete="off" hidden>
                                    <div id="productNameFeedback" class="invalid-feedback">
                                        โปรดระบุข้อมูลให้ครบถ้วน
                                    </div>
                                </div>
                            </div>

                    </div>
                        <div>
                            <div class="form-row">
                                    <label for="bankname">เลือกประเภทชุด</label>
                                    <select class="form-control mb-2" id="product">
                                        <option value="" disabled selected hidden>เลือกประเภทชุด</option>
                                        @foreach(\App\Product::get() as $product)
                                            <option value="{{$product->id}}" data-fix="{{$product->is_fix}}" data-tprice="{{$product->price_tailor}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="productFeedback" class="invalid-feedback">
                                        โปรดเลือกประเภทชุด
                                    </div>
                                </div>
                        </div>
                        <div id="tailor-selection" style="display: none;">
                            @if(Auth::user()->role != "tailor")
                                <div class="form-row">
                                  <div class="form-group col-12">
                                      <label for="tailor">ช่างตัด</label>
                                      <input type="text" class="form-control" id="tailor" name="tailor" value="" autocomplete="off" readonly hidden>
                                      <input type="text" class="form-control" id="tailor-label" value="" autocomplete="off" readonly>
                                  </div>
                                </div>
                              @else
                                <input type="text" class="form-control" id="tailor" name="tailor" value="{{Auth::user()->id}}" autocomplete="off" readonly hidden>
                              @endif
                        </div>
                        <div>
                            <div class="form-row" style="display: none;">
                                <div class="form-group col-12">
                                    <label for="detail-form">ไซส์และชื่อลูกค้า</label>
                                    <input type="text" class="form-control" id="detail-form" name="detail-form" placeholder="ไซส์และชื่อลูกค้า" autocomplete="off">
                                    <div id="detailFeedback" class="invalid-feedback">
                                        โปรดระบุข้อมูลให้ครบถ้วน
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                              <div class="form-group col-12 mb-3">
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="upload" aria-describedby="upload">
                                      <label class="custom-file-label" for="upload">เพิ่มรูปภาพงาน</label>
                                  </div>
                              </div>
                            </div>
                    </div>
                    <!-- End Form -->
                </div>
            </div>
        </div>

        <button type="button" class="btn rounded w-100 mt-2 " id="confirm"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="{{ mix('js/approvework.js') }}" defer></script>   
    <script>
            $('#upload').on('change',function(e){
                var fileName = e.target.files[0].name;
                $('.custom-file-label').html(fileName);
            })
        </script>
</html>