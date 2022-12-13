<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordController extends Controller
{

    function changePassword(Request $request)
    {
        $oldPwd = $request['oldpwd'];
        $newPwd = $request['newpwd'];
        $confirmPwd = $request['confirmpwd'];

        


        if(password_verify($oldPwd, auth()->user()->password) ){
            if($newPwd == $confirmPwd){
                $id = $this->uid();
                $pwd = Hash::make($newPwd);

                User::where('sid', $id)->update(['password'=> $pwd]);

                $loginData = [
                    'email' => auth()->user()->email,
                    'password' => $newPwd
                ];
                auth()->attempt($loginData);

                return back()->with('success','Password changed successfully');
            }else{
                return back()->with('error','Password mismatch');
            }
        }else{
            return back()->with('error','The old password is not correct');
        }
        
    }
}
