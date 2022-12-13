<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Expitem;
use App\Models\Expend;
use App\Models\Supply;

class ExpenditureController extends Controller
{




  function expenseCheckout(){
  $ymd = date('ymd');    
    $bid = $this->Bid();
    $salesid = (session()->has('expense'))?session()->get('expense'):'';
    $rep = $this->uid();
    
    $invoice = session()->get('expense');
    $cash = $_POST['cash'];

    $vid = $_POST['vid'];
    $amount = $_POST['total'];
    $name = $this->vName($vid); 

                  
    if($amount==0){ 
      return back()->with('success','A transaction error occured with invoice ID: #'.$salesid);
    } else{ 
      $res2 = DB::insert("INSERT INTO expend2 (salesid,id,inv,amount,cash,name,rep,bid,today)
      VALUES('$salesid','$vid','$invoice','$amount','$cash','$name','$rep','$bid','$ymd')") or die(mysqli_error('Server Error')); 

      $resk = DB::update("UPDATE expend SET status = 1, vendor='$vid' WHERE salesid = '$salesid' AND  bid = '$bid' ") or die(mysqli_error('cannnot connect 1'));
      if($cash>0){
        $sql = DB::insert("INSERT INTO payout (id,name,salesid,amount,note,rep,bid,today)
        VALUES('$vid','$name','$salesid','$cash','expend amount','$rep','$bid','$ymd')") or die(mysqli_error('cannot connect2'));    
    }

    }

    session()->forget('expense');
    return back()->with('success','You have successfully closed an expense invoice with invoice ID: #'.$salesid);
 
    }


  public function index()
  {
      $item = Expitem::where('bid',$this->bid())->orderby('id','DESC')->get();
      $salesid = (session()->has('expense'))?session()->get('expense'):'';
      $exp = Expend::where('bid',$this->bid())->where('salesid',$salesid)->orderby('id','DESC')->get();
      
      $sup = Supply::where('bid',$this->bid())->orderby('id','DESC')->get();
      //if(session()->has('expend')){}
      if($salesid != ''){
        foreach($exp as $s){
          $my[] = $this->sqLx('expitem','id',$s->expid,'item');
        }
        return view('other.expenditure2',['items' => $item,'exps' => $exp,'supp' => $sup,'iname'=>$my]);
      }
      return view('other.expenditure2',['items' => $item,'exps' => $exp,'supp' => $sup]);
  }



  public function addExpenditureType(Request $request)
  {
      $validate = Validator::make($request->all(), [
        'ExpenseCategory' => 'string|max:255',
        'ExpenseDescription' => 'string|max:255',
      ])->validate();

      Expitem::create([
        'item' => $request['ExpenseCategory'],
        'des' => $request['ExpenseDescription'],
        'today' => time(),
        'bid' => $this->bid(),
        'rep' => auth()->user()->sid,
      ]);

      return redirect('expenditure')->with('success', 'Expense type added sucessfully');
  }

  public function addExpenditure(Request $request)
  {
      $validate = Validator::make($request->all(), [
        'cat' => 'required|string|max:255',
        'amount' => 'required|integer',
        'agent' => 'required|string|max:55',
        'description' => 'required|string|max:255',
      ])->validate();

      $salesid = (session()->has('expense'))?session()->get('expense'):$this->win_hash(10);
      session()->put('expense',$salesid);

      Expend::create([
        'expid' => $request['cat'],
        'salesid' => $salesid,
        'amount' => $request['amount'],
        'name' => $request['agent'],
        'des' => $request['description'],
        'bid' => $this->bid(),
        'rep' => auth()->user()->sid,
      ]);

      return redirect('expenditure')->with('success', 'Expenditure sucessfully entered');
  }

  public function deleteExpenditure(Request $request)
  {
      $id = $request['delete'];
      DB::delete("DELETE FROM expend WHERE id=$id ");

      return redirect('expenditure')->with('success', 'Expenditure sucessfully Deleted');
  }
  public function addSupplier(Request $request)
  {
      $validate = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'phone' => 'required',
        'address' => 'required|string|max:255',
      ])->validate();

      Supply::create([
        'name' => $request['name'],
        'phone' => $request['phone'],
        'address' => $request['address'],
        'bid' => $this->bid(),
        'rep' => auth()->user()->sid,
      ]);

      return redirect('expenditure')->with('success', 'Supplier sucessfully added');
  }

}
