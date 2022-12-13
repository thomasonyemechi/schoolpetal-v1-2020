@extends('layouts.app')

@section('content')
<?php 

$un = new App\Http\Controllers\Unstock;
$sta = new App\Http\Controllers\ProfileCOntroller;

$sales = session()->has('salesid')?session()->get('salesid'):'';
$sum=0;
$pid = session()->get('pid');
if($pid){
   foreach ($sins as $pit){
        $item = $pit->item;
        $price = $pit->unitprice;
        $cost = $pit->unitcost;
 }

}
   
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Point of Sale
            <small>POS</small></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">AddNew Student</li>
          </ol> --}}
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active" ><e style="font-size:16px"><?php echo strtoupper(date('D, d M. Y')) ?> | </e><e id="updatetime" style="font-size:18px"></e></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

   


<section class="content">
    <div class="row">
      <!-- left column -->
      <div class="col-md-6">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header" style="padding-bottom:0">
            <h3 class="card-title">Quick Search</h3>
          </div>
          <div class="card-body no-pad-top">
          
           
           
            <p><form method="post" action="{{route('postitempin')}}">
              @csrf
              <select name="itempin" class="form-control select2" onChange="submit()"  style="width: 100%"> 
                           
                           <option value="" selected disabled>...search item </option> 
                           @foreach($stocks as $stock)
                                <option value="{{$stock->id}}">{{$stock->item}}</option>
                           @endforeach
              </select>
              </form>
            </p>  
            <?php if($pid){ $qty = $un->itemqty($pid); $col = ($qty == 0)?'danger':'success'; ?>
                 

                    <div class="table-responsive mt-5">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="btn-{{$col}}"><td colspan="5"><h4>
                                    <b>{{ucwords($item)}}</b><h4></th></tr>
                                <tr>
                                    <th>Unit Price</th>
                                    <th>Qty In Store </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$price}} </td>
                                    <td>{{$qty}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                 
   
   
                  <div class="tab-content">
                      <div class="tab-pane active container" id="unit">
                      <form method="post" action="{{route('unitSales')}}">
                              @csrf
                              <div class="row">
                                  <div class="col-md-4 col-6">
                                      <div class="form-group">
                                          <label>Quantity</label>
                                      <input class="form-control" type="text" name="qty" value="1" />
                                      </div>
                                  </div>
                                  <div class="col-md-4 col-6">
                                      <div class="form-group">
                                          <label>Unit Price</label>
                                      <input class="form-control"  type="text" name="price" value="{{$price}} "/>
                                      </div>
                                  </div>
                                  <div class="col-md-4"><br>
                                    <button type="submit" class="btn btn-primary btn-block mt-2">Add Unit</button>
                                  </div>
                              </div>   
                          
                                
                          </form>
                      </div>

                
                  </div>
                <?php } ?>
      
                  
                 
          </div>
        </div>
      </div>
     {{---end of first 6 column---}}

     
     <div class="col-md-6">
      <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Current Cart</h3></div>
            <div class="card-body">
                  
              <div class="table-responsive">
                <table id='example1' class="table table-sm table-hover" >
                  <tr>
                    <th>Sn</th>
                    <th>Item</th>
                    <th>Qty</th>
                    
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Action</th>
                 </tr>

                 <tbody> 
                   <?php $i =0; if($pid){ foreach ($csel as $cs) { $i++; $sum += $cs->amount ?>
                    <tr>
                      <td>{{$i}} </td>
                      <td>{{$cs->item}} </td>
                      <td>
                        <form action="/EditLinePos" method="post"> @csrf
                          <input class="form-control form-control-sm" style="width: 40px; border-top: none;border-left: none;border-right: none;  text-align: center; padding: 5px 2px"
                           type="number" min="1" max="999" name="qty" value="{{$cs->qty}}" onchange="submit()"><input type="hidden" name="EditLinePos" value="{{$cs->id}}">
                           <input type="hidden" name="price" value="{{$cs->price}}"><input type="hidden" name="pid" value="{{$cs->pid}}"></form></td>


                      <td>{{$cs->price}} </td>
                      <td>{{$cs->amount}} </td>
                      <td><a href="#" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> &times; </a></td>
                    </tr>
                   <?php } } ?>
                 </tbody>
      
                
    
          <tr><th colspan="4">Sub-Total</th><th colspan="2"><a href="#" onClick="autoFill(); return true;" >₦{{$sum}}
              
           </a></th></tr> 
        
        </table>
              </div>
       
            <div>
            </div>

          </div>


           

        </div>

        <div class="card card-primary">
          <div class="card-header border-0">
            <h3 class="card-title">
              Checkout Invoice
            </h3>
          </div>
          <div class="card-body">
            <form action="/salesCheckout" method="post">@csrf
              <div class="row">
                   <div class="col-md-4">
                    <label>Bill to:</label>
                   
                    <select name="cid" class="form-control select2"> 
                           @foreach ($students as $std)
                              <option value="{{$std->id}}">{{ucwords($std->surname)}} {{ucwords($std->firstname)}} </option>
                           @endforeach            
                      </select>
                   </div>
                   <div class="col-md-4 col-6">
                    <label>Amount Paid:</label>
                     <input type="number" name="cash" class="form-control ">
                     <input type="hidden"  name="total" value="{{$sum}} ">
                   </div>
                   <div class="col-md-4 col-6">
                    <label>Payment Mode</label>
                     <select class="form-control" name="mode"><option value="1">CASH</option>
                       <option value="2">POS</option>
                       <option value="3">Cheque</option>
                       <option value="4">Bank Deposit/Transfer</option>
                       <option value="5">Others</option>
                     </select>
                   </div>
                   <div class="col-12 mt-2">
                    <a href="#"
                    onclick="BrWindow('receipt?transactionIndex=<?php echo $sta->lsalesid('transact2','sn') ?>','','width=800,height=600')" class="btn btn-secondary float-right">Print Last Invoice</a>
                     <button type="submit" name="salesCheckout" class="btn btn-primary float-left">Close Invoice</button>
                   </div>
               </div>
            </form>
          </div>
        </div>

</section> 

<?php $i =0; if($pid){ foreach ($csel as $cs) { $i++; ?>

<div class="modal fade" id="modal-<?php echo $i; ?>">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <h4 class="modal-title">Remove Item From Cart</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <p>Are you sure you want to remove this item from cart?</p>
  <table class="table"><tr><td class="center"><?php echo $cs->qty ?></td>
   <td><?php echo ucfirst($cs->item) ?></td>
    <td class="center">₦<?php echo number_format($cs->amount) ?></td></tr></table>
</div>
<div class="modal-footer justify-content-between">
  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  <form action="/removeItem" method="post">@csrf
    <button type="submit" class="btn btn-danger" name="removeItem" value="<?php echo $cs->id ?>">Remove</button></form>
</div>
</form>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php } } ?>





@endsection