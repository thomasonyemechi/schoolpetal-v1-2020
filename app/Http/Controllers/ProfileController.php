<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cbt\Exam;
use App\Models\Setsubject;
use App\Models\Course\Course;

class ProfileController extends Controller
{

  function countcat($class){

  }

  function lsalesid($table,$order){
    $bid = $this->bid();
    $sql = DB::select(" SELECT * FROM $table WHERE bid = '$bid' ORDER BY $order DESC LIMIT 1  ");
    foreach($sql as $row){
      return $row->salesid;
    }
  }

  function resql2($salesid)
  {
    $bid = $this->bid();
    return DB::select("select * FROM transact WHERE salesid = '$salesid' AND bid = '$bid' ORDER BY id ASC LIMIT 0 , 200" );
  }

  function resql($salesid,$col){
    $bid = $this->bid();
    $sql = DB::select("select * FROM transact2 WHERE salesid = '$salesid' AND bid = '$bid' ORDER BY sn ASC LIMIT 1 " );
    foreach($sql as $row){
      return $row->$col;
    }
    
  }


  function yRestock(){
    $bid=$this->bid();

$sql = DB::select("SELECT SUM(totalcost) AS value_sum FROM stockup  WHERE  bid = '$bid' ");
///$row = mysqli_fetch_object($sql); 
$amount = 0;// $row['value_sum'];
return $amount;
}

function sqlitem($limit)
{
  $bid = $this->bid(); 
  return DB::select("SELECT * FROM stock WHERE  bid = $bid ORDER by RAND() limit $limit ");
}

function sqlsales($limit){
  $rep = $this->uid();
  return DB::select("SELECT * FROM transact2 WHERE rep = '$rep' ORDER BY sn DESC limit $limit ");
}


  function activeCustomersLast30Days(){    
    $bid=$this->bid();
    $datea = time();
    $dateb = $datea-2592000;
$sum=0;
$sql = DB::select("SELECT * FROM students WHERE bid = '$bid' ");  
foreach($sql as $row){ 
    $id = $row->id;
$sq =  DB::select("SELECT * FROM transact2 WHERE id = '$id' AND bid = '$bid' ORDER BY sn DESC LIMIT 1 ");
foreach($sq as $r){
//$r=mysqli_fetch_assoc($sq);
    $date2 = strtotime($r->created);

if($date2 <= $datea AND $date2 >= $dateb){$sum += 1; }
}
}

return $sum;
}



  function totalTrans(){
    global $db;
    $bid=$this->bid();

$sql = DB::select("SELECT * FROM transact2  WHERE  bid = '$bid' ");
return count($sql);
}

  function catCount(){
    global $db;
    $bid=$this->bid();
$sql = DB::select("SELECT * FROM cat WHERE bid = '$bid' "); 
return count($sql);
}


  function sales(){
    $bid=$this->bid();
$sql = DB::select("SELECT * FROM transact2 WHERE bid = '$bid' ");   
return count($sql);
}

  function totalSales(){
    $bid=$this->Bid();
    $ymd = date('ymd');
$sql = DB::select("SELECT SUM(amount) AS value_sum FROM transact  WHERE  bid = '$bid' AND today = '$ymd' ");
//$row = mysqli_fetch_object($sql); 
$amount =0;// $row['value_sum'];
return $amount;
}

  function stockCount(){
    $bid=$this->bid();
return count(DB::select("SELECT * FROM stock WHERE bid = '$bid' "));
}



  function ansques($tcode){
    $bid = $this->bid();
    return count(DB::select("SELECT * FROM result2 WHERE tcode='$tcode' "));
  }

  function countques($esn){
    //return count(DB::table('question')->where('esn',$esn)->where('status',1)->get());
    $bid = $this->bid();
    return count(DB::table('question')->where('esn',$esn)->where('bid',$bid)->where('status',1)->get());
  }
  function counttopic($t)
  {
    return count(DB::select("SELECT * FROM topic WHERE mid='$t' "));
  }

