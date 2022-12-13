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
            <h1 class="m-0 text-dark">Active Exam</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Active</li>
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
                <div class="d-md-flex">
                    <div class="row">
                        <?php foreach ($aexam as $row) {  $col = ($row->status==1)?'success':'warning'; ?>
                            <div class="col-md-6">
                                <div class="info-box mb-3 bg-{{$col}}">
                                    <span class="info-box-icon"><i>{{strtoupper(substr($sta->subject($row->subject),0,3))}}</i></span>
                        
                                   <div class="info-box-content">
                                    <a href="/answer/{{$row->sn}}"><span class="info-box-number">{{strtoupper($sta->esn($row->sn))}} {{strtoupper($sta->termname($row->term))}} TERM</span>
                                        <span class="info-box-text">{{$sta->countques($row->sn)}} Active Questions</span>
                                    </div></a>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            
                            </div>
                        <?php } ?>
                        <div class="col-md-12">
                            {{$aexam->links()}}
                        </div>
                    </div>
                  </div><!-- /.card-pane-right -->
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