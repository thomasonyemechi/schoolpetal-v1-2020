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
            <h1 class="m-0 text-dark">Course Information</h1>
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
    <section class="">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         <!-- /.col -->
         <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Description</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Curricullum</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <?php echo $info->info ?>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-8">
                        <div class="well">
                          <ul>
                            <li></li>
                          </ul>
                        </div>

                        <nav class="mt-2">
                          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            

                          <?php foreach ($module as $row) {
                             $topic = $sta->sql('topic','mid',$row->sn);
                             
                             ?>

                            <li class="nav-item has-treeview">
                              <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                              <p><big>{{$row->module}}</big><small class="ml-3">({{count($topic)}} Topics)</small>
                                  <i class="right fas fa-angle-left"></i>
                                </p>
                              </a>
                              <ul class="nav nav-treeview ml-5">
                                @foreach ($topic as $rw)
                                  <li class="nav-item">
                                    <a class="nav-link">
                                      <i class="far fa-circle nav-icon"></i>
                                      <p>{{$rw->topic}}</p>
                                    </a>
                                  </li>
                                @endforeach
                              </ul>
                            </li>  

                            
                          <?php } ?>
                  


                         </ul>
                        </nav>

                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->

          </div>
          <!-- /.col -->

        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection