@extends('layouts.app')

@section('content')
<?php 
$sta = new App\Http\Controllers\Profilecontroller; 
 ?>

        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark"> Library Management</h1>
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

          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Add Book</h3><button class="btn btn-default btn-sm float-right" data-toggle="modal" data-target="#addcat">Add Book Category</button>
                    </div>
                       
                    <x-jet-validation-errors class="mb-4" />
                    <div class="card-body">
                    <p><form action method="post" role="form" enctype="multipart/form-data">
                             @csrf     
                              <div class="row">


                                <div class="col-lg-6">
                                  <label>Book Title</label>
                                  <input class="form-control" placeholder="name" type="text" name="name"  autofocus autocomplete="cat" />
                                </div>


                                <div class="col-lg-6">
                                  <label>Book Category</label>
                                <select name="cat" class="form-control select2"> 
                             <option disabled selected>select category</option>                                        
                                  @foreach($cats as $cat)
                                  <option value="{{$cat->id}}">{{ucwords($cat->category)}}</option>
                                  @endforeach
                                </select>
                              </div>

                            

                                <div class="col-lg-12">
                                  <label> Book Description</label>
                                  <input class="form-control" placeholder="Description" type="text" name="des"  autofocus autocomplete="cat" />
                                  <textarea name="des" id="" cols="30" rows="10"></textarea>
                                </div>


                              <div class="col-lg-12">
                              <button type="submit" class="btn btn-primary float-right mt-2">Submit</button>

                                </div>


                                </form>
                    </p>
                      
                    </div>



                  </div>
                </div>

              
            </div>

               



            <div class="col-md-6 col-sm-6">
                                  
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Recently Added Books</h3>
                </div>
                          
                  <div class="card-body">
                                
                    <em>  Showing the last 20 items recently added</em>
                                  <table class="table table-sm" >
                                     <tr>
                                      <td>SN</td>
                                      <td>Title</td>
                                       <td>Category</td>
                                        <td>Des</td>
                                        <td>Action</td></tr>
             

                                    <?php   $i = 1;?>           
                                    {{-- @foreach($books as $row)
                                        
                                    <tr class="odd gradeX">
                                      <td class="center"><?php  echo $i++; ?></td>
                                      <td><?php  echo ucfirst($row->name) ;?></td>
                                      <td><?php  echo ucfirst($sta->bookcat($row->cat)) ;?></td>
                                      <td><?php  echo  ($row->des) ;?></td>
                                      <form method="post">
                                        <td> <button class="btn btn-danger btn-xs" value="{{$row->id}}"><i class="fa fa-trash"></i></button></td> 
                                      </form> 
                                    </td> 
                                  </tr>   
                                              

                                    @endforeach --}}
                                </table>
                  </div>
                </div>  

                <div class="col-md-6 col-sm-6">
                  <div class="table-responsive">
               
                  </div>



                      </div>
            </div><div class="modal fade" id="addcat">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Book Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('createbookcategory')}}" method="post" role="form">
                      @csrf
                      <div class="card-body">
                        <x-jet-validation-errors class="mb-4" />
                        <div class="row">
                          <div class="col-md-9 form-group">
                            <x-jet-input class="block mt-1 w-full" placeholder="Add Category" type="text" name="cat"  autofocus autocomplete="cat" />
                          </div>
                          <div class="col-md-3 form-group">
                          <button type="submit" class="block mt-1 w-full btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                </div>
                
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
          </section>

          
  @endsection
