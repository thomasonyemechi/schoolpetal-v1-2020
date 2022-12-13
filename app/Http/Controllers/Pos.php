<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Unstock;

use App\Models\Student;

class Pos extends Controller
{
    //    
   public function post_uid(Request $request) {
    $postuid = $request['postuid'];
    $request->session()->put('postuid',$postuid);
    $bid = $this->bid(); 
    $studentuid =     Unstock::where('bid',$bid)->where('uid',$postuid)->get(); 
    $students =       Student::where('uid',$postuid)->get(); 
 
    foreach ($students  as $student) {
        $request->session()->put('studentname',$student->firstname);
    }
    $request->session()->put('studentuid',$studentuid);
    return  redirect('pos');
}
}
