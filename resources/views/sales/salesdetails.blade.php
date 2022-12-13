@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller;
$qty=0;

// $day = isset($_POST['startdate']) ? $_POST['startdate'] : date('Y-m-d');
// $day2 = isset($_POST['startdate2']) ? $_POST['startdate2'] : date('Y-m-d');
// $item = !empty($_POST['item']) ? $_POST['item'] : '';
// $srep = !empty($_POST['salesrepProfile']) ? $_POST['salesrepProfile'] : '';

$day = session('startdate') ? session('startdate') : date('Y-m-d');
$day2 = session('startdate2') ? session('startdate2') : date('Y-m-d');
$item = session('item') ? session('item') : '';
$srep = session('salesrepProfile') ? session('salesrepProfile') : '';

?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bussiness Report
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

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 col-sm-3">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Select</h3>
                </div>
                <div class="card-body pt-0">
                    <form action="/getinfo" method="post">@csrf
                        <label>Year</label>
                        <select name="salesrepProfile" class="form-control select2" style="width: 100%"> 
                            <option value="">All Staff</option>
                          @foreach ($staffs as $sr)
                              <option value="{{$sr->sid}} ">{{ucwords($sr->name)}} </option>
                          @endforeach
                          </select>
  
                          <label>Item</label>
                          <select name="item" class="form-control select2" style="width: 100%"> 
                            <option value="">All Item</option>
                            @foreach ($stocks as $st)
                                <option value="{{$st->id}} ">{{ucwords($st->item)}} </option>
                            @endforeach
                            </select>
                        <label>From</label>
                        <input class="form-control" type="date" name="startdate">


                        <label>To</label>
                        <input class="form-control" type="date" name="startdate2">
                        <button class="btn btn-primary btn-block mt-3">Search</button>
                      </form>
                </div>
              </div>
        </div>
        <div class="col-md-9 col-sm-9">
          <div class="card card-primary card-outline p-0">
            <div class="card-header border-0">
                <h3 class="card-title">DATE: <?php echo date('d M. Y',strtotime($day)).' - '.date('d M. Y',strtotime($day2))  ?> 
                    <?php if(!empty($item)){ echo '['.$sta->itemName($item).']';  } ?> 
                    <?php if(!empty($srep)){ echo '['.$sta->rName($srep).']'; } ?>
                </h3>
              </div>
            <div class="card-body pt-0">
            
            <div class="table-responsive">
                @if(empty($item))
                    <table id="example1" class="table table-sm">
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
                        <?php
                            $i=1; $amt=0; $cash=0;
                            if(empty($srep)){
                                $saless = $sta->sql('transact2','bid',$bid);
                            }else{
                                $saless = $sta->sql('transact2','rep',$srep);
                            }
                            foreach ($saless as $row){
                                $sns=$row->id;
                                if(strtotime($day) <= strtotime($row->created) AND strtotime($day2) >= strtotime($row->created)){
                                    $e=$i++; $amt += $row->amount; $cash += $row->cash;?>
                                    <tr class="odd gradeX" <?php if($row->cash==0){ ?> bgcolor="#FF66CC" <?php }  ?> >
                                        <td class="center"><?php echo $e ?></td>
                                        <td><?php echo ucfirst($row->salesid) ?></td>
                                        <td><?php echo $row->name;   ?></td>
                                        <td ><?php echo number_format($row->amount) ?></td>
                                        <td class="center"><?php echo number_format($row->cash) ?></td>
                                        <td  class="center"><?php echo $row->created ?></td>
                                        <td  class="center"><?php echo $sta->rName($row->rep) ?></td>
                                        <td  class="center"><a href="#" onclick="BrWindow('receipt.php?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')" > Receipt </a></td> 
                                    </tr>
                                <?php } 
                            }
                        ?>
                        <tr><th colspan="3">TOTAL</th>
                        <th><?php echo $amt; ?></th>
                        <th><?php echo $cash; ?></th><th></th><th></th><th></th></tr>
                        </tbody>
                    </table>
                @else
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th >Receipt No</th>
                                <th >Item</th>
                                <th >Qty</th>
                                <th >Price</th>
                                <th >Amount </th>
                                <th >Date/Time</th>
                                <th >Agent</th>
                                <th >Print</th>
                            </tr>
                        </thead>
                        <tbody> 
                        <?php
                            $i=1; $amt=0; $cash=0;
                            if(empty($srep)){
                                $saless = $sta->sqSb('transact','bid',$bid,'pid',$item);
                            }else{
                                $saless = $sta->sqSb1('transact','bid',$bid,'rep',$srep,'pid',$item);
                            }

                            foreach ($saless as $row){
                                $sns=$row->id;
                                if(strtotime($day) <= strtotime($row->created) AND strtotime($day2) >= strtotime($row->created)){$e=$i++; $amt += $row->amount; $qty += $row->qty;?>
                                    <tr class="odd gradeX" <?php if($row->cash==0){ ?> bgcolor <?php }  ?> >
                                            <td class="center"><?php echo $e ?></td>
                                             <td><?php echo ucfirst($row->salesid) ?></td>
                                            <td><?php echo $row->item;   ?></td>
                                             <td><?php echo $row->qty;   ?></td>
                                              <td><?php echo $row->price;   ?></td>
                                            <td ><?php echo number_format($row->amount) ?></td>
                                           
                                            <td  class="center"><?php echo $row->created ?></td>
                                            <td  class="center"><?php echo $sta->rName($row->rep) ?></td>
                                            <td  class="center"><a href="#" onclick="BrWindow('receipt.php?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')" > Receipt </a></td> 
                                    </tr>
                                    
                                <?php } 
                            }
                        ?>
                        <tr><th colspan="3">TOTAL</th>
                            <th><?php echo number_format($qty); ?></th></th><th><th>₦<?php echo number_format($amt); ?></th><th></th><th></th></tr>
                           
                        </tbody>
                    </table>
                @endif 
              </div>

           </div>

          </div>


        </div>
        </div>
      </div>    
    </div><!-- /.container-fluid -->
  </section>


@endsection