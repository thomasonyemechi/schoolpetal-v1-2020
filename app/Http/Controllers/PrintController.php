<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Classe;

class PrintController extends Controller
{










    function resultinfo($uid, $class){
        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $sr = DB::table('result')
                    ->where('uid',$uid)
                    ->where('bid',$bid)
                    ->where('class',$class)
                    ->where('term', $term)
                    ->where('sess', $sess)
                    ->orderBy('id')
                    ->get();
            return $sr;

    }


    function allprint(){
        $bid = $this->bid();
        $class = Classe::where('bid',$bid)->get();
        $cla = (session()->has('studentclass'))?session()->get('studentclass'):'';
        $student = Student::where('class',$cla)->where('bid',$bid)->paginate(3);
        return view('other.allresult',['class'=>$class,'students'=>$student]);
    }

    function allprintlinkxx(){
        $bid = $this->bid();
        $class = Classe::where('bid',$bid)->get();
        $cla = (session()->has('studentclass'))?session()->get('studentclass'):'';
        $student = Student::where('class',$cla)->where('bid',$bid)->get();
        return view('other.printxx',['class'=>$class,'students'=>$student]);
    }
    
    
    function allprintlink(){
        $bid = $this->bid();
        $class = Classe::where('bid',$bid)->get();
        $cla = (session()->has('studentclass'))?session()->get('studentclass'):'';
        $student = Student::where('class',$cla)->where('bid',$bid)->get();
        return view('other.print2',['class'=>$class,'students'=>$student]);
    }


    public function index1()
    {   
        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $school = DB::table('schools')
                    ->where('bid',$bid)
                    ->get();
        $allstudent = Student::where('bid',$bid)->get();
        $ts = $this->termname($term);

        if(session()->has('studentid')){
            $si = Student::find(session()->get('studentid'));
            $sr = DB::table('result')
                    ->where('uid',$si->uid)
                    ->where('bid',$bid)
                    ->where('class',$si->class)
                    ->where('term', $term)
                    ->where('sess', $sess)
                    ->orderBy('id')
                    ->get();
        
            foreach ($sr as $key) {
                // if($key->total == 0){
                //     continue;
                // }
                //subjects name
                $total = $key->t1+$key->t2+$key->t3;
                $overall = $key->exam+$total; 
                @$taverage = $this->aggregate($key->uid,$key->class,'total')/$this->aggregate($key->uid,$key->class,);
                $resultTotal = $this->classAverage($key->class);
                $resultNo = ($this->classAverage($key->class,1)=='')?1:$this->classAverage($key->class,1);
                $classaverage = $resultTotal/$resultNo;
                            $comment = DB::select("SELECT * FROM grade WHERE bid='$bid'");
                            $gr =strtolower($this->grade($taverage)) ;
                            $Tgrade = 't'.$gr;
                            $Pgrade = 'p'.$gr;
                $sname[] =  ''.$this->sqLx('subject','id',$key->subject,'subject').'' ;
                
                //$position[] = $this->position($key->class,$key->subject,$key->id);
                $average[] = $this->average($key->class,$key->subject);
                $min[] = $this->average($key->class,$key->subject,'min');
                $max[] = $this->average($key->class,$key->subject,'max');
                $grade[] = $this->grade($overall);
                $remark[] = $this->grade($overall,1);
                $oth = [
                    'nos'=> $this->aggregate($key->uid,$key->class,),
                    'total' => $this->aggregate($key->uid,$key->class,'total'),
                    'average' => $taverage,
                    'tstudent' => $this->totalStudent($key->class),
                    'caverage' => $classaverage,
                    'vd' => $this->term('close'),
                    'rd' => $this->term('resume'),
                    'prep' => $this->remark($Pgrade),
                    'trep' => $this->remark($Tgrade),
                ];

                
                
            }

            if(count($sr)==0){
                $sname = 'null';
                $average = 'null';
                $min = 'null';
                $max = 'null';
                $grade = 'null';
                $remark = 'null';
                $oth = [
                    'nos'=> '',
                    'total' => 0,
                    'average' => 0,
                    'tstudent' => '',
                    'caverage' => 0,
                    'vd' => '',
                    'rd' => '',
                    'prep' => '',
                    'trep' => '',
                ];
            }
           
            return view('other.printresult',[
                'allstudent'=>$allstudent,
                'school'=>$school, 
                'term'=>$ts,
                'sess'=>$sess, 
                'sinfo'=>$si, 
                'sr'=>$sr, 
                'subjects'=>$sname,
                'average'=>$average,
                'min'=>$min,
                'max'=>$max,
                'grade'=>$grade,
                'remark'=>$remark,
                'other' => $oth,
                'img' => $this->simg('photo')
            ]); 
        }
        return view('other.printresult',['allstudent'=>$allstudent,'school'=>$school,'term'=>$ts,'sess'=>$sess,'img' => $this->simg('photo')]);
    }

    public function index2()
    {
        return view('other.print');
    }


    function average($class,$subject,$col=''){

        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $array = array();
        $sum = 0;
        $no = 0;

        $sql = DB::table('result')
                    ->where('bid',$bid)
                    ->where('sess',$sess)
                    ->where('term',$term)
                    ->where('class',$class)
                    ->where('subject',$subject)
                    ->orderBy('total','DESC')
                    ->get();

        
        //$sql = $db->query("SELECT * FROM result WHERE bid='$bid' AND sess='$sess' AND term='$term' AND class='$class' AND subject='$subject' ORDER BY total DESC");
        foreach($sql as $row){
            if($row->total<=0){continue;}
            else {
                $no = $no + 1;
                $sum = $sum + $row->total;
                array_push($array,$row->total);
            }
        }
        $pos = count($array);
        if($col == ''){
            $num = ($no==0)?1:$no;
            $avg = $sum/$num;
            return $avg;
        }
        elseif($col == 'max'){
            $position = ($pos == 0)?'':$array[0];
            return $position;
        }
        elseif($col == 'min'){
            $position = ($pos == 0)?'':$array[$pos-1];
            return $position;
        }
        return;
    }

