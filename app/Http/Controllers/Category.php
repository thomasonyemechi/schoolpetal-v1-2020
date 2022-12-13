<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Cat;
use App\Models\Stock;

class Category extends Controller
{
    //

            //post and get for add category

                public function category() {
                        $rows =Cat::orderBy('id','asc')->get();
                    
                        return view('sales.addcategory',['rows'=>$rows]); 
                }

                public function add_category(Request $request) {
                
                    $this->validate($request,[
                        "cat"=>"required"
                    ]);  
                    
                    $cat = $request['cat'];
                    Cat::create([
                        'cat' => $cat,
                        'rep' => auth()->user()->id,
                        'bid' => $this->bid()
                    ]);
                

                    $success =  'Product Category added successfully '.$cat;
                    return redirect('createitem')->with('success', $success); 
                  }



                  

          //post and get for add items
            public function add_item() {
                
                //find table
                $bid =  $this->bid();
                $rows = DB::select("SELECT * FROM cats WHERE bid='$bid'");
                $stocks = Stock::where('bid',$bid)->get();
                $items = Stock::where('bid',$bid)->orderBy('id','desc')->take(20)->get();

                
                return view('sales.additem',['rows'=>$rows,'stocks'=>$stocks,'items'=>$items]); 

            }

                public function post_item(Request $request)  {
                    
                    $this->validate($request,[
                        "itemcategory"=>"required",
                        "item" => "required|string",
                        "des" =>  "required|string",
                        "type" =>  "required"
                    ]);  
                    
                $item = $request['item'];
                $cat   = $request['itemcategory'];
                    Stock::create([
                        'cat' => $cat,
                        'bid' => $this->bid(),
                        'des'  => $request['des'],
                        'rep'  => auth()->user()->sid,
                        'item' => $item,
                        'pin'  => $this->win_hash(12),
                        'type' => $request['type'],
                                        
                    ]);
                        

                    $success =   $item.'  item  added successfully';
                    // $request->session()->put('cat',$cat);
                    // $get_cat = Stock::where('cat',$cat)->get();
                    // $request->session()->put('cats',$get_cat);

                    return redirect('createitem')->with('success',$success); 
            
                }

}
