<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Member;
use App\Customer;
use App\Employee;

use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChangPasswordController extends Controller {


    public function new_password(Request $request)
    {
        $username = trim($request->username);
        $old_password = trim($request->old_password);
        $new_password = trim($request->new_password);
        $confirm_new_password = trim($request->confirm_new_password);

        $member = Member::where('user_member', $username)->first();
        // verify old password
        $result = '';
        $message = '';
        if ((password_verify($old_password, $member->pass_member))) {
            // verify new password and confirm new password
            if($new_password == $confirm_new_password){
                // hash_password
                $new_password_hash = password_hash($new_password,PASSWORD_DEFAULT);
                // save new password
                $member->pass_member = $new_password_hash;
                $member->save();

                $result = 'OK';
                $message = 'เปลี่ยนรหัสผ่านสำเร็จ';
            }else {
                $result = 'ERROR';
                $message = 'กรุณากรอกรหัสผ่านใหม่ให้ตรงกัน';
            }
        }else {
            $result = 'ERROR';
            $message = 'รหัสผ่านเดิมไม่ถูกต้อง';
        }


        return response()->json([
            'status' => $result,
            'result' => $result,
            'message' => $message,
            // 'member' => $member
        ], 200);
    }

}
