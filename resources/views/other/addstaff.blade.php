@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Staff Management</h1>
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
        <h3 class="card-title">Add New Staff</h3>
      </div>
      <form action="{{route('adderuser')}}" method="post" role="form">
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
          <div class="row">
            <div class="col-md-6 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Full Name" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            </div>
            <div class="col-md-6 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="E-mail" type="email" name="email" :value="old('email')" autofocus autocomplete="email" />
            </div>
            <div class="col-md-6 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Phone" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
            </div>
            <div class="col-md-6 form-group">
              <select class="block mt-1 w-full form-control select2 bs4" name="gender" id="">
                <option selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="col-md-12 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Address" type="text" name="address" :value="old('address')" autofocus autocomplete="address" />
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
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">All Class</h3>
          </div>
          <div class="card-body">
            <table id="example1" class="table table-sm">
              <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Profile</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)

                  <tr>
                    <td>{{ucwords($user->name)}}</td>
                    <td>{{ucwords($user->phone)}}</td>
                    <td>{{ucwords($user->address)}}</td>
                    <td><form method="post" action="/getstaff">@csrf
                      <button name="staff" value='{{$user->id}}' class="btn btn-info btn-xs">profile</button>
                     </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection
