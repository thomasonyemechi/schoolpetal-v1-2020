<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Power;
use App\Models\Smssetup;
use App\Models\Grade;
use App\Models\School;
use App\Models\Userhour;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

//use Laravel\Fortify\Contracts\CreatesNewUsers;





class SignupController extends Controller
{
  //use PasswordValidationRules;


  public function signup(Request $request)
    {
      //
      // $this->validate($request,[
      //     // 'name' => 'required|string|max:5',
      //     // 'email' => 'required|string|email|max:255|unique:users',
      //     // 'manager' => 'required|string|max:100',
      //     // 'phone' => 'required|max:15',
      //     // 'phone2' => 'max:15',
      //     // 'address' => 'required|string|max:255',
      //     // 'website' => 'string|max:200',
      //     // 'motto' => 'required|string|max:250',
      //     // 'password' => 'required|confirmed',
      //         // 'name' => ['required', 'string', 'max:5'],
      //         // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      //         // 'manager' => ['required', 'string', 'max:100'],
      //         // 'phone' => ['required', 'max:15'],
      //         // 'phone2' => ['max:15'],
      //         // 'address' => ['required', 'string', 'max:255'],
      //         // 'website' => ['string', 'max:200'],
      //         // 'motto' => ['required', 'string', 'max:250'],
      //         // 'password' => ['required', 'confirmed'],
      //   ]);

      //generzating bussiness and user id number
      $bid = $this->win_hash(8);
      $sid = $this->win_hashs(10);

      //capturing the activation and expiry date of the product
      $active = time();
      $expires = $active+31536000;

      //validating form inputs
      $validate = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'manager' => 'required|string|max:100',
        'phone' => 'required|max:15',
        'phone2' => 'max:15',
        'address' => 'required|string|max:255',
        'website' => 'string|max:200',
        'motto' => 'required|string|max:250',
        'password' => 'required|confirmed',
      ])->validate();

      //creating the user/admin account for the shool
       User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'manager' => $request['manager'],
        'phone' => $request['phone'],
        'phone2' => $request['phone2'],
        'address' => $request['address'],
        'website' => $request['website'],
        'motto' => $request['motto'],
        'password' => Hash::make($request['password']),
        'bid' => $bid,
        'sid' => $sid,
        'level' => 10,
      ]);

      //craeting the school account
      School::create([
       'name' => $request['name'],
       'email' => $request['email'],
       'manager' => $request['manager'],
       'phone' => $request['phone'],
       'phone2' => $request['phone2'],
       'address' => $request['address'],
       'website' => $request['website'],
       'motto' => $request['motto'],
       'password' => Hash::make($request['password']),
       'bid' => $bid,
       'sid' => $sid,
       'active' => $active,
       'expires' => $expires,
       'status' => 1,
      ]);

      //adding the school grades
      Grade::create([
       'bid' => $bid,
      ]);

      Power::create([
        'uid' => $sid,
        'bid' => $bid
      ]);

      DB::update("UPDATE power SET power=1 WHERE uid='$sid' ");

      //creating the hours of work per day
      Userhour::create([
       'uid' => $sid,
       'bid' => $bid,
      ]);
      //creating the sms apicol
      Smssetup::create([
        'bid' => $bid,
      ]);
    //end
        return redirect('login')->with('success', 'School Registered Created Sucessfully');
    }

  // public function register(Request $request)
  // {
  //
  //     // validation..
  //     $validatedData = $request->validate([
  //         'name' => 'required|max:225',
  //         'email' => 'email|required|unique:users',
  //         'password' => 'required|confirmed'
  //     ]);
  //
  //     //encrypt the password...
  //     $validatedData['password'] = bcrypt($request->password);
  //
  //     //create the data ..
  //     $user = User::create($validatedData);
  //     //return the data and the access token created..
  //     return redirect('dashboard')->with('success', 'Refistered Sucessfully');
  // }
  //






}