    public function grade($num,$opt=''){
        $bid = $this->bid();
        $sql = DB::table('grade')
                    ->where('bid',$bid)
                    ->get();
        foreach($sql as $row){
            if($num >= $row->a){
                $grade = "A";
                $remark = "Excellent";
            }
            else if ($num >= $row->b && $num < $row->a){
                $grade = "B";
                $remark = "Very Good";
            }
            else if ($num >= $row->c && $num < $row->b){
                $grade = "C";
                $remark = "Good";
            }
            else if ($num >= $row->d && $num < $row->c){
                $grade = "D";
                $remark = "Fair";
            }
            else if ($num >= $row->e && $num < $row->d){
                $grade = "E";
                $remark = "Pass";
            }
            else {
                $grade = "F";
                $remark = "Fail";
            }
            if($opt==1){
                return $remark;
            }else{
                return $grade;
            }
        }
    }

    public function aggregate($uid,$class,$col=''){
        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $sum = 0; $fir = 0; $sec = 0;
        $num=0;

        $s_1 = ptmtTerm($term, $sess, $bid, 1 , 'sess'); $t_1 = ptmtTerm($term, $sess, $bid, 1 , 'term');
        $s_2 = ptmtTerm($term, $sess, $bid, 0 , 'sess'); $t_2 = ptmtTerm($term, $sess, $bid, 0 , 'term');


        $sql = DB::select("SELECT subject, total FROM result WHERE uid='$uid' AND class='$class' AND term='$term' AND sess='$sess' AND bid='$bid' ORDER BY subject");
        foreach($sql as $row){

            if($term > 1) { $fir += fetchLastTermResultBySubject($uid, $row->subject,  $t_1 , $s_1, $class) ?? 0; }else{ $fir += 0; }
            if($term > 2) { $sec += fetchLastTermResultBySubject($uid, $row->subject,  $t_2 , $s_2, $class) ?? 0; }else{ $fir += 0; }


            $sum += ($row->total);
            $num = ($row->total==0)?$num +=0:$num +=1;
        }
        $div = ($fir == 0) ? 1 : 2 ;
        $div = ($sec == 0) ? $div : $div+1 ;
        $all = ($sum + $fir + $sec) / $div;

        $result = ($col=='')?$num:$all;
        return $result;
    }



    // public function aggregate($uid,$class,$col=''){
    //     $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
    //     $sum = 0;
    //     $num=0;
    //     $sql = DB::select("SELECT subject, total FROM result WHERE uid='$uid' AND class='$class' AND term='$term' AND sess='$sess' AND bid='$bid' ORDER BY subject");

    //     foreach($sql as $row){
    //         $sum += $row->total;
    //         $num = ($row->total==0)?$num +=0:$num +=1;
    //     }
    //     $result = ($col=='')?$num:$sum;
    //     return $result;
    // }






    // function fetchLastTermResultByAll($uid, $class, $term, $sess)
    // {

        
    // }

    public function totalStudent($class){
        $no = 0;
        $bid = $this->bid();
        $sql = DB::select("SELECT * FROM students WHERE bid='$bid' AND class='$class' AND active='1'");
        foreach($sql as $row){
            $no = $no+1;
        }
        return $no;


    }

    public function classAverage($class,$col=''){
        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $total = 0;  $fir = 0; $sec = 0;
        $no = 0;

        $s_1 = ptmtTerm($term, $sess, $bid, 1 , 'sess'); $t_1 = ptmtTerm($term, $sess, $bid, 1 , 'term');
        $s_2 = ptmtTerm($term, $sess, $bid, 0 , 'sess'); $t_2 = ptmtTerm($term, $sess, $bid, 0 , 'term');


        $sql = DB::select("SELECT * FROM result WHERE bid='$bid' AND class='$class' AND term='$term' AND sess='$sess'");
        foreach($sql as $row){
            if($row->total<=0){continue;}
            else {
                $no = $no + 1;
                $total = $total + $row->total;

                // if($term == 2) { $fir += fetchLastTermResultBySubject($row->uid, $row->subject,  $t_1 , $s_1, $class) ?? 0; }else{ $fir += 0; }
                // if($term == 3) { $sec += fetchLastTermResultBySubject($row->uid, $row->subject,  $t_2 , $s_2, $class) ?? 0; } else{ $sec += 0; }

                $fir += 0;
                $sec += 0;

            }
        }

        $div = ($fir == 0) ? 1 : 2 ;
        $div = ($sec == 0) ? $div : $div+1 ;
        $all = ($total + $fir + $sec) / $div;
        
        $result = ($col=='')?$all:$no;
        return $result;
    }

    public function remark($grade)
    {   
        $bid = $this->bid();
        $sql = DB::select("SELECT * FROM grade WHERE bid='$bid'");
        foreach($sql as $row){
            return @$row->$grade;
        }
        
    }

    public function getsid(Request $request)
    {
        $id = $request['studentid']; session()->put('studentid',$id);
        return back();
    }

    public function getclass(Request $request)
    {
        session()->put('studentclass',$request['class']);
        return back();
    }

}
