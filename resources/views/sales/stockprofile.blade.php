@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;

$pid = (session()->has('pid'))?session()->get('pid'):'';
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Stock Management
            <small></small></h1>
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
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="card card-primary card-outline p-0">
            <div class="card-header border-0">
              <h3 class="card-title">
                Quick Search
              </h3>
            </div>
            <div class="card-body pt-0">
              <form method="post" action="{{route('postitempin')}}">
                @csrf
                <select name="itempin" class="form-control select2" onChange="submit()"  style="width: 100%"> 
                             
                             <option value="" selected disabled>...search item </option> 
                             @foreach($stocks as $stock)
                                  <option value="{{$stock->id}}">{{$stock->item}}</option>
                             @endforeach
                </select>
                </form> 


                        <?php if($pid){  ?>
                          <div class="table-responsive">
                            <table class="table table-bordered table-sm text-center mt-5" >
                              <tr class="btn-success"><td colspan="5"><h4><b><?php echo $sta->pin('item'); ?></b> <small style="color:#FFF"></small><h4></th></tr>
                              <tr>
                                 <td>Unit Price<br>
                                   <strong>₦<?php echo number_format($sta->pin('unitprice')); ?></strong></td>
                                   <td>Pack Price<br>
                                     <strong>₦</strong></td>
                                   <td>Unit Qty<br>
                                     <strong><?php echo $sta->itemqty($pid); ?></strong></td>
                                   <td>Unit /Pack<br>
                                     <strong></strong></td>
                                   <td>Uptimum<br><strong></strong></td></tr>
               
                                    <tr>
                                 <td>Restock<br>
                                   <strong><?php echo number_format($sta->sqSuma('stockup','pid',$pid,'qty')); ?> Units, ₦<?php echo number_format($sta->sqSuma('stockup','pid',$pid,'totalcost')); ?></strong></td>
                                   <td>Sold<br><strong>
                                     <?php echo number_format($sta->sqSuma('transact','pid',$pid,'qty')); ?> Units, ₦<?php echo number_format($sta->sqSuma('transact','pid',$pid,'amount')); ?></strong></td>
                                   <td>First Sale<br>
                                     <strong>
                                     <a href="#" onclick="BrWindow('receipt.php?transactionIndex=<?php echo $sta->itemFirstSold(); ?>','','width=800,height=600')"><?php echo $sta->itemFirstSold('created'); ?></a></strong></td>
                                   <td>Last Sale<br>
                                     <strong>
                                     <a href="#" onclick="BrWindow('receipt.php?transactionIndex=<?php echo $sta->itemLastSold(); ?>','','width=800,height=600')"><?php echo $sta->itemLastSold('created'); ?></a></strong></td>
                                   <td>Status<br><strong></strong></td></tr>
               
               
                  <tr>
                                 <td>Return<br>
                                   <strong><?php echo number_format($sta->sqSuma('returnx','pid',$pid,'qty')); ?> Units, ₦<?php echo number_format($sta->sqSuma('returnx','pid',$pid,'amount')); ?></strong></td>
                                   <td>Unstock<br>
                                     <strong><?php echo number_format($sta->sqSuma('unstock','pid',$pid,'qty')); ?> Units, ₦<?php echo number_format($sta->sqSuma('unstock','pid',$pid,'amount')); ?></strong></td>
                                   <td>Big Sale<br>
                                     <strong>
                                     <a href="#" onclick="BrWindow('receipt.php?transactionIndex=<?php echo $sta->itemBigSale(); ?>','','width=800,height=600')">₦<?php echo number_format($sta->itemBigSale('amount')); ?></a></strong></td>
                                   <td>Sales No<br>
                                     <strong><?php echo $sta->itemTrn(); ?></strong></td>
                                   <td>Created<br><strong><?php echo $sta->pin('created_at'); ?></strong></td></tr>
               
                                 </table> 
                          </div>
                             <?php } ?>
           <br><br>
           
            <div class="table-responsive">
              <table class="table table-sm text-center" >
           
           <tr><th><?php echo date('Y'); ?> </th><?php $i =1; while($i <= 12){$e = $i++; ?>
                        <th><?php echo substr(strtoupper(date("F", mktime(0, 0, 0, $e, 10))),0,3); ?></th><?php } ?></tr>
           <tr><th>Sales</th><?php $a =1; while($a <= 12){$b = $a++; ?>
                        <td><?php echo $sta->itemSoldMonthly($b); ?></td><?php } ?></tr>
           <tr><th>Restock</th><?php $a =1; while($a <= 12){$b = $a++; ?>
                        <td><?php  echo $sta->itemRestockMonthly($b); ?></td><?php } ?></tr>
           <tr><th>Return</th><?php $a =1; while($a <= 12){$b = $a++; ?>
                        <td><?php  echo $sta->itemReturnMonthly($b); ?></td><?php } ?></tr>
           <tr><th>Unstock</th><?php $a =1; while($a <= 12){$b = $a++; ?>
                        <td><?php  echo $sta->itemUnstockMonthly($b); ?></td><?php } ?></tr>
                             </table> 
            </div>
              
            



                </div>

