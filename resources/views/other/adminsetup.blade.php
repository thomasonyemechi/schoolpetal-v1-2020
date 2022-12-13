@extends('layouts.app')

@section('content')
 <?php $cs = session()->get('user'); ?>
 <?php $sta = new App\Http\Controllers\Profilecontroller;  ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User Management</h1>
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
           <h3 class="card-title">@if($cs) Update Role For {{ucwords($cs->name)}}  @else Add User @endif</h3>
         </div>
         <div class="card-body">

          @if($cs)
          <form action="/updaterole" method="post" role="form">
            @csrf
            {{-- @method('PUT') --}}
              <x-jet-validation-errors class="mb-4" />
              <div class="row">
                  <div class="col-md-12 form-group">
                    <label> Select user role</label>
                    <select name="role" class="form-control form-group select2bs4" required>
                    <option selected="selected" disabled="disabled" value="">Select Role</option>
                    <option value='8' {{cr(8,$cs->level)}} >Accountant</option>
                    <option value='9' {{cr(9,$cs->level)}}>Administrator</option>
                    <option value='5' {{cr(5,$cs->level)}}>Liberian</option>
                    <option value='7' {{cr(7,$cs->level)}}>Teacher</option>
                    <option value='6' {{cr(6,$cs->level)}}>Sales Rep</option>
                    
                  </select>
                  <input class="form-control" type="hidden" name="id" value="{{$cs->id}}">
                </div>
                <div class="col-md-12 form-group">
                  <button type="submit" class="btn btn-primary btn-block">Update</button>
                </div>
            </div>
          </form>
          @else
            <form action="{{route('adduser')}}" method="post" role="form">
              @csrf
              {{-- @method('PUT') --}}
                <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label>Select prefered Staff</label>
                    <select name="staff" class="form-control form-group select2bs4" required>
                      <option selected="selected" disabled="disabled" value="">...select Staff</option>
                      @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    </select>
                  </div>
                    <div class="col-md-12 form-group">
                      <label> Select user role</label>
                    <select name="role" class="form-control form-group select2bs4" required>
                      <option selected="selected" disabled="disabled" value="">Select Role</option>
                      <option value='8'>Accountant</option>
                      <option value='9'>Administrator</option>
                      <option value='5'>Liberian</option>
                      <option value='7'>Teacher</option>
                      <option value='6'>Sales Rep</option>
                      
                    </select>
                  </div>
                  <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                  </div>
              </div>
            </form>
          @endif
         </div>
         <!-- /.card-body -->
       </div>
       <div class="card card-secondary">
         <div class="card-header">
           <h3 class="card-title">Registered Users</h3>
         </div>
         <div class="card-body">
           <table id="example2" class="table table-sm">
             <thead>
             <tr>
               <th>Name</th>
               <th>Email</th>
               <th>Role</th>
               <th>Acction</th>
             </tr>
             </thead>
             <tbody>
               @foreach ($admins as $admin)
                 <tr>
                   <td>{{$admin->name}}</td>
                   <td>{{$admin->email}}</td>
                   <td>{{role($admin->level)}}</td>
                   <td>
                      <form action="{{route('pick')}}" method="post">@csrf
                        <button type="submit" name="staff" value="{{$admin->id}}" class="btn btn-primary btn-xs">Manage</button>
                      </form>
                    </td>
                 </tr>
                 {{-- href="{{route('adminsetup')}}"  --}}
               @endforeach
             </tbody>
           </table>
         </div>
         <!-- /.card-body -->
       </div>
     </div>
     @if($cs)
      <div class="col-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Update Operating Hours For {{ucwords($cs->name)}} </h3>
          </div>
          <div class="card-boody p-3">
                {{-- @foreach ($hours as $row)
                    {{$item->a1}}
                @endforeach --}}
                <?php   function timeDif($t1,$t2){$r = (strtotime($t2)-strtotime($t1)-3600);
                  return date('H:i',$r);
                } 
              
                ?>
                <table  class="table table-sm">
                    <thead>
                        <tr>
                            <th>Days</th>
                            <th>Opening</th>
                              <th>Closing</th>
                              <th>Remark</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php  
                      $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday',''];
                      $row = $hours;
                      foreach ($hours as $row){
                      $i=0;
                      while($i<=6){
                      $e=$i++;  $f = $e+1;
                      $a = 'a'.$f;  
                      $b = 'b'.$f;
                      $x = 'a'.date('N');
                      $y = 'b'.date('N');
                      $oh = timeDif($row->$a,$row->$b);  
                      $remark = ($row->$a==$row->$b)?'Closed':$oh.' Hours Open';

                    ?>            
                      <tr class="odd gradeX">
                            <td class="center"><?php  echo $days[$e]; ?></td>
                            <td class="bootstrap-timepicker">
                              
                              <input autocomplete="off" type="text" onkeydown="return false" class="form-control timepicker" name="<?php echo $a ?>" value="<?php echo $row->$a ?>">
                            </td>
                            <td class="bootstrap-timepicker">
                              
                              <input autocomplete="off" type="text" onkeydown="return false" class="form-control timepicker" name="<?php echo $b ?>" value="<?php echo $row->$b ?>">
                            </td>
                          <td><?php echo $remark ?></td>
                          
                      </tr>
                    <?php } } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2">
                      <form action="{{route('UpdateOperatingHr')}}" method="POST">@csrf
                        <button type="submit" class="btn btn-primary float-right" name="UpdateOperatingHr" value="{{$cs->id}}" >Update Operating Time </button>
                      </form></td>
                  @if($cs->act==1)
                  <form action="{{route('UserShutdown')}}" method="POST">@csrf
                  <td colspan="2"><button type="submit" class="btn btn-danger float-left" name="UserShutdown" value="{{$cs->act}}" >Prevent User Access</button></td></form>
                  @else
                  <form action="{{route('UserShutdown')}}" method="POST">@csrf
                  <td colspan="2"><button type="submit" class="btn btn-success float-left" name="UserShutdown" value="{{$cs->act}}" >Allow User Access</button></td>
                  </form>
                  @endif
                    </tr>
                  </tfoot>
                </table>
                <div class="col-12 pb-3">
                  
                </div>
                  
            <!-- /.box-body -->
              
              <!-- /.box-footer -->

          </div>
        </div>
      </div>
      @endif
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
