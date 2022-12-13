@extends('layouts.app')

@section('content')
  <?php use \App\Http\Controllers\Controller; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Contact Management</h1>
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
      <div class="col-6">
      <!-- About Me Box -->
       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Staff Profile Information</h3>
         </div>
         <!-- /.card-header -->
         {{-- @foreach ($user as $use)
           {{$user->name}}
         @endforeach --}}

         <div class="card-body">
           <div class="row">
             {{-- @foreach ($use as $user => $value) --}}

             <div class="col-md-6 col-6">
              <strong> Name</strong>
               <p class="text-muted">
                 {{$user->name}}
               </p>
               <hr>
             </div>
             <div class="col-md-6 col-6">
              <strong> E-mail</strong>
               <p class="text-muted">
                 {{$user->email}}
               </p>
               <hr>
             </div>
             <div class="col-md-6 col-6">
              <strong> Phone</strong>
               <p class="text-muted">
                 {{$user->phone}}
               </p>
               <hr>
             </div>
             <div class="col-md-6 col-6">
              <strong> Address</strong>
               <p class="text-muted">
                 {{$user->address}}
               </p>
               <hr>
             </div>
           </div>
         </div>

         <!-- /.card-body -->
       </div>
       <!-- /.card -->
       @if(auth()->user()->level > 9)
       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Set Subjects</h3>
         </div>
         <div class="card-body">
           <form action="{{route('setsubject', $user->id)}}" method="post" role="form">
             @csrf
             <div class="card-body">
               <x-jet-validation-errors class="mb-4" />
               <div class="row">
                 <div class="col-md-4 form-group">
                   <select name="subject" class="form-control form-group select2bs4" required>
                     <option selected="selected" disabled="disabled" value="">... select Subject</option>
                     @foreach ($subjects as $sub)
                       <option value="{{$sub->id}}">{{ucwords($sub->subject)}}</option>
                     @endforeach
                   </select>
                 </div>
                 <div class="col-md-4 form-group">
                   <select name="class" class="form-control form-group select2bs4" required>
                     <option selected="selected" disabled="disabled" value="">... select Class</option>
                     @foreach ($classes as $class)
                       <option value="{{$class->id}}">{{ucwords($class->class)}}</option>
                     @endforeach

                   </select>
                 </div>
                 <div class="col-md-4 form-group">
                   <button type="submit" class="btn btn-primary btn-block">Submit</button>
                 </div>
             </div>
           </div>
           </form>
         </div>
         <!-- /.card-body -->
       </div>
        @endif
     </div>
       <div class="col-6">
         <div class="card card-secondary">
           <div class="card-header">
             <h3 class="card-title">Salary Payment History</h3>
           </div>
           <div class="card-body">
             <table id="example" class="table table-sm">
               <thead>
               <tr>
                 <th>INV</th>
                 <th>Date</th>
                 <th>Ammount</th>
               </tr>
               </thead>
               <tbody>
               </tbody>
             </table>
           </div>
           <!-- /.card-body -->
         </div>
         <div class="card card-secondary">
           <div class="card-header">
             <h3 class="card-title">Subject(s)</h3>
           </div>
           <div class="card-body">
             <table id="example" class="table table-sm">
               <thead>
               <tr>
                 <th>Subject</th>
                 <th>Class</th>
                 <th>Acction</th>
               </tr>
               </thead>
               <tbody>
                 @foreach ($mysubject as $dat)
                   <tr>
                     <td>{{$dat->sid}}</td>
                     <td>{{$dat->classid}}</td>
                     <td><button class="btn btn-danger btn-xs">Delete</button> </td>
                   </tr>
                 @endforeach
               </tbody>
             </table>
           </div>
           <!-- /.card-body -->
         </div>

         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Payment Details</h3>
           </div>
           <div class="card-body">
             <form action="{{route('paymentdetail')}}" method="post" role="form">
               @csrf
               <div class="card-body">
                 <x-jet-validation-errors class="mb-4" />
                 <div class="row">
                   <div class="col-md-4 form-group">
                     <select name="month" class="form-control form-group select2bs4" required>
                       <option selected="selected" disabled="disabled" value="">... select month</option>
                         <option value="khbjhkb">october</option>
                     </select>
                   </div>
                   <div class="col-md-4 form-group">
                     <select name="year" class="form-control form-group select2bs4" required>
                       <option selected="selected" disabled="disabled" value="">... select Year</option>
                         <option value="khbjhkb">2020</option>
                     </select>
                   </div>
                   <div class="col-md-4 form-group">
                     <button type="submit" class="btn btn-primary btn-block">View</button>
                   </div>
               </div>
             </div>
             </form>


             <table id="example" class="table table-sm">
               <thead>
               <tr>
                 <th>INV</th>
                 <th>Date</th>
                 <th>Ammount</th>
               </tr>
               </thead>
               <tbody>
               </tbody>
             </table>


           </div>
           <!-- /.card-body -->
         </div>
       </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
