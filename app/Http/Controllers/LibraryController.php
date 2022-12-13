<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Bookcat;
use App\Models\Book;
use App\Models\Book2;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{

    function addbookindex2()
    {
        $bid = $this->bid();
        $cat = Bookcat::where('bid',$bid)->get();
        $book = Book2::where('bid',$bid)->limit(20)->get();
    //    / return response($cat);
        return view('library.addbook',['cats'=>$cat,'books'=>$book]);
    }


    function addbookindex()
    {
        $bid = $this->bid();
        $cat = Bookcat::where('bid',$bid)->get();
        $book = Book::where('bid',$bid)->limit(20)->get();
    //    / return response($cat);
        return view('library.addebook',['cats'=>$cat,'books'=>$book]);
    }

    function createbookcategory(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'cat' => 'required',
          ])->validate();

          Bookcat::create([
              'category'=>$request['cat'],
              'rep' => $this->uid(),
              'bid' => $this->bid(),
          ]);

        return back()->with('success','Book Category Successfully Added');
    }

    public function AddBook(Request $request){

        $bid = $this->bid();
        $name = $request['name'];
        $loc = $_FILES['file']['tmp_name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $file=$_FILES['file']['name'];
       // 
        //if ($ext = $this->booksize($size)) {
            $ext = explode('/', $type);
            
            $ext = strtolower(end($ext));
            
            if ($ext == 'pdf') {
                $new_name = $name.$bid.time();
                //$sql = DB::update("UPDATE users SET photo='$new_name' WHERE bid='$bid' AND level=10 ");
                $bname = $this->win_hashs(20).'.pdf';
                move_uploaded_file($loc,'bussiness/book/'.$bname);
                //return response($ext);
                Book::create([
                    'name' => $request['name'],
                    'bookid' => $this->win_hash(8),
                    'bid' => $bid,
                    'des' => $request['des'],
                    'cat' => $request['cat'],
                    'rep' =>$this->uid(),
                    'file' => $request['file'],
                    'sname' => $bname

                ]);
               
                return back()->with('success',"Book Successfully Added");
            } else {
              return back()->with('error',"Book must be in PDF fromat"); }
        //}
        // else {
        //    return back()->with('error',"Book Size Must Not Be More Than 1MB"); }
  
    }
  
}
