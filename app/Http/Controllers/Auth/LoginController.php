<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
  // public function authenticate(Request $request){
  //   // Retrive Input
  //   $credentials = $request->only('email', 'password');
  //
  //   if (Auth::attempt($credentials)) {
  //       // if success login
  //
  //       return redirect('dashboard');
  //
  //       //return redirect()->intended('/details');
  //   }
  //   // if failed login
  //   return redirect('login');
  // }

  public function login(Request $request)
  {
      //validatiing passed information
      $loginData = $request->validate([
          'email' => 'email|required',
          'password' => 'required'
      ]);
      //checking for errors
      if (!auth()->attempt($loginData)) {
          return redirect('login')->with('error', 'Invalid Credentials');
      }
      // if(auth()->user()->status==0){
      //   //unset_session($_SESSION['userid']);
      //   return redirect('login')->with('error', 'Your account ahs been deactivated');
      // }

      //$accessToken = auth()->user()->createToken('authToken')->accessToken;
      //acesssing the user information
      $userid = auth()->user()->id;
      // sessionig the userid
      $request->session()->put('userid', $userid);
      $sinfo = ['img'=>$this->simg('photo'),'name'=>$this->simg('name')];
      session()->put('sinfo', $sinfo);
      //redirecting client
      if(auth()->user()->act == 0 AND auth()->user()->level != 10){
          session()->flush();
        return back()->with('error','You have not been authorized to access this portal, please contact your director or manager');
      }elseif(auth()->user()->level == 0){
        session()->flush();
        return back()->with('error','No role has being assigned to you');
      }

      return redirect('dashboard')->with('success', 'Welcome Back');

  }


  public function studentlogin(Request $request)
  {
      //validatiing passed information
      $loginData = $request->validate([
          'username' => 'required',
          'password' => 'required'
      ]);
      //checking for errors
      if (auth()->guard('student')->attempt($loginData)) {
    //if (!auth()->guard('student')->attempt(['username'=>$request['username'],'password'=>$request['password']])) {
      $me = DB::table('students')->where('username',$request['username'])->get();
      foreach($me as $r){
        $id = $r->uid;
        $status = $r->status;
      }
      // if($status == 0){
      //   session()->flush();
      //   return back()->with('error','Your Account has Been deactivated');
      // }
      session()->put('student_idx',$id);
      return redirect('mydashboard')->with(['success' => 'Welcome Back']);
          
      }

    return redirect('studentaccess')->with('error', 'Invalid Credentials');
      

  }


  public function studentlogin2(Request $request)
  {
      //validatiing passed information
      $loginData = $request->validate([
          'username' => 'required',
          'password' => 'required'
      ]);
      //checking for errors
      if (auth()->guard('student')->attempt($loginData)) {
      $me = DB::table('students')->where('username',$request['username'])->get();
      foreach($me as $r){
        $id = $r->uid;
        $status = $r->status;
      }
      // if($status == 0){
      //   session()->flush();
      //   return back()->with('error','Your Account has Been deactivated');
      // }
      session()->put('student_idx',$id);
      return redirect('mydashboard')->with(['success' => 'Welcome Back']);
          
      }

    return redirect('studentaccess')->with('error', 'Invalid Credentials');
      

  }



}
