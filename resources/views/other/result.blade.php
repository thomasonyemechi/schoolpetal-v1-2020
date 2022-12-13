@extends('layouts.app')

@section('content') <?php $ca1 = 0; $ca2 = 0; $ca3 = 0; $exam = 0; 

$sta = new App\Http\Controllers\Profilecontroller;

$mysub = $sta->sql('setsubject','uid',$sta->uid());

?>

  <!-- Content Header (Page header) -->
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
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Post Result</h3>
                </div>
                <form action="{{route('startresult')}}" method="post" role="form">
                    @csrf
                    <div class="card-body">
                        <x-jet-validation-errors class="mb-4" />
                        <div class="row">
                            <div class="col-md-12 form-group">
                            <select name="resultid" class="form-control form-group select2bs4" onchange="submit()" required>
                                <option selected="selected" disabled="disabled" value="">select Subject</option>
                                @foreach ($mysub as $sub)
                                  {{$sub->id}}
                                <option value="{{$sub->id}}">{{$sta->subject($sub->sid)}} {{$sta->class($sub->classid)}} </option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="col-12">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Post Result for [ {{session()->get('rname')}}] </h3>
              </div>
              <div class="card-body">
              <form action="{{route('submitresult')}}" method="post">
                  @csrf
                  <div class="table-responsive">
                    <table class="table table-sm">
                      <thead>
                          <?php if(session()->has('resultid')){ foreach ($grade as $ke){ $ca1 = $ke->ca1; $ca3 = $ke->ca3;  $ca2 = $ke->ca2; $exam = $ke->exam;}  ?>      
                          <tr>
                            <td colspan="12">{{$students->links()}} </td>
                          </tr>
                        <tr>
                          
                            <th>SN</th>
                            <th>Student</th>
                            <th>CA1({{$ca1}}) </th>
                            <th>CA2({{$ca2}}) </th>
                            <th>CA3({{$ca3}})</th>
                            <th>EXAM({{$exam}})</th>
                            <th>TOTAL(100)</th>
                            <th>POSITION</th>    
                        </tr>
                       
                      </thead>
                      <tbody>
                        <?php $i = 0; $dis = ($ca3==0)?'disabled':''; foreach ($students as $std) { $i++;?>
                          @if(count($name)>0)
                              <tr class="odd gradeX">
                                  <td>{{$i}}<input type="hidden" value="{{$std->id}}" name="sn{{$i}}"></td>
                                  <td><a>{{ucwords($name[$i-1])}}</a></td>
                                  <td><input type="number" class="form-control form-control-sm ca" min="0" max="{{$ca1}}" value="{{$std->t1}}" name="ca{{$i}}"></td>
                                  <td><input type="number" class="form-control form-control-sm ca" min="0" max="{{$ca2}}" value="{{$std->t2}}" name="cb{{$i}}"></td>
                                  <td><input type="number" {{$dis}} class="form-control form-control-sm ca" min="0" max="{{$ca3}}" value="{{$std->t3}}" name="cc{{$i}}"></td>
                                  <td><input type="number" class="form-control form-control-sm ca" min="0" max="{{$exam}}" value="{{$std->exam}}" name="cd{{$i}}"></td>
                                  <td>{{$std->total}}</td>
                                  <td>{{$position[$i-1]}}</td>
                              </tr>
                            @else
                              <tr><td colspan="12"><p>No Student i Selected Class</p></td></tr>
                            @endif
                        <?php }  ?>
                      </tbody>
                      <tfoot>
                        <tr><td colspan="9"><button type="submit" class="btn btn-primary float-right">Submit Result</button></td></tr>
                      </tfoot>
                    <?php } ?>
                     </table>
                  </div>
                </form>
              <?php if(session()->has('resultid')){ ?>{{$students->links()}} <?php } ?>
              </div>
            </div>
        </div>

    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
