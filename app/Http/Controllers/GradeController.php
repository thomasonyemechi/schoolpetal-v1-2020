<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class GradeController extends Controller
{
    public function index()
    {   
        $bid = $this->bid();
        $grades = DB::table('grade')
                    ->where('bid',$bid)
                    ->get();
        return view('other.resultsetup',['grade'=>$grades]);
    }

    public function updateDefaultGrade(Request $request)
    {
        $bid = $this->bid();
        $a = $request['a'];
        $b = $request['b'];
        $c = $request['c'];
        $d = $request['d'];
        $e = $_POST['e'];

        if($b < $a || $b != $a ){
            if($c < $b || $c != $b){
                if($d < $c || $d != $c){
                    if($e < $d || $e != $d){
                        if($e >= 40){
                            DB::update("UPDATE grade SET a='$a',b='$b',c='$c',d='$d',e='$e' WHERE bid='$bid'");
                            return redirect('resultsetup')->with('success',"Successfully Updated");
                        } else {  return redirect('resultsetup')->with('error',"Grade E cannot Be lesser than 40");}
                    } else {  return redirect('resultsetup')->with('error',"Grade E cannot Be greater than or equal to Grade D"); }
                } else { return redirect('resultsetup')->with('error',"Grade D cannot Be greater than or equal to Grade C"); }
            } else {  return redirect('resultsetup')->with('error',"Grade C cannot Be greater than or equal to Grade B"); }
        } else { return redirect('resultsetup')->with('error',"Grade B cannot Be greater than or equal to Grade A"); }
    }

    public function updateDefaultScore(Request $request)
    {
        global $db, $report, $count;

        $bid = $this->bid();
        $ca1 = $request['ca1'];
        $ca2 = $request['ca2'];
        $ca3 = $request['ca3'];
        $exam = $request['exam'];

        $total = $ca1 + $ca2 + $ca3 + $exam;
        if ($total <= 100) {
            DB::update("UPDATE grade SET ca1='$ca1',ca2='$ca2',ca3='$ca3',exam='$exam' WHERE bid='$bid'");
            return redirect('resultsetup')->with('success',"Successfully Updated");
        } else {
            return redirect('resultsetup')->with('error',"Sorry Total Score Cannot Be More than 100");
        }
    }

    public function UpdateComment(Request $request)
    {    
        $bid = $this->bid();
    
        $t1 = trim($request['t1']);
        $t2 = trim($request['t2']);
        $t3 = trim($request['t3']);
        $t4 = trim($request['t4']);
        $t5 = trim($request['t5']);
        $t6 = trim($request['t6']);
        $p1 = trim($request['p1']);
        $p2 = trim($request['p2']);
        $p3 = trim($request['p3']);
        $p4 = trim($request['p4']);
        $p5 = trim($request['p5']);
        $p6 = trim($request['p6']);
    
        $sql = DB::update("UPDATE grade SET ta='$t1',tb='$t2',tc='$t3',td='$t4',te='$t5',tf='$t6',
                          pa='$p1',pb='$p2',pc='$p3',pd='$p4',pe='$p5',pf='$p6' WHERE bid='$bid'");
        
        return redirect('resultsetup')->with('success',"Comment Updated Successfully");
    }

}
