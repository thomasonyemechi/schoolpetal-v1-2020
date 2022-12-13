<?php  $sta = new App\Http\Controllers\Profilecontroller;  ?>   
   
   <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
  
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
  
                <div class="info-box-content">salerpe
                  <span class="info-box-number"></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
  
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa fa-bookmark"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Stock</span>
                  <span class="info-box-number">
                    <?php echo $sta->stockCount(); ?>
  <!--                   <small>%</small>
   -->                </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Today's Sales</span>
                  <span class="info-box-number"><?php echo number_format($sta->totalSales()); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
  
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
  
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number"><?php echo number_format($sta->sales()); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            
          </div>
          <!-- /.row -->
  
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h5 class="card-title"><i class="fa far-pie-chart nav-icon"></i> Daily Sales</h5>
  
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    
                    <!-- /.col -->
                    <div class="col-md-6">
                      <p class="text-center">
                        <strong>Recent Sales</strong>
                      </p>
  
                      <table class="table table-sm">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Date/Time</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $rep = auth()->user()->sid;
                         // $db->query("SELECT * FROM transact2 WHERe rep='$rep' Order by sn desc limit 5 " )or die(mysqli_error());
                        $query = $sta->sqlsales(7);
                            $i=1; 
                        foreach($query as $row){
                        $e=$i++;
                        
                        ?>
                       <tr class="odd gradeX">
                         
                            <td class="center"><?php echo $row->name ?></td>
                            
                            <td class="center">₦<?php echo number_format($row->amount) ?></td>
                            
                            <td class="center"><a href="#" onclick="BrWindow('receipt?transactionIndex=<?php echo $row->salesid; ?>','','width=800,height=600')"><?php echo date('d M. h:ia',strtotime($row->created)); ?></a></td>
                          </tr>
                          <?php  } ?>
                        </tbody>
                      </table>
                      
                    </div>


                    <div class="col-md-6">
                        <p class="text-center">
                          <strong>Item Quantity</strong>
                        </p>

                        <table class="table table-sm">
                            <thead>
                            <tr>
                              <th>Name</th>
                              <th>Qty</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php

                            $qy = $sta->sqlitem(7);
                            foreach($qy as $r){
                            
                            ?>
                           <tr class="odd gradeX">
                             
                                <td class="center"><?php echo $r->item ?></td>
                                
                                <td class="center"><?php echo number_format($sta->itemqty($r->id)) ?></td>
                                
                              </tr>
                              <?php  } ?>
                            </tbody>
                          </table>

                      </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header"><?php echo $sta->catCount(); ?></h5>
                        <span class="description-text">Item Category</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header"><?php echo $sta->totalTrans(); ?></h5>
                        <span class="description-text">Stocking Invoices</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header"><?php echo $sta->activeCustomersLast30Days(); ?></h5>
                        <span class="description-text">Active Customers</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <h5 class="description-header"><?php echo number_format($sta->yRestock()); ?></h5>
                        <span class="description-text">Restock Of Item</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->