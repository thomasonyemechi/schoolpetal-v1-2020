@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;

$vid = session()->get('vendor');
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Supplier Profile
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
               <form action="/getvendor" method="post">@csrf
              <select name="vendor" class="form-control select2" onChange="submit()" style="width: 100%"> 
                                           <option selected disabled>...search Supplier </option>
                        @foreach ($asrep as $s)
                            <option value="{{$s->id}} ">{{ucwords($s->name)}} </option>
                        @endforeach
                        </select></form>     


                        <div class="table-responsive mt-5">
                          <table class="table table-sm table-bordered text-center" >
                          <tr class="btn-success"><td colspan="5"><h4><b><?php echo $sta->vName($vid); ?></b> <small style="color:#FFF"><?php echo $sta->vName($vid,'phone').', '.$sta->vName($vid,'address'); ?></small><h4></th></tr>
                           <tr><th colspan="5">Transaction Analysis</th></tr>
                          <tr>
                             <td>TRN<br>
                               <strong><?php echo number_format($sta->countRowsa('stockup2','id',$vid)+$sta->countRowsa('expend2','id',$vid)); ?></strong></td>
                               <td>Invoice Amount<br>
                                 <strong>₦<?php $a = $sta->sqSuma('stockup2','name',$sta->vName($vid),'amount')+$sta->sqSuma('expend2','id',$vid,'amount'); echo number_format($a) ?></strong></td>
                               <td>Amount Paid<br>
                                 <strong><?php $b = $sta->sqSuma('payout','id',$vid,'amount'); echo number_format($b) ?></strong></td>
                               <td>Balance<br>
                                 <strong>₦<?php echo number_format($a-$b); ?></strong></td>
                               
           
                               
           
           
              
           
                             </table> 
                           </div> 
           
                           <div class="table-responsive">
                             <table class="table table-bordered table-sm text-center" >
           
           <tr><td></td><td>Yestarday</td><td>Today</td><td>Last Week</td><td>This Week</td><td>Last Year</td><td>This Year</td></tr>
           <tr><th>Invoice</th><td><?php echo $sta->vendorInvoiceYest(); ?></td><td><?php echo $sta->vendorInvoiceToday(); ?></td><td><?php echo $sta->vendorInvoiceLw(); ?></td><td><?php echo $sta->vendorInvoiceTw(); ?></td><td><?php echo $sta->vendorInvoiceLy(); ?></td><td><?php echo $sta->vendorInvoiceTy(); ?></td></tr>
           
           <tr><th>Payment</th><td><?php echo $sta->vendorPayYest(); ?></td><td><?php echo $sta->vendorPayToday(); ?></td><td><?php echo $sta->vendorPayLw(); ?></td><td><?php echo $sta->vendorPayTw(); ?></td><td><?php echo $sta->vendorPayLy(); ?></td><td><?php echo $sta->vendorPayTy(); ?></td></tr>
                             </table> 
                           </div>
           
           <div class="table-responsive">
           <table class="table table-sm table-bordered text-center" >
           
           <tr><th><?php echo date('Y'); ?> </th><?php $i =1; while($i <= 12){$e = $i++; ?>
                        <th><?php echo substr(strtoupper(date("F", mktime(0, 0, 0, $e, 10))),0,3); ?></th><?php } ?></tr>
           <tr><th>Invoice</th><?php $a =1; while($a <= 12){$b = $a++; ?>
                        <td><?php echo $sta->vendorInvoiceMonthly($b); ?></td><?php } ?></tr>
           <tr><th>Payment</th><?php $a =1; while($a <= 12){$b = $a++; ?>
                        <td><?php  echo $sta->vendorPaidMonthly($b); ?></td><?php } ?></tr>
           
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
                Supply History
              </h3><em class="float-right">Last 25 Sales </em>
            </div>
            <div class="card-body pt-0">
              <table class="table table-sm">
             <thead>
                       <tr>
                        <th>INV #</th>
                        <th>Vendor</th>
                        
                        <th>Item</th>
                          <th>Amount</th>
                 
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($shis as $row)
                      <form method="post">   <tr class="odd gradeX">
                        <td class="center"><?php echo $row->salesid ?><br><?php echo $row->created ?></td>
                        <td><?php echo ucfirst($row->name) ?></td>
                        
                        <td class="center">₦<?php echo number_format($row->amount) ?></td>
                         <td class="center">
                         <a href="#" onclick="BrWindow('invoice?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')" > Receipt </a></td>
                       
                      </tr></form>  
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