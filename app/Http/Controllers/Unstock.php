<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Unstocked;
use App\Models\Reason;
use App\Models\Stock;
use App\Models\Unstocker;
use App\Models\Supply;
use App\Models\Returnx;



class Unstock extends Controller
{
    //




    
    function UnstockItemUnit(Request $request){
      $ymd = date('ymd');
      $bid = $this->Bid();
      $rep = auth()->user()->sid;
      $salesid = (session()->has('ustock'))?session()->get('ustock'):$this->win_hash(10);
      session()->put('ustock',$salesid);
      $pid = session()->get('pid');

      $reason = $request['reason'];
    $qty = $request['qty'];
    $unitcost = $this->pin('unitcost');
    $amount = $qty*$unitcost; 
    $balqty = $this->pin('qty')-$qty;
    $item = $this->pin('item');
    $cat = $this->pin('cat'); $tot = $this->itemqty($pid);
           
      if($qty>$tot){ 
        
        return back()->with('error','Sorry, you have entered a quantity that is more than available quantity. Verify and try again');}
           
      else{  
       // return response($this->itemqty($pid));    
    $res2 = DB::insert("INSERT INTO unstock (item,salesid,pid,cat,qty,cost,amount,rep,reason,bid,today)
    VALUES('$item','$salesid','$pid','$cat','$qty','$unitcost','$amount','$rep','$reason','$bid',$ymd)") or die('cannot connect56789');

    if($res2){

    $resk = DB::update("UPDATE stock SET qty = '$balqty' WHERE id = '$pid' AND  bid = '$bid' LIMIT 1") or die('cannot connect-00000');
    return back()->with('success', 'You have successfully unstocked an item: '.$item ); 
    }

    }
    }



    public function unstock()  {
        $bid     =     $this->bid();
        $stocks  =     Stock::where('bid',$bid)->get();
        $supplier = Supply::where('bid',$bid)->get();
            $reason = Reason::where('bid',$bid)->get();

          if(session()->has('pid')){
            $pid =    session()->get('pid');  
            $salesid = session()->has('ustock')?session()->get('ustock'):'';
            $sd = Unstocker::where('salesid',$salesid)->get();
            $sins = Stock::where('id',$pid)->get();
            

            return view('sales.unstock',[
                                          'stocks'=>$stocks,
                                          'supplier'=>$supplier,
                                          'sd'=>$sd,
                                          'sins'=>$sins,
                                          'reason'=>$reason
                                          ]);
          }

        return view('sales.unstock',['stocks'=>$stocks,'reason'=>$reason,'supplier'=>$supplier]);
       }


    // public function unstock() {
          
    //     $bid = $this->bid();
    //     $item_pin =        session()->get('pinunstock');
    //     $reason =          Reason::all();
    //     $stocks =          Stock::where('bid',$bid)->get();
    //     $unstocked =       Unstocked::where('bid',$bid)->where('pin',$item_pin)->paginate(5);
    //     $unstockeds =      Unstocked::where('bid',$bid)->where('pin',$item_pin)->get();
    //     $stock_pin =       Stock::where('pin',$item_pin)->where('bid',$bid)->get();
       

    //     foreach ($stock_pin as $stock_pins) {
    //             session()->put('unstockitemized',$stock_pins->item); 
    //    }

    //     return view('sales.unstock',['stocks'=> $stocks,'stock_pins'=> $stock_pin, 
    //     'unstockeds'=> $reason,'allstocked'=>$unstocked,'totals'=>$unstockeds]);
    // }

    public function unstocks(Request $request) {
         
        $bid =  $this->bid();
        $itempin = $request['itempin'];
        $request->session()->put('pinunstock',$itempin);
        return redirect('unstock');

    }

    public function reason(Request $request) {

        $bid   =  $this->bid();
        $reason = $request['complain'];
        $this->validate($request, [
            'complain' => 'required'
        ]);
        Reason::create([
            'bid'=>$bid,
            'reason'=>$reason,
            'rep'=>$this->uid(),
        ]);

        return redirect('unstock')->with('success', 'Ustocking Reason successfully added');  
    }

    public function allreasons(Request $request){
        $bid   =  $this->bid(); 
        $rescat = $request['rescat'];
        $pin  = session()->get('pinunstock');
        $unitcost = session()->get('stock_unitcost');
        $pin  = session()->get('pinunstock');
        $stockpins =   Stock::where('pin',$pin)->get();
        $insert_qty   =  $request['qty'];
        foreach ($stockpins as $stockpin) {
            session()->put('stock_qtys',$stockpin->qty);
            session()->put('stock_unitcost',$stockpin->unitcost);
            session()->put('unstockeditemized',$stockpin->item);
     }
        $stock_qty =  session()->get('stock_qtys');
        $unstocked_item =  session()->get('unstockeditemized');
        $new_stock_qty  = $stock_qty -  $insert_qty;
     
          $unstocked  = new Unstocked();
          $unstocked->rescat =   $rescat;
          $unstocked->qty =  $insert_qty;
          $unstocked->unitcost =   $unitcost;
          $unstocked->bid  = $bid;
          $unstocked->item  =  $unstocked_item;
          $unstocked->pin = $pin;
          $amount = $unstocked->qty *  $unstocked->unitcost;
          $unstocked->amount = $amount;
          $successful = $unstocked ->save();

        if($successful) { 
               Stock::where('bid',$bid)->where('pin',$pin)->update([
                   'qty' =>  $new_stock_qty,
               ]);
        }
       
      return  redirect('unstock');
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
