@extends('layouts.app')

@section('content')
<?php  $sta = new App\Http\Controllers\Profilecontroller;  ?>
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
      <div class="col-md-6">

       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Manage Active Sessions</h3>
         </div>
         <div class="card-body">
           <form action="{{route('createterm')}}" method="post" role="form">
             @csrf
               <x-jet-validation-errors class="mb-4" />
               <div class="row">
                 <div class="col-md-4 col-6 form-group">
                   <select class="form-control" name="session" required>
                      <option value="">SELECT SESSION</option>
                      <option>{{date('Y')-1}}/{{date('Y')}}</option>
                      <option>{{date('Y')}}/{{date('Y')+1}}</option>
                  </select>
                 </div>
                 <div class="col-md-4 col-6 form-group">
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
           <div class="table-responsive">
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
               <?php foreach ($terms as $term){
                 $val = ($term->active == 1)?'':'<button name="ActivateTerm" value="'.$term->id.'" class="btn btn-success btn-xs">Activate</button>';
                 ?>
                 <tr>
                   <td>{{$term->sess}}</td>
                   <td>{{$sta->termname($term->term)}}</td>
                   <td>{{$term->close}}</td>
                   <td>{{$term->resume}}</td>
                   <td><form action="/ActivateTerm" method="POST">@csrf<?php echo $val ?> </form></td>
                 </tr>
                <?php } ?>
             </tbody>
           </table>
           </div>
          @if($sta->term('id'))
            <form action="{{route('updatedate')}}" method="post" class="pt-3" role="form">
              @csrf
                <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-md-4 col-6 form-group">
                    <label>Current Term Ends:</label>
                    <input type="date" class="form-control" name="end">
                  </div>
                  <div class="col-md-4 col-6 form-group">
                    <label>New Term Begins:</label>
                    <input type="date" class="form-control" name="next">
                  </div>
                  <div class="col-md-4 form-group">
                    <label class="text-white">.</label>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                  </div>
              </div>
            </form>
          @endif
         </div>
         <!-- /.card-body -->
       </div>
     </div>
       <div class="col-md-6">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Update School Infromation</h3>
           </div>
           <div class="card-body">

             <form action="{{route('updateadinfo')}}" method="post" class="pt-3" role="form">
               @csrf
                 <div class="row">
                   <div class="col-md-12 form-group">
                     <label>School Name</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Name" type="text" name="name" value="{{$user->name}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 col-6 form-group">
                     <label>Address</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Address" type="text" name="address" value="{{$user->address}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 col-6 form-group">
                     <label>email</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="email" type="text" name="email" value="{{$user->email}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 col-6 form-group">
                     <label>Phone Number</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Phone Number" type="text" name="phone" value="{{$user->phone}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 col-6 form-group">
                     <label>Phone Number2</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Phone Number" type="text" name="phone2" value="{{$user->phone2}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 col-6 form-group">
                     <label>Website</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="School Website" type="text" name="website" value="{{$user->website}}" autofocus autocomplete="surname" />
                   </div>
                   <div class="col-md-6 col-6 form-group">
                     <label>Manager</label>
                     <x-jet-input class="block mt-1 w-full" placeholder="Manager" type="text" name="manager" value="{{$user->manager}}" autofocus autocomplete="surname" />
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
           <div class="card-body">
           <form action="{{route('UpdateTitleLogo')}}" enctype="multipart/form-data" method="post">
              <div class="row">
                  @csrf
                  <div class="col-6">
                      <strong>Upload Logo:</strong>
                      <input type="file" name="photo" class="form-control" required/>
                      <br>
                      <input type="hidden" value="{{$user->name}} " name="name1"/>
                      <input type="hidden" value="{{$user->manager}} " name="nick1"/>
                      <button type="submit" class="btn btn-success pull-right">Upload Logo</button>
                  </div>
                  <div class="col-6">
                    <?php $image = ($user->photo =='')?'favicon.png':$user->photo;?>
                    <img src="bussiness/sch/{{$image}}"  class="user-image img img-rounded" alt="User Image" width="100"><br/>

                </div>
                  <div class="col-md-12">
                      

                  </div>
              </div>
          </form>
           </div>
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
