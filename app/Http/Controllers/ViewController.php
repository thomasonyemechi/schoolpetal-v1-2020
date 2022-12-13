<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Stock;
use App\Models\User;
use App\Models\Supply;
use App\Models\Feecat;
use App\Models\Payfee;

class ViewController extends Controller
{

    function rindex(){
        return view('receipt');
    }
    public function index()
    {   
        $bid = $this->bid(); $total=0; $term = $this->term('term');  $sess = $this->term('sess');
        $date1 = date('YW'); $sum=0; $tp = 0;
        $student = DB::table('students')
                    ->where('bid',$bid)
                    ->orderBy('id','DESC')
                    ->limit(8)
                    ->get();
        //count all student
        $allstudent = count(DB::table('students')->where('bid',$bid)->get());
        //count all subject
        $allsubject = count(DB::table('subject')->where('bid',$bid)->get());
        //count all staff
        $allstaff = count(DB::table('users')->where('bid',$bid)->get())-1;
        //count all classes
        $class = count(DB::table('class')->where('bid',$bid)->get());
        $classname = DB::table('class')->where('bid',$bid)->orderBy('class','ASC')->get();

        //expected fees
        $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND  active=1 ");
        foreach($sql as $row){ $total += $row->amount-$row->discount; } 
        
        //total paid fee
        $sql1 = DB::select("SELECT * FROM payfees WHERE bid='$bid' AND term='$term' AND sess='$sess' AND active='1'");
        foreach($sql1 as $row){ $tp += $row->amount; }

        //registered this week
        $sql2 = DB::select("SELECT * FROM students WHERE bid = '$bid' ");	
        foreach($sql2 as $ro){ $trd = strtotime($ro->created_at); $date2 = date('YW',$trd);
        if($date1 == $date2){$sum += 1; }
        }
     //  $vpc = '';
        foreach($classname as $cc){
            $vpc[] = $this->feep($cc->id);
        }
        if(count($classname) == 0){
            $vpc = [];
        }
        


        //return response($vpc);

        return view('dashboard',
        ['students'=>$student,
            'allstudent'=>$allstudent,
            'tweek' => $sum,
            'allsubject'=>$allsubject,
            'allstaff'=>$allstaff,
            'expectedfee' => $total,
            'tp' => $tp,
            'class' =>$class,
            'classname' =>$classname,
            'vpc' => $vpc,
        ]);
    }


    function feep($class)
    {
        $tp = 0;
        $bid = $this->bid(); $term = $this->term('term');  $sess = $this->term('sess');
        $student = DB::select("SELECT * FROM students WHERE bid='$bid' AND class='$class'");
        foreach($student as $st){
            $sql1 = DB::select("SELECT * FROM payfees WHERE bid='$bid' AND uid='$st->uid' AND term='$term' AND sess='$sess' AND active='1'");
            foreach($sql1 as $row){ $tp += $row->amount; }
        }        
        return $tp;
    }

    public function feereceipt($salesid)
    {
        // $bid = $this->bid(); $term = $this->term('term');  $sess = $this->term('sess');
        // $title = DB::select("SELECT * FROM schools WHERE bid = '$bid' ");
        // $fee = DB::select("select * FROM payfees WHERE salesid = '$salesid' AND bid = '$bid' BY id ASC LIMIT 1 " );
        // $d = DB::select("SELECT * FROM fee WHERE id='$id' AND term='$term' AND sess='$sess' AND bid='$bid' AND fee='$fee'");
        
        // foreach ($fee as $k) {
        //     $fee2 = [
        //                 'des'=>$this->sqLx('feecat','id',$k->note,'fee'),
        //                 'amtp'=>$k->amount - $k->discount,
        //             ];
        // }
        // return response($fee2);
        // return view('other.feereceipt',['title',$title,'fee'=>$fee]);
    }

    public function getsrep(Request $request){
         $srep = $request['srep'];
         session()->put('srep', $srep);
         return back();
    }


    public function getvendor(Request $request){
        $vendor = $request['vendor'];
        session()->put('vendor', $vendor);
        return back();
   }


    public function repindex(){
        $bid = $this->bid();
        $asrep = DB::select("SELECT * FROM users WHERE bid='$bid' AND level = 6 ");
        $srep = session()->has('srep')?session()->get('srep'):'';
        $shis = DB::select("SELECT * FROM transact2 WHERE rep='$srep' AND bid='$bid' ORDER BY sn DESC LIMIT 25 " );
        $rhis = DB::select("SELECT * FROM returnx WHERE rep ='$srep' ORDER BY sn DESC LIMIT 25 ");
        return view('sales.repprofile',['asrep'=>$asrep,'shis'=>$shis,'rhis'=>$rhis]);
    }


    public function supindex(){
        $bid = $this->bid();
        $vid = (session()->has('vendor'))?session()->get('vendor'):'';
        $asrep = Supply::where('bid',$bid)->get();
        $shis = DB::select("SELECT * FROM stockup2 WHERE id='$vid' AND bid='$bid' ORDER BY sn DESC LIMIT 25" );
        return view('sales.vendorprofile',['asrep'=>$asrep,'shis'=>$shis]);
    }


