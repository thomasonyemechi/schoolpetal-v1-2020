@extends('layouts.app')

@section('content') <?php $sum = 0; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Promotions Management</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
       
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




      <div class="col-md-6 col-6">
        <div class="card card-secondary">
          <div class="card-header">
          <h3 class="card-title">Classes</h3>
          </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student</th>
                            <th>Class</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 0; foreach ($class as $cla) { $i++; ?>
                            <tr>
                                  
                                <td>
                                    {{$cla['class']}}
                                </td>   
                                <td>
                                    {{$cla['str']}}
                                </td>    
                                
                                <td>
                                    <a class="btn btn-xs btn-default " href="promotion/{{$cla['id']}}">View Class</a>
                                </td>  
                            </tr>
                        <?php } ?>
                        <tr>

                    </tbody>
                    
                </table>
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
