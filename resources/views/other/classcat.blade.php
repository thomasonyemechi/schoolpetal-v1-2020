@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Caregory/Arm Management</h1>
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
        <h3 class="card-title">Add New Class Category</h3>
      </div>
      <form action="{{route('createcat')}}" method="post" role="form">
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
          <div class="row">
            <div class="col-md-9 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Class Category" type="text" name="classCategory" :value="old('classCategory')" required autofocus autocomplete="classcat" />
            </div>
            <div class="col-md-3 form-group">
            <button name="postproject" type="submit" class="block mt-1 w-full btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
    </div>


      <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add New Class Arm</h3>
      </div>
      <form action="{{route('createarm')}}" method="post" role="form">
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
          <div class="row">
            <div class="col-md-9 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Class Arm" type="text" name="classArm" :value="old('classArm')" required autofocus autocomplete="classArm" />
            </div>
            <div class="col-md-3 form-group">
            <button name="postproject" type="submit" class="block mt-1 w-full btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    </div>
    <div class="col-md-6">
      @if(count($classcats)>0)
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">All Class Category</h3>
          </div>
          <div class="card-body">
            <table id="" class="table table-sm">
              <thead>
              <tr>
                <th>Category</th>
                <th>Date</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($classcats as $cat)

                  <tr>
                    <td>{{ucwords($cat->cat)}}</td>
                    <td><p>
                        {{$cat->created_at}}
                      </p>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      @endif
      @if(count($classarms)>0)
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">All Class Arm</h3>
          </div>
          <div class="card-body">
            <table id="" class="table table-sm">
              <thead>
              <tr>
                <th>Arm</th>
                <th>Date</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($classarms as $arm)

                  <tr>
                    <td>{{ucwords($arm->arm)}}</td>
                    <td><p>
                      {{$arm->created_at}}</p>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      @endif
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection
