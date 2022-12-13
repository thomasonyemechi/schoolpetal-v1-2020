@extends('layouts.app')

@section('content')
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
                <select name="sex" class="block mt-1 w-full form-control form-group select2bs4" required>
                  <option selected="selected" disabled="disabled" value="">Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
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
             <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
                <strong style="padding-left:15px">OTEHRS</strong>
              </div>
             <div class="col-xs-12 col-sm-12 col-12" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Residential Address" type="text" name="address" :value="old('address')" autofocus autocomplete="address" />
             </div>
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
