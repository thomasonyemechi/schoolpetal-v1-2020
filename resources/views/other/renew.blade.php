@extends('layouts.app')

@section('content')
  <!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">School</h1>
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
      <div class="col-md-6">

       <div class="card card-primary">
         <div class="card-header">
           <h3 class="card-title">Billing</h3>
         </div>
         <div class="card-body">

         </div>
         <!-- /.card-body -->
       </div>
       <div class="card card-secondary">
         <div class="card-header">
           <h3 class="card-title">Bills</h3>
         </div>
         <div class="card-body">
           <div class="table-responsive">
               <table id="example" class="table table-sm">
             <thead>
             <tr>
               <th>session</th>
               <th>term</th>
               <th>term closes</th>
               <th>New Term Begins</th>
               <th>Action</th>
             </tr>
             </thead>
     
           </table>
           </div>

         </div>
         <!-- /.card-body -->
       </div>
     </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
