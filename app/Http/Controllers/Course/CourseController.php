<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\Course;
use App\Models\Course\Module;
use App\Models\Setsubject;
use App\Models\Student;
use App\Models\Studentdata;
use App\Models\Classe;
use App\Models\Fee;
use App\Models\Payfee;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{

    function updatepwd(Request $request){
        $bid = $this->bid();
        $sql = DB::select(" SELECT * FROM students WHERE bid='$bid' ");
        foreach($sql as $row){
            $pwd = $this->win_hash(4);
            $password = Hash::make($pwd);
            DB::update("UPDATE students Set pwd=$pwd, password='$password' WHERE id='$row->id' ");
        }

        return response('done!');
    }

    function triggerpay(Request $request){
        $bid = $this->bid();
        $alfee = Fee::where('bid',$bid)->get();
        foreach($alfee as $pf){
            Payfee::create([
                'uid' => $pf->uid,
                'amount' => rand(0,$pf->amount),
                'note' => $pf->fee,
                'bid' => $bid,
                'term' => $pf->term,
                'sess' => $pf->sess,
                'tan' => time(),
                'salesid' => $this->win_hash(9),
                'rep' => $this->uid(),
              ]);
        }

        return response('done !');
    }

    function moduleup(Request $request){
        $bid=$this->bid();
        $mindex=$_POST['ClassUp'];
    
        $sum = 0;
        $sql = DB::select("SELECT * FROM module WHERE bid='$bid' AND mindex < '$mindex' ORDER BY mindex DESC LIMIT 2");
        foreach($sql as $row){$sum += $row->mindex; }
        $sum = (count($sql)<2)?$this->firstindex('module','mindex')/2:$sum;
        $newindex = (int)($sum/2);
        DB::update("UPDATE module SET mindex='$newindex' WHERE mindex='$mindex' AND bid='$bid' ");
        return back();
    }
    
    function moduledown(Request $request){
      $bid=$this->bid();
      $mindex=$_POST['ClassDown'];
    
      $sum = 0;
      $sql = DB::select("SELECT * FROM module WHERE bid='$bid' AND mindex > '$mindex' ORDER BY mindex ASC LIMIT 2");
      foreach($sql as $row){$sum += $row->mindex; }
      $sum = (count($sql)<2)?2*$this->lastindex('module','mindex')+20000:$sum;
      $newindex = (int)($sum/2);
      DB::update("UPDATE module SET mindex='$newindex' WHERE mindex='$mindex' AND bid='$bid' ");
      return back();
    }

    


    function addmoudle(Request $request){


        $val = Validator::make($request->all(),[
            'module'=>'string|required|min:5',
            'description'=>'string|required|min:10',
        ])->validate();

        $index = $this->lastindex('module','mindex')+1000;
        Module::create([
            'module'=>$request['module'],
            'cid'=>$request['cid'],
            'des'=>$request['description'],
            'mindex'=>$index,
            'rep'=> $this->uid(),
            'bid'=> $this->bid(),
        ]);

        
        return back()->with('success',$request['module'].' Added');
    }
    


    function lastindex($table, $col){
		$sql = DB::select("SELECT * FROM $table ORDER BY $col DESC LIMIT 1");
		foreach($sql as $row){
            return $row->$col;
        }
    }

    function firstindex($table, $col){
		$sql = DB::select("SELECT * FROM $table ORDER BY $col ASC LIMIT 1");
		foreach($sql as $row){
            return $row->$col;
        }
    }
    

    



    function dostudent()
    {
        $name = 'Moses,Ogbaji,Salami,Ogbaji,Ogbaji,Omoniyi,Godwin,Jegede,Ogbaji,Moses,Akinkuebi,Ajibade,Faluyi,Fajuyi,Bello,Aboderin,Ogu,Jibrin,Moses,
        Solagbade,Ayo,Fadahunsi,Segun,Iweoma,Moshud,Segun,Taiwo,Ayorinde,Alabi,Olotu,Joseph,Swanson,Akinremi,Sunday,Balogun,Jimoh,Emmanuel,Aderonmu,
        Sijuade,Ogbaji,Ayodeji,Eze,Adebayo,Olagunju,Falade,Olajide,Fayemi,Bello,Arowolo,Adenegan,Olowe,Egbon,Monday,Pius,Aderemi,Nwando,Akinmoladun,
        Jegede,Adegunju,Noel,Adebusuyi,Adebusuyi,Akala,Micheal,Austin,Omojua,Rasheed,Adeyeye,Ajileye,Oladayo,Micheals,Akinyosola,Isinjola,Ogunbayo,
        Ogbaji,Ogbaji,Ademola,Kolawole,Olayode,Oni,Oyebode,Omotosho,Ogendegbe,Adewusi,Babalola,Ibrahim,Ogunniyi,Oladimeji,Adeleke,Duntoye,Oni,Oyegbemi
        ,Olayode,Ademola,Ogunsiji,Olajide,Oladosu,Ademola,Oyebode,Adekanye,Agbomola,Adeleke,Abdulwasii,Ayeni,Ogunsiji,Oladosu,Adeleke,Olayode,Muhammad,
        Ishola,Kolawole,Omotosho,Oyebode,Oladimeji,Oladimeji,Oladimeji,Oyegbemi,Ademola,Adekola,Olawale,Oyegbemi,Olusegun,Kolawole,Obadofin,Jembola,
        Jembola,Kazeem,Ifeanyi,Imoh,Julius,Muritala,Abdulmalik,Rotimi,Akinnawonu,Christopher,Friday,Abdul Hamed,Igim,Abdul Kareem,Akinfe,Fidelis,Godwin
        ,Ogah,Ogbonna,Oluwade,Sunday,Afolabi,Uko,Ebukam,Okunlola,Rotimi,Sunday,Oladipupo,Ezekiel,Gbadegesin,Emmanuel,Adubiaro,Godwin,Isah,Musa,Oyewumi,
        ,Eze,Edwin,Oluwole,Oshin,Okoye,Salawu,Samuel,Emmanuel,Friday,Godwin,Isa,James,John,Moses,Ogunleke,Olega,Oshin,Owolabi,Precious,Thomas,Clement,
        Gabriel,Gabriel,Ibuoye,Jude,Ojo,Nwaocha,Job,Abifade,Atee,Ebokam,Edwin,Isah,Jembola,Oyekunle,Uko,Emmanuel,Ikem,Ismaila,Jacob,Jeremiah,Muhammed,
        Okoye,Omeje,Samuel,Agada,Alara,Abdulmalik,James,Joseph,Samson,Simon,Oyewumi,Adeduro,Abah,Gabriel,Jembola,Agada,Owoeye,Owolabi,Musa,Moses,
        Ipinlaye,Daniel,Sunday,Samuel,Raphael,Ameh,Eze,Akinwale,Ipinlaye,Arogunrerin,Micheal,Abah,Akinrinmade,Blessing,Folorunsho,Jacob,John,Simon,
        Jembola,Yakubu,Rapheal,Akinwale,Aroge,Christopher,Emmanuel,Eze,James,John,Peter,Shaibu,Owolabi,Fapohunda,Mathias,Michael,Fabian,Salawu,Adebagbo
        ,Adebisi,Adekoya,Adepoju,Afolabi,Akinola,Anwo,Azeez,Babayomi,Irewumio,Jimoh,Lasisi,Lawal,Morountonun,Niniola,Ogundiran,Olasunkanmi,Otegbade
        ,Surajudeen,Abdul,Rasheed,Adebayo,Adetoye,Adetunji,Alimi,Fashina,Folarin,Ganiyu,Joshua,Oguntoye,Okunade,Olaniyi,Olaniyi,Olaniyi,Olatundun
        ,Omotosho,Oni,Oyebobe,Yusuf,Adediran,Adetona,Afolabi,Isawuimi,Famuyiwa,Olatoye,Oyelami,Ganiyu,Olajire,Agboola,Ayankule,Adebayo,Addegbite,Ibrahim,
        Olokun,Ayansina,Olawale,Akintoye,Ogunbiyi,Jimoh,Salami,Adetoye,Ajala,Akewusholar,Adegbagbo,Bello,Morontodun,Omotosho,Oladosu,Aina,Olasinde,
        Adekunle,Owolabi,Omotunde,Hammed,Abioye,Folorunsho,Olaore,Fadaunsi,Adeyoyin,Bamigboye,Odugbemi,Omofoye,Babatunde,Olasunkanmi,Olawale,Oni,
        Bakare,Olasunkanmi,Adeoye,Olatundun,Otegbade,Arowolo,Aminulahi,Okedele,Oloyede,Oyewo,Addebagbo,Adebiyi,Alolade,Ayodeji,Bello,Badmus,Famuyiwa,
        Ganiyu,Okike,Olawale';
    
        $na = explode(',',$name); $c= count($na)-1;   $bid = $this->bid();
        $ac = Classe::where('bid',$bid)->get();
        foreach($ac as $a){
            $class[] = $a->id;
        }
        $sex = ['MALE','FEMALE'];
        for ($i=0; $i <=500 ; $i++) { 
            $ind = rand(0,$c); $ind1 = rand(0,$c); $ind2 = rand(0,$c);

        
            $regno = $this->win_hashss(20);
            $uid = $this->win_hashs(10);
            Student::create([
                'regno' => $regno,
                'uid' => $uid,
                'rep' => auth()->user()->sid,
                'bid' => auth()->user()->bid,
                'surname' => trim($na[$ind]),
                'firstname' => trim($na[$ind1]),
                'midname' => trim($na[$ind2]),
                'class' => $class[rand(0,count($class)-1)],
                //'arm' => $request['arm'],
                'sex' => $sex[rand(0,count($sex)-1)],
                'sess'=> $this->term('sess'),
                'password' => Hash::make(trim(strtolower($na[$ind]))),
                'username' => trim($na[$ind]).trim($na[$ind1]).substr($regno,0,5)
            ]);


            //creating the student profile in the studentdata table
            Studentdata::create([
                'uid' => $uid,
                'rep' => auth()->user()->sid,
                'bid' => auth()->user()->bid,
            ]);
        }

            return response('done !');

        }



        

    function chapindex($sn)
    {
        $csn = $sn;
        $c = Course::find($sn); 
        if($c->bid != $this->bid()){ return redirect('dashboard')->with('error','Unauthorized Page'); }
        //return response($c->bid);
        $module = Module::where('cid',$csn)->orderby('mindex','ASC')->paginate(100);

        return view('course.addmodule',['module'=>$module,'course'=>$c]);
    }


    public function index()
    {   
        $uid = $this->uid(); $bid = $this->bid();
        $sub = Setsubject::where('uid',$uid)->get();
        $course = Course::where('bid',$bid)->get();
        return View('course.createcourse',['subject'=>$sub,'course'=>$course]);
    }

    function addcourse(Request $request)
    {
        $bid  = $this->bid(); $cou = $request['subject']; $term = $request['term'];
        $validate = Validator::make($request->all(), [
            'subject' => 'string|max:255',
            'term' => 'string|max:3',
            'description' => 'string',
          ])->validate();

        $sub = Setsubject::find($cou);
        $subject = $sub->sid;
        $class = $sub->classid;

        $cindex = $bid.$subject.$class.$term;

        //return response($cindex);
        if(count(Course::where('cindex',$cindex)->get())>0){
            return back()->with('error','Course Already Exist');
        }

        $loc = $_FILES['photo']['tmp_name'];
        $size = $_FILES['photo']['size'];
        $type = $_FILES['photo']['type'];
        //return response($loc);
        if ($ext = $this->imagesize($size)) {
            $ext = explode('/', $type);
            $ext = strtolower(end($ext));
            if ($new_name = $this->imagetype($ext)) {
                $new_name = $bid.time(). '.' . $ext;
                move_uploaded_file($loc,'bussiness/sch/'.$new_name);
                Course::create([
                    'course'=> $subject,
                    'class' => $class,
                    'rep' => $this->uid(),
                    'bid' => $bid,
                    'photo' => $new_name,
                    'info' =>$request['description'],
                    'cindex' =>$cindex,
                    'term' => $term,
                ]);
                return back()->with('success',"Course Added Sucessfully Proceed To Add Chapters");
            } else {
            return back()->with('error',"Image Must Be in Jpeg,Jpg or Png Format"); }
        }

       


    }
}
