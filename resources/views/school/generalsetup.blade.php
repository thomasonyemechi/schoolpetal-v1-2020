@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">School</h1>
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

       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Manage Active Sessions in my school</h3>
         </div>
         <div class="card-body">
           <form action="{{route('createterm')}}" method="post" role="form">
             @csrf
               <x-jet-validation-errors class="mb-4" />
               <div class="row">
                 <div class="col-md-4 form-group">
                   <select class="form-control" name="session" required>
                      <option value="">SELECT SESSION</option>
                      <option>{{date('Y')-1}}/{{date('Y')}}</option>
                      <option>{{date('Y')}}/{{date('Y')+1}}</option>
                  </select>
                 </div>
                 <div class="col-md-4 form-group">
                   <select class="form-control" name="term" required>
                    <option value="">SELECT TERM</option>
                    <option value="1">FIRST</option>
                    <option value="2">SECOND</option>
                    <option value="3">THIRD</option>
                  </select>
                 </div>
                 <div class="col-md-4 form-group">
                   <button type="submit" class="btn btn-primary btn-block">Submit</button>
                 </div>
             </div>
           </form>
         </div>
         <!-- /.card-body -->
       </div>
       <div class="card card-secondary">
         <div class="card-header">
           <h3 class="card-title">Registered Sessions/Terms</h3>
         </div>
         <div class="card-body">
           <table id="example" class="table table-sm">
             <thead>
             <tr>
               <th>session</th>
               <th>term</th>
               <th>term closes</th>
               <th>New Term Begins</th>
               <th>Action</th>
             </tr>
             </thead>
             <tbody>
               @foreach ($terms as $term)
                 <tr>
                   <td>{{$term->sess}}</td>
                   <td>{{$term->term}}</td>
                   <td></td>
                   <td></td>
                   <td><button class="btn btn-danger btn-xs">Activate</button> </td>
                 </tr>
               @endforeach
             </tbody>
           </table>

           <form action="" method="post" class="pt-3" role="form">
             @csrf
               <x-jet-validation-errors class="mb-4" />
               <div class="row">
                 <div class="col-md-4 form-group">
                   <label>Current Term Ends:</label>
                   <input type="date" class="form-control" name="">
                 </div>
                 <div class="col-md-4 form-group">
                   <label>New Term Begins:</label>
                   <input type="date" class="form-control" name="">
                 </div>
                 <div class="col-md-4 form-group">
                   <label class="text-white">.</label>
                   <button type="submit" class="btn btn-primary btn-block">Submit</button>
                 </div>
             </div>
           </form>
         </div>
         <!-- /.card-body -->
       </div>
     </div>
       <div class="col-6">
         <div class="card card-secondary">
           <div class="card-header">
             <h3 class="card-title">Salary Payment History</h3>
           </div>
           <div class="card-body">

             <form action="" method="post" class="pt-3" role="form">
               @csrf
                 <x-jet-validation-errors class="mb-4" />
                 <div class="row">
                   <div class="col-md-12 form-group">
                     <label>School Name</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Name" type="text" name="surname" value="{{$user->name}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 form-group">
                     <label>Address</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Address" type="text" name="surname" value="{{$user->address}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 form-group">
                     <label>email</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="email" type="text" name="surname" value="{{$user->email}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 form-group">
                     <label>Phone Number</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Phone Number" type="text" name="surname" value="{{$user->phone}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 form-group">
                     <label>Phone Number2</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Phone Number" type="text" name="surname" value="{{$user->phone2}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 form-group">
                     <label>Website</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="School Website" type="text" name="surname" value="{{$user->website}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 form-group">
                     <label>Manager</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Manager" type="text" name="surname" value="{{$user->manager}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-12 form-group">
                     <label>Motto</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Motto" type="text" name="motto" value="{{$user->motto}}" autofocus autocomplete="motto" />
                   </div>
                   <div class="col-md-12 form-group">
                     <button class="btn btn-primary float-right">Update Information</button>
                   </div>
               </div>
             </form>
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
