@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Add Examtype</h1>
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
    <div class="col-md-3">
      <!-- general form elements -->

      <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Exam Type</h3>
        </div>
        <form action="addtype" method="post" role="form">
            
            @csrf
            <div class="card-body">
            <x-jet-validation-errors class="mb-4" />
                <input type="text" name="type" class="form-control" placeholder="Exam Type" >
                <button class="btn btn-primary mt-1 btn-block">Create Type</button>
            </div>
        </form>
      </div>
   </div>
   <div class="col-md-9">
    <div class="card card-secondary">
        <div class="card-header">
            <h3>Recent Exam Type</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($type as $t) { $i++; ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$t->examtype}}</td>
                                <td><button class="btn btn-danger btn-sm">Deactivate</button> <button class="btn btn-info btn-sm">Profile</button></td>
                            </tr>
                        <?php } ?>
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
