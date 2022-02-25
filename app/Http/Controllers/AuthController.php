<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request) {

        $user = User::where('username', $request->username)->first();
        
        if($user && $user->password == $request->password) {
            Auth::login($user, $request->remember_me == "true" ? true : false);
            return response()->json([
                'status' => 'success',
                'result' => 'ดำเนินการสำเร็จ',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }
        else {
            return response()->json([
                'status' => 'error',
                'result' => 'ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง',
            ], 200, array('Content-Type' => 'application\json;charset=utf8'), JSON_UNESCAPED_UNICODE);
        }


    }

    public function logout() {
        Auth::logout();
        return redirect("/");
    }
}
