<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Feecat;
use App\Models\Classe;
use App\Models\Fee;

class FeeController extends Controller
{
  public function index()
  {   $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
      $fee = Feecat::where('bid',$this->bid())->orderby('id','DESC')->get();
      $class = Classe::where('bid',$this->bid())->orderby('class','ASC')->get();
      $allfee = Feecat::where('bid',$this->bid())->orderby('id','DESC')->get();

      foreach ($allfee as $afee) { $id = $afee->id;
        //calculating the $students that a fee is assigned to
        $student=0;   $discount = $this->calFee($id,'discount'); $amount = $this->calFee($id,'amount'); $total = $amount-$discount;
        $stud = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND fee='$id' AND active=1 ");
        foreach ($stud as $a) { if($a->amount != $a->discount){$student += 1; }   }
        $myarray[] = ['fee'=>$afee->fee,'student'=>$student,'amount'=>$amount,'discount'=>$discount,'total'=>$total,'range'=>$this->feeRange($id),];
        
      }

      if(session()->has('class')){

        $cl = session()->get('class'); $fe = session()->get('fee'); $term = $this->term('term'); $sess = $this->term('sess');

        if($cl == 'all'){
         // $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND fee='$fe' AND term='$term' AND sess='$sess' ORDER BY id ASC ");
          $sql = DB::table('fee')->where('bid',$bid)->where('fee',$fe)->where('term',$term)->where('sess',$sess)->paginate(100);
        }
        else{
          //$sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND class='$cl' AND fee='$fe' AND term='$term' AND sess='$sess' ORDER BY id ASC ");
          $sql = DB::table('fee')->where('bid',$bid)->where('class',$cl)->where('fee',$fe)->where('term',$term)->where('sess',$sess)->paginate(100);
        }
        foreach ($sql as $key) {
          $name[] = ''.$this->sqLx('students','uid',$key->uid,'surname').' '.$this->sqLx('students','uid',$key->uid,'firstname').'' ;
        }

        //$sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND class='1' AND fee='$fe' AND term='$term' AND sess='$sess' ORDER BY id ASC ");

        return view('other.setfees2',['fees'=>$fee,'class'=>$class,'students'=>$sql,'myfee'=>$myarray,'name'=>$name]);
      }
      
      if(count($allfee)==0){$myarray[] = ['fee'=>0 ,'student'=>'','amount'=>0,'discount'=>0,'total'=>0,'range'=>''];}
      return view('other.setfees2',['fees'=>$fee,'class'=>$class,'myfee'=>$myarray]);
  }

  public function addfeecat(Request $request)
  {
    $bid = $this->bid();
    $validate = Validator::make($request->all(), [
      'feecategory' => 'required',
      'categorydescription' => 'required',
    ])->validate();

    Feecat::create([
      'fee' => $request['feecategory'],
      'des' => $request['categorydescription'],
      'rep' => auth()->user()->sid,
      'bid' => $bid,
    ]);
    return redirect('setfee')->with('success','Fee category Sucessfully added');
  }

  public function setfee($id,$class,$fee,$feecost)
  {
    $term = $this->term('term');  $sess = $this->term('sess');  $tan=time(); $bid = $this->bid(); $rep = auth()->user()->sid;

    // 	$che = DB::select("SELECT * FROM fee WHERE bid='75611193' AND class='1' AND fee='1' AND term='3' AND sess='2019/2020' AND uid='bflobktpr3' "); return response(count($che));

  	$sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND class='$class' AND fee='$fee' AND term='$term' AND sess='$sess' AND uid='$id' ");
    //if(count($sql)>0){return response('greater than 0'); }else{return response('less than 0');}
  	if(count($sql)==0){
    Fee::create([
      'uid' => $id,
      'term' => $term,
      'sess' => $sess,
      'class' => $class,
      'fee' => $fee,
      'amount' => $feecost,
      'bid' => $bid,
      'rep' => $rep,
      'tan' => $tan,
    ]);
  	}

  }

  public function addfee(Request $request)
  {
    $bid = $this->bid(); $fee  = $request['fee']; $class  = $request['class']; $feecost  = str_replace(",", "", trim($request['feecost']));
    //$rep = auth()->user()->sid;
    //sessioning form inputs
    session()->put('fee',$fee);
    session()->put('class',$class);
    session()->put('feecost',$feecost);
    //validating form inputs
    $validate = Validator::make($request->all(), [
      'fee' => 'required',
      'class' => 'required',
      'feecost' => 'required',
    ])->validate();
    //checking for what the selected class and fetching student information
    if($class == 'all'){
      $sql = DB::select("SELECT * FROM students where bid='$bid' order by surname ");
    }else{
      $sql = DB::select("SELECT * FROM students where bid='$bid' AND class='$class' order by surname ");
    }
    //pidking the current term and session
    //return response($feecost);
    $term = $this->term('term');
    $sess = $this->term('sess');
    //inserting the fee into the fee table for each of the student in the selected class
    foreach ($sql as $key) {
      $this->setfee($key->uid,$key->class,$fee,$feecost);
    }
    //checking if the class has student and returnng the success and error message
    if(count($sql) < 1){ return redirect('setfee')->with('error','This class is empty, Confrim and try again'); }else{
      $log = 'You can now proceed to adjust '.$this->sqLx('feecat','id',$fee,'fee').' for the following '.count($sql).' student(s)';
      //adding log
      $this->addlog($log,1);
      return back()->with('success',$log);
    }

  }

