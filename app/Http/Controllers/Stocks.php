<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stock;

use App\Models\Student;
use App\Models\Stockup;
use App\Models\Transact;
//use Dotenv\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

$sta = new ProfileController;

class Stocks extends Controller
{
    //

    function removeItem(){
         $bid=$this->bid();
           $sn = $_POST['removeItem'];
   //sqDb('transact','sn',$sn,'bid',$bid);
   //  return response($_POST);
   DB::delete("DELETE FROM transact WHERE id = $sn AND bid='$bid' ");
   return back()->with('success','You have successfully removed an item from cart');
    }
   

    function updateStockProfile(){
        global $db,$report,$count;
        
    $rep = $this->uid();
    $bid = $this->Bid();
    $pid = $this->Pid();
  
  $item = $_POST['item'];
  $unitprice = $_POST['unitprice'];
  
  $res = DB::update("UPDATE stock SET unitprice = '$unitprice' WHERE id = '$pid' AND  bid = '$bid' ");
  
  return back()->with('success','Item successfully updated: '.$this->pin('item'));
   }

   

     
    function EditLinePos(Request $request){

        $qty=$_POST['qty'];
        $price=$_POST['price']; $pid = $_POST['pid'];
        $sn=$_POST['EditLinePos'];
        $amount = $qty*$price;
      

        $tot = $this->itemqty($pid);
           
      if($qty>$tot){ 
        
        return back()->with('error','Sorry, you have entered a quantity that is more than available quantity. Verify and try again');
      }
        $sql = DB::update("UPDATE transact SET qty='$qty', amount='$amount' WHERE id = '$sn' ");
    return back()->with('success','Item quantity updated to: '.$qty);
    }


    
    function salesCheckout(Request $request){
        $ymd = date('ymd');
        $bid = $this->bid();
        $salesid = session()->get('salesid');
        $rep = $this->uid();
        
        $mode = $_POST['mode'];
    $cash = $_POST['cash'];
    
    $cid = $_POST['cid'];
    $amount = $_POST['total'];
     $name = $this->cName($cid); 

     //return response($name);
                  
    if($amount==0){
        return back()->with('error','A transaction error occured with invoice ID: #'.$salesid);
    } else{ 
        $res2 = DB::insert("INSERT INTO transact2 (salesid,id,inv,amount,cash,name,rep,mode,bid,today)
        VALUES('$salesid','$cid','$salesid','$amount','$cash','$name','$rep','$mode','$bid','$ymd')") or die(mysqli_error('Server Error')); 
        
        $resk = DB::update("UPDATE transact SET status = 1, name='$name' WHERE salesid = '$salesid' AND  rep = '$rep' ") or die('Cannot Connect 6');
        if($cash>0){
            $sql = DB::insert("INSERT INTO payment (salesid,id,name,amount,note,rep,today,bid)
            VALUES('$salesid','$cid','$name','$cash','Point-of-sale','$rep','$ymd','$bid')") or die('Cannot Connect 2');    
            //$this->transactionSms($cid,$cash); //send transaction sms
        }
    
        //$_SESSION['mode']=2;
        session()->forget('salesid');
        return back()->with('success','You have successfully checked out the transaction with invoice ID: #'.$salesid);
        //$this->addLog();
        //$this->loadTrapped(); // load trapped items
    
    }
   
    
    }
    
    function unitSales(Request $request){

      
        $bid = $this->Bid(); $ymd = date('ymd');
        $salesid = (session()->has('salesid'))?session()->get('salesid'):$this->win_hash(10);
        session()->put('salesid', $salesid);
        $rep = $this->uid();
        $pid = $this->Pid();
        $qty = $_POST['qty'];

        $price = (int)$_POST['price'];
        $amount = $qty*$price; 
        $balqty = $this->itemqty($pid)-$qty;
        $cat = $this->pin('cat');
        $item = $this->pin('item');
                
        if($this->itemqty($pid)<$qty AND $this->pin('type')==1){    
            return back()->with('error','Sorry! available quantity is less than the specified quantity. You can buy '.$this->itemqty($pid).' units or less.');}
        else{     
            $res2 = DB::insert("INSERT INTO transact (salesid,pid,item,cat,qty,price,amount,rep,bid,today)
            VALUES('$salesid','$pid','$item','$cat','$qty','$price','$amount','$rep','$bid','$ymd')") or die('cannot connect');
            DB::update("UPDATE stock SET qty=$balqty WHERE id=$pid ");
            if($res2){
                return back()->with('success', $this->pin('item').' ('.$qty.') successfully added to cart');
            }

        }
    }


      public function index() {
          
        $bid = $this->bid();
        $stocks =      Stock::where('bid',$bid)->get();  
        $students =    Student::where('bid',$bid)->get();
        
        if(session()->has('pid')){
            $pid = session()->get('pid');
            
            $salesid = session()->has('salesid')?session()->get('salesid'):'';
            $csel = Transact::where('salesid',$salesid)->get();
            $sins = Stock::where('id',$pid)->get();
            

            return view('sales.sale')->with([
                'stocks'=>$stocks,
                'students'=>$students,
                'students'=>$students,
                'csel'=>$csel,
                'sins'=>$sins,
            ]);
        }
      
        return view('sales.sale')->with(['stocks'=>$stocks,'students'=>$students,]);

    }

    

        
    function sqql($table,$a,$b,$c,$d,$col){
    $sum = 0;
    $sql = DB::select("SELECT * FROM $table WHERE $a='$b' AND $c='$d' ");
    foreach($sql as $row){
        $sum += $row->$col;
    }
    return $sum;
    }

    function itemqty($pid){
    $bid = $this->bid();
    $sum1 = $this->sqql('stockup','pid',$pid,'bid',$bid,'qty');//stocking item
    $sum2 = $this->sqql('transact','pid',$pid,'bid',$bid,'qty');//dispensary
    $sum3 = $this->sqql('unstock','pid',$pid,'bid',$bid,'qty');//unstocking

    return $sum1-$sum2-$sum3;
    }



}
