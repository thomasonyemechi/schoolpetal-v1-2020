<?php

namespace App\Http\Controllers\Cbt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Cbt\Type;
use App\Models\Cbt\Exam;
use App\Models\Cbt\Question;
use App\Models\Setsubject;

class QuestionController extends Controller
{

    

    function updatequestion(Request $request,$id)
    {
        $esn = session()->get('esn');
        $validate = Validator::make($request->all(), [
            'a' => 'required|max:5000',
            'b' => 'required|max:5000',
            'c' => 'required|max:5000',
            'd' => 'required|max:5000',
            'ca' => 'required|max:2',
            'question' => 'required|max:20000',
        ])->validate();

        DB::table('question')->updateOrInsert(
            ['sn' => $id],
            [
            'question'=>$request['question'], 
            'a' => $request['a'],
            'b' => $request['b'],
            'c'=>$request['c'], 
            'd' => $request['d'],
            'ca' => $request['ca'],
            'rep'=>$this->uid() ,
            ],
        );
        return redirect('addquestion')->with('success','Question Sucessfully Updated ');

    }

    function showq($sn)
    {
        $esn = session()->get('esn');
        $question = Question::where('esn',$esn)->orderby('sn','DESC')->paginate(100);
        $ques = Question::where('sn',$sn)->get();
        return view('cbt.editquestion',['question'=>$question,'ques'=>$ques]);
    }


    function submitQuestion(Request $request)
    {
        $esn = session()->get('esn');
        $validate = Validator::make($request->all(), [
            'a' => 'required|max:5000',
            'b' => 'required|max:5000',
            'c' => 'required|max:5000',
            'd' => 'required|max:5000',
            'ca' => 'required|max:2',
            'question' => 'required|max:20000',
        ])->validate();

        Question::create([
            'esn'=>$esn,
            'rep'=>$this->uid(),
            'bid'=>$this->bid(),
            'qn'=>$this->qNumber($esn),
            'a'=>addslashes(trim($request['a'])),
            'b'=>addslashes(trim($request['b'])),
            'c'=>addslashes(trim($request['b'])),
            'd'=>addslashes(trim($request['b'])),
            'ca'=>addslashes(trim($request['ca'])),
            'question'=>addslashes(trim($request['question'])),
        ]);

        return back()->with('success','Question added Sucessfully');
    }

    function qNumber($esn){
        $sql=Question::where('esn',$esn)->get();
        return count($sql)+1;
    }

    function examin()
    {
        $bid = $this->bid(); $uid = $this->uid();
        $ty = Type::where('bid',$bid)->get();
        $mysub = Setsubject::where('uid',$uid)->where('bid',$bid)->get();
        $exam = Exam::where('bid',$bid)->paginate(100);
        return view('cbt.addexam',['type'=>$ty,'subject'=>$mysub,'exam'=>$exam]);
    }


    function index()
    {
        $esn = session()->get('esn');
        $question = Question::where('esn',$esn)->orderby('sn','DESC')->paginate(100);
        return view('cbt.addquestion',['question'=>$question]);
    }

    function typein()
    {
        $bid = $this->bid();
        $ty = Type::where('bid',$bid)->get();
        return view('cbt.examtype',['type'=>$ty]);
    }

    function addtype(Request $request)
    {
        $bid = $this->bid(); $type = $request['type'];
        $validate = Validator::make($request->all(), [
            'type' => 'required|max:200',
        ])->validate();
        
        if(count(Type::where('examtype',$type)->where('bid',$bid)->get())>0){
            return back()->with('error', 'Exam Type Already Exits');
        }

        Type::create([
            'examtype'=>$type,
            'bid'=>$bid,
            'rep'=>$this->uid(),
        ]);
        
        return back()->with('success','Type Add');
    }

    function addexam(Request $request)
    {
        
        $bid = $this->bid(); $type = $request['type']; $subject = $request['subject']; $term = $request['term'];
        $validate = Validator::make($request->all(), [
            'subject' => 'required|max:200',
            'type' => 'required|max:200',
            'term' => 'required|max:200',
        ])->validate();
        
        $tinfo = Setsubject::find($subject);

        $index = $term.$tinfo->classid.$tinfo->sid.$type.$bid;
        
        //return response($index);
        if(count(Exam::where('eindex',$index)->get())>0){
            return back()->with('error', 'Exam Already Exits');
        }

        Exam::create([
            'examtype'=>$type,
            'term'=>$term,
            'code'=>$subject,
            'class'=>$tinfo->classid,
            'subject'=>$tinfo->sid,
            'bid'=>$bid,
            'eindex'=>$index,
            'rep'=>$this->uid(),
        ]);
        
        return back()->with('success','Added Sucessfully Procced To Add Questions');
    }

    function getesn(Request $request){
        session()->put('esn',$request['esn']);
        return redirect('addquestion');
    }


}
