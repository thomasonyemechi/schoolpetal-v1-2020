@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\Profilecontroller;
$subject =  (session()->has('subjectres'))?session()->get('subjectres'):'';
$term = $sta->term('term');
$sess = $sta->term('sess');


?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Student Result</h1>
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
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Select Subject</h3>
        </div>
        <div class="card-body">
          <form action="/pickresult" method="POST">@csrf
            <select class="form-control select2 bs4" name="result" onchange="submit()">
              <option selected disabled>Select class</option>
              @foreach ($mysub as $sub)
                <option value="{{$sub['id']}}">{{$sub['class']}}</option>
              @endforeach
            </select>
          </form>
        </div>
      </div>
@if(session()->has('classres'))

        @foreach ($type as $rw)
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{$rw->examtype}} ({{$sta->class(session()->get('classres'))}} {{$sta->subject(session()->get('subjectres'))}} )</h3>
            </div>

            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // ;
                        // foreach ($al as $std) { $stu[] = $std->id; } 
                        // $st[] = array_unique($stu); 
                        // print_r($st);
                        $i=0;
                        
                        foreach ($students as $std) {  
                          $al = $sta->fetchresult2($subject, $term, $sess, $rw->sn,$std->uid);
                          $i++;?>
                    
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$std->surname}} {{$std->firstname}} </td>
                                <td colspan="12"> 
                                  @if(count($al)>0)
                                    <table class="table">
                                      <tr>
                                        <th>Date</th> 
                                        <th>Score</th>
                                        <th>Total Questions</th>
                                        <th>Time Spent</th>
                                        <th>View info</th>
                                      </tr>  
                                      <?php 
                                      foreach ($al as $row) {  $time = $row->ctime2-$row->ctime;?>
                                      <tr>
                                        <td><p>{{date('j-D/M/Y',strtotime($row->created_at))}}</p></td>
                                        <td>{{$row->total}} </td>
                                        <td> {{$sta->ansques($row->tcode)}} </td>
                                        <td>{{floor($sta->time($time))}} mins</td>
                                        <td><a href="#"> {{$row->tcode}}</a></td>
                                      </tr>
                                      <?php } ?> 
                                    </table> 
                                  @endif 
                                </td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
                {{$students->links()}}
            </div>  
        </div>
        @endforeach
      @endif
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
