@extends('layouts.app')

@section('content') <?php 
$fee = new App\Http\Controllers\Feecontroller; 
$sta = new App\Http\Controllers\Profilecontroller; 
$c = (session()->has('studentclass'))?session()->get('studentclass'):'';
$sum = 0; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Class Management</h1>
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
            <h3 class="card-title">Select Class To Continue</h3>
          </div>
            <div class="card-body">
                <form action="/getclass" method="post">@csrf
                    <div class="row">
                        <div class="col-md-12 form-group">
                          <select name="class" class="form-control form-group select2bs4" required onchange="submit()">
                            <option selected="selected" disabled="disabled">select class</option>
                            <option value="all">ALL STUDENTS/PUPILS</option>
                            @foreach ($class as $cla)
                                <option value="{{$cla->id}}">{{$cla->class}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>

        @if(session()->has('studentclass'))
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Send SMS to All in [{{$sta->class($c)}}] </h3>
                </div>
                <div class="card-body">
                  <form method="post">
                    <div class="box-body">
                  <textarea name="sms" class="form-control" placeholder="Type SMS here..." rows="3"></textarea>
                      
                               <!-- /.box-body -->
                     <p>&nbsp;</p>
                  
                    
                      <button type="submit" class="btn btn-primary float-right"  name="ComposeOneClientSms">Send SMS</button>
                   </div>
                 </form>
      
                 <button type="submit" class="btn btn-success float-left"  name="RemindClassClient">Send Balance Reminder</button>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-pink">
                <div class="card-header">
                  <h3 class="card-title">Other Operations</h3>
                </div>
                <div class="card-body">
                  <a href="/printresultall" class="btn btn-success">Click To Print All Result</a>
                  <a href="/generatecomment" class="btn btn-sucess">Click To Print Generate/Edit Result Comment</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Payment Profile for [{{$sta->class($c)}}]</h3>
            </div>
              <div class="card-body">
                 <?php
                 
                 echo $fee->showClassPayment($c); 
                 $sql = $fee->student($c);  ?>
                 {{$sql->links()}}
              </div>
            </div>
          </div>
        @endif
     

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