  function esn($esn,$col=''){
    $sql = Exam::where('sn',$esn)->get();
    foreach ($sql as $row) {
      $na = ''.$this->subject($row->subject).' '.$this->class($row->class).' '.$this->etype($row->examtype).'';
      $name = ($col=='')?$na:$row->$col;
      return $name;
    }
  }

  function course($csn,$col=''){
    $row = Course::find($csn);
      $na = ''.$this->class($row->class).' '.$this->subject($row->course).' '.$this->termname($row->term).' TERM';
      $name = ($col=='')?$na:$row->$col;
      return $name;
  }

  function subject($sn,$col='')
  {
    $sql = DB::select("SELECT * FROM subject WHERE id='$sn' ");
    foreach ($sql as $row) {
      $name = ($col=='')?$row->subject:$row->$col;
      return $name;
    }
  }
  function class($sn,$col='')
  {
    $sql = DB::select("SELECT * FROM class WHERE id='$sn' ");
    foreach ($sql as $row) {
      $name = ($col=='')?$row->class:$row->$col;
      return $name;
    }
  }

  function etype($sn,$col='')
  {
    $sql = DB::select("SELECT * FROM type WHERE sn='$sn' ");
    foreach ($sql as $row) {
      $name = ($col=='')?$row->examtype:$row->$col;
      return $name;
    }
  }

  public function termname($sn)
  {
    if($sn == 1){ $name = 'first';}
    elseif($sn == 2){$name = 'second';}
    elseif($sn == 3){$name = 'third';}
    return $name;
  }


  function pow($vak){
    $ck = ($vak==1)?'checked':'';
    return $ck;
  } 


  function monthExpend($month,$pid){
     $amt = 0; $bid = $this->bid();
    $query=DB::select("select * FROM expend WHERE bid = '$bid' AND expid = '$pid' " );
    foreach($query as $row){
          if($month == date('Ym',strtotime($row->created_at))){   $amt += $row->amount;     }
        }
        return $amt;
  }
  
  // function monthExpendTotal($month){
  //   global $db,$bid;
  //    $amt = 0;
  //   $query=$db->query("select * FROM expend WHERE bid = '$bid' " )or die(mysqli_error());
  //               while($row=mysqli_fetch_array($query)){
  //         if($month == date('Ym',strtotime($row['created']))){   $amt += $row['amount'];     }
  //       }
  //       return $amt;
  // }
  