    public function stockindex(){
        $bid  = $this->bid();
        $stocks  =     Stock::where('bid',$bid)->get();
        $pid = (session()->has('pid'))?session()->get('pid'):'';
        $shis = DB::select("SELECT * FROM stockup WHERE pid ='$pid' AND bid='$bid' ORDER BY sn DESC LIMIT 25 ");
        $uhis = DB::select("SELECT * FROM unstock WHERE pid ='$pid' AND bid='$bid' ORDER BY id DESC LIMIT 25 ");
        return view('sales.stockprofile',['stocks'=>$stocks,'shis'=>$shis,'uhis'=>$uhis]);
    }


    public function genstock(){
        $bid  = $this->bid();
        $c = DB::select("SELECT * FROM cats WHERE bid='$bid' ORDER BY cat ASC " );
        //return response($item);
        return view('sales.genstock',['cats'=>$c]);
    }


    function dailysales()
    {
        $bid = $this->bid();
        $sales = DB::select("SELECT * FROM transact2 WHERE bid = '$bid' " );
        return view('sales.dailysales',['sales'=>$sales]);
    }


    function getday(Request $request){
        session()->put('day',$request['startdate']);
        return back();
    }


    function weeklysales()
    {
        $bid = $this->bid();
        $sales = DB::select("SELECT * FROM transact2 WHERE bid = '$bid' " );
        return view('sales.weeklysales',['sales'=>$sales]);
    }


    function getweek(Request $request){
        session()->put('week',$request['week']);
        return back();
    }


    function monthlysales()
    {
        $bid = $this->bid();
        $sales = DB::select("SELECT * FROM transact2 WHERE bid = '$bid' " );
        return view('sales.monthlysales',['sales'=>$sales]);
    }


    function getmonth(Request $request){
        session()->put('mon',$request['mon']);
        session()->put('year',$request['year']);
        return back();
    }


    function annualsales()
    {
        $bid = $this->bid();
        $sales = DB::select("select * FROM stock WHERE bid = '$bid'" );
        return view('sales.annualsales',['sales'=>$sales]);
    }


    function annualstock()
    {
        $bid = $this->bid();
        $sales = DB::select("select * FROM stock WHERE bid = '$bid'" );
        return view('sales.annualstock',['sales'=>$sales]);
    }



    function profitloss()
    {
        return view('sales.profitloss');
    }


    function expend()
    {
        $bid = $this->bid();
        return view('sales.expend',['expend'=>DB::select("SELECT * FROM expitem WHERE bid = '$bid'" )]);
    }


    function sadr()
    {
        $bid = $this->bid();
        $salesrep = User::where('bid',$bid)->get();
        $stocks = Stock::where('bid',$bid)->get();
        $sales = DB::select("SELECT * FROM transact2 WHERE bid = '$bid' " );
        return view('sales.salesdetails',['staffs'=>$salesrep,'stocks'=>$stocks,'sales'=>$sales,'bid'=>$bid]);
    }

    function getinfo(Request $request)
    {
        return back()->with([
            'item'=>$request['item'],
            'salesrepProfile'=>$request['salesrepProfile'],
            'startdate'=>$request['startdate'],
            'startdate2'=>$request['startdate2'],
        ]);
    }


    function genfee()
    {
        $bid=$this->bid();
        $feecat = Feecat::where('bid',$bid)->get();
        return view('other.genfee',['feecat'=>$feecat]);
    }


    function dailyfee()
    {
        $bid=$this->bid(); $term = $this->term('term');
        $sess = $this->term('sess');
        $fee = Payfee::where('bid',$bid)->where('term',$term)->where('sess',$sess)->paginate(200);
        return view('other.dailyfee',['fee'=>$fee]);
    }

    function getday2(Request $request)
    {
        session()->put('day',$request['startdate']);
        return back();
    }


    function weeklyfee()
    {
        $bid=$this->bid(); $term = $this->term('term');
        $sess = $this->term('sess');
        $fee = Payfee::where('bid',$bid)->where('term',$term)->where('sess',$sess)->paginate(200);
        return view('other.weeklyfees',['fee'=>$fee]);
    }

    function getweek2(Request $request)
    {
        session()->put('week',$request['week']);
        return back();
    }


    function termlyfee()
    {
        $bid=$this->bid(); $term = $this->term('term');
        $sess = $this->term('sess');
        $aterm = DB::select("SELECT * FROM term WHERE bid='$bid' order BY termindex ASC ");
        $fee = Payfee::where('bid',$bid)->where('term',$term)->where('sess',$sess)->paginate(200);
        return view('other.termlyfee',['fee'=>$fee,'term'=>$term,'aterm'=>$aterm,'sess'=>$sess]);
    }

    function getterm(Request $request)
    {
        return back()->with([
            'termsess'=>$request['termsess']
        ]);
    }


}
