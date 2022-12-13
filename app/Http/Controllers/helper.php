<?php 
use Illuminate\Support\Facades\DB;
use App\Models\Slot;
function role($role)
{
    if($role == 9){
        $name = 'Administrator';
    }elseif($role == 8){
        $name = 'Accountant';
    }elseif($role == 7){
        $name = 'Teacher';
    }elseif($role == 6){
        $name = 'Sales Rep';
    }elseif($role == 5){
        $name = 'Liberian';
    }
    return $name;
} 

function cr($val,$role)
{        
    $som = ($role == $val)?'selected':'';
    return $som;
}


//total student
function totalStudent($bid)
{
    $allstudent = count(DB::table('students')->where('bid',$bid)->get());
    return $allstudent;
}

//total avtive student
function ativeStudent($bid)
{
    $allstudent = count(DB::table('students')->where('bid',$bid)->where('active', 1)->get());
    return $allstudent;
}

function slot($bid,$col='total')
{
    $lastSlot = Slot::where('bid',$bid)->where('active',1)->get()->last();
    if($col == 'total'){
        return $lastSlot->total;
    }elseif($col == 'remain'){
        return $lastSlot->total-totalStudent($bid);
    }else{
        return $lastSlot->$col;
    }
}


function slotInfo($token,$col)
{
    $slot = Slot::where('token',$token)->get()->last();
    return $slot->$col ;
}


function rName($rep,$col='name'){    
    $sql=DB::select("SELECT * FROM users WHERE sid='$rep' LIMIT 1 " );
    foreach($sql as $row){
        return $row->$col;
    }
}


function remark($id,$class,$term,$sess,$col='')
{
    $r = \App\Models\Remark::where('class', $class)->where('student', $id)
    ->where('term', $term)->where('sess', $sess)->first();
    return @$r->$col;
}


function remarkOn($id,$class,$term,$sess,$col='')
{
    $r = \App\Models\Remark::where('class', $class)->where('student', $id)
    ->where('term', $term)->where('sess', $sess)->first();
    return $r->$col;
}

function liveId()
{
    return 'ht05gd4d';
}


function walletBalance($id)
{
    $resp = file_get_contents(env('AURL').'api.php?userid='.$id);
    //var_dump($resp);
    //echo gettype(json_decode($resp,TRUE));
    $resp = json_decode($resp,TRUE);
    $bal = $resp['balance'];
    return $bal;
}


function fetchLastTermResultBySubject($uid, $subject, $term, $sess, $class)
{
    $res = DB::table('result')
    ->where('uid',$uid)
    ->where('class',$class)
    ->where('subject',$subject)
    ->where('term', $term)
    ->where('sess', $sess)
    ->first();
    $total = @$res->t1+@$res->t2+@$res->t3;
    $overall = @$res->exam+$total;
    return $overall ?? 0;   
}



function ptmtTerm($term, $sess, $bid, $arr=0, $val='sess')
{

    $res = DB::table('term')->where('term', $term)
    ->where('sess', $sess)->where('bid', $bid)->first();
    $cid = $res->id; $term = $res->term;
    $year =  explode('/',$res->sess);

    $fq = DB::table('term')->where('id', '<', $cid)->where('term', '<', $term)->orderBy('id', 'DESC')->limit(2)->where('bid', $bid)->get();
    $dt = [];
    for($i = 0; $i <= 2; $i++)
    {
        $y = $fq[$i]->sess ?? '0/0';
        // $ye = explode('/', $y);

        if( ($y[0] > 0) AND ( $y[0] <= $year[0] ) ){
            $dt[] = [
                'sess' => $y,
                'term' => $fq[$i]->term ?? 0,
            ];
        }else{
            $dt[] = [
                'sess' => 0,
                'term' => 0,
            ];
        }
        
    }
    return $dt[$arr][$val];
}
