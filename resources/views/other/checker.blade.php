@extends('layouts.sapp')
@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller;  ?>
  <!-- Content Header (Page header) -->
  <?php
  
 /// $info = session()->get('sinfo');

$id = session()->get('student_idx')  ;
  
  foreach ($school as $k) {
    $sname = $k->name;
    $ad = $k->address;
  } 
  
   $pr = new App\Http\Controllers\Printcontroller; 
    $sta = new App\Http\Controllers\Profilecontroller; 

  $term = $sta->term('term');
  $sess = $sta->term('sess');

  $bid = $sta->bid();
  

  $term = $sta->term('term');
    $sess = $sta->term('sess');
$s_1 = ptmtTerm($term, $sess, $bid, 1 , 'sess'); $t_1 = ptmtTerm($term, $sess, $bid, 1 , 'term');
                        $s_2 = ptmtTerm($term, $sess, $bid, 0 , 'sess'); $t_2 = ptmtTerm($term, $sess, $bid, 0 , 'term');

  
  ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">My Result</h1>
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

            <div class="card-body">
                
                
                 <div style="border: solid thin #CCC" class="mb-1 p-2">   <table class="" width="100%">
                 
                      <tr>
                          <th>
                            <table width="100%"><tr><td>  <?php $im = $img != ''? $img:'favicon.ico';  ?>
                                  <img width="100" class="img-rounded" src="{{asset('bussiness/sch/'.$im.'')}}">
                                </td>
                              <td width="50%">
                              
                                <div class="text-center">
                                  <h1 style="font-size: 25px; font-weight:bold;">{{strtoupper($sta->school())}}</h1>
                                  <p>{{$sta->school('address')}} </p>
                                  <h3 style="font-size: 15px; font-weight:bold;">TERMLY CONTINOUS ASSESSMENT DOSSIER </h3>
                                  <h3 style="font-size: 15px; font-weight:bold;">{{strtoupper($term)}} TERM {{$sess}} ACADEMIC SESSION </h3>
                                </div>
                              </td>
                              <td width="25%"></td>
                              </tr>
                              </table>
                            </th>
                            </tr>
                    
                    </table></div>
                    
                    <table class="table table-bordered mb-1">
                    <thead>
                      <tr>
                          <td colspan="4"><b>Name:</b>  {{ucwords($sinfo->surname)}} {{ucwords($sinfo->firstname)}} {{ucwords($sinfo->midname)}}  </td>
                          <td colspan="4"><b>Class:</b> {{ucwords($sinfo->classe->class)}}</td>
                          <td colspan="4"><b>Gender:</b> {{ucwords($sinfo->sex)}}</td>
                      </tr>
                  </thead>
                  
                </table>
                
                            
              
              <div class="table-responsive">
                <table class="table table-sm table">
                  <table class="table table-bordered mb-1">
                  <thead>
                    <tr>
                      <th>Subjects</th>
                      <th>CA1</th>
                      <th>CA2</th>
                      <th>CA3</th>
                      <th>CA</th>
                      <th>Exam</th>
                      <th>Term Total</th>
                      <th>Last Cum</th>
                      <th>Cum Av</th>
                      <th>Class Av</th>
                      <th>Grade</th>
                      <th>Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                      <?php $cla = $sinfo->class ;  $i = 0; foreach ($sr as $res) {  $i++;
                      
                        
                        $total = $res->t1+$res->t2+$res->t3;
                        if($total==0){ continue; }
                        $overall = $res->exam+$total;
                        $sub = $res->subject;
                        $first = ($term > 1) ? fetchLastTermResultBySubject($id, $sub, $t_1 , $s_1, $cla) : 0 ;
                        $second = ($term > 2) ? fetchLastTermResultBySubject($id, $sub, $t_2, $s_2, $cla) : 0 ;


                        $div = ($first == 0) ? 1 : 2 ;
                        $div = ($second == 0) ? $div : $div+1 ;

                        $overall = (($res->exam+$total) + $first + $second)/ $div;
                        
                        $ca = $res->t3 + $res->t2 + $res->t1;
                        
                    ?>
                        <tr class="odd gradeX">
                              <td class="center">{{ucwords($sta->subject($sub))}} </td>
                              <td class="center">{{$res->t1}}</td>
                              <td class="center">{{$res->t2}}</td>
                              <td class="center">{{$res->t3}}</td>
                              <td class="center">{{$ca}}</td>
                              <td class="center">{{$res->exam}}</td>
                              <td class="center">{{$ca+ $res->exam}}</td>
                              <td>{{ $second }}</td>
                              <td class="center">{{number_format($overall)}}</td> 
                              <td class="center">{{number_format($pr->average($cla,$sub))}}</td>
                              <td class="center">{{ucwords($pr->grade($overall))}}</td>
                              <td class="center">{{ucwords($pr->grade($overall,1))}}</td>
                         </tr>
                    <?php } ?>
                  </tbody>
                  <!--<tfoot>-->
                  <!--    <tr>-->
                  <!--        <th colspan="2">Subjects:  {{$other['nos']}}</th>-->
                  <!--        <th colspan="2">Total Score: {{$other['total']}}</th>-->
                  <!--        <th colspan="2">Average: {{number_format($other['average'])}}</th>-->
                  <!--        <th colspan="2">Class Average: {{number_format($other['caverage'])}}</th>-->
                  <!--        <th colspan="2">No in class: {{$other['tstudent']}}</th>-->
                  <!--    </tr>-->
                  <!--</tfoot>-->
                </table>
                
                <table class="table table-bordered">
                 <tfoot>
                      <tr>
                          <th colspan="2">Subjects:  {{$other['nos']}}</th>
                          <th colspan="2">Total Score: {{$pr->aggregate($id,$cla,'total')}}</th>
                          <th colspan="2">Average: {{number_format($other['average'])}}</th>
                          <th colspan="2">Class Average: {{number_format($other['caverage'])}}</th>
                          <th colspan="2">No in class: {{$pr->totalStudent($cla)}}</th>
                      </tr>
                  </tfoot>
                </table> 
                
                
              </div>
              <table class="table table-bordered mt-1" width="100%">
                 <tfoot>
                      <tr>
                          <th>
                              
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
                        <b>Class Teacher's Comment/Signature/Date: </b><br/>{{remark($id,$cla,$term,$sess,'tremark')}}
                      </div>
                      <div class="float-right">
                        <b>Principal/Head Teacher's Comment/Signature/Date: </b><br>{{remark($id,$cla,$term,$sess,'premark')}}
                      </div>
                    </div>
                  </div>
                  </th>
                  </tr>
                  </tfoot>
                </table>
                      
            </div>
        </div>
      <?php //} ?>
     </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection