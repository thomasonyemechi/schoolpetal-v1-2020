@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Add Exams</h1>
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
    <div class="col-md-4">
      <!-- general form elements -->

      <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Exam</h3>
        </div>
        <form action="addexam" method="post" role="form">
            
            @csrf
            <div class="card-body">
            <x-jet-validation-errors class="mb-4" />
                <div class="row">
                    <div class="col-md-12">
                        <label>Select Subject</label>
                        <select name="subject" class="form-control select2">
                            <option selected disabled>..Select Subject</option>
                            <?php foreach ($subject as $t) {?>
                                <option value="{{$t->id}} ">{{$sta->class($t->classid)}} {{$sta->subject($t->sid)}}</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label>Select Exam Type</label>
                        <select name="type" class="form-control select2">
                            <option selected disabled>..select Exam Type</option>
                            <?php foreach ($type as $t) {?>
                                <option value="{{$t->sn}} ">{{$t->examtype}}</option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                      <label>Select Term</label>
                      <select name="term" class="form-control select2" required>
                          <option selected disabled>..select Term</option>
                          <option value="1">First Term</option>
                          <option value="2">Second Term</option>
                          <option value="3">Third Term</option>
                      </select>
                      <button class="btn btn-primary mt-1 btn-block">Create Type</button>
                  </div>


                </div>
            </div>
        </form>
      </div>
   </div>
   <div class="col-md-8">
    <div class="card card-secondary">
        <div class="card-header">
            <h3>Recent Exams</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Term</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($exam as $t) { $i++; ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$sta->sqlx('subject','id',$t->subject,'subject')}}</td>
                                <td>{{$sta->sqlx('class','id',$t->class,'class')}}</td>
                                <td>{{$sta->sqlx('type','sn',$t->examtype,'examtype')}}</td>
                                <td>{{$sta->termname($t->term)}} term</td>
                                <td><form action="/getesn" method="post">@csrf<button name="esn" value="{{$t->sn}}" class="btn btn-info btn-sm">Add Questions</button></form></td>
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
