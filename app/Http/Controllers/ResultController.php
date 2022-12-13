<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setsubject;
use App\Models\Result;
use Illuminate\Support\Facades\DB;


class ResultController extends Controller
{

    function gra($col){
        $bid = $this->bid();
        $sql = DB::select("SELECT * FROM  grade WHERE bid='$bid' ");
        foreach($sql as $row){
            return $row->$col;
        }
    }


    public function kill($class,$subject)
    {
        $bid = $this->bid(); $rep = $this->uid();
        $term = $this->term('term'); $sess = $this->term('sess');
        $sr = DB::table('result')
                        ->where('bid', $bid)
                        ->where('class',$class)
                        ->where('subject', $subject)
                        ->where('term', $term)
                        ->where('sess',$sess)
                        ->orderBy('id','ASC')
                        ->get();
        foreach ($sr as $va) {
            $id=$va->id;
            $ca = rand(0,$this->gra('ca1'));
            $cb = rand(0,$this->gra('ca2'));

            
            $cc = rand(0,$this->gra('ca3'));
        
            $cd = rand(0,$this->gra('exam'));
            
            $total = $ca+$cb+$cc+$cd;
         
            $result = Result::find($id);
            $result->t1 = $ca;
            $result->t2 = $cb;
            $result->t3 = $cc;
            $result->exam = $cd;
            $result->total = $total;
            $result->rep = $rep;
            $result->save();
            
            
        }
        return back()->with('success','Result successfully updated for student(s)');
        //return response($id);
    }


    function autofillschoolresult(Request $request)
    {
        $term  = $this->term('term'); $sess  = $this->term('sess'); $rep = $this->uid();
        $class = $request['class']; $subject = $request['subject']; $bid = $this->bid();
        $students = DB::select("SELECT * FROM students WHERE bid='$bid' AND class='$class' order by RAND() limit 100 ");
        
        foreach($students as $key){
            $uid = $key->uid;
            $this->createResult($uid,$class,$subject,$term,$sess,$rep);
        }
        //return response($students);
        $this->kill($class,$subject);
        return response('done');
    }
    public function index()
    {   
        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $mysubjects = DB::table('setsubject')
                        ->where('uid', $this->uid())
                        ->get();
        // foreach($mysubjects as $ms){
        //     $msub[] = [
        //         'id'=>$ms->id, 
        //         'class' => ''.ucwords($this->sqLx('subject','id',$ms->sid,'subject')).'  '.$this->sqLx('class','id',$ms->classid,'class').'', 
        //     ];
        // }
            $name = [];
            $position = [];
        if(session()->has('resultid')){
            $grade = DB::table('grade')
                        ->where('bid', $bid)
                        ->get();
            $rinfo = Setsubject::find(session()->get('resultid'));
            $class = $rinfo->classid;
            $subject = $rinfo->sid;
            $students = DB::table('result')
                            ->where('bid', $bid)
                            ->where('class',$class)
                            ->where('subject', $subject)
                            ->where('term', $term)
                            ->where('sess',$sess)
                            ->orderBy('id','ASC')
                            ->paginate(100);
            
            
            // $db->query("SELECT * FROM result WHERE bid='$bid' AND class='$class' AND subject='$subject' AND term='$term' AND sess='$sess' ORDER BY sn ASC ") 
            //return response($students);
            
            foreach ($students as $key) {
                $name[] = ''.$this->sqLx('students','uid',$key->uid,'surname').' '.$this->sqLx('students','uid',$key->uid,'firstname').'' ;
                $position[] = $this->position($key->class,$key->subject,$key->id);
            }
            return view('other.result',['grade'=>$grade, 'students'=>$students,'name'=>$name,'position'=>$position]);
        }
        
        return view('other.result');
    }

    public function startresult(Request $request)
    {    
        $bid = $this->bid(); $rep = $this->uid();
        $rid = $request['resultid']; session()->put('resultid',$rid);
        $rinfo = Setsubject::find($rid);
        $class = $rinfo->classid;
        $subject = $rinfo->sid;
        $term = $this->term('term'); $sess = $this->term('sess');
        $ckc = DB::table('students')
                   ->where('class', $class)
                   ->where('active', 1)
                   ->where('bid', $bid)
                   ->get();
        if(count($ckc)==0){ return redirect('postresult')->with('error','This calss is empty'); }
        
        foreach($ckc as $sr){ 
            $uid = $sr->uid;
            $this->createResult($uid,$class,$subject,$term,$sess,$rep);
        }
        $rname = ''. ucwords($this->sqLx('subject','id',$subject,'subject')).' '.$this->sqLx('class','id',$class,'class').' ';
        session()->put('rname', $rname);
        $csub = 'You can now proceed to enter '.$rname.'  result for '.count($ckc).' student(s) ';

        return redirect('postresult')->with('success',$csub);
        
    }




