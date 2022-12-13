<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Stock;
use App\Models\Unstock;
use App\Models\Unstocked;
use App\Models\Supply;



use Illuminate\Support\Facades\DB;

class Genstock extends Controller
{
    //

           public function fetch() {  

            $bid = $this->bid();
            $qus_array = [];

            $qus =DB::select("SELECT * FROM cat WHERE bid='$bid'");
            if($qus>0) {
            foreach ($qus as $qu) {
                $qus_cat = $qu->cat;
                $qus_array = DB::select("SELECT * FROM stock WHERE cat='$qus_cat' AND bid ='$bid' ORDER BY item ASC "); 
               return  $qus_array;
            }
        }
        
              
            
        }  

        public function index()   {
            
            $bid = $this->bid();
            $qus =DB::select("SELECT * FROM cat WHERE bid='$bid'");
            $qus_array = $this->fetch();
            return view('sales.genstocks',['qus'=>$qus,'numb'=>1,'qus_array'=>$qus_array]);
        }


      public function add_supplier(Request $request) {

                
         $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
           
        ]);

        $supply = new Supply();
        $supply->bid = $this->bid();
        $supply->name = $request['name'];
        $supply->address = $request['address'];
        $supply->phone = $request['phone'];
        $supply->rep = auth()->user()->id;
        $save =  $supply->save();
         
        return redirect('restocks')->with('success', 'Supplier has been added successfully');
        

      }
           

    
      public function  stock_profile() {
            $bid = $this->bid(); 
            $get_pin   =       session()->get('pin');

            $unstock =         Unstock::where('bid',$bid)->where('pin', $get_pin)->get();   
            $stocks =          Stock::where('bid',$bid)->get();
            $stock_pin =       Stock::where('pin',$get_pin)->where('bid',$bid)->get();
            session()->put('stock_pin',$stock_pin);
            $unstocked  = Unstocked::where('bid',$bid)->get();
            return view('sales.stockprofile',['stocks'=>$stocks, 'stock_pins'=>$stock_pin,'unstock'=>$unstock,'unstockeds'=> $unstocked]);
      }
      
   
      public function profile(Request $request) {
           $item_pin =   $request['itempin'];
           $bid    = $this->bid();
           $request->session()->put('pin',$item_pin);
           $stocks =    Stock::where('bid',$bid)->where('pin',$item_pin)->get(); 
           foreach( $stocks  as $stock) {
               session()->put('protype',$stock->type);
               session()->put('procat',$stock->cat);
               session()->put('prodes',$stock->des);
               session()->put('proitem',$stock->item);
               session()->put('proqty',$stock->qty);
               session()->put('propin',$stock->pin);
               session()->put('prounitprice',$stock->unitprice);
               session()->put('propackprice',$stock->packprice);
               session()->put('propqty',$stock->pqty);
               session()->put('prostatus',$stock->status);
           }
        

           return redirect('profile');

      }
    
        
    
}
