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
    <div class="col-md-6 card">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header" style="padding-bottom:0">
         <form action="{{route('student.update', $student->id)}}" method="post">
           @csrf
           @method('PUT')
           <h2>Edit {{$student->surname}} profile {{floor(0.9)}}</h2>
           <x-jet-validation-errors class="mb-4" />

           <br>
           <div class="row">
             {{-- <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
               <input name="regno" class="form-control"  placeholder="Registration Number"  />
             </div> --}}

             <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Surname" type="text" name="surname" value="{{$student->surname}}" required autofocus autocomplete="surname" />
             </div>
             <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="First Name" type="text" name="firstname" value="{{$student->firstname}}" autofocus autocomplete="firstname" />
             </div>
             <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
               <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="text" name="midname" value="{{$student->midname}}" autofocus autocomplete="midname" />
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <select name="sex" class="block mt-1 w-full form-control select2">
                  <option selected="selected" disabled="disabled" value="">Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <select name="class" class="form-control select2" required>
                  <option selected="selected" disabled="disabled" value="">Prospective Class</option>
                  <option value="62">SSS 1</option>
                  <option value="63">SSS 2</option>
                  <option value="64">SSS 3</option>
                </select>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <select name="arm" class="form-control select2">
                  <option selected="selected">Class Arm</option>
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


            <div id="dvPsport" style="display: ">
              <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
               <div class="input-group">
                 <x-jet-input class="block mt-1 w-full" placeholder="Middle Name" type="date" name="dob" :value="old('dob')" autofocus autocomplete="dob" />
              </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Place of Birth" type="text" name="birthplace" :value="old('birthplace')" autofocus autocomplete="birthplace" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <select name="state" class="form-control select2">
                <option selected="selected" value="">State of Origin</option>
                <option>Yobe</option>
                <option>Zamfara</option>
                <option>Non Nigerian</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="L.G.A" type="text" name="lga" :value="old('lga')" autofocus autocomplete="lga" />
            </div><div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Previously Attended Schools with Dates" type="text" name="prschool" :value="old('prschool')" autofocus autocomplete="prschool" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Reason for Leaving School" type="text" name="reason" :value="old('reason')" autofocus autocomplete="reason" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">MEDICAL INFORMATION</strong>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Blood Group" type="text" name="bloodgr" :value="old('bloodgr')" autofocus autocomplete="bloodgr" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Genotype" type="text" name="genotype" :value="old('genotype')" autofocus autocomplete="genotype" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
                <x-jet-input class="block mt-1 w-full" placeholder="Ailment (if Any)" type="text" name="ailment" :value="old('ailment')" autofocus autocomplete="ailment" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Physical Disability (if Any)" type="text" name="disability" :value="old('disability')" autofocus autocomplete="disability" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <strong style="padding-left:15px">PARENTS INFORMATION</strong>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Name" type="text" name="pname" :value="old('pname')" autofocus autocomplete="pname" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Phone Number" type="text" name="phone" :value="old('phone')" autofocus autocomplete="phone" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s E-mail" type="text" name="email" :value="old('email')" autofocus autocomplete="email" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Occupation" type="text" name="occupation" :value="old('occupation')" autofocus autocomplete="occupation" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Father`s Office Address" type="text" name="officeadd" :value="old('officeadd')" autofocus autocomplete="officeadd" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Name" type="text" name="mname" :value="old('mname')" autofocus autocomplete="mname" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Phone Number" type="text" name="phone2" :value="old('phone2')" autofocus autocomplete="phone2" />
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s E-mail" type="text" name="email2" :value="old('email2')" autofocus autocomplete="email2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Occupation" type="text" name="occupation2" :value="old('occupation2')" autofocus autocomplete="occupation2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
              <x-jet-input class="block mt-1 w-full" placeholder="Mother`s Office Address" type="text" name="officeadd2" :value="old('officeadd2')" autofocus autocomplete="officeadd2" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom:10px" >
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
        <!-- /.box-header -->
        <!-- form start -->




      </div>
      <!-- /.box -->
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
