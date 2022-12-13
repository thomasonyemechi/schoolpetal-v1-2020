@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;

$srep = session()->get('srep');
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Sales Rep Profile
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
               <form action="/getsrep" method="post">@csrf
              <select name="srep" class="form-control select2" onChange="submit()" style="width: 100%"> 
                                           <option selected disabled>...search Salesrep </option>
                        @foreach ($asrep as $s)
                            <option value="{{$s->sid}} ">{{ucwords($s->name)}} </option>
                        @endforeach
                        </select></form>     


            <div class="table-responsive mt-5">
             <table class="table table-sm table-bordered text-center" >
             <tr class="btn-success">
               <td colspan="5"><h4><b><?php echo $sta->rName($srep); ?></b> <small style="color:#FFF"><?php echo $sta->rName($srep,'phone'); ?></small><h4></th></tr>
              <tr><th colspan="5">Sales Analysis</th></tr>
                <tr>
                <td>TRN<br>
                  <strong><?php echo number_format($sta->countRowsa('transact2','rep',$srep)); ?></strong></td>
                  <td>Client Invoice<br>
                    <strong>₦<?php echo number_format($sta->sqSuma('transact2','rep',$srep,'amount')); ?></strong></td>
                  <td>Amount Paid<br>
                    <strong>₦<?php $ap = $sta->sqSuma('payment','rep',$srep,'amount'); echo number_format($ap); ?></strong></td>
                  <td>Client Balance<br>
                    <strong>₦<?php echo number_format($sta->sqSuma('transact2','rep',$srep,'amount')-$sta->sqSuma('payment','rep',$srep,'amount')); ?></strong></td></tr>

                  

                   <tr>
                <td>Return<br>
                  <strong><?php echo number_format($sta->countRowsa('returnx','rep',$srep)); ?>, ₦<?php echo number_format($sta->sqSuma('returnx','rep',$srep,'amount')); ?></strong></td>
                    
                  <td>First Sale<br>
                    <strong>
                    <a href="#" onclick="BrWindow('receipt?transactionIndex=<?php echo $sta->repFirstSold(); ?>','','width=800,height=600')"><?php echo $sta->repFirstSold('created'); ?></a></strong></td>
                  <td>Last Sale<br>
                    <strong>
                    <a href="#" onclick="BrWindow('receipt?transactionIndex=<?php echo $sta->repLastSold(); ?>','','width=800,height=600')"><?php echo $sta->repLastSold('created'); ?></a></strong></td>
                  <td>Big Sale<br>
                    <strong>
                    <a href="#" onclick="BrWindow('receipt?transactionIndex=<?php echo $sta->repBigSale(); ?>','','width=800,height=600')">₦<?php echo number_format($sta->repBigSale('amount')); ?></a></strong></td></tr>


 

                </table> 
              </div>



         <div class="table-responsive">
                <table class="table table-sm table-bordered text-center" >

<tr><td></td><td>Yestarday</td><td>Today</td><td>Last Week</td><td>This Week</td><td>Last Year</td><td>This Year</td></tr>
<tr><th>Invoice</th><td><?php echo $sta->repInvoiceYest(); ?></td><td><?php echo $sta->repInvoiceToday(); ?></td><td><?php echo $sta->repInvoiceLw(); ?></td><td><?php echo $sta->repInvoiceTw(); ?></td><td><?php echo $sta->repInvoiceLy(); ?></td><td><?php echo $sta->repInvoiceTy(); ?></td></tr>

<tr><th>Payment</th><td><?php echo $sta->repPayYest(); ?></td><td><?php echo $sta->repPayToday(); ?></td><td><?php echo $sta->repPayLw(); ?></td><td><?php echo $sta->repPayTw(); ?></td><td><?php echo $sta->repPayLy(); ?></td><td><?php echo $sta->repPayTy(); ?></td></tr>
                </table> 
              </div>

<div class="table-responsive">
<table class="table table-bordered table-sm text-center" >

<tr><th><?php echo date('Y'); ?> </th><?php $i =1; while($i <= 12){$e = $i++; ?>
           <th><?php echo substr(strtoupper(date("F", mktime(0, 0, 0, $e, 10))),0,3); ?></th><?php } ?></tr>
<tr><th>Invoice</th><?php $a =1; while($a <= 12){$b = $a++; ?>
           <td><?php echo $sta->repInvoiceMonthly($b); ?></td><?php } ?></tr>
<tr><th>Payment</th><?php $a =1; while($a <= 12){$b = $a++; ?>
           <td><?php  echo $sta->repPayMonthly($b); ?></td><?php } ?></tr>

                </table> 


                </div>

<br><br>    

            </div>

          </div>


        </div>

            

        <div class="col-md-6 col-sm-6">

          


          <div class="card card-secondary card-outline p-0">
            <div class="card-header border-0">
              <h3 class="card-title">
                Sales History
              </h3><em class="float-right">Last 25 Sales </em>
            </div>
            <div class="card-body pt-0">
              <table class="table table-sm">
             <thead>
                       <tr>
                        <th>INV #</th>
                        <th>Customer</th>
                        
                        <th>AMOUNT</th>
                          <th>Action</th>
                 
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($shis as $row)
                      <form method="post">   <tr class="odd gradeX">
                        <td class="center"><?php echo $row->salesid ?><br><?php echo $row->created ?></td>
                        <td><?php echo ucfirst($row->name) ?></td>
                        
                        <td class="center">₦<?php echo number_format($row->amount) ?></td>
                         <td class="center">
                         <a href="#" onclick="BrWindow('receipt?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')" > Receipt </a></td>
                       
                      </tr></form>  
                      @endforeach
                     </tbody>
          </table>



            </div>
          </div>  

          <div class="card card-secondary card-outline p-0">
            <div class="card-header border-0">
              <h3 class="card-title">
                Return History
              </h3><em class="float-right">Last 25 Returns </em>
            </div>
            <div class="card-body pt-0">
              <table class="table table-sm">
              <thead>
                     
                      <tr>
                        <th>Qty</th>
                         <th>Item</th>
                        <th>Price</th>
                        <th>Amount</th>
                    
                        <th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($rhis as $row)
                      <tr class="odd gradeX">
                        <td class="center"><?php echo $row->qty ?></td>
                        <td><?php echo ucfirst($row->item) ?></td>
                        <td class="center">₦<?php echo number_format($row->price) ?></td>
                        <td class="center">₦<?php echo number_format($row->amount) ?></td>
                       
                        <td class="center"><?php echo $row->created; ?></td>
                      </tr>  
                      @endforeach
                    </tbody>
          </table>



            </div>
          </div>  


        </div>
      </div>    
    </div><!-- /.container-fluid -->
  </section>


@endsection