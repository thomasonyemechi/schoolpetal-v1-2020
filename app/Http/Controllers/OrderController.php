<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Supply;
use App\Models\Transact;
use App\Models\Stockorder;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


    function ApprovePreOrder(){
        $today = date('ymd');
        $salesid = $_POST['ApprovePreOrder'];
        $bid = $this->bid();
        $rep = $this->uid();
        $vid = $this->Vid();
        $vendor = $this->vName($vid);
        $amount=0;
        $sql= DB::select("SELECT * FROM stockorder WHERE bid='$bid' AND salesid='$salesid' " );
        $i=1; $num = count($sql);
        foreach($sql as $row){  $e=$i++;
            $pid = $row->pid;  $qty = $row->qty;
            $co = 'cost'.$e;  $pr='price'.$e;
            $unitcost = $_POST[$co];
            $unitprice = $_POST[$pr];
            
            $totalcost = $unitcost*$qty;
            $amount += $totalcost;
            
            $cat = 1;
            //$item = $row['item'];
                
            DB::insert("INSERT INTO stockup (salesid,pid,cat,qty,unitcost,totalcost,unitprice,rep,bid)
            VALUES('$salesid','$pid','$cat','$qty','$unitcost','$totalcost','$unitprice','$rep','$bid')");
            
            DB::update("UPDATE stock SET unitprice = '$unitprice',unitcost = '$unitcost',qty='$qty' WHERE id = '$pid' AND  bid = '$bid' ");
            
        }
        
        DB::insert("INSERT INTO stockup2 (salesid,id,inv,amount,name,rep,bid,today)
        VALUES('$salesid','$vid','$salesid','$amount','$vendor','$rep','$bid','$today')");
        
        DB::update("UPDATE stockorder2 SET mode = 3 WHERE salesid = '$salesid' AND  bid = '$bid' ");
        session()->forget('porder');
        return back()->with('success','Pre-ordered stock successfully approved ');
        
    }  

    function itemName($pid,$col='item'){
        $bid = $this->bid();
          
        $sql = $this->sqSb('stock','id',$pid,'bid',$bid);
         foreach($sql as $row){
            return $row->$col;
          }
        }



    function index(){
        $bid = $this->bid();
        $supply = DB::table('supply')->where('bid', 27588219)->get();
        $ap = DB::select("SELECT * FROM stockorder2 WHERE bid='$bid' AND mode=0 ORDER BY id ASC " );
        if(session()->has('vendor')){
            $vid = session()->get('vendor');
            
            $salesid = session()->has('order')?session()->get('order'):'';
            $ard = DB::select("SELECT * FROM stockorder2 WHERE id='$vid' AND bid='$bid' AND mode != 3 ORDER BY sn ASC " );
            $ord = Stockorder::where('salesid',$salesid)->orderBy('sn','DESC')->get();
            $d = (session()->has('porder'))?session()->get('porder'):'';
            $det = DB::select("SELECT * FROM stockorder WHERE salesid='$d' " );

            return view('sales.orderprocessing')->with([
                'ord'=>$ord,
                'ard'=>$ard,
                'supply'=>$supply,
                'details'=>$det,
                'ap'=>$ap
            ]);
        }
        return view('sales.orderprocessing',['supply'=>$supply,'ap'=>$ap]);
    }

    function ViewOrder(Request $request){
        
        session()->put('porder',$request['ViewOrder']);
        return back()->with('success','Processing Order: '.$request['ViewOrder']);
        
    }



    function oindex(){
        $bid = $this->bid();
        $stocks = Stock::where('bid',$bid)->get();
        $supply = DB::table('supply')->where('bid',$bid)->get();
        if(session()->has('pid')){
            $pid = session()->get('pid');
            
            $salesid = session()->has('order')?session()->get('order'):'';
            $ord = Stockorder::where('salesid',$salesid)->orderBy('sn','DESC')->get();
            $sins = Stock::where('id',$pid)->get();

            return view('sales.stockpreorder')->with([
                'stocks'=>$stocks,
                'ord'=>$ord,
                'sins'=>$sins,
                'supply'=>$supply,
            ]);
        }
        return view('sales.stockpreorder',['stocks'=>$stocks,'supply'=>$supply,]);
    }


    public  function unitPreOrder(Request $request){
        $bid = $this->bid(); $ymd = date('ymd');
        $salesid = (session()->has('order'))?session()->get('order'): $this->win_hash(10);
        session()->put('order',$salesid);
        $rep = $this->uid();
        $pid = $this->Pid();
        $price = $request['price'];
        $qty = $_POST['qty'];
        @$amount = $price*$qty;
        $cat = $this->pin('cat');
        $item = $this->pin('item');
        //return response($amount);
          
        $res2 = DB::insert("INSERT INTO stockorder (salesid,pid,item,cat,qty,rep,bid,today,amount,price)
        VALUES('$salesid','$pid','$item','$cat','$qty','$rep','$bid','$ymd','$amount','$price')");
        return back()->with('success',$this->pin('item').' ('.$qty.') ordered & added to cart');

    }  


    
    function EditLine(Request $request){
        $qty=$_POST['qty'];
        $price=$_POST['price'];
        $sn=$_POST['EditLine'];
        @$amount = $qty*$price;
        $sql = DB::update("UPDATE stockorder SET qty='$qty', amount='$amount' WHERE sn = '$sn' ");
        //return response($amount);
        return back()->with('success','Item quantity updated to: '.$qty);
    }


    function removeOrderItem(){
         $bid=$this->Bid();
           $sn = $_POST['removeOrderItem'];
   //sqDb('stockorder','sn',$sn,'bid',$bid);
   DB::delete("DELETE FROM stockorder WHERE sn=$sn ");
   return back()->with('success','You have successfully removed an order from cart');
    }

    function PreOrderCheckout(Request $request){
        $ymd = date('ymd');
        $bid = $this->bid();
        $salesid = session()->get('order');
    
        $rep = $this->uid();
        $amount = $request['amount'];
        
        $vid = session()->get('vendor');
        //return $vid;
        $name = $this->vName($vid);
        if($amount==0){
            return back()->with('error','A transaction error occured with invoice ID: #'.$salesid);} 
        else{ 
            $res2 = DB::insert("INSERT INTO stockorder2 (salesid,id,inv,name,rep,bid,today)
            VALUES('$salesid','$vid','$salesid','$name','$rep','$bid','$ymd')");
            
            $resk = DB::update("UPDATE stockorder SET status = 1, name='$vid', rep='$rep' WHERE salesid = '$salesid' AND  bid = '$bid' ");
            session()->forget('order');
            return back()->with('success','You have successfully checked out the order with invoice ID: #'.$salesid);
        }
    }
    
   

}
