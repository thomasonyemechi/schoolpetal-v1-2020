<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use App\Models\Feecat;
use App\Models\Smssetup;
use App\Models\Cbt\Result3;
use App\Models\Userhour;
use App\Models\Bookcat;

$db = new DB;

use App\Models\Log;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function __construct()
  {
    //$this->tolock();
    //$this->lockUserH();
    return;
  }

  public function bookcat($sn){
    //Bookcat::find($sn)->id;
    // $sql = DB::select(" SELECT * FROM bookcat WHERE id=$sn ");
    // foreach($sql as $row){
    //   return $row->category;
    // }
    return Bookcat::find($sn)->category;
  }

  function binfo($col='name'){
    $bid = $this->bid();
    $sql = DB::select(" SELECT * FROM schools WHERE bid='$bid' ");
    foreach($sql as $row){
      return $row->$col;
    }
  }


  public function aggregate2($uid, $class,$term, $sess,$col=''){
    $bid = $this->bid();
    $sum = 0;
    $num=0;
    $sql = DB::select("SELECT subject, total FROM result WHERE uid='$uid' AND class='$class' AND term='$term' AND sess='$sess' AND bid='$bid' ORDER BY subject");

    foreach($sql as $row){
        $sum += $row->total;
        $num = ($row->total==0)?$num +=0:$num +=1;
    }
    $result = ($col=='')?$num:$sum;
    return $result;
}

  function calcSub($id,$term,$sess,$class){
    $bid = $this->bid();
    // DB::table('result')->where('uid',$id)->where('class',$class)->where('term',$term)->where('sess',$sess)->where('bid',$bid)->get();
    $sql = DB::select("SELECT * FROM result WHERE uid='$id' AND class='$class' AND term='$term' AND sess='$sess' AND bid='$bid'");
    $num = count($sql);//->num_rows;
    return $num;
  }

  function currentFee($id){
    $term = $this->term('term');
    $sess = $this->term('sess');
    $bid = $this->bid();
    //$class = $_SESSION['class'];
    $total=0;
    $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND uid ='$id' AND active=1 ");
    foreach($sql as $row){
        $total +=$row->amount-$row->discount;
    }

    return $total;
}


  function termPaid($id,$term,$sess){
    $bid = $this->bid();
    $sum = 0;
    $sql = DB::select("SELECT * FROM payfees WHERE bid='$bid' AND uid='$id' AND term='$term' AND sess='$sess'");
    foreach($sql as $row){
      $sum += $row->amount;
    }
    return $sum;
  }

  function totalDebt($id){
      $bid = $this->bid();
      $termindex = $this->term('termindex');
      $sum = 0;
      $sql = DB::select("SELECT * FROM term WHERE bid='$bid' AND termindex < '$termindex'");
      foreach($sql as $row){
          $sum += $this->termExpected($id,$row->term,$row->sess) - $this->termPaid($id,$row->term,$row->sess);
      }
      return $sum;
  }


  function termExpected($id,$term,$sess){
    $bid = $this->bid();
    $sum = 0;
    $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND uid='$id' AND term='$term' AND sess='$sess'");
    foreach($sql as $row){
        $sum += $row->amount - $row->discount;
    }
    return $sum;
  }



  function time($t){
    return $t/60;
  }

  public function lockUserH(){
    if(!session()->has('userid')){
     $rep = $this->uid();
      exit();
      $now = Userhour::where('uid',$this->uid())->get();
      $now = DB::select("SELECT * FROM userhours WHERE uid = '$rep' ");
      print_r(auth()->user()->id); exit();

    
    }
      
  }
  public function sinfo($id,$col){
    $bid = $this->bid();
    $student = DB::table('students')->where('uid',$id)->where('bid',$bid)->get();
    foreach($student as $ro){
      $pid = $ro->parent;
      $parent = DB::table('parent')->where('uid',$pid)->where('bid',$bid)->get();
      foreach($parent as $row){
        return  $row->$col;
      }
    }
  }

  public function tolock(){
    // print_r(auth()->user()->id); exit();
    // foreach($now as $row){
    
    //   $x = 'a'.date('N');
    //   $y = 'b'.date('N');
    //   $z = date('h:i A'); //current Time
    //   $m = (strtotime($row->$x)<=strtotime($z) AND strtotime($row->$y)>=strtotime($z))?2:3;
      
    //   if($m==3 AND auth()->user()->level == 10){ 
    //     session()->flush();
    //     return redirect('login')->with('error', 'You are out of working hours');
    //   }
    // }
  }

  function sms($message,$receiver,$type){
    $in = Smssetup::where('bid',$this->bid())->get();
    foreach($in as $key){
      if($type == 1){
        //send the message
      }
    }
  }

  function sms2($message,$receiver){
    $in = Smssetup::where('bid',$this->bid())->get();
    foreach($in as $key){
      //send the message
    }
  }

  function school($col='name'){
    $bid = $this->bid();
    $sql = DB::select("SELECT * FROM schools WHERE bid='$bid' ");
    foreach($sql as $row){
      return $row->$col;
    }
  }


  function fetchresult($subject, $term, $sess, $type){
    $bid = $this->bid();
    //$al = Result3::where('subject',$subject)->where('term',$term)->where('sess',$sess)->where('type',$type)->where('bid',$bid)->paginate(100);
    $al = DB::table('result3')->where('subject',$subject)->where('term',$term)->where('sess',$sess)->where('type',$type)->where('bid',$this->bid())->paginate(100);
    return $al;
  }

  function fetchresult2($subject, $term, $sess, $type,$id){
    $bid = $this->bid();
    //$al = Result3::where('subject',$subject)->where('term',$term)->where('sess',$sess)->where('type',$type)->where('bid',$bid)->paginate(100);
    $al = DB::table('result3')->where('subject',$subject)->where('term',$term)->where('sess',$sess)->where('type',$type)->where('id',$id)->where('bid',$this->bid())->get();
  
    return $al;
  }

 
  function bid(){
    $bid = (session()->has('student_idx'))?$this->sbid():auth()->user()->bid;
    return $bid;
  }


  function sbid($col='bid'){
    $uid = session()->get('student_idx');
    $sql = DB::table('students')->where('uid',$uid)->get();
    foreach($sql as $row){
      return $row->$col;
    }
  }

  function fee($fee){
    //$f = DB::table('feecat')->where('id',$fee);
    $f = Feecat::find($fee);
    return $f->fee;
  }

  function sdata($col='')
  {
    $id = session()->get('student_idx');
    $sql = DB::table('studentdata')->where('uid',$id)->where('bid',$this->bid())->get();
    foreach($sql as $row){
      return $row->$col;
    }
  }

  function Pid(){
    $pid = (session()->has('pid'))?session()->get('pid'):'';
    return $pid;
  }

  function uid(){
    $id = (session()->has('student_idx'))?session()->get('student_idx'):auth()->user()->sid;
    return $id;
  }

  function win_hash($length)
  {
    return substr(str_shuffle(str_repeat('123456789', $length)), 0, $length);
  }

  function win_hashs($length)
  {
    return substr(str_shuffle(str_repeat('123456789abcdefghijklmnopqrstuvwxyz', $length)), 0, $length);
  }

  function win_hashss($length)
  {
    return substr(str_shuffle(str_repeat('123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', $length)), 0, $length);
  }

  public function addlog($log,$count){
    Log::create([
     'log' => $log,
     'count' => $count,
     'bid' => $this->bid(),
     'rep' => $this->uid(),
   ]);
  }
  public function sqLx($table,$col,$val,$l){
    $sql = DB::select("SELECT * FROM $table where $col='$val' ");
    foreach ($sql as $row) {
      return $row->$l;
    }
  }

  public function term($col){
    $bid  = $this->bid();
    $sql = DB::select("SELECT * FROM term where bid='$bid' AND active=1 ");
    foreach ($sql as $row) {
      return $row->$col;
    }
  }

  public function calFee($sn,$col)
  {
    $term = $this->term('term');
    $sess = $this->term('sess');
    $bid = $this->bid();
    $amount=0;
    $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND fee='$sn' AND active=1 ");
    foreach($sql as $row){ $amount += $row->$col; }
    return $amount;
  }

  public function termname($sn)
  {
    if($sn == 1){ $name = 'first';}
    elseif($sn == 2){$name = 'second';}
    elseif($sn == 3){$name = 'third';}
    return $name;
  }

  public function booksize($size){
    if($size <= 2048576) {
        return true;
    }
    else {
        return false;
    }
  }

  public function imagesize($size){
    if($size <= 1048576) {
        return true;
    }
    else {
        return false;
    }
  }

  function simg($col){
    $bid = $this->bid();
    $sql = DB::select("SELECT * FROM users WHERE bid ='$bid' and level = 10 ");
    foreach($sql as $row){
      return $row->$col;
    }
  }

  function cName($cid,$col=''){
    $bid = $this->bid();
      
    $sql = DB::select("SELECT * FROM students WHERE bid='$bid' AND id='$cid' ");
    foreach ($sql as $row) {
      $name = !empty($col) ? $row->$col : $row->surname . ' ' . $row->firstname . ' ' . $row->midname;
      return $name;
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

  function className($id,$col=''){
    $bid = $this->bid();

    $sql = DB::select("SELECT * FROM class WHERE id='$id'AND bid='$bid'");
    foreach ($sql as $row) {
      $result = !empty($col)?$row->$col:$row->class;
      return $result;
    }
    
  }


  // $affected = DB::table('users')
  // ->where('id', 1)
  // ->update(['options->enabled' => true]);

  function imagetype($ext){
    $array = array('jpg','jpeg','png');
    if(in_array($ext,$array)) {
        return true;
    }
    else {
        return false;
    }
  }


  function booktype($ext){
    $array = array('pdf','PDF');
    if(in_array($ext,$array)) {
        return true;
    }
    else {
        return false;
    }
  }

  // get the value of a column in an array 

  public  function  get_qty($array) {

    foreach ($array as $column)     {
        $qty =  $column->qty;
        return  $qty;
    }    

  } 


  function vid(){
    $vid = (session()->has('vendor'))?session()->get('vendor'):'';
    return $vid;
  }
    

    



  //get the value of a column in an array
  public  function  get_item($array) {

    foreach ($array as $column)     {
      $item =  $column->item;
      return  $item;
    }    
  }    

  function pin($col='item')
  {
    $bid = $this->bid();
    $pin = session()->get('pid');
    $sql = $this->sqsb('stock', 'id', $pin, 'bid', $bid);
    return $sql->$col ?? '';  //this will return the value of item column in the stocks table...
  }

  function sqsb($table, $sn, $pin, $bid, $bidd){
    $sqlquery = DB::select("SELECT * FROM $table WHERE $sn='$pin' AND $bid ='$bidd' ");
    //return mysqli_fetch_array($sqlquery);
    foreach($sqlquery as $row){
      return $row; //supposed to return the whole arraydata...
    }
    return; 
  }

	function sqSumb($a,$b,$c,$d,$e,$col){
		    $sum=0; 	
$sql = $this->sqSb($a,$b,$c,$d,$e);

@$sum += $sql->$col;
 // echo $sum; exit();
  

return $sum;
  }

  function itemQtyx($pid){
    $bid = $this->bid();
    $sum1 = $this->sqSumb('stockup','pid',$pid,'bid',$bid,'qty');//stocking item
    $sum2 = $this->sqSumb('transact','pid',$pid,'bid',$bid,'qty');//dispensary
    $sum3 = $this->sqSumb('unstock','pid',$pid,'bid',$bid,'qty');//unstocking
    //$sum4 = sqSumb('returnx','pid',$pid,'bid',$bid,'qty');//return
    return $sum1-$sum2-$sum3;
    }

  
function vName($vid,$col='name'){
  $bid = $this->bid();
    $sql = $this->sqsb('supply', 'id', $vid, 'bid', $bid);
    return $sql->$col ?? '';
    }







    
}

