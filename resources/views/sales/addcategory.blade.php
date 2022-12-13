@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Add Category</h1>
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
    <div class="col-md-6">
      <!-- general form elements -->

      <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Add new Category</h3>
      </div>
      <form action="{{route('createcategory')}}" method="post" role="form">
        @csrf
        <div class="card-body">
          <x-jet-validation-errors class="mb-4" />
          <div class="row">
            <div class="col-md-6 form-group">
              <x-jet-input class="block mt-1 w-full" placeholder="Add Category" type="text" name="cat"  autofocus autocomplete="cat" />
            </div>
            <div class="col-md-3 form-group">
            <button type="submit" class="block mt-1 w-full btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
    </div>


    <!--/.col (left) -->
    <!-- right column -->
    </div>
                       
    <div class="col-md-6">
        <!-- Horizontal Form -->
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Item Categories</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
         
            <div class="box-body no-padding">
               <table  class="table table-striped table-bordered table-hover">
                                  <thead>
                                      <tr>
                                          <th>SN</th>
                                          <th>Category</th>
                                           <th>Delete</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $rows = json_decode($rows) ?>
                                    @foreach ($rows as $row)
                                      
                                    <tr class="odd gradeX">

                                      
                                           <td class="center">{{$row->id}}</td>
                                           <td>{{ucfirst($row->cat)}}</td>
                                           <td><form method="post"><button name="delCat" class="btn btn-danger btn-xs" value="{{$row->id}}">Delete</button></form></td>
                                    </tr>         
                                         @endforeach
                                  </tbody>
               </table>
              </div>

    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>

<!-- /.content -->
@endsection
