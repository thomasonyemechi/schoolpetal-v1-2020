@extends('layouts.app')

@section('content') <?php $sum = 0; ?>
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">School Management</h1>
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
      <div class="col-md-6 col-6">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Classes</h3>
          </div>
            <div class="card-body">
                
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ($class as $k) { $i++; $id = $k['id']; ?>
                                <tr>
                                    <td>{{$i}} </td>
                                    <td>{{$k['class']}} </td>
                                    <td>{{$k['str']}} </td>
                                <td><a href="/promotion/{{$id}}"> Students </a> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        
                    </table>
                    <form action="/promoteall" method="post">@csrf
                        <button type="submit" class="btn btn-success btn-sm float-right mr-1"> Promote All Student </button>
                    </form>
            </div>
          </div>
        </div>




      <div class="col-md-6 col-6">
        <div class="card card-secondary">
          <div class="card-header">
          <h3 class="card-title">{{$cname}} Students</h3>
          </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Student</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <form action="{{route('promotesome')}} " method="post">@csrf --}}
                        
                        <?php $i = 0; foreach ($students as $ke) { $i++; ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="id[]" value="{{$ke->id}} ">{{$i}} 
                                </td>                               
                                <td>{{ucwords($ke->surname)}} {{ucwords($ke->firstname)}} {{ucwords($ke->midname)}} </td>
                                <td>{{$cname}} </td>
                                <td>{{$ke->sex}} </td>
                                <td class="row">
                                    <form class="col-6" action="{{route('promoteStudent')}} " method="POST">@csrf
                                        <button name="studentid" value="{{$ke->id}} " class="btn btn-success btn-xs"> Promote </button> 
                                    </form>
                                    <form class="col-6" action="{{route('demoteStudent')}} " method="POST">@csrf
                                        <button name="studentid" value="{{$ke->id}} " class="btn btn-danger btn-xs"> Demote </button> 
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                    {{-- </form> --}}
                    
                    </tbody>
                    
                </table>
                {{$students->links()}}
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
