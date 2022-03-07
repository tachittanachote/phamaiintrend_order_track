<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;

class PromotionController extends Controller
{
    public function promotion(Request $request)
    {
        $result = Promotion::get();
        return view('promotion', compact('result'));
    }

    public function promotionAdd(Request $request) {
        $imageFile = time() . '.' . $request->promotion_image->getClientOriginalExtension();
        $promotion = Promotion::create([
            'image_url' => $imageFile,
            'detail' => $request->detail,
            'link' => isset($request->link) ? $request->link : null,
        ]);

        if ($promotion) {
            $request->promotion_image->move(base_path() . '/storage/app/public/upload', $imageFile);
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

    public function promotionRemove(Request $request) {
        $promotion = Promotion::where('id', $request->id)->delete();
        if ($promotion) {
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
