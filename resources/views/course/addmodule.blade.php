@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Chapter Management</h1>
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
            <h3 class="card-title">Create Chapters For {{strtoupper($sta->course($course->sn))}} </h3>
        </div>
        <form action="/addmoudle" method="post" enctype="multipart/form-data" role="form">
            
            @csrf
            <div class="card-body">
            <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-md-12">
                    <label for="">Chapter Name</label>
                    <input class="form-control" type="text" name="module">
                    <input class="form-control" type="hidden" name="cid" value="{{$course->sn}} ">
                  </div>
                  <div class="col-md-12">
                    <label for="">Detail</label><br>
                    <small>What will student learn after taking this module</small>
                    <textarea name="description" class="textarea form-control" rows="4"></textarea>
                    <button class="btn btn-primary mt-2 float-right">Add Module</button>
                  </div>
                </div>
            </div>
        </form>
      </div>
   </div>
   <div class="col-md-6">
    <div class="card card-secondary">
        <div class="card-header">
            <h3>Recent Chapters</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Chapter</th>
                            <th>Topics</th>
                            <th>Order By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($module as $cs)
                          <tr>
                            <td>{{$loop->iteration}} </td>
                            <td>{{ucwords($cs->module)}}</td>
                            <td>{{$sta->counttopic($cs->sn)}} </td>
                            <td>
                              <form action="/moduledown"  method="POST">@csrf
                              <button type="submit" class="btn btn-default btn-xs float-left" name="ClassDown" value="{{$cs->mindex}}"> <i class="fa fa-arrow-down"></i> </button>
                              </form>
        
                              <form action="/moduleup" method="POST">@csrf
                                <button type="submit" class="btn btn-default btn-xs " name="ClassUp" value="{{$cs->mindex}} "> <i class="fa fa-arrow-up"></i> </button>
                              </form>
        
                            </td>
                            <td><button class="btn btn-info btn-sm">Edit</button>
                              <button class="btn btn-primary btn-sm">Create Topic</button></td>
                          </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
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
