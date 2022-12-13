@extends('layouts.app')

@section('content')
  <?php 
  $sta = new App\Http\Controllers\Controller;
  
  $amt = 0; $dis = 0; $total = 0;
    $gclass = session()->get('class');    $gfee = session()->get('fee');    $gfeecost = session()->get('feecost');
   ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Account Management</h1>
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
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Set School Fees</h3>
            <button type="button" class="btn btn-default btn-sm float-right" data-toggle="modal" data-target="#modal-default">Add Fee Category</button>
          </div>
          <form action="{{route('addfee')}}" method="post" role="form">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <select name="fee" class="form-control form-group select2bs4" required>
                    <option selected="selected" disabled="disabled" value="">select fee type</option>
                    @foreach ($fees as $fee)
                      <option value="{{$fee->id}}">{{$fee->fee}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <select name="class" class="form-control form-group select2bs4" required>
                    <option selected="selected" disabled="disabled" value="">select class</option>
                    <option value="all">All Pupils/student</option>
                    @foreach ($class as $cla)
                      <option value="{{$cla->id}}">{{$cla->class}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-6 form-group">
                    <x-jet-input class="block w-full form-control" placeholder="fee amount" type="text" name="feecost" :value="old('feecost')" required autofocus autocomplete="feecost" />
                </div>
                <div class="col-md-6 form-group">
                  <button type="submit" class="btn btn-primary btn-block">Add School Fees</button>
                </div>
            </div>
          </div>
          </form>
        </div>
      </div>
      <div class="col-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Addjust fee for [ {{$sta->sqLx('class','id',$gclass,'class')}} ] </h3>
            {{-- <button type="button" class="btn btn-default btn-sm float-right" data-toggle="modal">Search Student</button> --}}
            <button type="button" class="btn btn-default btn-sm mr-1 float-right" data-toggle="modal" data-target='#fee'>Fee Analysis</button>
          </div>
          <div class="card-body">
            <form action="{{route('adjustfee')}}" method="post">
              @csrf
              <table id="example2" class="table table-sm">
              <thead>
                  <tr>
                      <th>SN</th>
                      <th>Student</th>
                      <th>Fee</th>
                       <th>Amount</th>
                       <th>Discount</th>
                       <th>Amount Due</th>

                </tr>
              </thead>
              <tbody>
                <?php if($gclass){ $e= 0; foreach($students as $std){ $e++; @$amt += $std->amount; @$dis += $std->discount; $total = $amt - $dis;
                  $max = $std->amount;
                  ?>
                  <tr class="odd gradeX">
                    <td>{{$e}}<input type="hidden" value="{{$std->id}}" name="sn{{$e}}"></td>
                    <td><a href="?fee={{$std->uid}}">{{ucwords($name[$e-1])}}</a></td>
                    <td>{{$sta->sqLx('feecat','id',$std->fee,'fee')}}</td>
                    <td><input type="number" class="form-control form-control-sm ca" min="0" value="{{$std->amount}}" name="ca{{$e}}" style="width:100px"></td>
                    <td><input type="number" class="form-control form-control-sm ca" min="0" value="{{$std->discount}}" name="cb{{$e}}" max="{{$max}}" style="width:100px"></td>
                    <td>{{$std->amount-$std->discount}}</td>
                  </tr>
                <?php }  ?>
                <tr>
                  <th></th>
                  <th colspan="2">sub-total</th>

                   <th>{{$amt}}</th>
                   <th>{{$dis}}</th>
                   <th>{{$total}}</th>
                 </tr>
                 <tr><td colspan="6"><button type="submit" class="btn btn-primary float-right">Submit Fee Adjustment</button></td></tr>
                 <?php } ?>
               </tbody>
             </table>
            <?php if($gclass){ ?>{{$students->links()}} <?php } ?>
            </form>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


      <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Fee Category</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('addfeecat')}}" method="post" role="form">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 form-group">
                      <label>Fee Category</label>
                      <x-jet-input class="block w-full form-control" type="text" name="feecategory" :value="old('feecategory')" required autofocus autocomplete="feecategory" />
                    </div>
                    <div class="col-md-8 form-group">
                      <label>Category Description</label>
                      <x-jet-input class="block w-full form-control" type="text" name="categorydescription" :value="old('categorydescription')" required autofocus autocomplete="categorydescription" />
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Add fee category</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <div class="modal fade" id="fee">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail Fee Analysis</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-sm">
              <thead>
                  <tr>
                      <th>SN</th>
                      <th>Fee</th>
                       <th>Range</th>
                       <th>Students</th>
                       <th>Amount</th>
                       <th>Discount</th>
                       <th>Amount Due</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; foreach($myfee as $sf) {  @$ndis += $sf['discount']; @$namt += $sf['amount'];
                  $ntot = $namt-$ndis; ?>
                  <tr class="odd gradeX">
                    <td>{{$i}}</td>
                    <td>{{$sf['fee']}}</td>
                    <td>{{$sf['range']}}</td>
                    <td>{{$sf['student']}}</td>
                    <td>{{number_format($sf['amount'])}}</td>
                    <td>{{number_format($sf['discount'])}}</td>
                    <td>{{number_format($sf['total'])}}</td>
                  </tr>
                <?php } ?>
                <tr>
                  <th></th>
                  <th colspan="3">Total</th>
                  <th>{{number_format($namt)}}</th>
                  <th>{{number_format($ndis)}}</th>
                  <th>{{number_format($ntot)}}</th>
                </tr>

               </tbody>
             </table>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



@endsection
