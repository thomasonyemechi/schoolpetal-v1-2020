@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$week = session()->has('week')?session()->get('week'):date('W');

   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Fee Report
            <small class="text-sm">Weekly Fee Payment</small></h1>
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
        <div class="col-md-3 col-sm-12">
            <div class="card card-primary card">
                <div class="card-header">
                  <h3 class="card-title">Choose Week</h3>
                </div>
                <div class="card-body">
                  <form action="/getweek2" method="post">@csrf
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
        <div class="col-md-9 col-sm-12">
          <div class="card card-secondary card- p-0">
            <div class="card-header border-0">
                <h3 class="card-title">WEEK: <?php echo $week ?>, {{date('Y')}} </h3>
              </div>
            <div class="card-body pt-0">
            
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th>SN</th>
                        <th>Student Name</th>
                        <th>Amount </th>
                        <th>Fee type</th>
                        <th>Session</th>
                        <th>Term </th>
                        <th>Date/Time</th>
                        <th>Receipt</th>
                    </tr>
                    </thead>
                    <tbody> 
                        <?php $i=0; $amt=0; foreach ($fee as $fe) {
                        $date = date('W',strtotime($fe->created_at)); //echo $date;
                        if($week==$date){ 
                          $i++; $amt += $fe->amount;
                        ?>
                        <tr>
                            <td>{{$i}} </td>
                            <td>{{$sta->cName2($fe->uid)}}</td>
                            <td>{{number_format($fe->amount)}}</td>
                            <td>{{$sta->sqLx('feecat','id',$fe->note,'fee')}}</td>
                            <td>{{$fe->sess}}</td>
                            <td>{{$sta->termname($fe->term)}} term</td>
                            <td>{{$fe->created_at}}</td>
                            <td><a href=""> {{$fe->salesid}} </a></td>
                        </tr>
                        <?php } }?>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>{{number_format($amt)}}</th>
                        </tr>
                    </tbody>
                </table>
                {{$fee->links()}}
              </div>

           </div>

          </div>


        </div>
        </div>
      </div>    
    </div><!-- /.container-fluid -->
  </section>


@endsection