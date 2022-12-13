@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$un = new App\Http\Controllers\Unstock;
$week = (session()->has('week'))?session()->get('week'):date('W');
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bussiness Report
            <small class="text-sm">Weekly Sales</small></h1>
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
        <div class="col-md-3 col-sm-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Choose Week</h3>
                </div>
                <div class="card-body">
                    <form action="/getweek" method="post">@csrf
                        <label>Week</label>
                         <select name="week" class="form-control" onChange="submit()"> 
                         <?php $a=1; while($a<=53){ $b=$a++; ?>
                          <option value="<?php echo $b ?>">Week <?php echo $b ?></option>'; 
                          <?php } ?>
                         </select>
                    </form>  
    
         
                </div>
              </div>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="card card-primary card-outline p-0">
            <div class="card-header border-0">
                <h3 class="card-title">WEEK: <?php echo $week ?></h3>
              </div>
            <div class="card-body pt-0">
            
            <div class="table-responsive mt-5">
                <table class="table table-sm">
                    <thead>
                                         <tr>
                                             <th>SN</th>
                                             <th >Receipt No</th>
                                             <th >Customer</th>
                                             <th >Amount Due</th>
                                            <th >Cash Paid</th>
                                            <th >Date/Time</th>
                                            <th >Agent</th>
                                             <th >Print</th>
                                       </tr>
                                     </thead>
                                     <tbody> 
                                    <?php $i=1; $amt=0; $cash=0;
               foreach ($sales as $row){
               $sns=$row->sn;
               $week1 = date('W',strtotime($row->created));
             if($week==$week1){
                 $e=$i++; $amt += $row->amount; $cash += $row->cash;?>
                    <tr class="odd gradeX" <?php if($row->cash==0){ ?> bgcolor="#FF66CC" <?php }  ?> >
                                             <td class="center"><?php echo $e ?></td>
                                              <td><?php echo ucfirst($row->salesid) ?></td>
                                             <td><?php echo $row->name;   ?></td>
                                             <td ><?php echo number_format($row->amount) ?></td>
                                             <td class="center"><?php echo number_format($row->cash) ?></td>
                                             <td  class="center"><?php echo $row->created ?></td>
                                             <td  class="center"><?php echo $sta->rName($row->rep) ?></td>
                                             <td  class="center"><a href="#" onclick="BrWindow('receipt?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')" > Receipt </a></td> 
                                     </tr>  <?php } 
                                     }?>
                                     <tr><th colspan="3">TOTAL</th>
                                     <th><?php echo $amt; ?></th>
                                     <th><?php echo $cash; ?></th>
                                     
                                    <th></th><th></th><th></th></tr>
                                    
                                     </tbody>
                            </table>
              </div>

           </div>

          </div>


        </div>
        </div>
      </div>    
    </div><!-- /.container-fluid -->
  </section>


@endsection