  function yearExpend($year,$pid){
     $amt = 0;$bid = $this->bid();
    $query= DB::select("SELECT * FROM expend WHERE bid = '$bid' AND expid = '$pid' " );
    foreach($query as $row){
          if($year == date('Y',strtotime($row->created_at))){   $amt += $row->amount;     }
        }
        return $amt;
  }
  // function yearExpendTotal($year){
  //   global $db,$bid;
  //    $amt = 0;
  //   $query=$db->query("SELECT * FROM expend WHERE bid = '$bid' " )or die(mysqli_error());
  //               while($row=mysqli_fetch_array($query)){
  //         if($year == date('Y',strtotime($row['created']))){   $amt += $row['amount'];     }
  //       }
  //       return $amt;
  // }

  

  
// function monthStockingTotal($month){
//    $amt = 0;
//   $query= DB::select("select * FROM stockup WHERE bid = '$bid' " );
//               while($row=mysqli_fetch_array($query)){
//         if($month == date('Ym',strtotime($row->created))){   $amt += $row->totalcost;     }
//       }
//       return $amt;
// }

// function monthSalesTotal($month){
//    $amt = 0;
//   $query=  DB::select("select * FROM transact WHERE bid = '$bid' " );
//   foreach($query as $row){
//         if($month == date('Ym',strtotime($row->created))){   $amt += $row->amount;     }
//       }
//       return $amt;
// }

// function yearSalesTotal($year){
//    $amt = 0;
//   $query= DB::select("SELECT * FROM transact WHERE bid = '$bid' " );
//   foreach($query as $row){
//         if($year == date('Y',strtotime($row->created))){   $amt += $row->amount;     }
//       }
//       return $amt;
// }


// function yearStockingTotal($year){
//    $amt = 0;
//   $query= DB::select("SELECT * FROM stockup WHERE bid = '$bid' " );
//   foreach($query as $row){
//         if($year == date('Y',strtotime($row->created))){   $amt += $row->totalcost;     }
//       }
//       return $amt;
// }



function monthExpendTotal($month){
   $amt = 0;$bid = $this->bid();
  $query= DB::select("select * FROM expend WHERE bid = '$bid' " );
  foreach($query as $row){
        if($month == date('Ym',strtotime($row->created_at))){   $amt += $row->amount;     }
      }
      return $amt;
}

function yearExpendTotal($year){
   $amt = 0; $bid = $this->bid();
  $query= DB::select("SELECT * FROM expend WHERE bid = '$bid' " );
  foreach($query as $row){
        if($year == date('Y',strtotime($row->created_at))){   $amt += $row->amount;     }
      }
      return $amt;
}


function monthCost($month){
  
  $amt = 0; $bid = $this->bid();
  $query= DB::select("select * FROM expend WHERE bid = '$bid' " );
  foreach($query as $row){
        if($month == date('Ym',strtotime($row->created_at))){   $amt += $row->amount;     }
      }
    $query= DB::select("select * FROM stockup WHERE bid = '$bid' " );
    foreach($query as $row){
        if($month == date('Ym',strtotime($row->created))){   $amt += $row->totalcost;     }
      }
      return $amt;
}


function yearCost($year){
   $amt = 0; $bid = $this->bid();
  $query=DB::select("SELECT * FROM expend WHERE bid = '$bid' " );
      foreach($query as $row){
        if($year == date('Y',strtotime($row->created_at))){   $amt += $row->amount;     }
      }
 $query= DB::select("SELECT * FROM stockup WHERE bid = '$bid' " );
         foreach($query as $row){
        if($year == date('Y',strtotime($row->created))){   $amt += $row->totalcost;     }
      }

      return $amt;
}





  function monthStocking($month,$pid){
     $amt = 0; $bid = $this->bid();
    $query= DB::select("select * FROM stockup WHERE bid = '$bid' AND pid = '$pid' " );
    foreach($query as $row){
          if($month == date('Ym',strtotime($row->created))){   $amt += $row->totalcost;     }
        }
        return $amt;
  }
  
  function monthStockingTotal($month){
     $amt = 0; $bid = $this->bid();
    $query= DB::select("select * FROM stockup WHERE bid = '$bid' " );
    foreach($query as $row){
          if($month == date('Ym',strtotime($row->created))){   $amt += $row->totalcost;     }
        }
        return $amt;
  }
  
  function yearStocking($year,$pid){
     $amt = 0; $bid = $this->bid();
    $query= DB::select("SELECT * FROM stockup WHERE bid = '$bid' AND pid = '$pid' " );
    foreach($query as $row){
          if($year == date('Y',strtotime($row->created))){   $amt += $row->totalcost;     }
        }
        return $amt;
  }
  
  function yearStockingTotal($year){
     $amt = 0; $bid = $this->bid();
    $query=DB::select("SELECT * FROM stockup WHERE bid = '$bid' " );
    foreach($query as $row){
          if($year == date('Y',strtotime($row->created))){   $amt += $row->totalcost;     }
        }
        return $amt;
  }
  

  
function monthSales($month,$pid){
   $amt = 0; $bid = $this->bid();
  $query=DB::select("select * FROM transact WHERE bid = '$bid' AND pid = '$pid' " );
  foreach($query as $row){
        if($month == date('Ym',strtotime($row->created))){   $amt += $row->amount;     }
      }
      return $amt;
}

function monthSalesTotal($month){
   $amt = 0;
   $bid = $this->bid();
  $query=DB::select("select * FROM transact WHERE bid = '$bid' " );
  foreach($query as $row){
        if($month == date('Ym',strtotime($row->created))){   $amt += $row->amount;     }
      }
      return $amt;
}

function yearSales($year,$pid){
   $amt = 0;
   $bid = $this->bid();
  $query=DB::select("SELECT * FROM transact WHERE bid = '$bid' AND pid = '$pid' " );
  foreach($query as $row){
        if($year == date('Y',strtotime($row->created))){   $amt += $row->amount;     }
      }
      return $amt;
}

function yearSalesTotal($year){
  $bid = $this->bid();
   $amt = 0;
  $query=DB::select("SELECT * FROM transact WHERE bid = '$bid' " );
              foreach($query as $row){
        if($year == date('Y',strtotime($row->created))){   $amt += $row->amount;     }
      }
      return $amt;
}






