@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$un = new App\Http\Controllers\Unstock;

$mm = date('m');
$yy = date('Y');

   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bussiness Report
            <small class="text-sm">Annual Profit/Loss Summary</small></h1>
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
        <div class="col-md-12 col-sm-12">
          <div class="card card-primary card-outline p-0">
          
            <div class="card-body pt-0">
            
            <div class="table-responsive mt-5">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th >Item</th>
                            <?php $a=1; while($a<=12){$b=$a++;
      $month = date("F", mktime(0, 0, 0, $b, 10)) ; ?>
                              <th <?php if($month==$b){ ?> bgcolor="#99FF33" <?php  } ?>><?php echo strtoupper(substr($month,0,3)); ?></th>
                            <?php } ?>
                            <th >Total</th>
                              <th class="noprint" >Details</th>
                           
                      </tr>
                    </thead>
                    <tbody> 
                        <tr><th colspan="2">STOCKING COST</th>
                     <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = date('Y').$mon; ?>
                                    <td  <?php if($mm==$b){ ?> bgcolor="#99FF33" <?php  } ?>><?php echo number_format($sta->monthStockingTotal($month)); ?></td>
                                  <?php } ?>
                                  <th ><?php echo number_format($sta->yearStockingTotal($yy));   ?></th>
                         
                      </tr>
                       <tr><th colspan="14"></th></tr> 
                          <tr><th colspan="2">OTHER EXPENDITURE</th>
                          <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = date('Y').$mon; ?>
                                    <td  <?php if($mm==$b){ ?> bgcolor="#99FF33" <?php  } ?>><?php echo number_format($sta->monthExpendTotal($month)); ?></td>
                                  <?php } ?>
                                  <th ><?php echo number_format($sta->yearExpendTotal($yy));   ?></th>
                         
                     </tr>
                      
                       <tr><th colspan="14"></th></tr> 
                      
                      
                      
     <tr><th colspan="2">TOTAL COST</th>
                         
                                  <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = date('Y').$mon; ?>
                                    <td  <?php if($mm==$b){ ?> bgcolor="#99FF33" <?php  } ?>><?php echo number_format($sta->monthCost($month)); ?></td>
                                  <?php } ?>
                                  <th ><?php echo number_format($sta->yearCost($yy));   ?></th>
                         
                      </tr>                  
                       <tr><th colspan="14"></th></tr> 
                          <tr><th colspan="2">SALES TOTAL</th>
                           <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = date('Y').$mon; ?>
                                    <td  <?php if($mm==$b){ ?> bgcolor="#99FF33" <?php  } ?>><?php echo number_format($sta->monthSalesTotal($month)); ?></td>
                                  <?php } ?>
                                  <th ><?php echo number_format($sta->yearSalesTotal($yy));   ?></th>
                                
                                 
                            </tr>
                       <tr><th colspan="14"></th></tr> 
                      <tr><th colspan="2">PROFIT</th>
                         <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = date('Y').$mon; ?>
                                    <th  <?php if($sta->monthSalesTotal($month)-$sta->monthCost($month)<0){ ?> bgcolor="red" <?php  } ?>><?php echo number_format($sta->monthSalesTotal($month)-$sta->monthCost($month)); ?></th>
                                  <?php } ?>
                                  <th <?php if($sta->yearSalesTotal($yy)-$sta->yearCost($yy)<0){ ?> bgcolor="red" <?php  } ?> ><?php echo number_format($sta->yearSalesTotal($yy)-$sta->yearCost($yy));   ?></th>
                         
                      </tr>
                      
                      
                          
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