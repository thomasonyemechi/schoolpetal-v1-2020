<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Subject;

class SubjectController extends Controller
{
  public function index()
  {
    $bid = $this->bid();
      $sql = DB::select("SELECT * FROM subject WHERE bid='$bid' ");
      return view('other.subject',['subjects'=>$sql,]);
  }

  public function createsubject(Request $request)
  {
    $bid = $this->bid(); $subject = $request['subject'];
    //validating form inputs
    $validate = Validator::make($request->all(), [
      'subject' => 'required|string|max:100',
    ])->validate();
    //checking if input exist
    $sql = DB::select("SELECT * FROM subject WHERE bid='$bid' AND subject='$subject' ");
    if(count($sql)>0){
      $log = 'Subject Already Exist '.$subject;
      $this->addlog($log,2);
      return redirect('subjects')->with('error', $log);
    }
    //creating the Category
    Subject::create([
     'subject' => $subject,
     'rep' => $this->uid(),
     'bid' => $this->bid(),
   ]);
   $log = 'Subject Created Sucessfully '.$subject;
   //adding logs
   $this->addlog($log,1);
   return redirect('subjects')->with('success', $log);
  }

  public function deletesubject(Request $request)
  {
    $id = $request['delete'];
    $sql = DB::select("SELECT * FROM setsubject WHERE sid='$id'");
    if(count($sql)>0){return redirect('subjects')->with('error', 'Subject Cannot Be deleted'); }
      $sql = DB::delete("DELETE FROM subject WHERE id='$id' ");
      $log = 'Subject Deleted Sucessfully ';
      //adding logs
      $this->addlog($log,1);
      return redirect('subjects')->with('success', $log);
  }




}
