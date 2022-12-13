@extends('layouts.sapp')
@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller; 

$hamt = 0;  $tamt = 0; $tdis = 0; $tot2 = 0;
?>
    {{-- {{ Auth::guard('std')->id}} --}}

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">My Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-6">
              <!-- About Me Box -->
               <div class="card card-primary">
                 <div class="card-header">
                   <h3 class="card-title">Your Data</h3>
                 </div>
                 <!-- /.card-header -->
    
                 <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-6">
                         <strong> Name</strong>
                          <p class="text-muted">
                              {{''.ucwords($sta->sbid('surname')).' '.ucwords($sta->sbid('firstname')).' '.ucwords($sta->sbid('midname'))}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Class</strong>
                          <p class="text-muted">
                              {{$sta->class($sta->sbid('class'))}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                          <strong>User Name</strong>
                           <p class="text-muted">
                               {{$sta->sbid('username')}}
                           </p>
                           <hr>
                         </div>
                        <div class="col-md-6 col-6">
                         <strong> Gender</strong>
                          <p class="text-muted">
                              {{ucwords($sta->sbid('sex'))}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Arm</strong>
                          <p class="text-muted">
                              {{$sta->sbid('arm')}}
                          </p>
                          <hr>
                        </div>

                               
                        <div class="col-md-6 col-6">
                         <strong> Date of birth</strong>
                          <p class="text-muted">
                              {{$sta->sdata('dob')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Place of birth</strong>
                          <p class="text-muted">
                             {{$sta->sdata('birthplace')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> State of origin</strong>
                          <p class="text-muted">
                              {{$sta->sdata('state')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> L.G.A</strong>
                          <p class="text-muted">
                              {{$sta->sdata('lga')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Previous School Attended</strong>
                          <p class="text-muted">
                              {{$sta->sdata('prschool')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Reason for leaving</strong>
                          <p class="text-muted">
                              {{$sta->sdata('reason')}}
                          </p>
                        </div>
                        <div class="col-md-12 col-12">
                         <strong> Others</strong>
                          <p class="text-muted">
                              {{$sta->sdata('other')}}
                          </p>
                        </div>
                        <div class="col-md-12">
                            <h2 class="pt-2 pb-2">Medical Infromation</h2>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Blood Group</strong>
                          <p class="text-muted">
                              {{$sta->sdata('bloodgr')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Genotype</strong>
                          <p class="text-muted">
                              {{$sta->sdata('genotype')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Physical Disability</strong>
                          <p class="text-muted">
                              {{$sta->sdata('disability')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Ailment</strong>
                          <p class="text-muted">
                              {{$sta->sdata('ailment')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-12">
                            <h2 class="pt-2 pb-2">Parent Information: Father/Guardian Father</h2>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Name</strong>
                          <p class="text-muted">
                              {{$sta->sdata('pname')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Phone</strong>
                          <p class="text-muted">
                              {{$sta->sdata('phone')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> E-mail</strong>
                          <p class="text-muted">
                              {{$sta->sdata('email')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Occupation</strong>
                          <p class="text-muted">
                              {{$sta->sdata('occupation')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-12">
                         <strong> Office Address</strong>
                          <p class="text-muted">
                              {{$sta->sdata('officeadd')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-12">
                            <h2 class="pt-2 pb-2">Parent Information: Mother/Guardian Mother</h2>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Name</strong>
                          <p class="text-muted">
                              {{$sta->sdata('mname')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Phone</strong>
                          <p class="text-muted">
                              {{$sta->sdata('phone2')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> E-mail</strong>
                          <p class="text-muted">
                              {{$sta->sdata('email2')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-6">
                         <strong> Occupation</strong>
                          <p class="text-muted">
                              {{$sta->sdata('occupation2')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-6 col-12">
                         <strong> Office Address</strong>
                          <p class="text-muted">
                              {{$sta->sdata('officeadd2')}}
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-12">
                         <strong> Residential Address</strong>
                          <p class="text-muted">
                              {{$sta->sdata('address')}}
                          </p>
                          <hr>
                        </div>
                    
                    </div>
                 </div>
    
                 <!-- /.card-body -->
               </div>
               <!-- /.card -->
            <!-- /.col -->
          </div>
          <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Payment Profile</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>INV</th>
                                <th>Amount</th>
                                <th>Fee</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($mypay as $his){ @$hamt += $his->amount; if($his->salesid != '' ){ ?>
                            <tr>
                              <td>{{$his->salesid}} </td>
                              <td>{{$his->amount}} </td>
                              <td>{{$sta->fee($his->note)}} </td>
                              <td>{{date('M j,y', strtotime($his->created_at))}} </td>
          
                            </tr>
                          <?php }  } ?>
                          <tr>
                            <th colspan="1">Total</th>
                            <th>{{$hamt}} </th>
                          </tr>
                        </tbody>
                    </table>
                    {{$mypay->links()}}
                </div>
            </div>


            <div class="card card-secondary">
              <div class="card-header">
                  <h3 class="card-title">Expected History</h3>
              </div>
              <div class="card-body">
                  <table class="table table-sm">
                      <thead>
                          <tr>
                              <th>SN</th>
                              <th>Fee</th>
                              <th>Amount</th>
                              <th>Discount</th>
                              <th>Amount Due</th>
                      </thead>
                      <tbody>
                        <?php $i = 0; foreach ($myfee as $key) { 
                          $i++;  @$tamt += $key->amount; @$tdis += $key->discount; $tot2 = $tamt-$tdis; ?>
                          <tr>
                            <td>{{$i}}</td>
                            <td>{{$sta->fee($key->fee)}}</td>
                            <td>{{$key->amount}}</td>
                            <td>{{$key->discount}}</td>
                            <td>{{$key->amount-$key->discount}}</td>
                          </tr>
                        <?php } ?>
        
        
                        <tr>
                          <th colspan="2">Current Total Fee</th>
                          <th>{{$tamt}}</th>
                          <th>{{$tdis}}</th>
                          <th>{{$tot2}}</th>
                        </tr>
                        <tr>
                          <th colspan="4">Balance Brought Forward</th>
                          <th>$0</th>
                        </tr>
                        <tr>
                          <th colspan="4">Total Expected Fee</th>
                          <th>{{$tamt-$tdis}}</th>
                        </tr>
                        <tr>
                          <th colspan="4">Received Payment</th>
                          <th>{{$mytotal}} </th>
                        </tr>
                        <tr>
                          <th colspan="4">Balance</th>
                          <th>{{$tot2-$hamt}} </th>
                        </tr>
                      </tbody>
                  </table>
              </div>
          </div>

          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
      </section>
@endsection