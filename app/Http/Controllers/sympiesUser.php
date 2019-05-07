<?php

namespace App\Http\Controllers;

use App\r_account_credential;
use App\r_account_notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class sympiesUser extends Controller
{
    //
    public function loginUser(Request $request)
    {

        $username = $request->username;
        $password = md5($request->password);
        $cred = r_account_credential::where('rac_username', $username)
            ->where('rac_password', $password)->get();

        $isLogin = ($cred->count());
        $cred = $cred->first();
        if($isLogin){
            $account = Array(
                "ID" => $cred->rac_accountid,
                "NAME" => $cred->rac_username,
                "CONTACT_NO" => $cred->rac_pnumb,
                "HOME_ADDRESS" => "",
                "EMAIL" => $cred->rac_email,
            );
            $get = Session::get('sympiesAccount');
            Session::put('sympiesAccount', $account);
        }

        return $isLogin;
    }
}
