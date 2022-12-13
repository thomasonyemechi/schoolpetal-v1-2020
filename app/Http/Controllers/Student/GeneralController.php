<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Cbt\Exam;
use App\Models\course\Course;
use App\Models\course\Module;
use App\Models\Cbt\Question;
use App\Models\Cbt\Result2;
use App\Models\Cbt\Result3;
use App\Models\Cbt\Type;
use App\Models\Term;
use App\Models\Setsubject;
use App\Models\User;
use App\Models\Staffdata;
use App\Models\SetPayment;
use App\Models\Power;
use App\Models\Userhour;

class GeneralController extends Controller
{


    function test(Request $request){
        return response($request);
    }

    public function adderuser(Request $request)
    {
      // $bid = $this->bid();
      //validating form inputs 
      $email = $request['email']; $sid = $this->win_hashs(10);
      //return response($request);
     // exit();
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

    Userhour::create([
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

    

    function atuofillresult(Request $request){
        $bid = $this->bid();
        $class = $request['class'];
        $student = DB::select("SELECT * FROM students WHERE class=$class AND bid='$bid' ");
        $sub = DB::select("SELECT * FROM exam WHERE bid=$bid AND class=$class ");
       if(count($sub)>0){
        foreach ($sub as $key) { $subject[] = $key->sn; }
        foreach($student as $me){
            $t1 = time();
            $esn = $subject[rand(0,count($subject)-1)];
            $tcode = $this->win_hash(10);
            $id = $me->uid;
            Result3::create([
                'id'=>$id,
                'type' => $this->esnme($esn,'examtype'),
                'esn' => $esn,
                'subject' => $this->esnme($esn,'subject'),
                'tcode' => $tcode,
                'ctime' => $t1,
                'term' => $this->term('term'),        
                'sess' => $this->term('sess'),
                'bid' => $this->bid(),
                      
            ]);
            $t = $t1+3600;
            $total = rand(0,100);
            DB::update("UPDATE result3 SET total=$total, ctime2 = $t  WHERE tcode = $tcode AND id='$id' AND esn=$esn "); 
        }
       }
        
        
        return response('done');
    }


    function esnme($esn,$col){
        return Exam::find($esn)->$col;
    }

    function allresult(){
        //$term = $this->term('term'); $sess = $this->term('sess');
        $class = (session()->has('classres'))?session()->get('classres'):'';
        $bid = $this->bid();
        $t = Type::where('bid',$bid)->get();
        
        // foreach ($t as $row) {
        //     $sql[] = $this->fetchresult($subject,$term,$sess,$row->sn);
        // }

        $mysub = Setsubject::where('uid', $this->uid())->get();


        $students = Student::where('bid',$bid)->where('class',$class)->paginate(100);
        //return response($sql);
        //$msub = ['id'=>'', 'class'=>''];
        foreach($mysub as $ms){
            $msub[] = [
                'id'=>$ms->id,
                'class' => ''.ucwords($this->sqLx('subject','id',$ms->sid,'subject')).'  '.$this->sqLx('class','id',$ms->classid,'class').'', 
            ];
        }
        //return response()
        return view('student.studentresult',['type'=>$t,'students'=>$students,'mysub'=>$msub]);
    }

    function pickresult(Request $request){
        $rid = $request['result']; //session()->put('resultid',$rid);
        $rinfo = Setsubject::find($rid);
        $class = $rinfo->classid;
        $subject = $rinfo->sid;
        session()->put('classres',$class);
        session()->put('subjectres',$subject);
        return back();
    }



    function saveanswer(Request $request){
        $esn = session()->get('esn'); $bid = $this->bid(); $tcode = session()->get('tcode');
        $question = Question::where('esn',$esn)->where('bid',$bid)->where('status',1)->limit(25)->get();
        $e = 0; $tp = Exam::find($esn)->examtype; $id = $this->uid();
        $term = $this->term('term'); $sess = $this->term('sess');

        foreach ($question as $row) { $e++;
            $qn = $request['qn'.$e];
            $opt = $request['custom'.$e];
            $ans = $this->ans($esn,$qn);
            $score = ($ans == $opt)?1:0;
            Result2::create([
                'id'=> $id,
                'type' => $tp,
                'qn' => $qn,
                'tcode'=> $tcode,
                'esn'=> $esn,
                'score' => $score,
                'myoption' => $opt,
            ]);

            $total = $this->total($tcode,$id);
            $t  = time();

            DB::update("UPDATE result3 SET total=$total, ctime2 = $t  WHERE tcode = $tcode AND id='$id' AND esn=$esn "); 
            session()->forget('tcode');        

        }

        return redirect('afterexam');
    }

    function total($tcode, $id){
        $al = Result2::where('tcode',$tcode)->where('id',$id)->get();
        $s = 0;
        foreach($al as $rw){
            $s += $rw->score;
        }
        return $s;
    }

    function ans($esn,$qn){
        $sql = Question::where('esn',$esn)->where('qn',$qn)->get();
        foreach($sql as $row){
            return $row->ca;
        }
    }

    function trig(Request $request){
        $bid = $this->bid();
        $ex  = Exam::where('bid',$bid)->get();
        foreach($ex as $es){ $in[] = $es->sn; }
        $sql = DB::select("SELECT * FROM question ORDER BY rand() LIMIT 100 ");
        //DB::table('question2')->orderby('')->get();
        foreach($sql as $row){
            $esn = $in[rand(0,count($in)-1)];
            DB::update("UPDATE question SET esn=$esn, bid='$bid' where sn=$row->sn ");
        }
        return response('done !');
    }

    function answerf($esn){
        $tp = Exam::find($esn);
        if($tp->status == 0){
            return back()->with('error', 'This Exam Is Not Active');
        }
        $tcode = $this->win_hash(10);
        Result3::create([
            'id'=>$this->uid(),
            'type' => $tp->examtype,
            'esn' => $esn,
            'subject' => $tp->subject,
            'tcode' => $tcode,
            'ctime' => time(),
            'term' => $this->term('term'),        
            'sess' => $this->term('sess'),
            'bid' => $this->bid(),
                  
        ]);
        session()->put('esn',$esn);
        session()->put('tcode', $tcode);
        return redirect('answerquestion')->with('success', 'You Can Now Answer Questions');
    }

    function answer(){
        $esn = session()->get('esn'); $bid = $this->bid();
        $question = Question::where('esn',$esn)->where('bid',$bid)->where('status',1)->limit(25)->get();
        return view('student.answerquestion',['question'=>$question]);
    }


    function courseinfo($sn)
    {
        $bid = $this->bid(); $class = $this->sbid('class');
        $sql = Course::find($sn);
        if($bid != $sql->bid){
            return redirect('dashboard')->with('error','Unaurthorized Page');
        }

        $module = Module::where('cid',$sn)->where('bid',$bid)->orderby('mindex','ASC')->get();


        //return response($sql);
        return view('student.courseinfo',['info'=>$sql,'module'=>$module]);
    }


    function activecourse()
    {
        $bid = $this->bid(); $class = $this->sbid('class');
        $sql = Course::where('bid',$bid)->where('class',$class)->orderby('sn','DESC')->paginate(50);
        //return response($sql);
        return view('student.allcourse',['acourse'=>$sql]);
    }

    function updateuname(Request $request)
    {
        // $bid = $this->bid();
        // $alstudent = Student::where('bid', $bid)->get();
        // foreach($alstudent as $as){
        //     $username = $as->surname.$as->firstname.substr($as->regno,0,5);
        //     $password = Hash::make($as->surname); $uid = $as->uid;
        //     $nuid = $this->win_hashs(10);
        //     DB::update("UPDATE students set username='$username' , password='$password', uid='$nuid' WHERE bid='$bid'  limit 1 ");
        // }

        return response('done');

    }

    function index()
    {
        return view('student.dashboard');
    }

    function mprofile()
    {
        $uid = $this->uid(); $term = $this->term('term'); $sess = $this->term('sess');
        $bid = $this->bid(); $mytotal = 0;
        $mypay = DB::table('payfees')->where('uid',$uid)->where('term',$term)->where('sess',$sess)->where('bid',$bid)->paginate(20);
        $an = DB::table('payfees')->where('uid',$uid)->where('term',$term)->where('sess',$sess)->where('bid',$bid)->get();
        foreach ($an as $key) {
            $mytotal  += $key->amount;
        }
        //return response($mytotal);
        $myfee = DB::table('fee')->where('uid',$uid)->where('term',$term)->where('sess',$sess)->where('bid',$bid)->get();
        return view('student.myprofile',['mypay'=>$mypay,'myfee'=>$myfee,'mytotal'=>$mytotal]);
    }

    function activeexam()
    {
        $bid = $this->bid(); $class = $this->sbid('class');
        $sql = Exam::where('bid',$bid)->where('class',$class)->orderby('sn','DESC')->paginate(50);
        //return response($sql);
        return view('student.allexam',['aexam'=>$sql]);
    }
}


