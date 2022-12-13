@extends('layouts.app')

@section('content')
   <?php 
$sum=0;
$pid = session()->get('pid');

if($pid){
    foreach ($sins as $pit){
        $item = $pit->item;
        $qty = $pit->qty;
        $price = $pit->unitprice;
        $cost = $pit->unitcost;
    }
}

   ?>
<div class="wrapper">

    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    Un-stock 
                    <small>Remove Stock</small>
                  </h1>
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
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Quick Search</h3>
                <button class="btn btn-default float-right btn-xs" data-toggle="modal" data-target="#add-reason">Add Unstocking Reason</button>
            </div>
                <div class="card-body">
                <p><form method="post" action="{{route('postitempin')}}">

                  @csrf
                
                    <select name="itempin" class="form-control select2" onChange="submit()"  style="width: 100%"> 
                               <option value="" selected disabled>...search item </option> 
                                
                               @foreach($stocks as $stock)
                               <option value="{{$stock->id}}">{{$stock->item}}</option>
                               @endforeach
                               
                  </select>
                  </form>
                  <br><br><br><br>
                </p>
            
           
                    
                 
                         

                <p>         
                    @if($pid)<?php $col = ($qty == 0)?'danger':'success'; ?>
                 

                    <div class="table-responsive">
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

                    <h6 class="text-uppercase">Un-stock Item</h6>
                         
                      
                 <x-jet-validation-errors class="mb-4" />        
                    <div class="tab-content">
                        <div class="tab-pane active container" id="unit">
                        <form method="post" action="/UnstockItemUnit">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Reason For Unstocking</label>
                                            <select name="reason" class="form-control select2">
                                                <option selected disabled>...select reason</option>
                                                @if(count($reason)>0)
                                                    @foreach ($reason as $r)
                                                        <option value="{{$r->id}} ">{{$r->reason}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-6">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control"  type="text" name="qty" :value="old('unitcost')" autofocus autocomplete="unitcost" />
                                        </div>
                                    </div>
                                
                                
                                    <div class="col-md-4 col-6">
                                        <div class="form-group">
                                            <label>Stock Worth</label>
                                            <input  type="type" class="form-control" name="unitprice"
                                        value="" />
                                        </div>
                                     </div>
                                    </div>  
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary float-right">Unstock Item</button>
                                    </div>
                            </form>
                        </div>

                       
                    </div>


                        
                    @endif

                

                 


            </p>
            
                



          </div>   
       </div>  
      </div> 

                            
                                <div class="col-md-6">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                        <h3 class="card-title">Un-stocking Details For Today {{session()->get('qty')}} </h3></div>
                                          <div class="card-body">
                                                
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover" >
                                                    <tr>
                                                    <th>Sn</th>
                                                    <th>Item</th>
                                                    <th>Qty</th>
                                                     <th>Unit Cost</th>
                                                     <th>Amount</th>
                                                     <th>Action</th>
                                                   </tr>
                                                @if($pid)
                                                   @if(count($sd)>0)
                                                   <?php  $e = 0; foreach($sd as $rit){ $sum += $rit->amount; $e++; ?>
                                                        <tr class="odd gradeX">
                                                        <td>{{$e}}</td>
                                                        <td class="center">{{$rit->item}} </td>
                                                        <td class="center">{{$rit->qty}} </td>
                                                        <td class="center">₦<?php echo number_format($rit->cost); ?></td>
                                                        <td class="center">₦<?php echo number_format($rit->amount); ?></td>
                                                        <td> <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></td>      
                                                        </tr>
                                                    <?php } ?>
                                                   
                                                         
                                                         <tr><th colspan="4">Sub-Total  <?php //echo minLapse($pro->ltTime()); ?></th><th colspan="2"><a href="#" onClick="autoFill(); return true;" >₦
                                                     
                                                             {{$sum}}
                                                            </a></th></tr>
                                                    @endif
                                                @endif
                                                </table>
                                            </div>
                                          </div>
                                    </div>
                                     

                          <!----modal  for customer supplier on click should appear --->
                 
                          <div class="modal fade" id="modal-customer">
                            <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Register Supplier</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                      <form action="{{route('addsupplier')}}" method="post"  role="form">
                                        @csrf
                                        <div class="card-body">
                                            <x-jet-validation-errors class="mb-4" />
                                            <div class="row">
                                                     
                                                <div class="col-md-4 form-group">
                                                    <x-jet-input class="block mt-1 w-full" placeholder="Full Name" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                                                 </div>

                                                 <div class="col-md-4 form-group">
                                                    <x-jet-input class="block mt-1 w-full" placeholder="phone Number" type="text" name="phone" :value="old('phone')" autofocus autocomplete="name" />
                                                 </div>

                                                 <div class="col-md-4 form-group">
                                                    <x-jet-input class="block mt-1 w-full" placeholder="Address" type="text" name="address" :value="old('address')" autofocus autocomplete="name" />
                                                 </div>
                                                     

                                            </div>
                                            
                                            
                                        </div>
                                   
                                </div>
                                    
                                <div class="modal-footer justify-content-between">
                              
                                <button type="button" class="btn btn-primary" onclick="submit()">Register</button>
                            </form>

                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div> 
                            <!-- /.modal-dialog -->
                </div>




                        

                                </div>
                            </div>
                             
    </div>  
              
          
              
</div> 

<script type="text/javascript">

    function autoFill() {
      document.getElementById('input1').value = "<?php echo $sum?>";
    }
  
    function autoFill2() {
      document.getElementById('input2').value = "<?php $rstock ?>";
    }
  
     setInterval(function() {
      $("#refr").load(location.href+" #refr>*","");
  }, 5000); 

  
function BrWindow(theURL,winName,features) { //v2.0

window.open(theURL,winName,features);

}

</script>
<div class="modal fade" id="add-reason">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Add Catergory for unstocking </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <x-jet-validation-errors class="mb-4" />    
            <form action="{{route('reason')}}"  method="post">
                @csrf
                        <div class="form-group">
                            <label>Category for Reason for Unstocking</label>
                            <x-jet-input class="block mt-1 w-full" type="text" name="complain" :value="old('complain')" autofocus autocomplete="complain" />
                        </div>
                  
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                   </div>
           </form>

        </div>

    </div>
    </div>
  </div>

 
@endsection