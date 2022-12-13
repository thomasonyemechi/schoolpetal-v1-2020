<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(Request $request){
      $title = 'welcome to gideon pages';
        //return view('pages.index', compact('title'));
        //getiing all session data
        $request->session()->put('key', $title);

        //$data = $request->session()->all();
        return view('school.index')->with('title', $title);
    }

    public function about(){
      $title = 'About Gideon';
        return view('school.about')->with('title', $title);
    }

    public function services(){
      $data = array(
        'title' => 'Services',
        'services' => ['Web Design', 'Programming', 'SEO']
      );
        return view('pages.services')->with($data);
    }
    public function RegisterStudent(){
        return view('registerstudent');
    }
}
