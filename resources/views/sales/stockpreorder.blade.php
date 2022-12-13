@extends('layouts.app')

@section('content')
<?php 

$un = new App\Http\Controllers\Unstock;
$sta = new App\Http\Controllers\ProfileController;

$vid = session()->get('vendor');

$sum=0;
$pid = (session()->has('pid'))?session()->get('pid'):'';
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
          <h1 class="m-0 text-dark"> Pre-Order
            <small class="text-sm">Preorder Stocks</small></h1>
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
                      <form method="post" action="{{route('unitPreOrder')}}">
                              @csrf
                              <h4>Pre-Order</h4>
                              <div class="row">
                                  <div class="col-md-4 mt-1 mb-1">
                                      <div class="form-group">
                                          <label>Total Quantity</label>
                                      <input class="form-control" type="text" name="qty" value="1" />
                                      </div>
                                  </div>
                                  <div class="col-md-4 mt-1 mb-1">
                                      <div class="form-group">
                                          <label>Unit Cost</label>
                                      <input class="form-control"  type="text" name="price" value="{{$cost}}"/>
                                      </div>
                                  </div>
                                  <div class="col-md-4 mt-1 mb-1"><br>
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
            <h3 class="card-title">Order Details</h3></div>
            <div class="card-body">
                  
              <table id='example1' class="table table-sm table-hover" >
                  <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    
                    <th>Action</th>
                 </tr>

                 <tbody> 
                     <?php if(session()->has('order')){ $e=0; foreach($ord as $row){ $e++; $sum += $row->amount; ?>
                        <tr class="odd gradeX">
                            <td><?php echo ucfirst($row->item) ?></td>
                            <td class="center"><form action="/EditLine" method="post">@csrf
                                <input class="form-control form-control-sm" 
                                style="width: 40px; border-top: none;border-left: none;border-right: none;  text-align: center; padding: 5px 2px" 
                                type="number" min="1" max="999" name="qty" value="<?php echo $row->qty ?>" onchange="submit()">
                                <input type="hidden" name="EditLine" value="<?php echo $row->sn ?>">
                                <input type="hidden" name="price" value="<?php echo $row->price ?>"></form></td>
                            
                            <!-- <td class="center">₦<?php echo number_format($row->price) ?></td>
                            <td class="center">₦<?php echo number_format($row->amount) ?></td> -->
                            <td class="center" style=""><big><a href="#" data-toggle="modal" data-target="#modal-{{$e}}">&times;</a></big></td>
                        </tr>
                    <?php } } ?>
                 </tbody>
      
                
    
          <tr><th colspan="1">Sub-Total</th><th><a href="#" onClick="autoFill(); return true;" >₦{{$sum}}
              
           </a></th></tr> 
        
        </table>
       
            <div>
            </div>

          </div>


           

        </div>

        <div class="card card-primary">
          <div class="card-header border-0">
            <h3 class="card-title">
              Order Checkout
            </h3>
          </div>
          <div class="card-body">
            
              <div class="row">
                   <div class="col-md-12">
                    <label>Supplier:</label>
                    <form action="/getvendor" method="post">@csrf
                    <select name="vendor" required class="form-control select2 bs4" onchange="submit()"> \
                        <option selected disabled>Select Vendor</option>
                           <?php foreach ($supply as $std){ $ck = ($std->id == $vid)?'selected':''; ?>
                              <option {{$ck}} value="{{$std->id}}">{{ucwords($std->name)}}</option>
                            <?php } ?>           
                      </select>
                    </form>
                   </div>
                   <div class="col-12 mt-2">
                    <a href="#" onclick="BrWindow('receipt.php?transactionIndex=','','width=800,height=600')" class="btn btn-secondary float-right">Print Last Invoice</a>
                    <button name="PreOrderCheckout" type="button" class="btn btn-primary float-left"   data-toggle="modal" data-target="#checkout">Order Checkout</button>
                   </div>
               </div>
            
          </div>
        </div>

</section> 

<?php $e=0; if(session()->has('order')){ foreach($ord as $row){ $e++; ?>

 <div class="modal fade" id="modal-<?php echo $e; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Remove Item from Cart</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <p>Are you sure you want to remove this item from cart?</p>
          <table class="table"><tr><td class="center"><?php echo $row->qty ?></td>
                          <td><?php echo ucfirst($row->item) ?></td>
                          <td class="center">₦<?php echo number_format($row->amount) ?></td></tr></table>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <form action="/removeOrderItem" method="post">@csrf <button type="submit" class="btn btn-danger" name="removeOrderItem" value="<?php echo $row->sn ?>">Remove</button></form>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php } } ?>


<div class="modal fade" id="checkout">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Checkout for <?php echo $sta->vName($vid); ?>  </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
     <font color="red"><i> <h4>Are you sure you want to place order for <?php echo $sta->vName($vid); ?>?  </h4></i></font>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <form action="/PreOrderCheckout" method="post">@csrf
              <input type="hidden" name="amount" value="{{$sum}}">
          <button type="submit" class="btn btn-success" name="PreOrderCheckout">Check Out</button>
         
               </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


@endsection