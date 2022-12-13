<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Power;
use Illuminate\Support\Facades\DB;

class PowerController extends Controller
{

    function update(Request $request)
    {   
         $e=0; $bid = $this->bid();
        $power = DB::select("SELECT * FROM power WHERE bid='$bid' ");

        foreach ($power as $r) { $e++;
            $id=$_POST['id'.$e];
            $make_sales = $this->on($request['make_sales'.$e]) ;
            $add_student = $this->on($request['add_student'.$e]) ;
            $add_expense = $this->on($request['add_expense'.$e]) ;
            $make_payment = $this->on($request['make_payment'.$e]) ;
            $sales_report = $this->on($request['sales_report'.$e]) ;
            $set_fees = $this->on($request['set_fees'.$e]) ;
            $add_staff = $this->on($request['add_staff'.$e]) ;
            $print_result = $this->on($request['print_result'.$e]) ;
            $big_salesrep = $this->on($request['big_salesrep'.$e]) ;
            $pay_profile = $this->on($request['pay_profile'.$e]) ;
            
            DB::update("UPDATE power SET make_sales='$make_sales', add_student='$add_student'
            , add_expense='$add_expense', make_payment='$make_payment', sales_report='$sales_report'
            , set_fees='$set_fees', add_staff='$add_staff', print_result='$print_result'
            , big_salesrep='$big_salesrep', pay_profile='$pay_profile' WHERE uid='$id'  ");
            $id = $id;      
          }
         // return response($id);
        return back()->with('success','Permission Update Sucessfully');
    }


    function on($val){
        $vak = ($val == 'on')?'1':'0';
        return $vak;
    }

    function power(Request $request){
        $bid = $this->bid();
        $sql = DB::select("SELECT * FROM users WHERE bid='$bid' ");
        foreach($sql as $row){
            $id = $row->sid;
            $ck = DB::select("SELECT * FROM power WHERE uid='$id' ");
            if(count($ck)==0){
                DB::insert("INSERT INTO power (uid,bid) VALUES('$id','$bid') ");
            }
        }

        return response('done');
    }

    public function index()
    {   
        $bid = $this->bid();
        $sch = $this->sqsb('users', 'bid', $bid, 'level', 10);
        $power = DB::select("SELECT * FROM power WHERE bid='$bid' ");
        return view('other.power',['power'=>$power,'sch'=>$sch]);
    }
}
