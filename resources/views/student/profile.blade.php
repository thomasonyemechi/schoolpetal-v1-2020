@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <style>
  big{
    color:blue;
  }
  .pro{
    padding:5px;
  }
  </style>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Student Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  {{-- {{student()->}} --}}
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="../../dist/img/user4-128x128.jpg"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{''.ucwords($student->surname).' '.ucwords($student->firstname).' '.ucwords($student->midname)}}</h3>

              <p class="text-muted text-center">{{$student->regno}}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Class</b> <a class="float-right">{{$student->classe->class}}</a>
                </li>
              </ul>

              <a href="/student/{{$student->id}}/edit" class="btn btn-primary btn-block"><b>Edit Profile</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <!-- About Me Box -->
           <div class="card card-primary">
             <div class="card-header">
               <h3 class="card-title">Student Data</h3>
             </div>
             <!-- /.card-header -->

             <div class="card-body">
               <div class="row">
                 <div class="col-md-4 col-6">
                  <strong> Name</strong>
                   <p class="text-muted">
                       {{''.ucwords($student->surname).' '.ucwords($student->firstname).' '.ucwords($student->midname)}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Class</strong>
                   <p class="text-muted">
                       {{$student->classe->class}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Gender</strong>
                   <p class="text-muted">
                       {{ucwords($student->sex)}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Arm</strong>
                   <p class="text-muted">
                       {{ucwords($student->arm)}}
                   </p>
                   <hr>
                 </div>

                 <div class="col-md-4 col-6">
                  <strong> Date of birth</strong>
                   <p class="text-muted">
                       {{$student->studentdata->dob}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Place of birth</strong>
                   <p class="text-muted">
                      {{$student->studentdata->birthplace}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> State of origin</strong>
                   <p class="text-muted">
                       {{$student->studentdata->state}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> L.G.A</strong>
                   <p class="text-muted">
                       {{$student->studentdata->lga}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Previous School Attended</strong>
                   <p class="text-muted">
                       {{$student->studentdata->prschool}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Reason for leaving</strong>
                   <p class="text-muted">
                       {{$student->studentdata->reason}}
                   </p>
                 </div>
                 <div class="col-md-8 col-12">
                  <strong> Others</strong>
                   <p class="text-muted">
                       {{$student->studentdata->other}}
                   </p>
                 </div>
                 <div class="col-md-12">
                     <h2 class="pt-2 pb-2">Medical Infromation</h2>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Blood Group</strong>
                   <p class="text-muted">
                       {{$student->studentdata->bloodgr}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Genotype</strong>
                   <p class="text-muted">
                       {{$student->studentdata->genotype}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Physical Disability</strong>
                   <p class="text-muted">
                       {{$student->studentdata->disability}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Ailment</strong>
                   <p class="text-muted">
                       {{$student->studentdata->ailment}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-12">
                     <h2 class="pt-2 pb-2">Parent Information: Father/Guardian Father</h2>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Name</strong>
                   <p class="text-muted">
                       {{$student->studentdata->pname}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Phone</strong>
                   <p class="text-muted">
                       {{$student->studentdata->phone}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> E-mail</strong>
                   <p class="text-muted">
                       {{$student->studentdata->email}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Occupation</strong>
                   <p class="text-muted">
                       {{$student->studentdata->occupation}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-12">
                  <strong> Office Address</strong>
                   <p class="text-muted">
                       {{$student->studentdata->officeadd}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-12">
                     <h2 class="pt-2 pb-2">Parent Information: Mother/Guardian Mother</h2>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Name</strong>
                   <p class="text-muted">
                       {{$student->studentdata->mname}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Phone</strong>
                   <p class="text-muted">
                       {{$student->studentdata->phone2}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> E-mail</strong>
                   <p class="text-muted">
                       {{$student->studentdata->email2}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-6">
                  <strong> Occupation</strong>
                   <p class="text-muted">
                       {{$student->studentdata->occupation2}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-4 col-12">
                  <strong> Office Address</strong>
                   <p class="text-muted">
                       {{$student->studentdata->officeadd2}}
                   </p>
                   <hr>
                 </div>
                 <div class="col-md-12">
                  <strong> Residential Address</strong>
                   <p class="text-muted">
                       {{$student->studentdata->address}}
                   </p>
                   <hr>
                 </div>
              </div>
             </div>

             <!-- /.card-body -->
           </div>
           <!-- /.card -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
