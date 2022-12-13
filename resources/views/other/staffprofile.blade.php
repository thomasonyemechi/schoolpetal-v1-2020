@extends('layouts.app')

@section('content')
<?php $te = 0;  $td = 0; 
$cuser = [];
$sta = new App\Http\Controllers\Profilecontroller;
if(session()->has('user') AND auth()->user()->level > 7){ 
  $user = session()->get('user');
}else{
  $user = $cuser;
}

$ad = auth()->user()->level;
   ?>
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
      <div class="col-md-6">
   
        @if(auth()->user()->level > 7)
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Quick Search</h3>
            </div>
            <form action="{{route('getstaff')}}" method="post" role="form">
              @csrf
              <div class="card-body">
                <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-md-12 form-group">
                    <select name="staff" class="form-control form-group select2bs4" onchange="submit()" required>
                      <option selected="selected" disabled="disabled" value="">... select staff</option>
                      @foreach ($staffs as $staff)
                        <option value="{{$staff->id}}">{{ucwords($staff->name)}}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
            </div>
            </form>
        </div>
        @endif
      @if ($user)
        {{-- {{session()->get('user')}} --}}
        <!-- About Me Box -->
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">{{$user->name}} Profile Information</h3>
           </div>

           <div class="card-body">
             <div class="row">

               <div class="col-md-4 col-6">
                <strong> Name</strong>
                 <p class="text-muted">
                   {{$user->name}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> E-mail</strong>
                 <p class="text-muted">
                   {{$user->email}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> Phone</strong>
                 <p class="text-muted">
                   {{$user->phone}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> Address</strong>
                 <p class="text-muted">
                   {{$user->address}}
                 </p>
                 <hr>
               </div>
                <div class="col-md-4 col-6">
                 <strong> Role</strong>
                  <p class="text-muted">
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Gender</strong>
                  <p class="text-muted">
                    {{$user->sex}}
                  </p>
                  <hr>
                </div>

                <div class="col-md-4 col-6">
                 <strong> Date of birth</strong>
                  <p class="text-muted">
                    {{$user->staffdata->dob}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Place of birth</strong>
                  <p class="text-muted">
                    {{$user->staffdata->birthplace}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> State of origin</strong>
                  <p class="text-muted">
                    {{$user->staffdata->state}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> L.G.A</strong>
                  <p class="text-muted">
                    {{$user->staffdata->lga}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-8 col-12">
                 <strong> Others</strong>
                  <p class="text-muted">
                    {{$user->staffdata->other}}
                  </p>
                </div>
                <div class="col-md-12">
                    <h2 class="pt-2 pb-2">Medical Infromation</h2>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Blood Group</strong>
                  <p class="text-muted">
                    {{$user->staffdata->bloodgr}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Genotype</strong>
                  <p class="text-muted">
                    {{$user->staffdata->genotype}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Physical Disability</strong>
                  <p class="text-muted">
                    {{$user->staffdata->disability}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Ailment</strong>
                  <p class="text-muted">
                    {{$user->staffdata->ailment}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-12">
                    <h2 class="pt-2 pb-2">Parent Information: Father/Guardian Father</h2>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Name</strong>
                  <p class="text-muted">
                    {{$user->staffdata->pname}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Phone</strong>
                  <p class="text-muted">
                    {{$user->staffdata->phone}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> E-mail</strong>
                  <p class="text-muted">
                    {{$user->staffdata->email}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Occupation</strong>
                  <p class="text-muted">
                    {{$user->staffdata->occupation}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-12">
                 <strong> Office Address</strong>
                  <p class="text-muted">
                    {{$user->staffdata->oficeadd}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-12">
                    <h2 class="pt-2 pb-2">Parent Information: Mother/Guardian Mother</h2>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Name</strong>
                  <p class="text-muted">
                    {{$user->staffdata->mname}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Phone</strong>
                  <p class="text-muted">
                    {{$user->staffdata->phone2}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> E-mail</strong>
                  <p class="text-muted">
                    {{$user->staffdata->email2}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-6">
                 <strong> Occupation</strong>
                  <p class="text-muted">
                    {{$user->staffdata->occupation2}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-4 col-12">
                 <strong> Office Address</strong>
                  <p class="text-muted">
                    {{$user->staffdata->officeadd2}}
                  </p>
                  <hr>
                </div>
                <div class="col-md-12">
                 <strong> Residential Address</strong>
                  <p class="text-muted">
                    {{$user->staffdata->address}}
                  </p>
                  <hr>
                </div>
                
                <div class="col-md-12">@if(auth()->user()->level > 8)
                  @if($user->act == 1)
                    <form action="{{route('deactivatestaff')}} " method="POST">@csrf
                      <button name="id" value="{{$user->id}} " class="btn btn-danger mt-1 float-left">Deactivate Stafff</button>
                    </form>
                  @else
                  <form action="{{route('activatestaff')}} " method="POST">@csrf
                    <button name="id" value="{{$user->id}} " class="btn btn-success mt-1 float-left">Activate Stafff</button>
                  </form>
                  @endif
                  <button class="btn btn-primary mt-1 float-right"  data-toggle="modal" data-target="#modal-default">Update Staff information</button>
                  @endif
                </div>
               
             </div>
            </div>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
      @endif

    </div>
    <!-- /.row -->
    @if($user)
      <div class="col-md-6">
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
        @if(auth()->user()->level > 8 OR auth()->user()->level == 7 OR $user->level == 7)
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Subject(s)</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-sm">
              <thead>
              <tr>
                <th>SN</th>
                <th>Subject</th>
                <th>Class</th>
                @if($ad > 8)
                <th>Action</th>
                @endif
              </tr>
              </thead>
              <tbody>
                <?php $i = 0; 
                $mysub = $sta->sql('setsubject','uid',$user->sid);
                
                foreach ($mysub as $dat){ $i++; ?>
                  <tr>
                    <td>{{$i}} </td>
                    <td>{{ucwords($sta->subject($dat->sid))}}</td>
                    <td>{{$sta->class($dat->classid)}}</td>
                    @if($ad > 8)
                    <td><form action="{{route('deletesubject2')}}" method="POST">@csrf
                    <button type="submit" name="id" value="{{$dat->id}}" class="btn btn-danger btn-xs">Delete</button></form> </td>
                    @endif
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        @endif

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

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Payment Details</h3>
          
              
          </div>
          <div class="card-body">
            

            <form action="{{route('getmy')}}" method="POST">@csrf
              <div class="pb-2 row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 col-6">
                  <select name="month" class="fo form-group-sm select2bs4 float-right" required>
                    <?php $mth = session()->has('month1')?session()->get('month1'):date("m");  ?>
                  <option selected="selected" value="{{$mth}}">{{date("F",mktime(0,0,0, $mth))}}</option>
                      <?php  for ($i=1; $i <13 ; $i++) { if($i==$mth){continue;}   ?>
                          <option value="{{$i}}">{{date("F",mktime(0,0,0, $i))}} </option>
                      <?php } ?>
                  </select>
                </div>
                <div class="col-sm-3 col-6">
                  <select name="year" class="form-control form-group select2bs4" required>
                    <?php $cy = session()->has('year1')?session()->get('year1'):date("Y");  ?>
                    <option selected="selected" value="{{$cy}} " selected>{{$cy}} </option>
                      <?php  $prev2 = date("Y")-1;
                      for($year=date("Y") ;$year>=$prev2;$year--){
                          if($year == $cy){ continue;}else { ?>
                            <option value="{{$year}} ">{{$year}} </option>
                      <?php } } ?>
                  </select>
                </div>
                <div class="col-sm-2"><button class="btn btn btn-default float-right">View</button>
                </div>
              </div>
            </form>
              
            <div class="row">
              <div class="col-md-6">
                <table id="example" class="table table-sm">
                  <thead>
                  <tr>
                    <th>Earning</th>
                    <th>Amount</th>
                    @if($ad == 8)
                    <th>Action</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($earning as $en){ @$te += $en->amount; ?>
                      <tr>
                        <td>{{$en->title}}</td>
                        <td>{{$en->amount}}</td>
                        @if($ad == 8)
                        <td><button class="btn btn-danger btn-xs" value="{{$en->id}}"><i class="fa fa-trash"></i></button> </td>
                        @endif
                      </tr> 
                    <?php } ?>
                    <tr>
                      <th>Total Earning</th>
                      <th>{{$te}} </th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <table id="example" class="table table-sm">
                  <thead>
                  <tr>
                    <th>Deduction</th>
                    <th>Amount</th>
                    @if($ad == 8)
                    <th>Action</th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($deduction as $dc){ @$td += $dc->amount; ?>
                      <tr>
                        <td>{{$dc->title}}</td>
                        <td>{{$dc->amount}}</td>
                        @if($ad == 8)
                        <td><button class="btn btn-danger btn-xs" value="{{$dc->id}}"><i class="fa fa-trash"></i></button> </td>
                        @endif
                      </tr> 
                    <?php } ?>
                    <tr>
                      <th>Total Discount</th>
                      <th>{{$td}} </th>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                  <label>NetPay:  </label><b>{{$te-$td}}</b>
                  {{-- <button class="btn btn-secondary float-right">Print Payslip</button> --}}
              </div>
              
            </div>


          </div>
          <!-- /.card-body -->
        </div>
        @if(auth()->user()->power->make_payment == 1)
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Payment</h3>
            </div>
            <div class="card-body">
              <form action="{{route('addpayment')}} " method="post" role="form">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <select name="month" class="form-control form-group select2bs4" required>
                        <?php $mth = session()->has('month')?session()->get('month'):date("m");  ?>
                      <option selected="selected" value="{{$mth}} " selected>{{date("F",mktime(0,0,0, $mth))}}</option>
                          <?php  for ($i=1; $i <13 ; $i++) { if($i==$mth){continue;}   ?>
                              <option value="{{$i}}">{{date("F",mktime(0,0,0, $i))}} </option>
                          <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <select name="year" class="form-control form-group select2bs4" required>
                        <?php $cy = session()->has('year')?session()->get('year'):date("Y");  ?>
                        <option selected="selected" value="{{$cy}} " selected>{{$cy}} </option>
                          <?php  $prev2 = date("Y")-1;
                          for($year=date("Y") ;$year>=$prev2;$year--){
                              if($year == $cy){ continue;}else { ?>
                                <option value="{{$year}} ">{{$year}} </option>
                          <?php } } ?>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <select name="type" class="form-control form-group select2bs4" required>
                        <option selected="selected" disabled="disabled" value="">Payment Type</option>
                          <option value="1">Earning</option>
                          <option value="0">Deduction</option>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <input type="number" name="amount" placeholder="Enter Amount" class="form-control" required>
                      <input type="hidden" name="id" value="{{$user->sid}} " class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <input type="text" name="title" placeholder="Enter Title" class="form-control" required>
                    </div>
                    <div class="col-md-6 form-group">
                      <button type="submit" class="btn btn-primary btn-block">Add Payment</button>
                    </div>
                </div>
              </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
        @endif


      </div>
     </div>
    @endif
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@if($user AND auth()->user()->level!=10)
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update {{ucwords($user->name)}} Profile Information </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('updatestaff')}}" method="post">
            <x-jet-validation-errors class="mb-4" />
            @csrf
            <br>
            {{-- $student->studentdata->birthplace --}}
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Full Name</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Name" type="text" name="name" value="{{$user->name}} " required autofocus autocomplete="surname" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Email</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Email" type="text" name="myemail" value="{{$user->email}}" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Phone Number</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Phone Number" type="text" name="myphone" value="{{$user->phone}}" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Gender</label>
                <select name="sex" class="form-control form-group select2bs4" required>
                  <option selected="selected" value="{{$user->sex}} ">{{$user->sex}}</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>

            </div>
            <div id="dvPassport">
              <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Date of Birth</label>
                <div class="input-group">
                  <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="date" name="dob" value="{{$user->staffdata->dob}}" autofocus autocomplete="dob" />
              </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Place of Birthh</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Place of Birth" type="text" name="birthplace" value="{{$user->staffdata->birthplace}}" autofocus autocomplete="birthplace" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Place of Birthh</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Place of Birth" type="text" name="birthplace" value="{{$user->staffdata->birthplace}}" autofocus autocomplete="birthplace" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>State of Origin</label>
              <select name="state" class="mt-1 form-control select2">
                <option selected="selected" disabled>State of Origin</option>
                <option>Yobe</option>
                <option>Zamfara</option>
                <option>Non Nigerian</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>L.G.A</label>
              <x-jet-input class="block mt-1 w-full" placeholder="L.G.A" type="text" name="lga" value="" autofocus autocomplete="lga" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">MEDICAL INFORMATION</strong>
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Blood Group</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Blood Group" type="text" name="bloodgr" value="{{$user->staffdata->bloodgr}}" autofocus autocomplete="bloodgr" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Genotype</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Genotype" type="text" name="genotype" value="{{$user->staffdata->genotype}}" autofocus autocomplete="genotype" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Ailment (if any)</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Ailment (if Any)" type="text" name="ailment" value="{{$user->staffdata->ailment}}" autofocus autocomplete="ailment" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Physical Disability (if any)</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Physical Disability (if Any)" type="text" name="disability" value="{{$user->staffdata->disability}}" autofocus autocomplete="disability" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">PARENTS INFORMATION <small>Father</small></strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s Name</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Name" type="text" name="pname" value="{{$user->staffdata->pname}}" autofocus autocomplete="pname" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s Phone Number</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Phone Number" type="text" name="phone" value="{{$user->staffdata->phone}}" autofocus autocomplete="phone" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s E-mail</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s E-mail" type="email" name="email" value="{{$user->staffdata->email}}" autofocus autocomplete="email" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s Occupation</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Occupation" type="text" name="occupation" value="{{$user->staffdata->occupation}}" autofocus autocomplete="occupation" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <label>Father`s Office Address</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Office Address" type="text" name="officeadd" value="{{$user->staffdata->officeadd}}" autofocus autocomplete="officeadd" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">PARENTS INFORMATION <small>Mother</small></strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s Name</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Name" type="text" name="mname" value="{{$user->staffdata->mname}}" autofocus autocomplete="mname" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s Phone Number</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Phone Number" type="text" name="phone2" value="{{$user->staffdata->phone2}}" autofocus autocomplete="phone2" />
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s E-mail</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s E-mail" type="email" name="email2" value="{{$user->staffdata->email2}}" autofocus autocomplete="email2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s Occupation</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Occupation" type="text" name="occupation2" value="{{$user->staffdata->occupation2}}" autofocus autocomplete="occupation2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <label>Mother`s Office Address</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Office Address" type="text" name="officeadd2" value="{{$user->staffdata->officeadd2}}" autofocus autocomplete="officeadd2" />
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-bottom:10px" >
              <label>Residential Address</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Residential Address" type="text" name="address" value="{{$user->staffdata->address}}" autofocus autocomplete="address" />
            </div>
              <div class="col-xs-6 col-sm-6 col-md-6" style="padding-bottom:10px" >
                <label>Any Other Information</label>
                <input type="hidden" name="id" value="{{$user->id}} ">
                <x-jet-input class="block mt-1 w-full" placeholder="Any Other Information" type="text" name="other" value="{{$user->staffdata->other}}" autofocus autocomplete="other" />
              </div>
          </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <button style="text-align:center; width:100%" type="submit" class="btn btn-primary">Update Profile information</button>
            </div>
          </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endif

@endsection
