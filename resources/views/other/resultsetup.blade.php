@extends('layouts.app')

@section('content') <?php $sum = 0; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Result and Grades</h1>
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
      <div class="col-md-4 col-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">View Grades</h3>
          </div>
            <div class="card-body">
                <form action="{{route('updateDefaultGrade')}} " method="post">@csrf
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Grades</th>
                                <th>Minimum Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php foreach ($grade as $row) { ?>
                            <tr>
                                <td>A</td>
                                <td>

                                    <input autocomplete="off" type="number"  class="form-control form-control-sm" name="a" value="<?php echo $row->a ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>B</td>
                                <td>
                                    <input autocomplete="off" type="number"  class="form-control form-control-sm" name="b" value="<?php echo $row->b ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>C</td>
                                <td>
                                    <input autocomplete="off" type="number"  class="form-control form-control-sm" name="c" value="<?php echo $row->c ?>" required>
                                </td>
                            </tr>
                            <tr>
                                <td>D</td>
                                <td>
                                    <input type="number"  class="form-control form-control-sm" name="d" value="<?php echo $row->d ?>" required>
                                </td>


                            </tr>
                            <tr class="odd gradeX">
                                <td class="center">E</td>
                                <td class="bootstrap-timepicker">

                                    <input  type="number"  class="form-control form-control-sm" name="e" value="<?php echo $row->e ?>" required/>
                                </td>
                            </tr>
                            <tr><td colspan="2"><button type="submit" class="btn btn-primary btn-sm float-right">Update Default Grade</button></td></tr>
                            <?php } ?>
                        </tbody>
                        
                    </table>
                </form>
            </div>
          </div>
        </div>
     
      <div class="col-md-4 col-6">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">View Assesment Scores</h3>
          </div>
            <div class="card-body">
            <form action="{{route('updateDefaultScore')}}" method="post">@csrf
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Assesment</th>
                                    <th>Maximum Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php foreach ($grade as $row) { ?>
                                <tr>
                                    <td>C.A1</td>
                                    <td>
    
                                        <input autocomplete="off" type="number"  class="form-control form-control-sm" name="ca1" value="<?php echo $row->ca1 ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.A2</td>
                                    <td>
                                        <input autocomplete="off" type="number"  class="form-control form-control-sm" name="ca2" value="<?php echo $row->ca2 ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>C.A3</td>
                                    <td>
                                        <input autocomplete="off" type="number"  class="form-control form-control-sm" name="ca3" value="<?php echo $row->ca3 ?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Exam</td>
                                    <td>
                                        <input type="number"  class="form-control form-control-sm" name="exam" value="<?php echo $row->exam ?>" required>
                                    </td>
                                </tr>
                                <tr><td colspan="2"><button type="submit" class="btn btn-primary btn-sm float-right">Update Default Score</button></td></tr>
                                <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>
                </form>
            </div>
          </div>
        </div>
      

      <div class="col-md-4 col-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">View Assesment Comment</h3>
          </div>
            <div class="card-body">
            <form action="{{route('UpdateComment')}}" method="post">@csrf
                    <div class="row">
                        <div class="col-md-12 col-6">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th colspan="2">Class Teacher's Comment:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php foreach ($grade as $row) { ?>
                                    <tr>
                                        <td>A</td>
                                        <td>
        
                                            <input autocomplete="off" type="text"  class="form-control form-control-sm" name="t1" value="<?php echo $row->ta ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>
                                            <input autocomplete="off" type="text"  class="form-control form-control-sm" name="t2" value="<?php echo $row->tb ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>
                                            <input autocomplete="off" type="text"  class="form-control form-control-sm" name="t3" value="<?php echo $row->tc ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D</td>
                                        <td>
                                            <input type="text"  class="form-control form-control-sm" name="t4" value="<?php echo $row->td ?>" required>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>E</td>
                                        <td>
                                            <input type="text"  class="form-control form-control-sm" name="t5" value="<?php echo $row->te ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>F</td>
                                        <td>
                                            <input type="text"  class="form-control form-control-sm" name="t6" value="<?php echo $row->tf ?>" required>
                                        </td>
                                    </tr>
                                </tbody>
                                
                            </table>
                        </div>
                        <div class="col-md-12 col-6">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th colspan="2">Principal/Head Teacher's Comment:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>A</td>
                                        <td>
        
                                            <input autocomplete="off" type="text"  class="form-control form-control-sm" name="p1" value="<?php echo $row->pa ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>
                                            <input autocomplete="off" type="text"  class="form-control form-control-sm" name="p2" value="<?php echo $row->pb ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>
                                            <input autocomplete="off" type="text"  class="form-control form-control-sm" name="p3" value="<?php echo $row->pc ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>D</td>
                                        <td>
                                            <input type="text"  class="form-control form-control-sm" name="p4" value="<?php echo $row->pd ?>" required>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>E</td>
                                        <td>
                                            <input type="text"  class="form-control form-control-sm" name="p5" value="<?php echo $row->pe ?>" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>F</td>
                                        <td>
                                            <input type="text"  class="form-control form-control-sm" name="p6" value="<?php echo $row->pf ?>" required>
                                            <input type="hidden"  class="form-control form-control-sm" name="d" value="<?php echo $row->id ?>">
                                        </td>
                                    </tr>
                                    <tr><td colspan="2"><button type="submit" class="btn btn-primary btn-sm float-right">Update Comment</button></td></tr>
                                    <?php } ?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>



    </div>

  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->


@endsection
