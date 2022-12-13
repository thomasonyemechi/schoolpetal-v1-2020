<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Stockup;
use App\Models\Supply;
use App\Models\Transact;
use App\Models\Unstocker;
use App\Models\Returnx;
use Illuminate\Support\Facades\DB;


class Sale extends Controller
{


  function invoiceCheckout(){
    
    $ymd = date('ymd');
    $bid = $this->Bid();
    $salesid = (session()->has('rstock'))?session()->get('rstock'):'';
    $rep = $this->uid();
    
    $invoice = (session()->has('rstock'))?session()->get('rstock'):'';
  $cash = $_POST['cash'];
  
  $vid = $_POST['vid'];
  $amount = $_POST['total'];
   $name = $this->vName($vid); 
  
          
         if($amount==0){return redirect()->with('success','A transaction error occured with invoice ID: #'.$salesid);} else{ 
  
   $res2 = DB::insert("INSERT INTO stockup2 (salesid,id,inv,amount,cash,name,rep,bid,today)
  VALUES('$salesid','$vid','$invoice','$amount','$cash','$name','$rep','$bid','$ymd')") or die(mysqli_error('Server Error')); 
  
  $resk = DB::update("UPDATE stockup SET status =1  WHERE salesid='$salesid' ") or die('cannot connect12');
  if($cash>0){
  $sql = DB::insert("INSERT INTO payout (id,name,salesid,amount,note,rep,bid,today)
  VALUES('$vid','$name','$salesid','$cash','Invoice amount','$rep','$bid','$ymd')") or die('cannot connect45'); 
  }
  

  $report = 'You have successfully closed an invoice with invoice ID: #'.$salesid;
  session()->forget('rstock');
  
         }
  return redirect('restocks')->with('success', $report);
  }
  

  function StockItemUnit(){
    $bid = $this->Bid();
    $rep = $this->uid();
    //$salesid = $this->Salesid();
    $salesid = (session()->has('rstock'))?session()->get('rstock'):$this->win_hash(10);
    session()->put('rstock', $salesid);
    //print_r($_SESSION['stock']); exit();
    $pid = $this->Pid();
    $item = $this->pin();
    $qty = $_POST['qty'];
    $unitprice = $_POST['unitprice'];
    $unitcost = ($_POST['unitcost']>0)?$_POST['unitcost']:$unitprice;
    $totalcost = $unitcost*$qty;
    $balqty = $this->pin('qty')+$qty;
    $cat = $this->pin('cat');
    $item = $this->pin('item');

    $sql = DB::insert("INSERT INTO stockup (item,salesid,pid,cat,qty,unitcost,totalcost,unitprice,rep,bid)
    VALUES('$item','$salesid','$pid','$cat','$qty','$unitcost','$totalcost','$unitprice','$rep','$bid')") or die('cannot connnect');

    if($sql){

    $res = DB::update("UPDATE stock SET qty = '$balqty',unitprice = '$unitprice',unitcost = '$unitcost' WHERE id = '$pid' AND  bid = '$bid' ") or die('cannot Connect');
    $report='Item successfully added: '.$qty.' unit(s) of '.$item;
    }
    return back();
  }




    // function for display view sale blade template
       public function restock()  {
        $bid     =     $this->bid();
        $stocks  =     Stock::where('bid',$bid)->get();
        $supplier = Supply::where('bid',$bid)->get();
          if(session()->has('pid')){
            $pid =    session()->get('pid');  
            $salesid = session()->has('rstock')?session()->get('rstock'):'';
            $sd = Stockup::where('salesid',$salesid)->get();
            $sins = Stock::where('id',$pid)->get();
            

            return view('sales.restocks',[
                                          'stocks'=>$stocks,
                                          'supplier'=>$supplier,
                                          'sd'=>$sd,
                                          'sins'=>$sins
                                          ]);
          }

        return view('sales.restocks',['stocks'=>$stocks,'supplier'=>$supplier]);
       }

     

       public function post_itempin(Request $request) {
            
        //put the item pin in a session 
        $bid =  $this->bid();
        $itempin = $request['itempin'];
        $request->session()->put('pid',$itempin);
        return back();  
       }

       

       public function unit_item(Request $request)   {
          
         $this->validate($request, [
            'qty' => 'required',
            'unitcost' => 'required',
            'unitprice' => 'required',
        ]);

        

          $stockname = session()->get('item');

          $type = session()->get('type');
          
          

          $stockup = new Stockup();

          $item_pin = session()->get('itempin'); 
          
          $des = session()->get('des');

           
          

          $stockcat = session()->get('cat');

          $stockup->bid = auth()->user()->bid;

          $stockup->saleid = $item_pin.'123456';

          $stockup->pin = $item_pin;

          $stockup->des = $des;

          $stockup->type = $type;


        

          $stockup->item = $stockname;

          $stockup->cat = $stockcat;

          $request->session()->put('salesid', $stockup->salesid); 

          $balqty = $this->pin('qty') + $request['qty'];
          
          $stockup->qty =  $balqty;

          $stockup->unitprice = $request['unitprice'];

          $amounts   =   $stockup->qty * $request['unitcost'];
          
          $stockup->packprice = $request['packprice'];
     
          $stockup->unitcost = $request['unitcost'];

          $stockup->uptimum = $request['uptimum']; 


          $totalcost = ($stockup->unitcost) * ($stockup->qty);

          $stockup->totalcost = $totalcost;
          $stockup->item = $stockname;
          $stockup->cat = $stockcat;
          $balqty = $this->pin('qty')+($stockup->qty);
          $unitstockup = $stockup->save();
       
          if( $unitstockup) {
            $affected = DB::table('stocks')
            ->where('pin', $item_pin)
            ->where('bid', $stockup->bid)
            ->update([
                'qty' => $balqty,
                'unitprice' => $stockup->unitprice,
                'packprice' => $stockup->packprice,
                'unitcost' => $stockup->unitcost,
                'amount'    => $amounts,
                'uptimum' => $stockup->uptimum
                ]);
         return redirect('restocks')->with('success', 'Item successfully added: '.$stockup->qty.' unit(s) of '.$stockname);
//addLog ...suppose to update the log table as well ...
           }
          
      }





       public function  pack_item(Request $request)   { 
       
         $this->validate($request, [
            'packno' => 'required',
            'packcost' => 'required',
            'upp' => 'required',
            'unitprice' => 'required',
            'packprice' => 'required',
            'uptimum' => 'required',
        ]);

        $qty = $request['packno'] * $request['upp'];
        $unitcost = $request['packcost'] / $request['upp'];
        $unitcost = round($request['packcost'], 1);
        $totalcost = $request['packcost'] * $request['packno'];
        $balqty = $this->pin('qty') + $qty;
        $stockpin = session()->get('itempin'); 
        $stockname = session()->get('item'); 
        $stockcat = session()->get('cat'); 
        $unitprice= session()->get('unitprice'); 
        $amounts =  $balqty *  $unitcost;
       
        

        $packstockup = DB::table('stockups')->insert([
         'saleid' => $stockpin.'123456', 
         'pin' => $stockpin,
         'item' => $stockname,
         'cat'=> $stockcat,
         'des' => session()->get('des'),
         'type' => session()->get('type'),
         'qty' => $qty,
         'pqty' => $request['upp'],
         'unitcost'=>$unitcost, 
         'totalcost'=>$totalcost,
         'unitprice'=>$request['unitprice'],
         'packprice'=>$request['packprice'],
         'uptimum'=>$request['uptimum'],
         'rep'=> auth()->user()->id,
         'bid'=> $this->bid(),
         
     ]);
if($packstockup){
//update stocks..table..
$affected = DB::table('stocks')
     ->where('pin', $stockpin)
     ->where('bid', $this->bid())
     ->update([
         'qty' => $balqty,
         'unitprice' => $request['unitprice'],
         'packprice' => $request['packprice'],
         'unitcost' => $unitcost,
         'amount'   => $amounts,
         'uptimum' => $request['uptimum'],
         'pqty' => $request['upp'],
         ]);
    return redirect('restocks') 
        ->with('success', 'Item successfully added: '.$qty.' unit(s) of '.$stockname);
       }
    }



     public  function checkout(Request $request) {
      
      
      $bid = $this->bid();

      $uidsale = $request['uidsale'];

      Unstocker::where('bid',$bid)->where('uid', $uidsale)->delete();

      return redirect('pos');

    }
}
