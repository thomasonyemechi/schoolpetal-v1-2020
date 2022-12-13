<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Staffdata;
use App\Models\Setsubject;
use App\Models\SetPayment;
use App\Models\Power;

class StaffController extends Controller
{
  public function index()
  {
    $bid = auth()->user()->bid;
      $sql = DB::select("SELECT * FROM users WHERE bid='$bid' AND level < 10 LIMIT 100 ");
      return view('other.addstaff',['users'=>$sql]);
  }
  public function index2()
  {
    $bid = $this->bid();
      $sql = DB::select("SELECT * FROM users WHERE bid='$bid' AND level between 5 and 9 ORDER BY name ");
      $cuser = User::find(auth()->user()->id);
      if(session()->has('staffid')){
        $user = user::find(session()->get('staffid'));
        $class = DB::select("SELECT * FROM class WHERE bid='$bid' order by class ");
        $subject = DB::select("SELECT * FROM subject WHERE bid='$bid' order by subject ");
        //return response($user->sid);
          $mysubject = DB::select("SELECT * FROM setsubject WHERE uid='$user->sid' ");
          foreach($mysubject as $ms){
            $msubject[] =  ['id'=>$ms->id,'sid' =>$this->sqLx('subject','id',$ms->sid,'subject'),'classid'=>$this->sqLx('class','id',$ms->classid,'class'),];
          }
          if(count($mysubject)==0){
            $msubject[] =  ['id'=>'','sid' =>'','classid'=>''];
          } 
           
          $earning = $this->ed($user->sid,'1');
          $deduction = $this->ed($user->sid, '0');
          return view('other.staffprofile',['staffs'=>$sql,'user'=>$user,'classes'=>$class,'mysubject'=>$mysubject,'subjects'=>$subject,'earning'=>$earning,'deduction'=>$deduction,'cuser'=>$cuser,'ms'=>$msubject]);

      }else{
        $mysubject = DB::select("SELECT * FROM setsubject WHERE uid='$cuser->sid' ");
        foreach($mysubject as $ms){
          $msubject[] =  ['sid' =>$this->sqLx('subject','id',$ms->sid,'subject'),'classid'=>$this->sqLx('class','id',$ms->classid,'class'),];
        }
        if(count($mysubject)==0){
          $msubject[] =  ['sid' =>' ','classid'=>' '];
        }
        //return response($msubject['sid']);
        $earning = $this->ed($cuser->sid,'1');
        $deduction = $this->ed($cuser->sid, '0');
        return view('other.staffprofile',['staffs'=>$sql,'cuser'=>$cuser,'earning'=>$earning,'deduction'=>$deduction,'ms'=>$msubject]);
      }
  }

  public function getstaff(Request $request)
  {
    $user = User::find($request['staff']);
    $request->session()->put('user',$user);
    $request->session()->put('staffid',$request['staff']);
    return redirect('staffprofile')->with('success', 'Search for '.$user->name);
  }

