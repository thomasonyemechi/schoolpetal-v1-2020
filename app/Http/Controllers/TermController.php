<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Term;

class TermController extends Controller
{

  function ActivateTerm(Request $request){
    $sn = $_POST['ActivateTerm'];
    $bid = $this->bid();
    
    DB::update("UPDATE term SET active = 0 WHERE bid = '$bid' ");
    DB::update("UPDATE term SET active = 1 WHERE bid = '$bid' AND id='$sn' ");
    return back()->with('success' ,'Term Successfully Activated: #'.$sn);
    
  }


    public function createterm(Request $request)
    { $bid = $this->bid(); $index = str_replace("/","",$request['session']).$request['term'];
      //validating form inputs
      $validate = Validator::make($request->all(), [
        'session' => 'required',
        'term' => 'required',
      ])->validate();
      if(count(DB::select("SELECT * FROM term WHERE bid ='$bid' AND termindex='$index' ")) > 0){
        $log = 'Term already exist'; $this->addlog($log,2);
        return redirect('generalsetup')->with('error', $log);
      }
      Term::create([
       'term' => $request['term'],
       'sess' => $request['session'],
       'termindex' => $index,
       'rep' => auth()->user()->sid,
       'bid' => $this->bid(),
      ]);
      $log = 'Term Created Sucessfully'; $this->addlog($log,1);
      return redirect('generalsetup')->with('success', $log);
    }

    public function updatedate(Request $request)
    {
       $bid = $this->bid();
      //  $validate = Validator::make($request->all(), [
      //    'next' => 'required',
      //    'end' => 'required',
      //  ])->validate();
      $id = $this->term('id');
      //  return $id;

       $sql = DB::select("SELECT * FROM term WHERE bid ='$bid' AND id='$id' ");
       foreach ($sql as $key) {
         $id = $key->id;
         $term = Term::find($id);
         $term->close = $request->input('end');
         $term->resume = $request->input('next');
         $term->save();
       }
       return redirect('generalsetup')->with('success','Updated Sucessfully');
    }


}