  public function adjustfee(Request $request)
  {
    $bid = $this->bid();  $fee =  session()->get('fee');  $class = session()->get('class'); $term = $this->term('term');   $sess = $this->term('sess'); $rep = auth()->user()->sid;
    //checking for what the selected class and fetching student information
    if($class == 'all'){
      //$sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND fee='$fee' AND term='$term' AND sess='$sess' ORDER BY id ASC ");
      $sql = DB::table('fee')->where('bid',$bid)->where('fee',$fee)->where('term',$term)->where('sess',$sess)->paginate(100);
    }else{
      //$sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND class='$class' AND fee='$fee' AND term='$term' AND sess='$sess' ORDER BY id ASC ");
      $sql = DB::table('fee')->where('bid',$bid)->where('class',$class)->where('fee',$fee)->where('term',$term)->where('sess',$sess)->paginate(100);
    }
    $e = 0;
    foreach ($sql as $key) { $e++;
      $id=$_POST['sn'.$e];
      $ca = str_replace(",", "", trim($request['ca'.$e])) ;
      $cb = str_replace(",", "", trim($request['cb'.$e]));
      $ca = ($ca == '')?0:$ca;
      $cb = ($cb == '')?0:$cb;

      if($ca < $cb){ continue; }

      $fee = Fee::find($id);
      $fee->amount = $ca;
      $fee->discount = $cb;
      $fee->rep = $rep;
      $fee->save();

    }
    //checking if the class has student and returnng the success and error message
      $log = 'Fee Modifided for '.count($sql).' student(s)'; $this->addlog($log,1);
      //adding log
      return back()->with('success',$log);
  }

  public function feeRange($sn)
  {
    $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
    $small=0;  $big=0;
    $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND fee='$sn' AND active=1 AND amount != 0 ORDER BY amount ASC LIMIT 1 ");
    foreach ($sql as $key) { $small = $key->amount;  }
    $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND fee='$sn' AND active=1 AND amount != 0 ORDER BY amount DESC LIMIT 1 ");
    foreach ($sql as $key) { $big = $key->amount;  }
    return number_format($small).' - '.number_format($big);
  }

  public function payindex()
  {
    $class = Classe::where('bid',$this->bid())->orderby('class','ASC')->get();
    return view('other.paymentprofile',['class'=>$class]);
  }

  function student($class){
    $bid = $this->bid();
    $sql = Student::where('bid',$bid)->where('class',$class)->orderby('surname','ASC')->paginate(150);
    return $sql;

  }

  function class($class){

  }

  public function showClassPayment($class){
    $term = $this->term('term');
    $sess = $this->term('sess');
    $bid = $this->bid();
    $table = '';
    $i=1;
    $sql = Student::where('bid',$bid)->where('class',$class)->orderby('surname','ASC')->paginate(150);
    //$sql = DB::select("SELECT * FROM student WHERE bid='$bid' AND class='$class' ORDER BY surname ASC ");
$sta = new ProfileController;
        $table .='<div class="table-responsive"> <table  class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>SN</th>
                                        <th>Student</th>
                                        <th>Class</th>
                                         <th>Current Fees(₦)</th>
                                         <th>Balance Brought Forward(₦)</th>
                                         <th>Total Expected Payment(₦)</th>
                                         <th>Received Payment(₦)</th>
                                         <th>Balance(₦)</th>
                                         <th>Remark</th>

                                  </tr>
                                </thead>
                                <tbody>';
        $expectedfee =0; $bbf=0; $balance=0;$currentfee=0;$receivedpayment=0;$percentage = 0;$percs = 0;
        foreach($sql as $row){ $e=$i++; $id = $row->uid;  $class2 = $row->class;
            $expected = $this->totalDebt($id)+$this->currentFee($id);
            $exp = ($expected==0)?1:$expected;
            $expectedfee = $exp+$expectedfee;
            $bbf +=$this->totalDebt($id);
            $balance +=$expected - $this->termPaid($id,$term,$sess);
            $receivedpayment +=$this->termPaid($id,$term,$sess);
            $currentfee +=$this->currentFee($id);
            $perc = (($this->termPaid($id,$term,$sess))/$exp)*100;
            //$percentage += $perc;
            $percs = ($receivedpayment/$expectedfee)*100;
            $table .= '<tr class="odd gradeX">
                         <td>'.$e.'</td>
                        <td><a href="?fee='.sha1($row->id).'">'.$this->cName($row->id).'</a></td>
                        <td>'.$sta->class($class2).'</td>
                         <td>'.number_format($this->currentFee($id)).'</td>
                         <td>'.number_format($this->totalDebt($id)).'</td>
                         <td>'.number_format($expected).'</td>
                         <td>'.number_format($this->termPaid($id,$term,$sess)).'</td>

                         <td>'.number_format($expected - $this->termPaid($id,$term,$sess)).'</td>
                         <td>'.(int)$perc.'%</td></tr>';
        }


$table .= '<tr class="odd gradeX" >
        <th colspan="3">sub-total</th>
        <th>'.number_format($currentfee).'</th>
        <th>'.number_format($bbf).'</th>
        <th>'.number_format($expectedfee).'</th>
        <th>'.number_format($receivedpayment).'</th>
        <th>'.number_format($balance).'</th>
        <th>'.(int)$percs.'%</th>
        </tr></tbody></table>
        ';
    return $table;
}




}