  public function addstaff(Request $request)
  {
    // $bid = $this->bid();
    //validating form inputs 
    $email = $request['email']; $sid = $this->win_hashs(10);
    $validate = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'phone' => 'required|max:15',
      'address' => 'required|string|max:255',
      'gender' => 'required',
    ])->validate();

    //creating the Category
    User::create([
     'name' => $request['name'],
     'email' => $request['email'],
     'phone' => $request['phone'],
     'address' => $request['address'],
     'level' => 0,
     'sex' => $request['gender'],
     'rep' => $this->uid(),
     'bid' => $this->bid(),
     'sid' => $sid,
     'password' => Hash::make(12345678),
   ]);

   Power::create([
    'uid' => $sid,
     'bid' => $this->bid(),
   ]);

   $ck = DB::select("SELECT * FROM users WHERE email='$email' ");
   foreach ($ck as $k) {
     Staffdata::create([
       'id' => $k->id,
       'bid' => $this->bid()
     ]);
   }

   $log = 'Staff Profile Created Sucessfully '.$request['name'];
   //adding logs
   $this->addlog($log,1);
   return redirect('staffs')->with('success', $log);
  }

  public function setsubject(Request $request, $id)
  {
      $bid = $this->bid(); $sub = $request['subject']; $cla = $request['class']; $uid = User::find($id)->sid;
      $validate = Validator::make($request->all(), [
        'subject' => 'required',
        'class' => 'required',
      ])->validate();

      $sql = DB::select("SELECT * FROM setsubject WHERE bid='$bid' AND sid='$sub' AND classid='$cla' AND uid='$uid' ");
      if(count($sql)>0){
        foreach($sql as $sl){$log = 'Subject cannot be set to a user twice'; $this->addlog($log,2); } ;
        return redirect('staffprofile')->with('error', $log);
      }

      Setsubject::create([
       'uid' => $uid,
       'sid' => $request['subject'],
       'classid' => $request['class'],
       'bid' => $bid,
     ]);

      $log = 'Subject set sucessfully';
     $this->addlog($log,1);
     return redirect('staffprofile')->with('success', $log);
  }

  public function paymentdetail(Request $request)
  {
    $validate = Validator::make($request->all(), [
      'month' => 'required',
      'year' => 'required',
    ])->validate();
   //  $log = 'Subject set sucessfully';
   // $this->addlog($log,1);
   return redirect('staffprofile');
  }


  public function addpayment(Request $request)
  { 
    $bid = $this->bid();  $month = $request['month'];  $year = $request['year']; $amount = str_replace(",", "", trim($request['amount']));
    $validate = Validator::make($request->all(), [
      'month' => 'required',
      'year' => 'required',
    ])->validate();
    
    session()->put('month', $month); session()->put('year', $year); 

    SetPayment::create([
      'uid' => $request['id'],
      'amount' => $amount,
      'title' => $request['title'],
      'type' => $request['type'],
      'month' => $request['month'],
      'year' => $request['year'],
      'bid' => $this->bid(),
      'rep' => auth()->user()->sid,
    ]);

   return redirect('staffprofile')->with('success','Payment Addded Sucessfully');
  }

  public function getmy(Request $request)
  {
    $month = $request['month'];  $year = $request['year'];
    session()->put('month1', $month); session()->put('year1', $year); 
    return redirect('staffprofile');
  }

  public function ed($sid, $type)
  {
    $bid = $this->bid();
    $y = session()->has('year1')?session()->get('year1'):date("Y"); $m = session()->has('month1')?session()->get('month1'):date("m");
    return DB::select("SELECT * FROM setpayment WHERE uid='$sid' AND type=$type AND bid='$bid' AND month='$m' AND  year='$y'");
  }


  public function deletesubject2(Request $request)
  {
    $bid = $this->bid();
    $id = $request['id'];
    DB::delete("DELETE FROM setsubject where id = $id ");
    return redirect('staffprofile')->with('success','Subject Deleted');
  }

  public function deactivatestaff(Request $request)
  {
    $bid = $this->bid();
    $id = $request['id'];
    DB::update("UPDATE users SET act=0 WHERE id=$id ");
    session()->put('user', User::find($id));
    return redirect('staffprofile')->with('success','Deactivated Sucessfully');
  }
  public function activatestaff(Request $request)
  {
    $bid = $this->bid();
    $id = $request['id'];
    DB::update("UPDATE users SET act=1 WHERE id=$id ");
    session()->put('user', User::find($id));
    return redirect('staffprofile')->with('success','Activated Sucessfully');
  }


  public function updatestaff(Request $request)
  { 
    $id = $request['id'];

    $validate = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'phone' => 'required|max:15',
      'address' => 'required|string|max:255',
      'sex' => 'required',
    ])->validate();


    DB::table('users')
    ->updateOrInsert(
        ['id' => $id],
        [
          
          //'email'=>$request['myemail'], 
          'phone' => $request['myphone'],
          'name' => $request['name'],
          'address' => $request['address'],
        ],
    );


    DB::table('staffdata')
    ->updateOrInsert(
        ['id' => $id],
        [
          
          'email'=>$request['email'], 
          'phone' => $request['phone'],
          'address' => $request['address'],
          'pname'=>$request['pname'], 
          'phone2' => $request['phone2'],
          'dob' => $request['dob'],
          'birthplace'=>$request['birthplace'], 
          'state' => $request['state'],
          'other' => $request['other'],
          'rep'=>$this->uid() , 
          'lga' => $request['lga'],
          'bloodgr' => $request['bloodgr'],
          'genotype' => $request['genotype'],
          'ailment'=>$request['ailment'], 
          'disability' => $request['disability'],
          'occupation' => $request['occupation'],
          'occupation2'=>$request['occupation2'], 
          'officeadd' => $request['officeadd'],
          'officeadd2' => $request['officeadd2'],
          'mname' => $request['mname'],
          'mphone' => $request['phone2'],
          'email2' => $request['email2'],
          'bid' => $this->bid(),
          'address' => $request['address'],
          'other' => $request['other'],
        ],
    );
    session()->put('user', User::find($id));
    return redirect('staffprofile')->with('success','Update Sucessfully');
  }


}
