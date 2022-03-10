<?php

namespace App\Http\Controllers;

use App\Imports\OrdersImport;
use App\Imports\DeliveriesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function uploadXLSX(Request $request) {

        $validator = Validator::make([
            'file'      => $request->file,
            'extension' => strtolower($request->file->getClientOriginalExtension()),
        ],[
            'file'          => 'required',
            'extension'      => 'required|in:xlsx',
        ]);

        $sheet = Excel::import(new OrdersImport, $request->file);

        if($sheet) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function uploadDelivery(Request $request)
    {
        $validator = Validator::make([
            'file'      => $request->file,
            'extension' => strtolower($request->file->getClientOriginalExtension()),
        ], [
            'file'          => 'required',
            'extension'      => 'required|in:xlsx',
        ]);

        $sheet = Excel::import(new DeliveriesImport, $request->file);

        if ($sheet) {
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'status' => 'error',
                'result' => 'ไม่สามารถดำเนินการได้',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
    }
}
