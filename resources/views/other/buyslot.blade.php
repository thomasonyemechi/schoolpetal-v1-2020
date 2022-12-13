@extends('layouts.app')

@section('content')
@php
    $sta = new App\Http\Controllers\ProfileCOntroller;
    $bid = $sta->bid();
@endphp
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Slot</h1>
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
      <div class="col-md-12">

       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Buy Slot <?php echo walletBalance(liveId()) ?></h3>
         </div>
         <div class="card-body">
             <b class="pb-2">Avaliable : {{slot($bid,'remain')}} </b>
            <form action="/generateSlotInvoice" method="POST" class="row">
                @csrf
 
                <div class="col-md-6">
                    Slot Amount:
                    <input type="number" min="1" max="250" class="form-control" name="slot" placeholder="Number of slot" required>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block mt-4" >Generate Invoice</button>
                </div>
            </form>


         </div>
         <!-- /.card-body -->
       </div>
       <div class="card card-secondary">
         <div class="card-header">
           <h3 class="card-title">Recent Slot Purchases</h3>
         </div>
         <div class="card-body">
           <div class="table-responsive">
               <table id="example" class="table table-sm">
             <thead>
             <tr>
               <th>sn</th>
               <th>Term/sess</th>
               <th>Slots</th>
               <th>Price</th>
               <th>Total</th>

               <th>Date/Time</th>
               <th>Action</th>
             </tr>
            </thead>
            <tbody>
                @foreach ($slots as $row)
                @php
                    $act = $row->active;
                @endphp
                    <tr>
                        <td>{{$loop->iteration}} </td>
                        <td>{{ucfirst($sta->termname($row->term))}} Term/{{$row->sess}} </td>
                        <td>{{$row->slot}}</td>
                        <td>{{$row->amount}}</td>
                        <td>{{$row->total}}</td> 
                        <td>{{date('j F Y',$row->ctime)}}</td>
                        <td>
                          @if($act == 1)
                            <a href="#" class="" style="color: green" disabled>Completed</a>
                          @else 
                          {{-- <a href="#" class="" style="color: rgb(254, 00, 00)" disabled>Pending</a> --}}
                          <form action="/getSlot" method="POST"> @csrf
                            <button type="submit" name="slotid" class="btn btn-xs  btn-danger" value="{{$row->token}}" title="Click to complete Transaction">Pending</button>
                          </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
     
           </table>
           {{$slots->links()}}
           </div>

         </div>
         <!-- /.card-body -->
       </div>
     </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

<script type="text/javascript">
  document.getElementById('options').onchange = function() {
      var i = 1;
      var myDiv = document.getElementById(i);
      while(myDiv) {
          myDiv.style.display = 'none';
          myDiv = document.getElementById(++i);
      }
      document.getElementById(this.value).style.display = 'block';
  };
  
  
  </script>

@endsection