<br><br>    

            </div>

           @if ($pid)
           <div class="card card-secondary card-outline p-0">
            <div class="card-header border-0">
              <h3 class="card-title">
                Edit Stock Profile
              </h3>
            </div>
            <div class="card-body pt-0">
              <form action="/updateStockProfile" method="post">@csrf
            <div class="row">
              <div class="col-lg-6 no-padding" >Unit Selling Price:<br> <input name="unitprice" type="number"  class="js-calc form-control" value="<?php echo $sta->pin('unitprice'); ?>" required >

              <input name="item" type="hidden" value="<?php echo $sta->pin('item'); ?>" >
            </div>


            <div class="col-lg-6 no-padding" ><br>
              <button type="submit" class="btn btn-primary pull-right">Update Stock Profile</button>
            </div>
                    
            </div>
           <!-- /.box-body -->
             <p>&nbsp;</p>
         </form>
            </div>
          </div> 

           @endif

          </div>


       

        <div class="col-md-6 col-sm-6">

          


          <div class="card card-secondary card-outline p-0">
            <div class="card-header border-0">
              <h3 class="card-title">
                Stocking History
              </h3>
            </div>
            <div class="card-body pt-0">
              <div class="table-responsive">
                <table class="table table-sm">
                  <thead>
                   <tr>
                     <th>Qty</th>
                     <th>Item</th>
                     <th>Price</th>
                     <th>Amount</th>
                     <th>Salesrep</th>
                   </tr>
                         </thead>
                         <tbody>
                           
                           @foreach($shis as $row)
                           <tr class="odd gradeX">
                             <td class="center"><?php echo $row->qty; ?></td>
                             <td><?php echo ucfirst($row->item) ?></td>
                             <td class="center">₦<?php echo number_format($row->unitcost) ?></td>
                             <td class="center">₦<?php echo number_format($row->totalcost) ?></td>
                             <td class="center"><?php echo $sta->rName($row->rep); ?><br>
                               <a href="#" onclick="BrWindow('invoice.php?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')"><?php echo $row->created; ?></a></td>
                            
                           </tr>
                           @endforeach
                          </tbody>
               </table>
              </div>



            </div>
          </div>  

          <div class="card card-secondary card-outline p-0">
            <div class="card-header border-0">
              <h3 class="card-title">
                Unstocking History
              </h3>
            </div>
            <div class="card-body pt-0">
              <div class="table-responsive">
                <table class="table table-sm">
                  <thead>
                         
                          <tr>
                            <th>Qty</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Salesrep</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($uhis as $row)
                          <tr class="odd gradeX">
                            <td class="center"><?php echo $row->qty; ?></td>
                            <td><?php echo ucfirst($row->item) ?></td>
                            <td class="center">₦<?php echo number_format($row->cost) ?></td>
                            <td class="center">₦<?php echo number_format($row->amount) ?></td>
                            <td class="center"><?php echo $sta->rName($row->rep); ?><br>
                              <a href="#"><?php echo $row->created; ?></a></td>
                          </tr>
                          @endforeach
                        </tbody>
              </table>
              </div>



            </div>
          </div>  


        </div>
      </div>    
    </div><!-- /.container-fluid -->
  </section>


@endsection