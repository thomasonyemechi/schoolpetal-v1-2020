<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Classcat;
use App\Models\Classarm;

class ClasscatController extends Controller
{
    public function index()
    {
      $bid = $this->bid();
        $sql = DB::select("SELECT * FROM classcat WHERE bid='$bid' ");
        $sql2 = DB::select("SELECT * FROM classarm WHERE bid='$bid' ");
        return view('other.classcat',['classcats'=>$sql,'classarms'=>$sql2]);
    }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
   public function create()
   {  $bid = $this->bid();
       $sql = DB::select("SELECT * FROM studentdata WHERE bid='$bid' ");
       return view('student.create');
   }

   public function createcat(Request $request)
   {
     $bid = $this->bid(); $cat = $request['classCategory'];
     //validating form inputs
     $validate = Validator::make($request->all(), [
       'classCategory' => 'required|string|max:10',
     ])->validate();
     //checking if input exist
     $sql = DB::select("SELECT * FROM classcat WHERE bid='$bid' AND cat='$cat' ");
     if(count($sql)>0){
       $log = 'Class Category Already Exist '.$request['classCategory'];
       $this->addlog($log,2);
       return redirect('classcat')->with('error', $log);
     }
     //creating the Category
     Classcat::create([
      'cat' => $request['classCategory'],
      'rep' => $this->uid(),
      'bid' => $this->bid(),
    ]);
    $log = 'Class Category Created Sucessfully '.$request['classCategory'];
    //adding logs
    $this->addlog($log,1);
    return redirect('classcat')->with('success', $log);
   }


   public function createarm(Request $request)
   {
     $bid = $this->bid(); $arm = $request['classArm'];
     //validating form inputs
     $validate = Validator::make($request->all(), [
       'classArm' => 'required|string|max:10',
     ])->validate();
     //checking if input exist
     $sql = DB::select("SELECT * FROM classarm WHERE bid='$bid' AND arm='$arm' ");
     if(count($sql)>0){
       $log = 'Class Arm Already Exist '.$request['classArm'];
       $this->addlog($log,2);
       return redirect('classcat')->with('error', $log);
     }
     //creating the Category
     Classarm::create([
      'arm' => $request['classArm'],
      'rep' => $this->uid(),
      'bid' => $this->bid(),
    ]);
    $log = 'Class Arm Created Sucessfully '.$request['classArm'];
    //adding logs
    $this->addlog($log,1);
    return redirect('classcat')->with('success', $log);
   }


}
