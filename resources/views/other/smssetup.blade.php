@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller;

foreach ($api as $key) {
  $akey = $key->apikey;
  $sender = $key->senderid;
  $pos = ($key->pos == 1)?'checked':'';
  $fee = ($key->fee == 1)?'checked':'';
}
?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Student Result</h1>
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
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Update Api key</h3>
            </div>
            <div class="card-body">
              <form action="/updateapikeyssms" method="post">@csrf
                <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-md-6">
                    <Label>API key</Label>
                    <input type="text" class="form-control" name="apikey" placeholder="" required>
                  </div>

                  <div class="col-md-6">
                    <Label>Sender's Name</Label>
                    <input type="text"  class="form-control" name="sender" placeholder="" required>
                  </div>

                  <div class="col-md-12">
                    <button class="btn btn-primary float-right mt-2">Save</button>
                  </div>
                </div>
              </form>
              <hr class="mt-2">
              <div class="col-md-12">
                <div class="">
                  <label>Current Api key:</label> {{$akey}}
                  <br>
                  <label>Sender id:</label> {{$sender}}
                </div>
              </div>
            </div>  
        </div>        
   </div>

   <div class="col-md-6">
    <!-- general form elements -->
      <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title">Sms Preference</h3>
          </div>
          <div class="card-body">
            <form action="/updatesmsprefer" method="post">@csrf
              <div class="row">
                <div class="col-md-6">
                  <div class="icheck-primary">
                    <input type="checkbox" {{$pos}} id="check" name="pos">
                    <label for="check">Purchase Sms</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="icheck-primary">
                    <input type="checkbox" {{$fee}} id="check2" name="fee">
                    <label for="check2">Payment Of school Fee</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <button class="btn btn-primary float-right mt-2 mr-5">Save</button>
                </div>
              </div>
            </form>
            <em>Note: If sms is deactivated for an action, sms will not be sent if transacton is made</em>
          </div>  
      </div>        
 </div>

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    </div>
    
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection
