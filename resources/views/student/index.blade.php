@extends('layouts.app')

@section('content')
<?php
$hamt = 0;  $tamt = 0; $tdis = 0; $tot2 = 0;

$sta = new App\Http\Controllers\Profilecontroller;?>

  <!-- Content Header (Page header) -->
  <?php $student = session()->get('student'); ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Student Management</h1>
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
            <h3 class="card-title">Quick Search</h3>
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            <form action="{{route('getstudent')}}" method="post" role="form">
              @csrf
                <div class="row">
                  <div class="col-md-12 form-group">
                    <select name="studentid" class="form-control select2bs4" onchange="submit()">
                      <option selected disabled>select student </option>
                      @foreach ($students as $std)
                        <option value="{{$std->id}}">{{$std->surname}} {{$std->firstname}} {{$std->lastname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- About Me Box -->
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Student Data</h3>
           </div>
           <!-- /.card-header -->
           @if($student)
           @php
               $sid = $student->uid;
           @endphp
            <div class="card-body">
             <div class="row">
               <div class="col-md-4 col-6">
                <strong> Name </strong>
                 <p class="text-muted">
                     {{''.ucwords($student->surname).' '.ucwords($student->firstname).' '.ucwords($student->midname)}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong>UserName</strong>
                 <p class="text-muted">
                     {{$student->username}}
                 </p>
                 <hr>
               </div>
               
               <div class="col-md-4 col-6">
                <strong>Password</strong>
                 <p class="text-muted">
                     {{$student->pwd}}
                 </p>
                 <hr>
               </div>
               
               
               <div class="col-md-4 col-6">
                <strong> Class</strong>
                 <p class="text-muted">
                     {{@$student->classe->class}}
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
                  {{$sta->sinfo($sid,'state')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> L.G.A</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'lga')}}
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
                  {{$sta->sinfo($sid,'pname')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> Phone</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'phone')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> E-mail</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'fatheremail')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> Occupation</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'occupation')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-12">
                <strong> Office Address</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'officeadd')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-12">
                   <h2 class="pt-2 pb-2">Parent Information: Mother/Guardian Mother</h2>
               </div>
               <div class="col-md-4 col-6">
                <strong> Name</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'mname')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> Phone</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'phone2')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> E-mail</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'motheremail')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-6">
                <strong> Occupation</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'occupation2')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-4 col-12">
                <strong> Office Address</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'officeadd2')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-12">
                <strong> Residential Address</strong>
                 <p class="text-muted">
                  {{$sta->sinfo($sid,'address')}}
                 </p>
                 <hr>
               </div>
               <div class="col-md-12">@if(auth()->user()->level > 8)
                @if($student->active == 1)
                  <form action="{{route('deactivatestudent')}} " method="POST">@csrf
                    <button name="id" value="{{$student->id}} " class="btn btn-danger mt-1 float-left">Deactivate Student</button>
                  </form>
                @else
                <form action="{{route('activatestudent')}} " method="POST">@csrf
                  <button name="id" value="{{$student->id}} " class="btn btn-success mt-1 float-left">Activate Student</button>
                </form>
                @endif
                <button class="btn btn-primary mt-1 float-right"  data-toggle="modal" data-target="#modal-default">Update Student information</button>
                @endif
              </div>
            </div>
            </div>
          @endif

           <!-- /.card-body -->
         </div>
         <!-- /.card -->
         @if($student)


      

