<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smssetup;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    //

    function updateapikeyssms(Request $request){
        $bid = $this->bid();
        $validate = Validator::make($request->all(), [
        'apikey' => 'required',
        'sender' => 'required',
        ])->validate();
            $akey = $request['apikey'];
            $send = $request['sender'];
        DB::update("UPDATE smssetup SET apikey='$akey', senderid='$send' WHERE bid=$bid ");

        return back()->with('success','Keys Set Successfully');
    }

    function updatesmsprefer(Request $request){
        $bid = $this->bid();
        $fee = ($request['fee']=='on')?1:0;
        $pos = ($request['pos']=='on')?1:0;
        DB::update("UPDATE smssetup SET pos='$pos', fee='$fee' WHERE bid=$bid ");
        //return response($request);
        return back()->with('success','Updated Successfully');
    }


    function updatesmssetup(Request $request){
        $al = User::where('level',10)->get();
        // foreach($al as $ro){
        //     Smssetup::create([
        //         'bid' => $ro->bid,
        //     ]);
        // }
        return response('done');
    }

    function index(){
        $bid = $this->bid();
        $myapi = Smssetup::where('bid',$bid)->get();
        return view('other.smssetup',['api'=>$myapi]);
    }


}
