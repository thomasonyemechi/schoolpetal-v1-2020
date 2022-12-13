@extends('layouts.sapp')
@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller;  ?>
    {{-- {{ Auth::guard('std')->id}} --}}

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pick A Preferred Course</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Course</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-md-12">

            <!-- MAP & BOX PANE -->
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body ">
                <div class="row">
                    <?php foreach ($acourse as $row) {  $col = ($row->status==1)?'success':'warning'; ?>
                        <div class="col-md-3 col-sm-3">
                            <div class="well mt-3 m-3 ">
                                <img width="100%" src="/bussiness/sch/{{$row->photo}}">
                                <b class="mt-5" style="margin-top: 20px;"><a href="/courseinfo/{{$row->sn}}" class="text-center">{{strtoupper($sta->course($row->sn))}}</a></b>
                                <p><?php echo substr($row->info,0,100); ?></p>
                              </div>
                        </div>
                    <?php } ?>                            
                    <div class="col-md-12">
                        {{$acourse->links()}}
                    </div>
                </div>
                </div><!-- /.d-md-flex -->
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection