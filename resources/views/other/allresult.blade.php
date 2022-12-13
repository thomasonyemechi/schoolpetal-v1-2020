@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
  <?php

  $sta = new App\Http\Controllers\Profilecontroller; 
  $pr = new App\Http\Controllers\Printcontroller; 

$sinfo = session()->get('sinfo');
  $term = $sta->term('term');
  $sess = $sta->term('sess');

  $taverage = 0;
  $classaverage = 0;
  $Tgrade = '';
  $Pgrade = '';
  
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
           <form action="{{route('getclass')}} " method="POST">@csrf
              <select class="form-control select2 bs4" name="class" onchange="submit()" required>
                <option disabled selected>Select Class to print result </option>
                <?php foreach ($class as $as) { ?>
                <option value="{{$as->id}}">{{ucwords($as->class)}}</option>
                <?php } ?>
              </select>
           </form>
         </div>
       </div>
      <?php if(session()->has('studentclass')){ ?>
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Print Result For {{$sta->class(session()->get('studentclass'))}} Students </h3>
            </div>
        </div>

          <?php
        foreach ($students as $std) {
            $id = $std->uid;
         ?> 
       <p style="page-break-before: always">
        <div class="card">
            <div class="row pt-3">
              <div class="col-md-2">
                <div class="pl-4 pt-2" >  <?php $im = $sinfo['img'] != ''? $sinfo['img']:'favicon.ico';  ?>
                  <img width="100%" class="img-rounded" src="{{asset('bussiness/sch/'.$im.'')}}">
                </div>
              </div>
              <div class="col-md-8">
                <div class="text-center">
                  <h1 style="font-size: 25px; font-weight:bold;">{{strtoupper($sta->school())}}</h1>
                  <p>{{$sta->school('address')}} </p>
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
                          <td colspan="2"><b>Name:</b> {{ucwords($sta->cName2($id))}}</td>
                          <td colspan="2"><b>Reg No:</b> {{$sta->cName2($id,'regno')}}</td>
                          <td colspan="2"><b>Class:</b> {{ucwords($std->classe->class)}}</td>
                          <td colspan="2"><b>Sex:</b> {{ucwords($sta->cName2($id,'sex'))}}</td>
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
                  <?php 
                    $cla = $std->class;
                      $sr = $pr->resultinfo($id, $cla);
                      if(count($sr)>0){  ?>
                  <tbody>
                      <?php
                     
                       $i = 0; foreach ($sr as $res) {  $i++;
                        $total = $res->t1+$res->t2+$res->t3;
                        if($total==0){ continue; }
                        $overall = $res->exam+$total;
                        $sub = $res->subject;

                        $taverage = $pr->aggregate($id,$cla,'total')/$pr->aggregate($id,$cla,);

                        $resultTotal = $pr->classAverage($cla);
                        $resultNo = ($pr->classAverage($cla,1)=='')?1:$pr->classAverage($cla,1);
                        $classaverage = $resultTotal/$resultNo;

                        $gr = strtolower($pr->grade($taverage)) ;
                        $Tgrade = 't'.$gr;
                        $Pgrade = 'p'.$gr;

                        ?>
                       <tr class="odd gradeX">
                          <td class="center">{{ucwords($sta->subject($sub))}} </td>
                        <td class="center">{{$res->t1}}</td>
                          <td class="center">{{$res->t2}}</td>
                          <td class="center">{{$res->exam}}</td>
                          <td class="center">{{$overall}} </td> 
                          <td class="center">{{number_format($pr->average($cla,$sub))}}</td>
                          <td class="center">{{number_format($pr->average($cla,$sub,'min'))}}</td>
                          <td class="center">{{number_format($pr->average($cla,$sub,'max'))}}</td>
                          <td class="center">{{ucwords($pr->grade($overall))}}</td>
                          <td class="center">{{ucwords($pr->grade($overall,1))}}</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                 <tfoot>
                      <tr>
                          <th colspan="2">Subjects:  {{$pr->aggregate($id,$cla)}}</th>
                          <th colspan="2">Total Score: {{$pr->aggregate($id,$cla,'total')}}</th>
                          <th colspan="2">Average: {{number_format($taverage)}}</th>
                          <th colspan="2">Class Average: {{number_format($classaverage)}}</th>
                          <th colspan="2">No in class: {{$pr->totalStudent($cla)}}</th>
                      </tr>
                  </tfoot>
                <?php } ?>
                </table> 
                  <div class="row">
                    <div class="col-md-12  p-2">
                      <div class="float-left">
                        <b>This Term Vacation Date: </b>{{$sta->term('close')}}
                      </div>
                      <div class="float-right">
                        <b>Next Term Resumption Date: </b>{{$sta->term('resume')}}
                      </div>
                    </div>
              
                    <div class="col-md-12 p-2">
                      <div class="float-left">
                        <b>Class Teacher's Comment/Signature/Date: </b><br/>{{$pr->remark($Tgrade)}}
                      </div>
                      <div class="float-right">
                        <b>Principal/Head Teacher's Comment/Signature/Date: </b><br>{{$pr->remark($Pgrade)}}
                      </div>
                    </div>
                  </div>
                      
            </div>
        </div>
       </p>
      <?php } } ?>
      {{$students->links()}}
     </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
