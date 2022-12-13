<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SMS') }}</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Favicons -->

        <link rel="icon" href="{{asset('favicon.ico')}}">
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
        <!-- Select2 -->
        <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
        <!-- summernote -->
        <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700')}}" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

        <!-- Fonts -->
        <link href="{{asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">

        {{-- texteditor cdn --}}
        <script src="{{asset('https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js')}}"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{asset('https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js')}}" defer></script>
        <script type="text/JavaScript">



          function BrWindow(theURL,winName,features) { //v2.0
          
            window.open(theURL,winName,features);
          
          }
          
          
          </script>
    </head>
    <body  class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
  <?php

  $sta = new App\Http\Controllers\Profilecontroller; 
  $pr = new App\Http\Controllers\Printcontroller; 

$sinfo = session()->get('sinfo');
  $term = $sta->term('term');
  $sess = $sta->term('sess');

  $bid = $sta->bid();

  $taverage = 0;
  $classaverage = 0;
  $Tgrade = '';
  $Pgrade = '';

  $s_1 = ptmtTerm($term, $sess, $bid, 1 , 'sess'); $t_1 = ptmtTerm($term, $sess, $bid, 1 , 'term');
  $s_2 = ptmtTerm($term, $sess, $bid, 0 , 'sess'); $t_2 = ptmtTerm($term, $sess, $bid, 0 , 'term');



  
  ?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
      <?php if(session()->has('studentclass')){ ?>


          <?php
        foreach ($students as $std) {
            $id = $std->uid;
         ?> 
       <p style="page-break-before: always">
        <div class="card">
            

            <div class="card-body">
                
                         <div style="border: solid thin #CCC" class="mb-1 p-2">   <table class="" width="100%">
                 
                      <tr>
                          <th>
                            <table width="100%"><tr><td>  <?php $im = $sinfo['img'] != ''? $sinfo['img']:'favicon.png';  ?>
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
                          <td colspan="4"><b>Name:</b> {{ucwords($sta->cName2($id))}}</td>
                          <td colspan="4"><b>Class:</b> {{ucwords($std->classe->class)}}</td>
                          <td colspan="4"><b>Gender:</b> {{ucwords($sta->cName2($id,'sex'))}}</td>
                      </tr>
                  </thead>
                  
                </table>
                
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
                      @if($term > 1) <th>1st Term</th> @endif
                      @if($term > 2) <th>2nd Term</th> @endif
                      <th>Cum Av</th>
                      <th>Class Av</th>
                      <th>Grade</th>
                      <th>Remark</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $cla = $std->class;
                      $sr = $pr->resultinfo($id, $cla);
                       $i = 0; foreach ($sr as $res) { $i++;
                        $total = $res->t1+$res->t2+$res->t3;
                        if($total==0){ continue; }
                        $sub = $res->subject;

                        $first = ($term > 1) ? fetchLastTermResultBySubject($id, $sub, $t_1 , $s_1, $cla) : 0 ;
                        $second = ($term > 2) ? fetchLastTermResultBySubject($id, $sub, $t_2, $s_2, $cla) : 0 ;


                        $div = ($first == 0) ? 1 : 2 ;
                        $div = ($second == 0) ? $div : $div+1 ;

                        $overall = (($res->exam+$total) + $first + $second)/ $div;
                        

                        $taverage = $pr->aggregate($id,$cla,'total')/$pr->aggregate($id,$cla,);

                        $resultTotal = $pr->classAverage($cla);
                        $resultNo = ($pr->classAverage($cla,1)=='')?1:$pr->classAverage($cla,1);
                        $classaverage = $resultTotal/$resultNo;

                        $gr = strtolower($pr->grade($taverage)) ;
                        $Tgrade = 't'.$gr;
                        $Pgrade = 'p'.$gr;


                        
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
                          @if($term > 1) <td>{{ $first }}</td> @endif
                          @if($term > 2) <td>{{ $second }}</td> @endif
                          <td class="center">{{ number_format($overall)}}</td> 
                          <td class="center">{{number_format($pr->average($cla,$sub))}}</td>
                          <td class="center">{{ucwords($pr->grade($overall))}}</td>
                          <td class="center">{{ucwords($pr->grade($overall,1))}}</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  
                 </table>
                
                <table class="table table-bordered">
                 <tfoot>
                      <tr>
                          <th colspan="2">Subjects:  {{$pr->aggregate($id,$cla)}}</th>
                          <th colspan="2">Total Score: {{$pr->aggregate($id,$cla,'total')}}</th>
                          <th colspan="2">Average: {{number_format($taverage)}}</th>
                          <th colspan="2">Class Average: {{number_format($classaverage)}}</th>
                          <th colspan="2">No in class: {{$pr->totalStudent($cla)}}</th>
                      </tr>
                  </tfoot>
                </table> 
                 <table class="table table-bordered mt-1" width="100%">
                 <tfoot>
                      <tr>
                          <th>
                              <div class="row" >
                                   <div class="col-md-12 p-2">
                      <div class="float-left">
                        <b>This Term Vacation Date: </b>{{$sta->term('close')}}
                      </div>
                      <div class="float-right">
                        <b>Next Term Resumption Date: </b>{{$sta->term('resume')}}
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
                  </th>
                  </tr>
                  </tfoot>
                </table>
            </div>
        </div>
       </p>
      <?php } } ?>
      {{-- {{$students->links()}} --}}
     </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
        </div>
    </body>
</html>