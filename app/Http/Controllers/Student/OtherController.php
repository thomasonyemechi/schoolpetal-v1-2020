<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\PrintController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Remark;
use App\Models\Classe;

class OtherController extends PrintController
{
    //


    function UpdateresultComment(Request $request)
    {   
        $cla = session()->get('studentclass'); $ii = 1;
        $std = \App\Models\Student::where('class', $cla)->orderby('status','desc')->paginate(100);
        foreach($std as $st)
        {
            $ee = $ii++;
            Remark::where('id', $request['ssn'.$ee])->update([
                'tremark' => $request['tcomment'.$ee],
                'premark' => $request['pcomment'.$ee],
            ]);
        }
        return back()->with('success','Sucessfully updated');
        // return response($request['ssn'.$ee]);
    }



    function generateComment()
    {
        $class = session()->get('studentclass');
        $std = Student::where('class', $class)->get();
        $term = $this->term('term'); $sess = $this->term('sess');
        foreach($std as $st){
            $other = $this->other($st->uid, $class);
            $this->doOrDie($st->uid,$st->class,$sess,$term,$other);
        }

        //return response($other);

        return view('other.editcomment');
    }


    function doOrDie($uid,$class,$sess,$term,$other) 
    {
        $ck = Remark::where('student',$uid)->where('sess',$sess)->where('term',$term)->where('class',$class)->get();
        if(count($ck) > 0) {}
        else{
            Remark::create([
                'student' => $uid,
                'term' => $term,
                'sess' => $sess,
                'class' => $class,
                'premark' => $other['prep'],
                'tremark' => $other['trep'],
            ]);
        }

        return;
    }





    function Other($uid,$class)
    {   
        @$taverage = $this->aggregate($uid,$class,'total')/$this->aggregate($uid,$class,);
        $gr =strtolower($this->grade($taverage)) ;
        $Tgrade = 't'.$gr;
        $Pgrade = 'p'.$gr;
        $oth = [
            'prep' => $this->remark($Pgrade),
            'trep' => $this->remark($Tgrade),
            'average' => $taverage,
        ];

        return $oth;
    }




    public function index()
    {
        return response('jhdvhbedvhbdvhbsdhibdhbvduhbvuhdbvuhdudv');
    }

    public function CheckMyResult()
    {   
        $bid = $this->bid(); $term = $this->term('term'); $sess = $this->term('sess');
        $school = DB::table('schools')
                    ->where('bid',$bid)
                    ->get();
        $ts = $this->termname($term);

        $uid = session()->has('student_idx');
            $si = Student::find($this->sdata('id'));
            $sr = DB::table('result')
                    ->where('uid',$si->uid)
                    ->where('bid',$bid)
                    ->where('class',$si->class)
                    ->where('term', $term)
                    ->where('sess', $sess)
                    ->orderBy('id')
                    ->get();
        
            foreach ($sr as $key) {
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
           
            return view('other.checker',[
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






}