<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Renew;
use App\Models\Slot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\json_decode;

class BillController extends Controller
{
    public function index()
    {
        return view('other.renew');
    }


    public function slotInvoiceIndex()
    {
        return view('other.slotinvoice');
    }


    public function slotindex()
    {   
        $bid = $this->bid();
        $slot = Slot::where('bid',$bid)->orderby('id','desc')->paginate(100);
        return view('other.buyslot',['slots'=>$slot]);
    }


    function balance($id){
        //api for sending
        $uri = 'https:://livepetal.com/petal/processwallet.php?bid='.$id.'';
        return $uri;
    }

    function payProcess($id,$amt,$status,$type,$remark,$opt='')
    {

        $trinfo = [
            'id' => $id,
            'amount' => $amt,
            'status' => $status,
            'type' => $type,
            'remark' => $remark,
            'opt' => $opt,
        ];
        $resp = file_get_contents(env('AURL').'api.php?transaction='.$trinfo);
        return $resp;
    }


    public function clearSlotInvoice(Request $request){
        $bid = $this->bid();  $rep = $this->uid();
        $liveid  = liveId();

        $slot = $request['slot'];  $type = $request['type'];  
        $amount = $slot*500;
        if($type == 1){
            //payment From livepetal wallet
            $mybalance = walletBalance($liveid);
            if($amount > $mybalance){ 
                return back()->with('error', 'You don\'\t have enough  fund in your Livepetal Wallet'); 
            }else{
                $trno = $this->win_hash(10);
                $opt =  $this->bid().$trno;
                //sends the transaction to livepetal to note
                $pay = $this->payProcess($liveid,$amount,2,3,'Student slot Purchase',$opt);
                $response = json_decode($pay);
                if($response->status == 5){
                    //transaction completed                   
                    //make the purchase of slots
                    $this->updateSlotPackage($bid, $rep ,$slot,$trno);
                    return back()->with('success', 'you have sucessfully purchased '.$slot.' slot(s)');
                }else{
                    return back()->with('error','Cannot complete transaction try again');
                }
            }
        }elseif($type == 2){
            //payment with debit/credit card
            //collect payment information and save it to my db in school petal
            //goes to flutterwave and make payment to livepetal\
            //fetches the livepetal balance
            $mybalance = 10000;
            //compares the amount if it will be enough
            //if not enough
            if($amount > $mybalance){ return back()->with('error', 'The fund deposited is not enough'); }
            //if enough
            else{
                //sends the transaction to livepetal to note
                $pay = $this->processPay($rep,$amount,'Slot Purchase',$bid);
                $response = json_decode($pay);
                if($response->status == 5){
                    //transaction completed
                    //make the purchase of slots
                    $trno = $response->trno;
                    $this->updateSlotPackage($bid, $rep ,$slot,$trno);
                    return back()->with('success', 'you have sucessfully purchased '.$slot.' slot(s)');
                }else{
                    return back()->with('error','Cannot complete transaction try again');
                }
            }
        }
        return back()->with('success', 'you have sucessfully purchased '.$slot.' slot(s)');
    }




    public function generateSlotInvoice(Request $request){
        $bid = $this->bid();  $rep = $this->uid();

        $slot = $request['slot'];
        $token = $this->win_hash(8);
        $ck = Slot::where('bid', $bid)->where('active', 0)->get();
        if(count($ck)>0){
            return back()->with('error', 'You have Pending Invoice');
        }else{
            $this->buySlot($bid, $rep ,$slot,$token);
        }

        session()->put('slottoken', $token);
   
        return redirect('slotinvoice')->with('success', 'Invoice Sucessfully Generated');
    }




    function getSlot(Request $request)
    {
        session()->put('slotid',$request['slotid']);
        return redirect('slotinvoice');
    }


    


    public function buySlot($bid, $rep,$tslot,$token){

        $term = $this->term('term'); $sess = $this->term('sess');
        Slot::create([
           'slot' => $tslot, 
           'bid' => $bid,
           'token' => $token,
           'amount' => $tslot*500,
           'term' => $term,
           'sess' => $sess,
           'ctime' => time(),
           'total' => slot($bid, 'total')+$tslot,
           'remain' => slot($bid, 'remain'),
           'package' => 1,
           'active' => 0,
           'rep' =>  $rep,
        ]);
        return $tslot;

    }



    public function updateRenewalPackage($bid, $rep, $created){
        
        $all = ativeStudent($bid);
        //value of four months in seconds
        $m4 = 10518984;
        $n4m = $created + $m4;
        $term = $this->term('term'); $sess = $this->term('term');
        Slot::create([
           'package' => 1, 
           'bid' => $bid,
           'trno' => $this->win_hash(10),
           'amount' => $all*500,
           'term' => $term,
           'sess' => $sess,
           'ctime' => time(),
           'lastsub' => $created,
           'expire' => $n4m,
           'total' => 0,
           'remain' => 0,
           'rep' =>  $rep,
        ]);
        return $m4;

    }





}