  function sql($table,$col,$val){
    return DB::select("SELECT * FROM $table WHERE $col='$val' ");
  }


  function NoStockOrder($salesid){
   $bid = $this->bid();
    $sql=DB::select("SELECT * FROM stockorder WHERE bid='$bid' AND salesid='$salesid' ORDER BY sn ASC " );
    return count($sql);
  }

    function Srep(){
        $srep = (session()->has('srep'))?session()->get('srep'):'';
        return $srep;
    }

    function repPayMonthly($month){
        $srep=$this->Srep();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }

      
        function sqSa($a,$b,$c){
                return DB::select("SELECT * FROM $a WHERE $b = '$c' ");
        }	


      function sqSuma($a,$b,$c,$col){
		    $sum=0; 	
        $sql = $this->sqSa($a,$b,$c);
        foreach($sql as $row){ @$sum += $row->$col;}
        return $sum;
            }
    

      function countRowsa($table,$a,$b){
        $bid = $this->bid();
        $sql= DB::select("SELECT * FROM $table WHERE bid = '$bid' AND $a = '$b' " );
        return count($sql);
    }
      
      
      
      
      function repInvoiceMonthly($month){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }


      function rName($rep,$col='name'){
        global $db;
        
    $sql=DB::select("SELECT * FROM users WHERE sid='$rep' LIMIT 1 " );
    foreach($sql as $row){
        return $row->$col;
      }
    }
    

      
        function tr2Name($sn,$col='amount'){
        global $db;
        $bid = $this->Bid();
        $query=DB::select("select * FROM transact2 WHERE sn='$sn' AND bid='$bid' " )or die(mysqli_error('cannot connect'));
        foreach($query as $row){
            return $row->$col;
          }
                }
      
      
      function discounted($sn){
        global $db;
        $bid = $this->Bid();
        $cid = $this->tr2Name($sn,'name');
        $salesid = $this->tr2Name($sn,'salesid');
        $percent = $this->tr2Name($sn,'discount');
        
      
        $sql = DB::select("SELECT SUM(amount) AS value_sum FROM transact  WHERE salesid = '$salesid' AND  bid = '$bid' ") or die(mysqli_error('cannot do that'));
      foreach($sql as $row){
                    $amount = $row->value_sum;
     }
      
      
      
      return $amount*(1-($percent/100));
      }
      
