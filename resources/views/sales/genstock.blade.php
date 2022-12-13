@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$un = new App\Http\Controllers\Unstock;

$srep = session()->get('srep');
   ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bussiness Report
            <small class="text-sm">General Stock Detail</small></h1>
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
            {{-- <div class="card-header border-0">
              <h3 class="card-title">
                Quick Search
              </h3>
            </div> --}}
            <div class="card-body pt-0">
            
            <div class="table-responsive mt-5">
                <table class="table table-sm">
                    <thead>
                                         <tr>
                                             <th>SN</th>
                                             <th>Item</th>
                                            <th>Stock Qty</th>
                                            <th>Unit Cost</th>
                                            <th>Unit Price</th>
                                            <th>Sold Qty</th>
                                            <th>Sold Amt</th>
                                            
                                       </tr>
                                     </thead>
                                     <tbody> 
                                    <?php $i = 0;  foreach($cats as $c){ $i++; ?>
                                        <tr>
                                            <th colspan="8">{{$i}}. {{$c->cat}}</th>
                                            <?php  ?>
                                        </tr>
                                            <?php $sql = $sta->sql('stock','cat',$c->id);
                                         $e = 0; foreach ($sql as $row) { $e++; ?>
                                        <tr>
                                            <td>{{$e}} </td>
                                            <td>{{$row->item}} </td>
                                            <td><?php echo number_format($un->itemqty($row->id)) ?></td>
                                            <td>{{$row->unitcost}} </td>
                                            <td>{{$row->unitprice}} </td>
                                            <td>{{$sta->sqSuma('transact','item',$row->item,'qty')}} </td>
                                            <td>{{$sta->sqSuma('transact','item',$row->item,'amount')}} </td>
                                        </tr>
                                        <?php } ?>
                                    <?php } ?>

                            

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