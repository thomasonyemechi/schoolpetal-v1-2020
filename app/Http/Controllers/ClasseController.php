<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Classe;
use App\Models\Setsubject;
use App\Models\Student;

class ClasseController extends Controller
{
  public function index()
  {
    $bid = $this->bid();
      $sql = DB::select("SELECT * FROM classcat WHERE bid='$bid' ");
      $sql2 = DB::select("SELECT * FROM class WHERE bid='$bid' order by classindex ASC ");
      return view('other.classes',['classcats'=>$sql,'classes'=>$sql2]);
  }


  function lastCindex(){
    $bid=$this->Bid();
    $sql = DB::select("SELECT * FROM class WHERE bid='$bid' ORDER BY classindex DESC LIMIT 1");
    foreach ($sql as $row) {
      return $row->classindex;
    }  
  }

  function firstCindex(){
    $bid=$this->Bid();
    $sql = DB::select("SELECT * FROM class WHERE bid='$bid' ORDER BY classindex ASC LIMIT 1");
    foreach ($sql as $row) {
      return $row->classindex;
    }  
  }


  public function createclass(Request $request)
  {
    $bid = $this->bid(); $class = ''.$request['class'].' '.$request['level'];
    $classindex=(int)($this->lastCindex()+10000);
    //return response($classindex);
    //validating form inputs
    $validate = Validator::make($request->all(), [
      'class' => 'required|string|max:10',
      'level' => 'required|max:2',
    ])->validate();
    //checking if input exist
    $sql = DB::select("SELECT * FROM class WHERE bid='$bid' AND class='$class' ");
    if(count($sql)>0){
      $log = 'Class Already Exist '.$class;
      $this->addlog($log,2);
      return redirect('classes')->with('error', $log);
    }
    //creating the Category
    Classe::create([
     'class' => $class,
     'classindex'=> $classindex,
     'rep' => $this->uid(),
     'bid' => $this->bid(),
   ]);
   $log = 'Class Created Sucessfully '.$class;
   //adding logs
   $this->addlog($log,1);
   return redirect('classes')->with('success', $log);
  }

  function ClassUp(Request $request){
    $bid=$this->bid();
    $classindex=$_POST['ClassUp'];

    $sum = 0;
    $sql = DB::select("SELECT * FROM class WHERE bid='$bid' AND classindex < '$classindex' ORDER BY classindex DESC LIMIT 2");
    foreach($sql as $row){$sum += $row->classindex; }
    $sum = (count($sql)<2)?$this->firstCindex()/2:$sum;
    $newindex = (int)($sum/2);
    DB::update("UPDATE class SET classindex='$newindex' WHERE classindex='$classindex' AND bid='$bid' ");
    return redirect('classes');
}

function ClassDown(Request $request){
  $bid=$this->bid();
  $classindex=$_POST['ClassDown'];

  $sum = 0;
  $sql = DB::select("SELECT * FROM class WHERE bid='$bid' AND classindex > '$classindex' ORDER BY classindex ASC LIMIT 2");
  foreach($sql as $row){$sum += $row->classindex; }
  $sum = (count($sql)<2)?2*$this->lastCindex()+20000:$sum;
  $newindex = (int)($sum/2);
  DB::update("UPDATE class SET classindex='$newindex' WHERE classindex='$classindex' AND bid='$bid' ");
  return redirect('classes');
}


function DeleteClass(Request $request){
  $bid = $this->bid();
  $class = $request['class'];
  $set = count(Setsubject::where('classid', $class)->get());
  $stud = count(Student::where('class', $class)->get());
  if($set > 0 OR $stud > 0){
    return back()->with('error','Cannot Remove this class');
  }else{
    DB::delete("DELETE FROM class WHERE id=$class ");
    return back()->with('success',' class removed sucessfully');
  }

}



}
