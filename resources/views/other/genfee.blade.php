@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$con = new App\Http\Controllers\Controller;
$un = new App\Http\Controllers\Unstock;

$srep = session()->get('srep');

$bid = $con->bid();
$term = $con->term('term');
$sess = $con->term('sess');


   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Fee Report
            <small class="text-sm">General Fee Detail for {{$sess}} {{ucwords($con->termname($term))}} Term </small></h1>
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
          <div class="card card-primary card p-0">
            {{-- <div class="card-header border-0">
              <h3 class="card-title">
                Quick Search
              </h3>
            </div> --}}
            <div class="card-body pt-0">
            
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student Name</th>
                            <th>Class</th>
                            <th>Amount </th>
                            <th>Discount</th>
                            <th>Amount Due</th>
                            <th>Amount Paid</th>
                            <th>Balance</th>
                            
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach ($feecat as $fc)
                            <tr><th colspan="12">{{ucwords($fc->fee)}} </th></tr>
                            <?php 
                            $fee = $fc->id; 
                            $fnow = $sta->lsql('fee','bid',$bid,'term',$term,'sess',$sess,'fee',$fee);
                            $i=0; $pf=0; $camt = 0; $cdis=0;
                            foreach($fnow as $nf){$i++; $mpay = $sta->allpay($nf->uid,$sess,$term,$fee);
                                $amd = $nf->amount-$nf->discount;

                                $camt += $nf->amount;
                                $cdis += $nf->discount;
                                $pf += $sta->allpay($nf->uid,$sess,$term,$fee);
                                
                                $aamd = $camt-$cdis;
                            ?>
                                <tr>
                                    <td>{{$i}} </td>
                                    <td>{{ucwords($sta->cName2($nf->uid))}} </td>
                                    <td>{{$sta->sqLx('class','id',$nf->class,'class')}}</td>
                                    <td>{{number_format($nf->amount)}}</td>
                                    <td>{{number_format($nf->discount)}}</td>
                                    <td>{{number_format($amd)}}</td>
                                    <td>{{number_format($mpay)}} </td>
                                    <td>{{number_format($amd-$mpay)}} </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th colspan="3"></th>
                                <th>{{number_format($camt)}} </th>
                                <th>{{number_format($cdis)}} </th>
                                <th>{{number_format($aamd)}}</th>
                                <th>{{number_format($pf)}}</th>
                                <th>{{number_format($aamd-$pf)}}</th>
                            </tr>
                            <tr>
                              <td colspan="12">{{$fnow->links()}}</td>
                            </tr>
                        @endforeach
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