          function repPayLy(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $date1 = date('Y')-1;
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      
          function repPayTy(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $date1 = date('Y');
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
          function repPayTw(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $date1 = date('YW');
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function repPayLw(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $lw = time()-604800;
        $date1 = date('YW',$lw);
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
          function repPayToday(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $today = date('Y-m-d');
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,10);
      if($today == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      function repPayYest(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $yest = time()-86400;
        $date1 = date('Ymd',$yest);
      $sum=0;
      $sql = DB::select("SELECT * FROM payment WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Ymd',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      
      function repInvoiceTy(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $date1 = date('Y');
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
          function repInvoiceLy(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $date1 = date('Y')-1;
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      
      function repInvoiceTw(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $date1 = date('YW');
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      
      function repInvoiceLw(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $lw = time()-604800;
        $date1 = date('YW',$lw);
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function repInvoiceToday(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $today = date('Y-m-d');
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,10);
      if($today == $trd){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      function repInvoiceYest(){
        global $db;
        $srep=$this->Srep();
        $bid=$this->Bid();
        $yest = time()-86400;
        $date1 = date('Ymd',$yest);
      $sum=0;
      $sql = DB::select("SELECT * FROM transact2 WHERE rep = '$srep' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Ymd',$trd);
      if($date1 == $date2){$sum += $this->discounted($row->sn); }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
    //     function updateVendorProfile(){
    //         global $db,$report,$count;
            
    //     $rep = $this->Rep();
    //     $bid = $this->Bid();
      
    //   $name = sanitize($_POST['name);
    //   $phone = sanitize($_POST['phone);
    //   $address = sanitize($_POST['address);
    //   $vid = $this->Vid();
        
    //   $res = DB::select("UPDATE supply SET name = '$name',phone = '$phone',address = '$address' WHERE id = '$vid' AND  bid = '$bid' ") or die(mysqli_error());
    //   $report='Vendor successfully updated: '.$name;
    //   return;
    //    }
      
      
        function repFirstSold($opt='salesid'){
        global $db;
        $bid = $this->Bid();
        $srep = $this->Srep();
        $query=DB::select("select * FROM transact2 WHERE rep='$srep' AND bid='$bid' ORDER BY sn ASC LIMIT 1" );
                  foreach($query as $row){
                    return $row->$opt;
                  }
                }
      
      
      
      function repLastSold($opt='salesid'){
        global $db;
        $bid = $this->Bid();
        $srep = $this->Srep();
        $query=DB::select("select * FROM transact2 WHERE rep='$srep' AND bid='$bid' ORDER BY sn DESC LIMIT 1" );
        foreach($query as $row){
            return $row->$opt;
          }
                }
      
      
      function repBigSale($opt='salesid'){
        global $db;
        $bid = $this->Bid();
        $srep = $this->Srep();
        $query=DB::select("select * FROM transact2 WHERE rep='$srep' AND bid='$bid' ORDER BY amount DESC LIMIT 1" );
        foreach($query as $row){
            return $row->$opt;
          }
                }
       
      
      
      function vendorPayTy(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $date1 = date('Y');
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      function vendorPaidMonthly($month){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      function vendorInvoiceMonthly($month){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->amount; }
      }
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){@$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      function vendorPayLw(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $lw = time()-604800;
        $date1 = date('YW',$lw);
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      function vendorPayTw(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $date1 = date('YW');
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      function vendorInvoiceLy(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $date1 = date('Y')-1;
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function vendorPayToday(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $today = date('Y-m-d');
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,10);
      if($today == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function vendorInvoiceTy(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $date1 = date('Y');
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){@$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      function vendorPayLy(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $date1 = date('Y')-1;
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Y',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function vendorInvoiceTw(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $date1 = date('YW');
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){@$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function vendorPayYest(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $yest = time()-86400;
        $date1 = date('Ymd',$yest);
      $sum=0;
      $sql = DB::select("SELECT * FROM payout WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Ymd',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      function vendorInvoiceToday(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $today = date('Y-m-d');
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,10);
      if($today == $trd){$sum += $row->amount; }
      }
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,10);
      if($today == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function vendorInvoiceLw(){
        global $db;
        $vid=$this->Vid();
        $bid=$this->Bid();
        $lw = time()-604800;
        $date1 = date('YW',$lw);
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('YW',$trd);
      if($date1 == $date2){@$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
    function vid(){
      $vid = (session()->has('vendor'))?session()->get('vendor'):'';
      return $vid;
    }
      
      
      function vendorInvoiceYest(){
        $vid=$this->Vid();
        $bid=$this->Bid();
        $yest = time()-86400;
        $date1 = date('Ymd',$yest);
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup2 WHERE id = '$vid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Ymd',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sql = DB::select("SELECT * FROM expend2 WHERE id = '$vid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = strtotime($row->created); $date2 = date('Ymd',$trd);
      if($date1 == $date2){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }

      

      function itemSoldMonthly($month){
        global $db;
        $pid=$this->Pid();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM transact WHERE pid = '$pid' AND bid = '$bid' "); 
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function itemRestockMonthly($month){
        global $db;
        $pid=$this->Pid();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM stockup WHERE pid = '$pid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->totalcost; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      function itemReturnMonthly($month){
        global $db;
        $pid=$this->Pid();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM returnx WHERE pid = '$pid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      function itemUnstockMonthly($month){
        global $db;
        $pid=$this->Pid();
        $bid=$this->Bid();
        $month = ($month<10) ? '0'.$month : $month;
        $month = date('Y-').$month;
      $sum=0;
      $sql = DB::select("SELECT * FROM unstock WHERE pid = '$pid' AND bid = '$bid' ");  
      foreach($sql as $row){ $trd = substr($row->created, 0,7);
      if($month == $trd){$sum += $row->amount; }
      }
      $sum = ($sum>0) ? '₦'.number_format($sum) : 0;
      return $sum;
      }
      
      
      
      
      
          function itemName($pid,$col='item'){
        $bid = $this->bid();
          
        $sql = $this->sqSb('stock','id',$pid,'bid',$bid);
         foreach($sql as $row){
            return $row->$col;
          }
        }

        function sqSb($a,$b,$c,$d,$e){
            return DB::select("SELECT * FROM $a WHERE $b = '$c' AND $d = '$e' ");
        }


        function sqSb1($a,$b,$c,$d,$e,$f,$g){
          return DB::table($a)->where($b,$c)->where($d,$e)->where($f,$g)->paginate(100);
          //return DB::select("SELECT * FROM $a WHERE $b = '$c' AND $d = '$e' AND $f='$g' ");
      }

      function lsql($a,$b,$c,$d,$e,$f,$g,$h,$i){
        return DB::table($a)->where($b,$c)->where($d,$e)->where($f,$g)->where($h,$i)->paginate(100);
        //return DB::select("SELECT * FROM $a WHERE $b = '$c' AND $d = '$e' AND $f='$g' AND $h='$i' ");
    }


         function itemTrn(){
  global $db;
  $bid = $this->Bid();
    $pid = $this->Pid();
  $query=DB::select("select * FROM transact WHERE pid='$pid' AND bid='$bid' " );
            $num=count($query);

            return $num;
          }


  function itemBigSale($opt='salesid'){
  $bid = $this->Bid();
    $pid = $this->Pid();
  $query=DB::select("select * FROM transact WHERE pid='$pid' AND bid='$bid' ORDER BY amount DESC LIMIT 1" );
  foreach($query as $row){
    return $row->$opt;
  }
          }


function itemLastSold($opt='salesid'){
  $bid = $this->Bid();
    $pid = $this->Pid();
  $query=DB::select("select * FROM transact WHERE pid='$pid' AND bid='$bid' ORDER BY id DESC LIMIT 1" );
  foreach($query as $row){
    return $row->$opt;
  }
}


 function itemFirstSold($opt='salesid'){
  $bid = $this->Bid();
    $pid = $this->Pid();
  $query=DB::select("select * FROM transact WHERE pid='$pid' AND bid='$bid' ORDER BY id ASC LIMIT 1" );
  foreach($query as $row){
    return $row->$opt;
  }
}
 


function pin($col='item'){
	$sn = session()->get('pid');
	$sql = DB::select("SELECT * FROM stock WHERE id = $sn ");
	foreach($sql as $row){
        return $row->$col;
      }
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

    
  function vName($vid,$col='name'){      
    $sql = $this->sqSa('supply','id',$vid);
    foreach($sql as $row){
      return $row->$col;
    }
      }


      public function sqLx($table,$col,$val,$l){
        $sql = DB::select("SELECT * FROM $table where $col='$val' ");
        foreach ($sql as $row) {
          return $row->$l;
        }
      }


    function cName2($cid,$col=''){
      $bid = $this->bid();
        
      $sql = DB::select("SELECT * FROM students WHERE bid='$bid' AND uid='$cid' ");
      foreach ($sql as $row) {
        $name = !empty($col) ? $row->$col : $row->surname . ' ' . $row->firstname . ' ' . $row->midname;
        return $name;
      }
    }

    function allpay($uid,$sess,$term,$fee)
    {
      $bid = $this->bid(); $amt = 0;
      $sql = DB::select("SELECT * FROM payfees WHERE bid='$bid' AND uid='$uid' AND sess='$sess' AND term='$term' AND note='$fee' ");
      foreach($sql as $row){
        $amt += $row->amount;
      }
      return $amt;
    }

      
}
