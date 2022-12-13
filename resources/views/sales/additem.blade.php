@extends('layouts.app')

@section('content')
<?php $sta = new App\Http\Controllers\ProfileCOntroller; ?>
        <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0 text-dark"> Stock Management</h1>
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
                      <h3 class="card-title">Add item</h3><button class="btn btn-default btn-xs float-right" data-toggle="modal" data-target="#addcat">Add Category</button>
                    </div>
                       
                    <x-jet-validation-errors class="mb-4" />
                    <div class="card-body">
                    <p><form action="{{route('postitem')}}" method="post" role="form">
                             @csrf     
                              <div class="row">


                                <div class="col-lg-6">
                                  <label>Item Name</label>
                                  <input class="form-control" placeholder="item" type="text" name="item"  autofocus autocomplete="cat" />
                                </div>


                                <div class="col-lg-6">
                                  <label>Category</label>
                                <select name="itemcategory" class="form-control select2"> 
                             <option value="">SELECT CATEGORY</option>                                        
                                  @foreach($rows as $row)
                                  <?php $row_id = $row->id?>      
                                  <option value="{{$row->id}}">{{$row->cat}}</option>
                                  @endforeach
                                </select>
                              </div>

                            

                                <div class="col-lg-6">
                                  <label>Item Description</label>
                                  <input class="form-control" placeholder="Description" type="text" name="des"  autofocus autocomplete="cat" />
                                </div>

                                  
                                <div class="col-lg-6">
                                  <label>Type</label>
                                <select name="type" class="form-control" >
                                  <option value="1">Product</option>
                                  {{-- <option value="1">Service</option> --}}
                                </select>
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
                  <h3 class="card-title">Recently Added Items</h3>
                </div>
                          
                  <div class="card-body">
                                
                    <em>  Showing the last 20 items recently added</em>
                                  <table class="table table-sm" >
                                     <tr>
                                      <td>SN</td>
                                      <td>Item</td>
                                       <td>Note</td>
                                        <td>Type</td>
                                        <td>Action</td></tr>
             

                                     <?php $items = json_decode($items); ?>
                                    @if($items>0) 
                                    <?php   $i = 1;?>           
                                    @foreach($items as $item)
                                        
                                    <tr class="odd gradeX">
                                      <td class="center"><?php  echo $i++; ?></td>
                                      <td><?php  echo ucfirst($item->item) ;?></td>
                                      <td><?php  echo ucfirst($item->des) ;?></td>
                                      <td><?php  echo       ($item->type) ;?></td>
                                      <form action="" method="post">
                                        <td> <button class="btn btn-danger btn-xs" value="{{$item->id}}"><i class="fa fa-trash"></i></button></td> 
                                      </form> 
                                    </td> 
                                  </tr>   
                                              

                                    @endforeach
                                    @endif
                                </table>
                  </div>
                </div>  

                <div class="col-md-6 col-sm-6">
                  <div class="table-responsive">
                    <table class="table table-bordered text-center" >
                      @if(session()->has('cat'))
                        <?php $cat = session()->get('cat');  ?>
                        
                        <tr class="btn-secondary"><td colspan="5"><h4><b>{{$cat}}</b> <h4></th></tr>
                          <tr>
                            <td>SN</td>
                          <td>Item</td>
                            <td>Note</td>
                            <td>Type</td>
                            <td>Action</td></tr>
                                
    
                                      
                            @if(session()->has('cats'))
                            <?php $cats = session()->get('cats');  ?>
                            @endif
                            
                            <?php $cats = json_decode($cats); $i=1?>
                              
                            @if($rows>0)                
                            @foreach($rows as $row)
                          
                            
                            
                            @if($cats>0)
    
                                @foreach($cats as $cated)
                                @if ($row->cat == $cat)
                                <tr class="odd gradeX">
                                  <td class="center"> {{$i++}} </td>
                                  <td class="center"> <?php echo  ucfirst($cated->item)?></td>
                                  <td class="center"> <?php echo  ucfirst($cated->des)?></td>
                                  <td class="center"> <?php echo  ($cated->type)?></td>
                              
                                    <td><form method="post"><button name="delItem" class="btn btn-danger btn-xs" value="<?php echo $cated->id ?>"><i class="fa fa-trash"></i></button></form></td>
                                @endif
                                @endforeach
                                @endif
                                
    
                            @endforeach
                            @endif
    
    
    
    
                            @endif
                    </table>
                  </div>



                      </div>
            </div><div class="modal fade" id="addcat">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Add Product Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="{{route('createcategory')}}" method="post" role="form">
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