    public function createResult($uid,$class,$subject,$term,$sess,$rep){
        $tan= time(); $bid = $this->bid();
        $msql = DB::table('result')
                    ->where('bid',$bid)
                    ->where('class',$class)
                    ->where('subject',$subject)
                    ->where('term', $term)
                    ->where('sess',$sess)
                    ->where('uid',$uid)
                    ->get();
        if(count($msql)==0){
            Result::create([
                'uid' => $uid,
                'term' => $term,
                'sess' => $sess,
                'class' => $class,
                'subject' => $subject,
                'bid' => $bid,
                'rep' => $rep,
                'tan' => $tan
            ]);
        }
        return;
    }


    public function submitresult(Request $request)
    {
        $bid = $this->bid(); $rep = $this->uid();
        $term = $this->term('term'); $sess = $this->term('sess');
        $rinfo = Setsubject::find(session()->get('resultid'));
        $class = $rinfo->classid;
        $subject = $rinfo->sid; $e=0;
        $sr = DB::table('result')
                        ->where('bid', $bid)
                        ->where('class',$class)
                        ->where('subject', $subject)
                        ->where('term', $term)
                        ->where('sess',$sess)
                        ->orderBy('id','ASC')
                        ->paginate(100);
        foreach ($sr as $va) { $e++;
            $id=$request['sn'.$e];
            $ca = abs(trim($request['ca'.$e]));
            $cb = abs(trim($request['cb'.$e]));
            $grade = DB::table('grade')
                        ->where('bid', $bid)
                        ->get();
            foreach ($grade as $k) {
                $ca3 = $k->ca3;
            }
            
            if( $ca3 == 0){ $cc = 0; }
            else { $cc = abs(trim($request['cc'.$e])); }
        
            $cd = abs(trim($request['cd'.$e]));
            
            $total = $ca+$cb+$cc+$cd;
            if($total>100){ 
                return back()->with('error','Invalid score entered for student(s) ');
            }

            $result = Result::find($id);
            $result->t1 = $ca;
            $result->t2 = $cb;
            $result->t3 = $cc;
            $result->exam = $cd;
            $result->total = $total;
            $result->rep = $rep;
            $result->save();
            
            
        }
        return back()->with('success','Result successfully updated for student(s)');
        //return response($id);
    }

    // function cResult($id){
    //     global $db,$report,$count;
    // $term = $this->Term('term');
    // $sess = $this->Term('sess');
    // $bid = $this->Bid();
    // //$rep = $this->Rep();
    // //$subject = $_SESSION['subject'];
    // $class = $_SESSION['class'];
    
    // $sql = $db->query("SELECT * FROM result WHERE bid='$bid' AND class='$class' AND term='$term' AND sess='$sess' AND id='$id' AND total>0 ") or die(mysqli_error()); 
    //     return mysqli_num_rows($sql);
    
    // }



    function position($class,$num,$id){
        $array = array();
        $term = $this->term('term');
//        $term = (isset($_SESSION['term']))?$_SESSION['term']:$this->Term('term');
        $sess = $this->term('sess');
//        $sess = (isset($_SESSION['session']))?$_SESSION['session']:$this->Term('sess');
        $bid = $this->bid();
        $arr='';
        $i = 1;
        $sql = DB::select("SELECT * FROM result WHERE bid='$bid' AND class='$class' AND subject='$num' AND term='$term' AND sess='$sess' ORDER BY total DESC");
        foreach($sql as $row){
            if($row->total==0){
                continue;
            }
            else {
                $e=$i++;
                $idx = $row->id;
                $total = $row->total;
                $arr .= $idx.'-'.$e.',';
            }


        }
        $var = '';
        $expl = explode(',',$arr);
        $count = count($expl)-1;
        //return $count;
        $i=0;
        while($i<$count){ $e=$i++;
            $pos = explode('-',$expl[$e]);
            if($pos[0]==$id){$var = $pos[1];}

        }
        return $var;
    }
    
}
