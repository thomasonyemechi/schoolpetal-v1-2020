<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Gurdian;

class ParentController extends Controller
{
    //

    function index()
    {
      $bid = $this->bid();
      $parents = Gurdian::where('bid',$bid)->paginate(100);
        return view('student.addparent',['parents'=>$parents]);
    }

    function spdate($id){
      
    }

    function shuffle(Request $request){
      $bid = $this->bid();
      $student = DB::select("SELECT * FROM students where bid='$bid' order by rand() ");
      $parent  = DB::select("SELECT * FROM parent where  bid = '$bid' order by rand() ");
      foreach($parent as $ro){
        $parents[] = $ro->uid;
      }
      foreach($student as $row){
        $pid = $parents[rand(0,count($parent)-1)];
        DB::update("UPDATE  students set parent='$pid' where uid='$row->uid' ");
      }
      return response('done!');
    }


    
    function doparent()
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
       
        for ($i=0; $i <=735 ; $i++) { 
            $ind = rand(0,$c); $ind1 = rand(0,$c); $ind2 = rand(0,$c);

            $ind3 = rand(0,$c); $ind4 = rand(0,$c); $ind5 = rand(0,$c);

            $pwd = strtolower($na[$ind]) ;
            $uid = $this->win_hashs(10);
            //creating the student profile in the studentdata table
            //return response($request['address']);
            Gurdian::create([
              'uid' => $uid,
              'rep' => auth()->user()->sid,
              'bid' => auth()->user()->bid,
              'phone' => $this->win_hash(10),
              'motheremail' => ''.trim($na[$ind]).''.trim($na[$ind1]).'@gmail.com',
              'address' => '',
              'pname' => ''.trim($na[$ind3]).' '.trim($na[$ind4]).'',
              'phone2' => $this->win_hash(10),
            //   'state' => '',
            //   'lga' => $request['lga'],
            //   'occupation' => $request['occupation'],
            //   'occupation2' => $request['occupation2'],
            //   'officeadd' => $request['officeadd'],
            //   'officeadd2' => $request['officeadd2'],
              'mname' => ''.trim($na[$ind]).' '.trim($na[$ind1]).'',
              'mphone' => $this->win_hash(10),
              'fatheremail' => ''.trim($na[$ind3]).''.trim($na[$ind4]).'@gmail.com',
              'password' => Hash::make($pwd),
              'pwd' => $pwd
            ]);


        }

            return response('done !');

        }



        




    public function RegisterParent(Request $request)
    {
        $pwd = $request['password'];
        $validate = Validator::make($request->all(), [
          'FatherEmail' => 'required|string|email|max:255|unique:parent',
          'MotherEmail' => 'required|string|email|max:255|unique:parent',
          'password' => 'required|confirmed',
        ])->validate();
        $uid = $this->win_hashs(10);
        //creating the student profile in the studentdata table
        //return response($request['address']);
        Gurdian::create([
          'uid' => $uid,
          'rep' => auth()->user()->sid,
          'bid' => auth()->user()->bid,
          'phone' => $request['phone'],
          'motheremail' => $request['MotherEmail'],
          'address' => $request['address'],
          'pname' => $request['pname'],
          'phone2' => $request['phone2'],
          'state' => $request['state'],
          'lga' => $request['lga'],
          'occupation' => $request['occupation'],
          'occupation2' => $request['occupation2'],
          'officeadd' => $request['officeadd'],
          'officeadd2' => $request['officeadd2'],
          'mname' => $request['mname'],
          'mphone' => $request['phone2'],
          'fatheremail' => $request['FatherEmail'],
          'password' => Hash::make($pwd),
          'pwd' => $pwd
        ]);

    return back()->with('success','Parent Sucessfully Added');
    }
    
}
