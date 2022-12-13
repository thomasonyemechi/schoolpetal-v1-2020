@extends('layouts.app')

@section('content')
<?php 
use App\Http\Controllers\ProfileController;
$sta = new ProfileController;

$sid = auth()->user()->sid;


   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"> Power/Permissions
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
  {{-- <form action="/upower" method="POST">@csrf 
    <button class="btn btn-danger" >Change Power!</button>

    </form> --}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="card card-primary card-outline p-0">
            {{-- <div class="card-header">
              
            </div> --}}
            <div class="card-body pt-0">
              
            <form action="/updatepower" method="POST">@csrf      
            <div class="table-responsive mt-5">
              
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Staff Name</th>
                            <th>Make Sales</th>
                            <th>Add Student</th>
                            <th>Manage Expense</th>
                            <th>Make Payment</th>
                            <th>Check Sales Report</th>
                            <th>Set Fee</th>
                            <th>Add Staff</th>
                            <th>Print Result</th>
                            <th>Bussiness Report</th>
                            <th>Payment Profile</th>
                            <th>Edit Permissions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                       
                            $sname = $sch->name;
                            $i=0; foreach ($power as $p){ $i++; $nam = $sta->rName($p->uid);
                            
                            
                            $name = ($sname == $nam)?$sch->manager:$nam;
                            $hid = ($sid == $sch->sid)?'':'';
                            
                            // if($sid == $sch->sid){
                            // continue;
                            
                            // }
                            ?>
                            <tr style="display: {{$hid}} ">
                                <td>{{$i}} </td>
                                <td>{{ucwords($name)}}</td>
                                <input type="hidden" name="id{{$i}}" value={{$p->uid}}>
                                <th><input type="checkbox" name="make_sales{{$i}}" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="add_student{{$i}}" {{$sta->pow($p->add_student)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="add_expense{{$i}}" {{$sta->pow($p->add_expense)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="make_payment{{$i}}" {{$sta->pow($p->make_payment)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="sales_report{{$i}}" {{$sta->pow($p->sales_report)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="set_fees{{$i}}" {{$sta->pow($p->set_fees)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="add_staff{{$i}}" {{$sta->pow($p->add_staff)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="print_result{{$i}}" {{$sta->pow($p->print_result)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="big_salesrep{{$i}}" {{$sta->pow($p->big_salesrep)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="pay_profile{{$i}}" {{$sta->pow($p->pay_profile)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="power{{$i}}" {{$sta->pow($p->power)}} data-bootstrap-switch></th>
                                {{-- <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th>
                                <th><input type="checkbox" name="my-checkbox" {{$sta->pow($p->make_sales)}} data-bootstrap-switch></th> --}}
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
              </div>
              <button class="btn btn-primary float-right">Update Power</button>
            </form>

           </div>

          </div>


        </div>
        </div>
      </div>    
    </div><!-- /.container-fluid -->
  </section>

@endsection