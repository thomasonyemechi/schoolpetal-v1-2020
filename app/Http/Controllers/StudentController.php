<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//importing student model
use App\Models\Student;
use App\Models\Payfee;
use App\Models\Feecat;
use App\Models\Studentdata;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
  {
    $bid = $this->bid(); $term = $this->term('term');  $sess = $this->term('sess');

    $students = Student::where('bid',$bid)->orderby('surname', 'ASC')->get();
    $feecat = Feecat::where('bid',$bid)->orderby('id', 'desc')->get();
    if(session()->has('student')){  $student = session()->get('student');
      $uid = $student->uid;
      $classarm = DB::select("SELECT * FROM classarm WHERE bid='$bid' order by arm ");
      $sql2 = DB::select("SELECT * FROM class WHERE bid='$bid' order by class ");
      $sql = DB::select("SELECT * FROM fee WHERE bid='$bid' AND term='$term' AND sess='$sess' AND uid='$uid' AND active=1 ");
      $payhis = DB::select("SELECT * FROM payfees WHERE uid='$uid' AND bid='$bid' AND term='$term' AND sess='$sess' ORDER BY id ASC");

      foreach($payhis as $ms){
        $ph[] =  ['salesid'=>$ms->salesid,'amount'=>$ms->amount,'note'=>$this->sqLx('feecat','id',$ms->note,'fee'),'created_at'=>$ms->created_at];
      }

      if(count($payhis)==0){
        $ph[] =  ['salesid' =>'','amount'=>'','note'=>'','created_at'=>'9000',];
      }

      return view('student.index',['students'=>$students,'feecat'=>$feecat,'efee'=>$sql,'payhis'=>$ph,'arm'=>$classarm,'class'=>$sql2]);
    }
    return view('student.index',['students'=>$students,'feecat'=>$feecat]);
  }

  public function index2()
  {
    $bid = $this->bid();
    $cla = DB::select("SELECT * FROM class where bid = '$bid' ORDER by id ASC ");
    foreach($cla as $k){
      $class[] = [
        'id' => $k->id,
        'class' => $k->class,
        'str' => $this->count($k->id)
      ];
    }
    //return response($class);
    return view('other.promotion1',['class'=>$class]);
  }

  public function index3($clasn)
  {
    $bid = $this->bid();
    $cla = DB::select("SELECT * FROM class where bid = '$bid' ORDER by classindex ASC ");
    //return response($clasn);
   // $students = DB::select("SELECT * FROM students where bid = '$bid' AND class=$clasn AND active=1 ");
    $students = DB::table('students')->where('bid',$bid)->where('active','1')->where('class',$clasn)->paginate(100);
    foreach($cla as $k){
      $class[] = [
        'id' => $k->id,
        'class' => $k->class,
        'str' => $this->count($k->id)
      ];
      
    }
    $cname = $this->sqLx('class','id',$clasn,'class');
    return view('other.promotion',['class'=>$class,'students'=>$students,'cname'=>$cname]);
  }

  public function count($sn){
    $bid = $this->bid();
    return count(DB::select("SELECT * FROM students where bid = '$bid' AND class=$sn AND active=1 "));
  }

  public function getstudent(Request $request)
  {
    $id = $request['studentid']; session()->put('studentid',$id);
      $student = Student::find($id);
      session()->put('student',$student);
      return redirect('student');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $bid = $this->bid();
      $student = Student::where('bid',$bid)->orderby('id', 'desc')->limit('20')->get();
      $classcat = DB::select("SELECT * FROM classcat WHERE bid='$bid' ");
      $classarm = DB::select("SELECT * FROM classarm WHERE bid='$bid' order by arm ");
      $sql2 = DB::select("SELECT * FROM class WHERE bid='$bid' order by class ");
      return view('student.create',['classcats'=>$classcat, 'classarms'=>$classarm,'students'=>$student,'classes'=>$sql2]);
  }

  public function addstd()
  {
      $bid = $this->bid();
      $student = Student::where('bid',$bid)->orderby('id', 'desc')->limit('20')->get();
      $classcat = DB::select("SELECT * FROM classcat WHERE bid='$bid' ");
      $classarm = DB::select("SELECT * FROM classarm WHERE bid='$bid' order by arm ");
      $sql2 = DB::select("SELECT * FROM class WHERE bid='$bid' order by class ");
      return view('student.addstudent',['classcats'=>$classcat, 'classarms'=>$classarm,'students'=>$student,'classes'=>$sql2]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //validating form inputs 
    $regno = $this->win_hashss(20);
    $pwd = $this->win_hash(4);
    // return response($request['parent']);
    $validate = Validator::make($request->all(), [
      'parent' => 'required',
      'surname' => 'required|string|max:255',
      'firstname' => 'required|string|max:255',
      'midname' => 'required|string|max:255',
      'sex' => 'required',
      'class' => 'required',
    ])->validate();
    $uid = $this->win_hashs(10);
    //creating the studrnt profile in the student table
      Student::create([
      'regno' => $regno,
      'uid' => $uid,
      'rep' => auth()->user()->sid,
      'bid' => auth()->user()->bid,
      'parent' => $request['parent'],
      'surname' => $request['surname'],
      'firstname' => $request['firstname'],
      'midname' => $request['midname'],
      'class' => $request['class'],
      'arm' => $request['arm'],
      'sex' => $request['sex'],
      'sess'=> $this->term('sess'),
      'password' => Hash::make($pwd),
      'pwd' => $pwd,
      'username' => $request['surname'].$request['firstname'].substr($regno,0,5)
    ]);


    //creating the student profile in the studentdata table
      Studentdata::create([
      'uid' => $uid,
      'rep' => auth()->user()->sid,
      'bid' => auth()->user()->bid,
      // 'phone' => $request['phone'],
      // 'email' => $request['email'],
      // 'address' => $request['address'],
      // 'pname' => $request['pname'],
      // 'phone2' => $request['phone2'],
      'dob' => $request['dob'],
      'birthplace' => $request['birthplace'],
      // 'state' => $request['state'],
      'other' => $request['other'],
      // 'lga' => $request['lga'],
      'prschool' => $request['prschool'],
      'reason' => $request['reason'],
      'bloodgr' => $request['bloodgr'],
      'genotype' => $request['genotype'],
      'ailment' => $request['ailment'],
      'disability' => $request['disability'],
      // 'occupation' => $request['occupation'],
      // 'occupation2' => $request['occupation2'],
      // 'officeadd' => $request['officeadd'],
      // 'officeadd2' => $request['officeadd2'],
      'level' => $request['level'],
      // 'mname' => $request['mname'],
      // 'mphone' => $request['phone2'],
      // 'email2' => $request['email2'],
    ]);
    $log = 'Student Profile Created Sucessfully '.$request['surname'] .$request['firstname'];
    $this->addlog($log,1);
      return redirect('student/create')->with('success', 'Student Profile Created Sucessfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $student = Student::find($id);
    if(auth()->user()->bid != $student->bid){
      return redirect('/student')->with('error', 'Unauthorized Page');
    }
    return view('student.profile',['student'=>$student]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit($uid)
    {
      $student = Student::find($uid);
      //checking for the authur of the post
      if(auth()->user()->sid !== $student->rep){
        return redirect('/student')->with('error', 'Unauthorized Page');
      }
      return view('student.edit')->with('student', $student);
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

  public function payfee(Request $request)
  {
    $bid = $this->bid(); $term = $this->term('term');  $sess = $this->term('sess'); $tan = time();  $amount = str_replace(",","",trim($request['amount']));
    $validate = Validator::make($request->all(), [
      'amount' => 'required',
      'fee' => 'required',
    ])->validate();

    Payfee::create([
      'uid' => $request['uid'],
      'amount' => $amount,
      'note' => $request['fee'],
      'bid' => $bid,
      'term' => $term,
      'sess' => $sess,
      'tan' => $tan,
      'salesid' => $this->win_hash(9),
      'rep' => auth()->user()->sid,
    ]);

    return redirect('student')->with('success','Payment made Sucessfully');
  }

  public function promoteStudent(Request $request)
  { 
    $id = $request['studentid'];
    $bid=$this->Bid();
    $class = $this->cName($id,'class');
    $sess = $this->term('sess');
    $classindex = $this->className($class,'classindex');
    $sql = DB::select("SELECT * FROM class WHERE classindex>'$classindex' AND bid='$bid' ORDER BY classindex ASC LIMIT 1");
    foreach ($sql as $row) {
    }

    $newclass = @$row->id;
    if($class == 'graduate'){
        $stat=TRUE;
    }
    else if(count($sql)>0) {
        DB::update("UPDATE students SET class = '$newclass' WHERE id='$id' AND bid='$bid' ");
        return redirect('promotion/'.$class.'')
        ->with('success', $this->cName($id).' Successfully Promoted to next class: '. $this->className($newclass));
    }else{
      DB::update("UPDATE students SET class='graduate', sess='$sess' WHERE id='$id' AND bid='$bid'");
      return redirect('promotion/'.$class.'')
      ->with('success', $this->cName($id).' Graduated Successfully ');   $stat=TRUE;
    }
  }

  public function demoteStudent(Request $request)
  { 
    $id = $request['studentid'];      
    $bid=$this->Bid();
    $class = $this->cName($id,'class');
    $sess = $this->term('sess');
    $classindex = $this->className($class,'classindex');
    $sql = DB::select("SELECT * FROM class WHERE classindex<'$classindex' AND bid='$bid' ORDER BY classindex DESC LIMIT 1");
    foreach ($sql as $row) {
    }

    $newclass = @$row->id;
    if($class == 'graduate'){
        $stat=TRUE;
    }
    else if(count($sql)>0) {
        DB::update("UPDATE students SET class = '$newclass' WHERE id='$id' AND bid='$bid' ");
        return redirect('promotion/'.$class.'')
        ->with('success', $this->cName($id).' Successfully Demoted to previous class: '. $this->className($newclass));
    }else{
      DB::update("UPDATE students SET class='graduate', sess='$sess' WHERE id='$id' AND bid='$bid'");
      return redirect('promotion/'.$class.'')
      ->with('success', ' Could not demote student '.$this->cName($id));   $stat=TRUE;
    }
  }

  public function promoter($id)
  { 
    $bid=$this->Bid();
    $class = $this->cName($id,'class');
    $sess = $this->term('sess');
    $classindex = $this->className($class,'classindex');
    $sql = DB::select("SELECT * FROM class WHERE classindex>'$classindex' AND bid='$bid' ORDER BY classindex       ASC LIMIT 1");
    foreach ($sql as $row) {
    }

    $newclass = @$row->id;
    if($class == 'graduate'){
        $stat=TRUE;
    }
    else if(count($sql)>0) {
        DB::update("UPDATE students SET class = '$newclass' WHERE id='$id' AND bid='$bid' ");
        // return redirect('promotion/'.$class.'')
        // ->with('success', $this->cName($id).' Successfully Promoted to next class: '. $this->className($newclass));
    }else{
      DB::update("UPDATE students SET class='graduate', sess='$sess' WHERE id='$id' AND bid='$bid'");
      // return redirect('promotion/'.$class.'')
      // ->with('success', $this->cName($id).' Graduated Successfully ');   $stat=TRUE;
    }
  }

  public function promotesome(Request $request)
  {
    $id[] = $request['id'];
    
    return response(json_encode($id));
  }

  public function promoteall(Request $request)
  {
    $bid = $this->bid();
    $sql = DB::select("SELECT * FROM students where bid='$bid' ");
    foreach ($sql as $rw) {
      $this->promoter($rw->id);
    }
    return redirect('promotion')->with('success','All student Promoted');
  }

  public function updatestudent(Request $request)
  { 
    $id = $request['id'];
    $uid = $request['uid'];

    $validate = Validator::make($request->all(), [
      'surname' => 'required|string|max:255',
      'firstname' => 'required|string|max:255',
      'midname' => 'required|string|max:255',
      'sex' => 'required',
    ])->validate();
      ///return response($request);

    DB::table('students')
    ->updateOrInsert(
        ['uid' => $uid],
        [
          
          'sex'=>$request['sex'], 
          'surname' => $request['surname'],
          'firstname' => $request['firstname'],
          'midname' => $request['midname'],
        ],
    );


    DB::table('studentdata')
    ->updateOrInsert(
        ['uid' => $uid],
        [
          
          'email'=>$request['email'], 
          'phone' => $request['phone'],
          'address' => $request['address'],
          'pname'=>$request['pname'], 
          'phone2' => $request['phone2'],
          'dob' => $request['dob'],
          'birthplace'=>$request['birthplace'], 
          'other' => $request['other'],
          'rep'=>$this->uid() , 
          'bloodgr' => $request['bloodgr'],
          'genotype' => $request['genotype'],
          'ailment'=>$request['ailment'], 
          'disability' => $request['disability'],
          'bid' => $this->bid(),
          'other' => $request['other'],
          'prschool' => $request['prschool'],
          'reason' => $request['reason'],
        ],
    );
    session()->put('student', Student::find($id));
    return redirect('student')->with('success','Update Sucessfully');
  }

  

  public function deactivatestudent(Request $request)
  {
    $bid = $this->bid();
    $id = $request['id'];
    DB::update("UPDATE students SET active=0 WHERE id=$id ");
    session()->put('student', Student::find($id));
    return redirect('student')->with('success','Deactivated Sucessfully');
  }
  public function activatestudent(Request $request)
  {
    $bid = $this->bid();
    $id = $request['id'];
    DB::update("UPDATE students SET active=1 WHERE id=$id ");
    session()->put('student', Student::find($id));
    return redirect('student')->with('success','Activated Sucessfully');
  }




}