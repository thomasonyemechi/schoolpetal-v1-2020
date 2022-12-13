@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller;



?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Create Course</h1>
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
            <h3 class="card-title">Create Course </h3>
        </div>
        
           <form action="/updatepwd" method="POST">@csrf
          <button class="btn btn-danger">update pwd</button>
        </form>

        <form action="/dostudent" method="POST">@csrf
        <em>User the button to add student</em><br>
          <button class="btn btn-danger">Submit</button></form> <br>
          
          <form action="/triggerpay" method="POST">@csrf
          <em>Use this butoon to add payment if you have set some fee</em><br>
            <button class="btn btn-danger" >trigge rpay</button></form><br>

          <form action="/triggerques" method="POST">@csrf
          <em>Use this to add question first make sure you have some cbt exam</em><br>
            <button class="btn btn-danger">Cbt Question</button>
          </form>
<br>
          <form action="/atuofillresult" method="POST">@csrf
          <em>use this ti add cbt result for student first add cbt exams</em><br>
            <select class="form-control" name="class" required>
            <option disabled selected>select class</option>
              <?php $class = $sta->sql('class','bid',$sta->bid());
              foreach ($class as $k) { ?>
                <option value="{{$k->id}}">{{$k->class}}</option>
              <?php } ?>
            </select>
            <button class="btn btn-danger">Trigger Cbt Result</button>
          </form><br>

          {{-- <form action="/updatesmssetup" method="POST">@csrf
            <button class="btn btn-danger">Trigger Smsetup</button>
          </form> --}}<br>

          <form action="/autofillschoolresult" method="POST">@csrf
          <em>Use this for to generaete result for student by class</em><br>
            <select name="class" class="form-control" id="" required>
              <option disabled selected>select class</option>
              <?php $class = $sta->sql('class','bid',$sta->bid());
              foreach ($class as $k) { ?>
                <option value="{{$k->id}}">{{$k->class}}</option>
              <?php } ?>
            </select>
            <select name="subject" class="form-control" id="" required>
              <option disabled selected>select subject</option>
              <?php $sub = $sta->sql('subject','bid',$sta->bid());
              foreach ($sub as $ke) { ?>
                <option value="{{$ke->id}}">{{$ke->subject}}</option>
              <?php } ?>
            </select>
            <button class="btn btn-danger">Post subject result</button>
          </form><br>

        <form action="/addcourse" method="post" enctype="multipart/form-data" role="form">
            
            @csrf
            <div class="card-body">
            <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-md-6">
                    <label for="">Select Subject</label>
                    <select name="subject"  class="form-control select2">
                      <option selected disabled>..select subject</option>
                      @foreach ($subject as $ms)
                          <option value="{{$ms->id}}">{{$sta->subject($ms->sid)}} {{$sta->class($ms->classid)}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="">Select Term</label>
                    <select name="term"  class="form-control select2">
                      <option selected disabled>..select term</option>
                      <option value="1">First Term</option>
                      <option value="2">Second Term</option>
                      <option value="3">Third Term</option>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <label for="">Select Cover Picture</label>
                    <input type="file" name="photo" class="form-control" placeholder="" >
                  </div>

                  <div class="col-md-12">
                    <label for="">Detail</label><br>
                    <small>Course Description And What Student will learn</small>
                    <textarea name="description" class="textarea form-control" rows="4"></textarea>
                    <button class="btn btn-primary mt-2 float-right">Add Course</button>
                  </div>
                </div>
            </div>
        </form>
      </div>
   </div>
   <div class="col-md-6">
    <div class="card card-secondary">
        <div class="card-header">
            <h3>Recent Courses</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($course as $cs)
                          <tr>
                            <td>{{$loop->iteration}} </td>
                            <td>{{ucwords($sta->course($cs->sn))}}</td>
                            <td><a href="/createmodule/{{$cs->sn}}"><button class="btn btn-info btn-sm">Edit</button></a> </td>
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
