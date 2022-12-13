@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;

$ts = session('termsess')?session('termsess'):''.ucwords($sta->termName($term)).' Term '.$sess.'';
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Fee Report  
            <small class="text-sm">Termly Fee Payment</small></h1>
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
            <div class="card card-primary card">
                <div class="card-header">
                  <h3 class="card-title">Choose Term</h3>
                </div>
                <div class="card-body">
                  <form action="/getterm" method="post">@csrf
                        <label>Terms</label>
                         <select name="termsess" class="form-control" onChange="submit()"> 
                           <option>Select</option>
                         <?php  foreach($aterm as $at){ ?>
                          <option value="{{''.ucwords($sta->termName($at->term)).' Term '.$at->sess.''}}">{{''.ucwords($sta->termName($at->term)).' Term '.$at->sess.''}}</option>'; 
                          <?php } ?>
                         </select>
                </form>
    
         
                </div>
              </div>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="card card-secondary card- p-0">
            <div class="card-header border-0">
                <h3 class="card-title">Term: <?php echo $ts ?>, </h3>
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
                        $ty = ''.ucwords($sta->termName($fe->term)).' Term '.$fe->sess.'';
                        if($ts==$ty){ 
                          $i++; $amt += $fe->amount;
                        ?>
                        <tr>
                            <td>{{$i}} </td>
                            <td>{{ucwords($sta->cName2($fe->uid))}}</td>
                            <td>{{$fe->amount}}</td>
                            <td>{{$sta->sqLx('feecat','id',$fe->note,'fee')}}</td>
                            <td>{{$fe->sess}}</td>
                            <td>{{$sta->termname($fe->term)}} term</td>
                            <td>{{$fe->created_at}}</td>
                            <td><a href=""> {{$fe->salesid}} </a></td>
                        </tr>
                        <?php } }?>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>{{$amt}}</th>
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