{{-- 
        
          <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Send SMS to parent</h3>           
              </div>
            <div class="card-body">
              <form method="post">
                <div class="box-body">
              <textarea name="sms" class="form-control" placeholder="Type SMS here..." rows="3"></textarea>
                  
                          <!-- /.box-body -->
                <p>&nbsp;</p>
              
                
                  <button type="submit" class="btn btn-primary float-right"  name="ComposeOneClientSms">Send SMS</button>
              </div>
            </form>

            <button type="submit" class="btn btn-success float-left mt-2"  name="RemindOneClient">Send Transaction Balance Reminder</button>
            </div>
          </div> --}}
          @endif
         
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <!-- About Me Box -->
         <div class="card card-secondary">
           <div class="card-header">
             <h3 class="card-title">Fee Payment History</h3>
           </div>
           <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-sm">
              <thead>
                  <tr>
                      <th>INV</th>
                       <th>Amount</th>
                       <th>Note</th>
                       <th>Date</th>
                       <th>Receipt</th>
                </tr>
              </thead>
              @if($student)
              {{-- {{print_r($payhis)}} --}}
              <tbody>
                <?php foreach ($payhis as $his){ @$hamt += $his['amount']; if($his['salesid'] != '' ){ ?>
                  <tr>
                    <td>{{$his['salesid']}} </td>
                    <td>{{$his['amount']}} </td>
                    <td>{{$his['note']}} </td>
                    <td>{{date('M j,y', strtotime($his['created_at']))}} </td>
                    <td><a href="">Print</a></td>

                  </tr>
                <?php }  } ?>
                <tr>
                  <th colspan="1">Total</th>
                  <th>{{$hamt}} </th>
                </tr>
              </tbody>

              @endif
             </table>
            </div>
         </div>
         
         <div class="card card-secondary">
           <div class="card-header">
             <h3 class="card-title">Expected Fees</h3>
           </div>
           <!-- /.card-header -->

            <div class="card-body">
              <table class="table table-sm">
              <thead>
                  <tr>
                      <th>SN</th>
                      <th>Fee</th>
                       <th>Amount</th>
                       <th>Discount</th>
                       <th>Amount Due</th>
                </tr>

              </thead>
              @if($student)
              <tbody>

                <?php $i = 0; foreach ($efee as $key) { 
                  $i++;  @$tamt += $key->amount; @$tdis += $key->discount; $tot2 = $tamt-$tdis; ?>
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$sta->sqLx('feecat','id',$key->fee,'fee')}}</td>
                    <td>{{$key->amount}}</td>
                    <td>{{$key->discount}}</td>
                    <td>{{$key->amount-$key->discount}}</td>
                  </tr>
                <?php } ?>


                <tr>
                  <th colspan="2">Current Total Fee</th>
                  <th>{{$tamt}}</th>
                  <th>{{$tdis}}</th>
                  <th>{{$tot2}}</th>
                </tr>
                <tr>
                  <th colspan="4">Balance Brought Forward</th>
                  <th>{{$sta->totalDebt($student->uid)}}</th>
                </tr>
                <tr>
                  <th colspan="4">Total Expected Fee</th>
                  <th>{{$tamt-$tdis}}</th>
                </tr>
                <tr>
                  <th colspan="4">Received Payment</th>
                  <th>{{$hamt}} </th>
                </tr>
                <tr>
                  <th colspan="4">Balance</th>
                  <th>{{$tot2-$hamt}} </th>
                </tr>
              </tbody>
              @endif
             </table>
            </div>


           <!-- /.card-body -->
         </div>
         <!-- /.card -->


         @if($student)

         <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title">Related Students</h3>           
            </div>
          <div class="card-body">
            <form  action="{{route('getstudent')}}" method="post">@csrf
              <div class="table-responsive">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th>SN </th>
                      <th>Name </th>
                      <th>Class </th>
                      <th>Gender </th>
                      <th>Profile </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; $sib = $sta->sql('students','parent',$student->parent) ;
                    foreach ($sib as $ke) { 
                    if($ke->uid == $student->uid){
                      continue;
                    }
                    $i++; 
                    ?>
         
                      <tr>
                        <td>{{$i}} </td>
                        <td>{{$sta->cname2($ke->uid)}} </td>
                        <td>{{$sta->class($ke->class)}} </td>
                        <td>{{$ke->sex}} </td>
                        <td><button name="studentid" class="btn btn-info btn-sm" value="{{$ke->id}}">Profile</button></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
          </form>
          </div>
        </div>


         @endif


         @if(auth()->user()->power->make_payment == 1)
           @if($student)
           <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Receive Payment</h3>
           </div>
           <!-- /.card-header -->

           <div class="card-body">
             <form action="{{route('payfee')}}" method="post" role="form">
               @csrf
                 <div class="row">
                   <div class="col-md-6 form-group">
                     <label>Amount</label>
                     <input type="number" name="amount" class="form-control">
                     <input type="hidden" name="uid" value="{{$student->uid}}" class="form-control">
                   </div>
                   <div class="col-md-6 form-group">
                     <label>Fee Type</label>
                     <select name="fee" class="form-control select2bs4">
                       <option selected disabled>...select fee type </option>
                       @foreach ($feecat as $fcat)
                         <option value="{{$fcat->id}}">{{$fcat->fee}}</option>
                       @endforeach
                     </select>
                   </div>
                   <div class="col-md-12"><button class="btn btn-primary float-right">Make Payment</button></div>
                 </div>
             </form>
           </div>
           <!-- /.card-body -->
         </div>
         
         @endif


         
         @endif
         <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@if($student)
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update {{$student->surname}} {{$student->firstname}} Profile Information </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('updatestudent')}}" method="post">
            <x-jet-validation-errors class="mb-4" />
            @csrf
            <br>
            {{-- $student->studentdata->birthplace --}}
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Surname</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Surname" type="text" name="surname" value="{{$student->surname}} " required autofocus autocomplete="surname" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Firstname</label>
                <x-jet-input class="block mt-1 w-full" placeholder="First Name" type="text" name="firstname" value="{{$student->firstname}} " autofocus autocomplete="firstname" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Middle Name</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="text" name="midname" value="{{$student->midname}} " required autofocus autocomplete="midname" />
              </div>
          
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <label>Gender</label>
                <select name="sex" class="form-control form-group select2bs4" required>
                  <option selected="selected" value="{{$student->sex}} ">{{$student->sex}}</option>
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
                  <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="date" name="dob" value="{{$student->studentdata->dob}}" autofocus autocomplete="dob" />
              </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Place of Birthh</label>
              <x-jet-input  class="block mt-1 w-full" placeholder="Place of Birth" type="text" name="birthplace" value="{{$student->studentdata->birthplace}}" autofocus autocomplete="birthplace" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Previous School Attended</label>
              <x-jet-input class="block mt-1 w-full" type="text" name="prschool" value="{{$student->studentdata->prschool}}" autofocus autocomplete="birthplace" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Reason for leaving</label>
              <x-jet-input class="block mt-1 w-full" type="text" name="reason" value="{{$student->studentdata->reason}}" autofocus autocomplete="birthplace" />
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>State of Origin</label>
              <select name="state" class="mt-1 form-control select2">
                <option selected="selected" value="{{$student->studentdata->state}} ">{{$student->studentdata->state}} </option>
                <option>Yobe</option>
                <option>Zamfara</option>
                <option>Non Nigerian</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>L.G.A</label>
              <x-jet-input class="block mt-1 w-full" placeholder="L.G.A" type="text" name="lga" value="{{$student->studentdata->lga}} " autofocus autocomplete="lga" />
            </div> --}}
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">MEDICAL INFORMATION</strong>
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Blood Group</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Blood Group" type="text" name="bloodgr" value="{{$student->studentdata->bloodgr}}" autofocus autocomplete="bloodgr" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Genotype</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Genotype" type="text" name="genotype" value="{{$student->studentdata->genotype}}" autofocus autocomplete="genotype" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Ailment (if any)</label>
                <x-jet-input class="block mt-1 w-full" placeholder="Ailment (if Any)" type="text" name="ailment" value="{{$student->studentdata->ailment}}" autofocus autocomplete="ailment" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Physical Disability (if any)</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Physical Disability (if Any)" type="text" name="disability" value="{{$student->studentdata->disability}}" autofocus autocomplete="disability" />
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">PARENTS INFORMATION <small>Father</small></strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s Name</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Name" type="text" name="pname" value="{{$student->studentdata->pname}}" autofocus autocomplete="pname" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s Phone Number</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Phone Number" type="text" name="phone" value="{{$student->studentdata->phone}}" autofocus autocomplete="phone" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s E-mail</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s E-mail" type="email" name="email" value="{{$student->studentdata->email}}" autofocus autocomplete="email" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Father`s Occupation</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Occupation" type="text" name="occupation" value="{{$student->studentdata->occupation}}" autofocus autocomplete="occupation" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <label>Father`s Office Address</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Office Address" type="text" name="officeadd" value="{{$student->studentdata->officeadd}}" autofocus autocomplete="officeadd" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">PARENTS INFORMATION <small>Mother</small></strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s Name</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Name" type="text" name="mname" value="{{$student->studentdata->mname}}" autofocus autocomplete="mname" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s Phone Number</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Phone Number" type="text" name="phone2" value="{{$student->studentdata->phone2}}" autofocus autocomplete="phone2" />
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s E-mail</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s E-mail" type="email" name="email2" value="{{$student->studentdata->email2}}" autofocus autocomplete="email2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <label>Mother`s Occupation</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Occupation" type="text" name="occupation2" value="{{$student->studentdata->occupation2}}" autofocus autocomplete="occupation2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <label>Mother`s Office Address</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Office Address" type="text" name="officeadd2" value="{{$student->studentdata->officeadd2}}" autofocus autocomplete="officeadd2" />
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6" style="padding-bottom:10px" >
              <label>Residential Address</label>
              <x-jet-input class="block mt-1 w-full" placeholder="Residential Address" type="text" name="address" value="{{$student->studentdata->address}}" autofocus autocomplete="address" />
            </div> --}}
              <div class="col-xs-6 col-sm-6 col-md-6" style="padding-bottom:10px" >
                <label>Any Other Information</label>
                <input type="hidden" name="id" value="{{$student->id}} "><input type="hidden" name="uid" value="{{$student->uid}} ">
                <x-jet-input class="block mt-1 w-full" placeholder="Any Other Information" type="text" name="other" value="{{$student->studentdata->other}}" autofocus autocomplete="other" />
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

  </div>
    @endif
@endsection
