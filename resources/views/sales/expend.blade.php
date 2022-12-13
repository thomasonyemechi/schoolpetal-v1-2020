@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$un = new App\Http\Controllers\Unstock;

$mm = date('m');
$yy = date('Y');

$year = $yy;

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
                       <?php $i=0; foreach($expend as $row){
                            $pid=$row->id;
                            
                            if($sta->yearExpend($year,$pid)>0){
                              $e=$i++;
                            
                            ?>
                                <tr class="odd gradeX" >
                                            <td class="center"><?php echo $e ?></td>
                                            
                                            <td><?php echo ucfirst($row->item) ?></td>
                                            <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = $year.$mon; ?>
                                            <td <?php if($mm==$b){ ?> bgcolor="#99FF33" <?php  } ?> ><?php echo number_format($sta->monthExpend($month,$pid));  ?></td>
                                            <?php } ?>
                                            
                                            <td><?php echo number_format($sta->yearExpend($year,$pid));   ?></td>
                                        <!--  <td  class="center"  class="noprint"><a href="#" onclick="BrWindow('expdetails.php?transactionIndex=<?php echo $row->id; ?>&year=<?php echo $year; ?>','','width=800,height=600')" > Details </a></td>  -->
                                            
                                    
                                    </tr>  <?php } } ?>
                                    <tr>
                                            <th colspan="2">Total</th>
                                            <?php $a=1; while($a<=12){$b=$a++; $mon = ($b<10) ? '0'.$b : $b; $month = $year.$mon; ?>
                                            <th  <?php if($mm==$b){ ?> bgcolor="#99FF33" <?php  } ?>>
                                                <a href="#" onclick="BrWindow('expdetail.php?transactionIndex=<?php echo $month; ?>','','width=800,height=600')" ><?php echo number_format($sta->monthExpendTotal($month)); ?></th>
                                            <?php } ?></a>
                                            <th ><?php echo number_format($sta->yearExpendTotal($year));   ?></th>
                                            <!-- <th class="noprint" ></th>-->
                                            
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