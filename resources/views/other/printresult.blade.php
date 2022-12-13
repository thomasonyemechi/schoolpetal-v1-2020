@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <?php
 $sta = new App\Http\Controllers\Profilecontroller; 
  
  foreach ($school as $k) {
    $sname = $k->name;
    $ad = $k->address;
  } 
  
  ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Result Management</h1>
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
      <div class="col-12">

       <div class="card">
         <div class="card-header">
           <form action="{{route('getsid')}} " method="POST">@csrf
              <select class="form-control select2 bs4" name="studentid" onchange="submit()" required>
                <option disabled selected>Select Student to print result </option>
                <?php foreach ($allstudent as $as) { ?>
                <option value="{{$as->id}} ">{{ucwords($as->surname)}} {{ucwords($as->firstname)}} {{@$as->classe->class}}  </option>
                <?php } ?>
              </select>
           </form>
         </div>
       </div>
      <?php if(session()->has('studentid')){ ?> 
        <div class="card">
            <div class="row pt-3">
              <div class="col-md-2">
                <div class="pl-4 pt-2" >  <?php $im = $img != ''? $img:'favicon.ico';  ?>
                  <img width="100%" class="img-rounded" src="{{asset('bussiness/sch/'.$im.'')}}">
                </div>
              </div>
              <div class="col-md-8">
                <div class="text-center">
                  <h1 style="font-size: 25px; font-weight:bold;">{{strtoupper($sname)}}</h1>
                  <p>{{$ad}} </p>
                  <h3 style="font-size: 15px; font-weight:bold;">TERMLY CONTINOUS ASSESSMENT DOSSIER </h3>
                  <h3 style="font-size: 15px; font-weight:bold;">{{strtoupper($term)}} TERM {{$sess}} ACADEMIC SESSION </h3>
                </div>
              </div>
              <div class="col-md-2">

              </div>
            </div>
            <div class="card-body">
              
              <table class="table table-sm table">
                    <thead>
                      <tr>
                          <td colspan="2"><b>Name:</b> {{ucwords($sinfo->surname)}} {{ucwords($sinfo->firstname)}} {{ucwords($sinfo->midname)}} </td>
                          <td colspan="2"><b>Reg No:</b> {{ucwords($sinfo->regno)}}</td>
                          <td colspan="2"><b>Class:</b> {{ucwords(@$sinfo->classe->class)}}</td>
                          <td colspan="2"><b>Sex:</b> {{ucwords($sinfo->sex)}}</td>
                          <td colspan="2"><b>Grade:</b> NO</td>
                      </tr>
                  </thead>
                  <thead>
                    <tr>
                      <th>Subjects</th>
                      <th>CA1</th>
                      <th>CA2</th>
                      <th>Exam</th>
                      <th>Total</th>
                      <th>Average</th>
                      <th>Min</th>
                      <th>Max</th>
                      <th>Grade</th>
                      <th>Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $i = 0; foreach ($sr as $res) {  $i++;
                        $total = $res->t1+$res->t2+$res->t3;
                        if($total==0){ continue; }
                        $overall = $res->exam+$total;
                        ?>
                        <tr class="odd gradeX">
                          <td class="center">{{ucwords($subjects[$i-1])}} </td>
                        <td class="center">{{$res->t1}}</td>
                          <td class="center">{{$res->t2}}</td>
                          <td class="center">{{$res->exam}}</td>
                          <td class="center">{{$overall}} </td>
                          <td class="center">{{number_format($average[$i-1])}}</td>
                          <td class="center">{{number_format($min[$i-1])}}</td>
                          <td class="center">{{number_format($max[$i-1])}}</td>
                          <td class="center">{{ucwords($grade[$i-1])}}</td>
                          <td class="center">{{ucwords($remark[$i-1])}}</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                      <tr>
                          <th colspan="2">Subjects:  {{$other['nos']}}</th>
                          <th colspan="2">Total Score: {{$other['total']}}</th>
                          <th colspan="2">Average: {{number_format($other['average'])}}</th>
                          <th colspan="2">Class Average: {{number_format($other['caverage'])}}</th>
                          <th colspan="2">No in class: {{$other['tstudent']}}</th>
                      </tr>
                  </tfoot>
                </table>
                  <div class="row">
                    <div class="col-md-12  p-2">
                      <div class="float-left">
                        <b>This Term Vacation Date: </b>{{$other['vd']}}
                      </div>
                      <div class="float-right">
                        <b>Next Term Resumption Date: </b>{{$other['rd']}}
                      </div>
                    </div>
              
                    <div class="col-md-12 p-2">
                      <div class="float-left">
                        <?php $t = $sta->term('term'); ?>
                        <b>Class Teacher's Comment/Signature/Date: </b><br/>{{remark($sinfo->uid,$sinfo->class,$t,$sess,'tremark')}}
                      </div>
                      <div class="float-right">
                        <b>Principal/Head Teacher's Comment/Signature/Date: </b><br>{{remark($sinfo->uid,$sinfo->class,$t,$sess,'premark')}}
                      </div>
                    </div>
                  </div>
                      
            </div>
        </div>
      <?php } ?>
     </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
