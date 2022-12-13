@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Class Management</h1>
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
        <h3 class="card-title">Add New Class</h3>
      </div>
      <form action="{{route('createclass')}}" method="post" role="form">
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
          <div class="row">
            <div class="col-md-6 form-group">
              <select name="class" class="form-control form-group select2bs4" required>
                <option selected="selected" disabled="disabled" value="">Class Category</option>
                @foreach ($classcats as $cat)
                  <option value="{{$cat->cat}}">{{$cat->cat}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6 form-group">
              <select name="level" class="form-control form-group select2bs4" required>
                <option selected="selected" disabled="disabled" value="">Level</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
              </select>
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
      @if(count($classes)>0)
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">All Class</h3>
          </div>
          <div class="card-body">
            <table id="" class="table table-sm">
              <thead>
              <tr>
                <th>Class</th>
                <th>Profile</th>
                <th>Order By</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($classes as $cla)

                  <tr>
                    <td>{{ucwords($cla->class)}}</td>
                    <td><p>
                      <form action="/classdelete" method="POST">@csrf
                      <button name="class" class="btn btn-danger btn-xs" value="{{$cla->id}}" >Remove</button>
                      </form></p>
                    </td>
                    <td>
                      <form action="{{route('ClassDown')}}"  method="POST">@csrf
                      <button type="submit" class="btn btn-default btn-xs float-left" name="ClassDown" value="{{$cla->classindex}}"> <i class="fa fa-arrow-down"></i> </button>
                      </form>

                      <form action="{{route('ClassUp')}}" method="POST">@csrf
                        <button type="submit" class="btn btn-default btn-xs " name="ClassUp" value="{{$cla->classindex}} "> <i class="fa fa-arrow-up"></i> </button>
                      </form>

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <em>NOTE: Classes must be arranged from lowest to highest. You can re-order them where necessary </em>
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
