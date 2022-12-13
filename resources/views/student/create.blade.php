@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller; ?>
  <!-- Content Header (Page header) -->
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
    <!-- left column -->


    <div class="col-md-6">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add New Student</h3>
        </div>
        <div class="card-body">
          <form action="{{route('student.store')}}" method="post">
            <x-jet-validation-errors class="mb-4" />
            @csrf
            <br>
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-12" style="padding-bottom:10px" >
                <select class="form-control select2 bs4"  name="parent" required>
                  <option selected disabled>Select Parent </option>
                  <?php $parent = $sta->sql('parent','bid',$sta->bid());
                  foreach ($parent as $row) {  ?>
                    <option value="<?php echo $row->uid ?>"><?php echo $row->pname ?> <b>|</b> <?php echo $row->mname ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                <x-jet-input class="block mt-1 w-full" placeholder="Surname" type="text" name="surname" :value="old('surname')" required autofocus autocomplete="surname" />
              </div>
              <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                <x-jet-input class="block mt-1 w-full" placeholder="First Name" type="text" name="firstname" :value="old('firstname')" autofocus autocomplete="firstname" />
              </div>
              <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="text" name="midname" :value="old('midname')" required autofocus autocomplete="midname" />
               </div>
               <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                 <select name="sex" class="block mt-1 w-full form-control form-group select2bs4" required>
                   <option selected="selected" disabled="disabled" value="">Gender</option>
                   <option value="Male">Male</option>
                   <option value="Female">Female</option>
                 </select>
               </div>
               <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                 <select name="class" class="block mt-1 w-full form-control form-group select2bs4" required>
                   <option selected="selected" disabled="disabled" value="">Prospective Class</option>
                   @foreach ($classes as $cla)
                     <option value="{{$cla->id}}">{{$cla->class}}</option>
                   @endforeach
                 </select>
               </div>
               <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                 <select name="arm" class="block mt-1 w-full form-control form-group select2bs4">
                   <option selected="selected">Class Arm</option>
                   @foreach ($classarms as $arm)
                     <option value="{{$arm->id}}">{{$arm->arm}}</option>
                   @endforeach
                 </select>
               </div>
             </div>
             <script type="text/javascript">
               function ShowHideDiv() {
                 var chkYes = document.getElementById("chkYes");
                 var dvPassport = document.getElementById("dvPassport");
                 dvPassport.style.display = chkYes.checked ? "block" : "none";
               }
             </script>


             <div id="dvPassport" style="display: none">
               <div class="row">
               <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                <div class="input-group">
                  <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="date" name="dob" :value="old('dob')" autofocus autocomplete="dob" />
               </div>
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Place of Birth" type="text" name="birthplace" :value="old('birthplace')" autofocus autocomplete="birthplace" />
             </div>
             {{-- <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <select name="state" class="form-control select2">
                 <option selected="selected" value="">State of Origin</option>
                 <option>Yobe</option>
                 <option>Zamfara</option>
                 <option>Non Nigerian</option>
               </select>
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="L.G.A" type="text" name="lga" :value="old('lga')" autofocus autocomplete="lga" />
             </div> --}}
             <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Previously Attended Schools with Dates" type="text" name="prschool" :value="old('prschool')" autofocus autocomplete="prschool" />
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Reason for Leaving School" type="text" name="reason" :value="old('reason')" autofocus autocomplete="reason" />
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <strong style="padding-left:15px">MEDICAL INFORMATION</strong>
             </div>

             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Blood Group" type="text" name="bloodgr" :value="old('bloodgr')" autofocus autocomplete="bloodgr" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Genotype" type="text" name="genotype" :value="old('genotype')" autofocus autocomplete="genotype" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
                 <x-jet-input class="block mt-1 w-full" placeholder="Ailment (if Any)" type="text" name="ailment" :value="old('ailment')" autofocus autocomplete="ailment" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Physical Disability (if Any)" type="text" name="disability" :value="old('disability')" autofocus autocomplete="disability" />
             </div>
             {{-- <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <strong style="padding-left:15px">PARENTS INFORMATION</strong>
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Father`s Name" type="text" name="pname" :value="old('pname')" autofocus autocomplete="pname" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Father`s Phone Number" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Father`s E-mail" type="text" name="email" :value="old('email')" autofocus autocomplete="email" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Father`s Occupation" type="text" name="occupation" :value="old('occupation')" autofocus autocomplete="occupation" />
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Father`s Office Address" type="text" name="officeadd" :value="old('officeadd')" autofocus autocomplete="officeadd" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Name" type="text" name="mname" :value="old('mname')" autofocus autocomplete="mname" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Phone Number" type="text" name="phone2" :value="old('phone2')" autofocus autocomplete="phone2" />
             </div>

             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Mother`s E-mail" type="text" name="email2" :value="old('email2')" autofocus autocomplete="email2" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Occupation" type="text" name="occupation2" :value="old('occupation2')" autofocus autocomplete="occupation2" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Office Address" type="text" name="officeadd2" :value="old('officeadd2')" autofocus autocomplete="officeadd2" />
             </div>
             <div class="col-xs-6 col-sm-6 col-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Residential Address" type="text" name="address" :value="old('address')" autofocus autocomplete="address" />
             </div> --}}
               <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
                 <x-jet-input class="block mt-1 w-full" placeholder="Any Other Information" type="text" name="other" :value="old('other')" autofocus autocomplete="other" />
               </div>
           </div>
         </div>
           <p>
             <label for="chkYes">
               <input type="radio" id="chkYes" name="chkwork" onclick="ShowHideDiv()" value="1"  />
               Enter More Data
             </label>&nbsp;&nbsp;&nbsp;
               <label for="chkNo">
                 <input type="radio" id="chkNo" name="chkwork" onclick="ShowHideDiv()" checked="checked" value="0"  />
                 Less Data
               </label>
             </p>
             <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <button style="text-align:center; width:100%" type="submit" class="btn btn-primary" name="addStudent">Register Student/Pupil</button>
             </div>
           </form>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-secondary">
        <div class="card-header">
          <h3 class="card-title">Recently Registered Students</h3>
        </div>
        {{-- @foreach ($datas as $data)
          <p>{{$data->uid}}</p>
        @endforeach --}}

        <!-- /.card-header -->

        <div class="card-body">
          <table id="example2" class="table table-sm">
            <thead>
            <tr>
              <th>Sn</th>
              <th>Name</th>
              <th>Class</th>
              <th>More</th>
            </tr>
            </thead>
            <tbody>
            <?php  $sn = 0;
              foreach ($students as $student){
              $sn++; ?>
                <tr>
                  <td>{{$sn}}</td>
                  <td>{{ucwords($student->surname)}} {{ucwords($student->firstname)}}</td>
                  <td>{{$student->classe->class}}</td>
                  <td><form action="{{route('getstudent')}}" method="post" role="form"> @csrf
                    <button name="studentid" value="{{$student->id}}" class="btn btn-info btn-xs">Profile</button></form>
                  </td>
                </tr>
                <?php } ?>
               {{-- @endforeach --}}

            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!--/.col (left) -->
    <!-- right column -->



    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection
