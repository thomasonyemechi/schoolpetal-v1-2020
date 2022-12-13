<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//depenidng on these facades
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Term;
use App\Models\User;
use App\Models\Userhour;


class SetupController extends Controller
{
    public function generalindex()
    {
      if(auth()->user()->level < 9){return redirect('dashboard')->with('error','Unauthrized Page'); }
      $terms = Term::where('bid',$this->bid())->orderby('id')->get();
      $user = User::find(auth()->user()->id);
      
   
      return view('other.gsetup',['terms'=>$terms, 'user'=>$user]);
    }

    public function adminindex()
    {
       $bid = $this->bid();
       if(auth()->user()->level < 9){return redirect('dashboard')->with('error','Unauthrized Page'); }
       $user = DB::select("SELECT * FROM users WHERE bid ='$bid' AND level=0 ");
       $admin = DB::select("SELECT * FROM users WHERE bid ='$bid' AND level between 5 and 9 ");
       if(session()->has('staffid')){
         $qu  = User::find(session()->get('staffid'));
         $userh = DB::table('userhours')->where('uid',$qu->sid)->get();
         //return response($userh);
         return view('other.adminsetup',['users'=>$user,'admins'=>$admin,'hours'=>$userh ]);
      }

       return view('other.adminsetup',['users'=>$user,'admins'=>$admin]);
    }

    public function UpdateTitleLogo(Request $request){

      $bid = $this->bid();
      $name = $request['name1'];
      $nick = $request['nick1'];
      $loc = $_FILES['photo']['tmp_name'];
      $size = $_FILES['photo']['size'];
      $type = $_FILES['photo']['type'];
      if ($ext = $this->imagesize($size)) {
          $ext = explode('/', $type);
          $ext = strtolower(end($ext));
          if ($new_name = $this->imagetype($ext)) {
              $new_name = $name . $nick .time(). '.' . $ext;
              $sql = DB::update("UPDATE users SET photo='$new_name' WHERE bid='$bid' AND level=10 ");
              move_uploaded_file($loc,'bussiness/sch/'.$new_name);
              return redirect('generalsetup')->with('success',"Logo Successfully Updated");
          } else {
            return redirect('generalsetup')->with('error',"Image Must Be in Jpeg,Jpg or Png Format"); }
      }
      else {
         return redirect('generalsetup')->with('error',"Image Size Must Not Be More Than 1MB"); }

  }

    public function updateinfo(Request $request)
    {
       $bid = $this->bid(); $id = auth()->user()->id;
       if(auth()->user()->level < 9){return redirect('dashboard')->with('error','Unauthrized Page'); }
       // $validate = Validator::make($request->all(), [
       //   'name' => 'string|max:255',
       //   'manager' => 'string|max:100',
       //   'phone' => 'max:15',
       //   'phone2' => 'max:15',
       //   'address' => 'string|max:255',
       //   'website' => 'string|max:200',
       //   'motto' => 'string|max:250',
       // ])->validate();

       //$id = $request=['id'];

      //  $user = User::find($id);
      //  $user->name = $request->input('name');
      //  $user->manager = $request->input('manager');
      //  $user->phone = $request->input('phone');
      //  $user->phone2 = $request->input('phone2');
      //  $user->address = $request->input('address');
      //  $user->website = $request->input('website');
      //  $user->motto = $request->input('motto');
      //  $user->save();




       return redirect('generalsetup')->with('success', 'updated Sucesfully');
    }

    public function adduser(Request $request)
    {
       $bid = $this->bid();
       $id  = $request['staff'];
       $validate = Validator::make($request->all(), [
         'staff' => 'required|max:20',
         'role' => 'required|max:5',
       ])->validate();

       $user = User::find($id);
       $user->level = $request->input('role');
       $user->save();

       Userhour::create([
         'uid' => $user->sid,
         'bid' => $bid,
       ]);

       $log = 'User Sucessfully assigned a role '.$this->sqLx('users','id',$id,'name'); $this->addlog($log,1);
       return redirect('adminsetup')->with('success',$log);
    }


    public function UpdateOperatingHr(Request $request)
    {   
      $srep=$request['UpdateOperatingHr'];      
      $i=1;
      while($i<=7){
         $e=$i++;  $a = 'a'.$e;  
         $b = 'b'.$e;
         $$a = $request[$a];
         $$b = $request[$b];
      }      
      $sql = DB::update("UPDATE userhours SET a1='$a1',b1='$b1',a2='$a2',b2='$b2',a3='$a3',b3='$b3',a4='$a4',b4='$b4',a5='$a5',b5='$b5',a6='$a6',b6='$b6',a7='$a7',b7='$b7'  WHERE id = '$srep' ");
      return redirect('adminsetup')->with('success','User Operating Hours Successfully Updated');
   }

   public function UserShutdown(Request $request)
   {  
      $cs = session()->get('user');
	   $s=$request['UserShutdown'];
      if($s==1){ $state = 0; $act = 'De-activated'; }elseif($s==0){$state = 1; $act = 'Activated';}
      //return response($s);
	   $sm = DB::update("UPDATE users SET act=$state WHERE id = $cs->id ");
      session()->put('user',User::find(session()->get('staffid')));
	   return redirect('adminsetup')->with('success','You have successfully '.$act.' user access of '.$cs->name);
   }

   public function pick(Request $request)
   {
     $user = User::find($request['staff']);
     $request->session()->put('user',$user);
     $request->session()->put('staffid',$request['staff']);
     return redirect('adminsetup');
   }



   public function updaterole(Request $request)
   {
    $af = User::where('id',$request['id'])->update(['level'=> $request['role']]);
    session()->forget('user');
    session()->forget('staffid');
    return back()->with('success','Role Sucessfully Update');
   }


}
