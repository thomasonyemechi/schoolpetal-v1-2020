@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Subject Management</h1>
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
        <h3 class="card-title">Add New Subject</h3>
      </div>
      <form action="{{route('createsubject')}}" method="post" role="form">
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
          <div class="row">
            <div class="col-md-9 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Subject" type="text" name="subject" :value="old('subject')" autofocus autocomplete="subject" />
            </div>
            <div class="col-md-3 form-group">
            <button type="submit" class="block mt-1 w-full btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
    </div>


    <!--/.col (left) -->
    <!-- right column -->
    </div>
    <div class="col-md-6">
      @if(count($subjects)>0)
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">All Subjects</h3>
          </div>
          <div class="card-body">
            <table id="" class="table table-sm">
              <thead>
              <tr>
                <th>Subject</th>
                <th>status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($subjects as $sub)

                  <tr>
                    <td>{{ucwords($sub->subject)}}</td>
                    <td>active</td>
                    <td><form action="{{route('deletesubject')}}" method="post">@csrf
                      <button name="delete" value='{{$sub->id}}' class="btn btn-danger btn-sm ">Remove</button>
                     </form>
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
