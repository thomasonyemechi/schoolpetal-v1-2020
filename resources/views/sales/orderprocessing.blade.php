@extends('layouts.app')

@section('content')
<?php 

$sta = new App\Http\Controllers\ProfileController;
$salesid = session()->get('porder');
$vid = session()->get('vendor');

$sum=0;
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Order Prosessing
            <small class="text-sm"></small></h1>
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
          
           
           
            <p><form action="/getvendor" method="post">@csrf
                <select name="vendor" class="form-control select2 bs4" onchange="submit()"> 
                       <?php foreach ($supply as $std){ $ck = ($std->id == $vid)?'selected':''; ?>
                          <option {{$ck}} value="{{$std->id}}">{{ucwords($std->name)}}</option>
                        <?php } ?>           
                  </select>
                </form>
            </p>  

   
            @if($vid)
                <div class="table-responsive mt-5">
                    <div class="table-responsive">
                      <table class="table table-sm table-striped">
                        <thead>
                            <tr class="btn-success"><td colspan="5"><h4>
                                <b>{{ucwords($sta->vName($vid))}}</b><h4></th></tr>
                                    <tr>
                                        <th>INV #</th>
                                        <th>Supplier</th>
                                       
                                        <th>No of Items</th>
                                          <th>Action</th>
                                 
                                      </tr>
                        </thead>
                        <tbody> {{session()->get('porder')}}
                         
                          @if(session()->has('vendor'))
                            @foreach($ard as $row)
                            <?php $col = ($salesid == $row->salesid)?'background-color:#CF0;':'';  //echo $col;?>
                              <form action="/ViewOrder" method="post">@csrf   <tr class="odd" style="{{$col}}" ?>
                              <td class="center"><?php echo $row->salesid ?><br><?php echo $row->created ?></td>
                              <td><?php echo ucfirst($row->name) ?></td>
                              
                              <td class="center"><?php echo $sta->NoStockOrder($row->salesid) ?></td>
                               <td class="center">
                               <button class="btn btn-success btn-sm" name="ViewOrder" value="<?php echo $row->salesid ?>" >Details</button>  </td>
                             
                            </tr></form>
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                    </div>
                </div>
            @endif
      
                  
                 
          </div>
        </div>


        <div class="card card-secondary outline p-0">
          <div class="card-header border-0">
            <h3 class="card-title">
              Pre-Orders Awating Approval
            </h3>
          </div>
          <div class="card-body">
           
                   <div class="table-responsive">
                    <table class="table table-sm" >
                      <thead>
                         <tr>
                          <th>SN</th>
                          <th>Company</th>
                         
                          <th>No of Items</th>
                          <th>Agent</th>
    
                        </tr>
                      </thead>
                      <tbody>
                    <?php $e=0; foreach ($ap as $row) { $e++;
                    ?>
                     <form method="post">   
                      <tr class="odd gradeX" >
                          <td class="center"><?php echo $e ?></td>
                          <td><?php echo strtoupper($sta->vName($row->id)) ?></td>
                          
                          <td class="center"><?php echo $sta->NoStockOrder($row->salesid) ?></td>
                           <td class="center"><?php echo $sta->rName($row->rep);?></td>
                         
                        </tr></form>
                        <?php  }  ?>
                       
                       </tbody></table> 
                   </div>



          </div>
        </div>  


      </div>
      
      <div class="col-md-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Order Details</h3>
          </div>
          <div class="card-body"><?php if(session()->has('porder')){  ?>
              <form action="/ApprovePreOrder" method="POST">@csrf
                 <div class="table-responsive">
                  <table id='example1' class="table table-sm table-hover" >
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        
                        <th>Cost</th>
                        <th>Price</th>
                    </tr>
        
        
                    <tbody>
                        <?php  if(session()->has('porder')){ $e=0; foreach($details as $row){ $e++; $sum += $row->amount; ?>
                            <tr class="odd gradeX">
                            <td><?php echo ucfirst($row->item) ?></td>
                            <td class="center"> <?php echo $row->qty ?></td>
                            
                            <td class="center"><input type="number"  class="form-control formed"  name="cost<?php echo $e ?>" value="<?php echo $sta->itemName($row->pid,'unitcost') ?>"  min="1"> </td>
                            <td class="center"><input type="number" class="form-control formed"  name="price<?php echo $e ?>" value="<?php echo $sta->itemName($row->pid,'unitprice') ?>" min="1"> </td>
                            
                            <td class="center" style=""><a href="#" data-toggle="modal" data-target="#modal-<?php echo $e; ?>"><i class="fa fa-remove"></i></a></td>
                            </tr>
                            <?php  } ?>
                    </tbody>
                    </table>
                 </div>
                  
                      <button class="btn btn-success pull-right" style="margin:20px" name="ApprovePreOrder" value="<?php echo $salesid ?>" >Approve Order</button>
                 
              </form>
              <?php } } ?>
          </div>
      </div>
        </div>








    </div>

</section> 


@endsection