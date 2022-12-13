
<?php
$uid = auth()->user()->power;

?>



<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  {{-- <a href="{{route('dashboard')}}" class="brand-link">
    <img src="{{asset('favicon.png')}}" alt="Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">SCHOOLPETAL</span>
  </a> --}}
  <?php $sinfo = session()->get('sinfo');
$img = ($sinfo['img'] != '')?$sinfo['img']:'favicon.png';

?>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('bussiness/sch/'.$img.'')}}" class="img-circle " alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          @if(Auth::user()->level>9)
            {{ucwords(Auth::user()->manager)}}
          @else
            {{ucwords(Auth::user()->name)}}
          @endif
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{route('dashboard')}}" class="nav-link active">
            <i class="fa fa-home"></i>
            <p>
              Dashboard 
            </p>
          </a>
        </li>


        @if($uid->make_sales == 1)
        <li class="nav-item">
          <a href="{{route('sales')}}" class="nav-link">
            <i class="fa fa-th nav-icon"></i>
            <p>Point of Sale</p>
          </a>
        </li>
        @endif

        @if($uid->make_sales == 1)
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Stock Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            

            {{-- <li class="nav-item">
              <a href="{{route('category')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add new Category</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="{{route('createitem')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Item</p>

              </a>
            </li>

            <li class="nav-item">
              <a href="/stockprofile" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stock Profile</p>
              </a> 
            </li>

            <li class="nav-item">
              <a href="{{route('restocks')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Restock Item</p>

              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('unstock')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Unstock Item</p>
              </a>
            </li>

      
            <li class="nav-item">
              <a href="stockpreorder" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stock Pro-Order</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="orderprocessing" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stock Order Processing</p>
              </a>
            </li>



          </ul>
        </li>      
        @endif
        

        @if(auth()->user()->level >=7)
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Students/Pupils
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($uid->add_student == 1)
              <li class="nav-item">
                <a href="/parent/add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Parent</p>
                </a>
              </li>
            @endif
            @if($uid->add_student == 1)
              <li class="nav-item">
                <a href="{{route('student.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Student</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->level > 7)
              <li class="nav-item">
                <a href="{{route('student.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Profile</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->level == 7)
              <li class="nav-item">
              <a href="{{route('postresult')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Post Result</p>
                </a>
              </li>
            @endif
            @if(auth()->user()->level >= 9)
              <li class="nav-item">
                <a href="{{route('classes')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('classcat')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Category/Arm</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('subjects')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subjects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('promotion')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Promotions</p>
                </a>
              </li>
            @endif

            @if($uid->set_fees == 1)
              <li class="nav-item">
                <a href="{{route('setfee')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Fees</p>
                </a>
              </li>
            @endif



            @if($uid->pay_profile == 1)
              <li class="nav-item">
                <a href="{{route('paymentprofile')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment Profile</p>
                </a>
              </li>
            @endif


            @if($uid->print_result == 1)
              <li class="nav-item">
                <a href="{{route('printresult')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Result</p>
                </a>
              </li>
            @endif
          </ul>
        </li>
        @endif


        @if(auth()->user()->level == 5)

        <li class="nav-item has-treeview menu-open">
          <a href class="nav-link">
            <i class="fa fa-home"></i>
            <p>
              Request Book
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              E-library
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/addebook" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add book</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
            School Library
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add book</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stock Libary</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Unstock Libary</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Library Histories
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Request History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Book History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Stocking History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Unstocking History</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Request History</p>
              </a>
            </li>
          </ul>
        </li>
      @endif



        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Staff Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($uid->add_staff == 1)
              <li class="nav-item">
                <a href="{{route('staffs')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Staff</p>
                </a>
              </li>
            @endif
            <li class="nav-item">
              <a href="{{route('staffprofile')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Staff Profile</p>
              </a>
            </li>
          </ul>
        </li>

        @if($uid->big_salesrep == 1)

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-phone"></i>
            <p>
              Contact Management
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/vendorprofile" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Supplier Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/repprofile" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Salesrep Profile</p>
              </a>
            </li>
          </ul>
        </li>
        @endif

        @if($uid->big_salesrep == 1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Bussiness Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/genstock" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Genral Stock Details</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dailysales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daily Sales Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/weeklysales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Weekly Sales Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/monthlysales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Sales Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/annualsales" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Annual Sales Summary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/annualstock" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Annual Stocking Summary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salesrep Sales Summary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Salesrep Sales Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/expend" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Annual Expenditure</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/profitloss" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profit & Loss Statement</p>
                </a>
              </li>
            </ul>
          </li>
        @endif

        @if($uid->power == 1)
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-chart-pie"></i>
            <p>
              School Fee Report
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="generalfee" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>General Fee Details</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dailyfee" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Daily Fee Detail</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="weeklyfee" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Weekly Fee Detail</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="termlyfee" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Termly Fee Detail</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Fee Across Date Range</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Fee Summary</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Salesrep Sales Detail</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/expend" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Annual Expenditure</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Profit & Loss Statement</p>
              </a>
            </li>
          </ul>
        </li>
      @endif


      @if($uid->add_expense == 1)
      <li class="nav-item has-treeview">
        <a href="{{route('expenditure')}}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Manage Expenditure
          </p>
        </a>
      </li>
    @endif



        @if(auth()->user()->level >= 9)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('adminsetup')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('resultsetup')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Result Setup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('generalsetup')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Setups</p>
                </a>
              </li>
              @if($uid->power == 1)
                <li class="nav-item">
                  <a href="/power" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Permission Setups</p>
                  </a>
                </li>
              @endif
              <li class="nav-item">
                <a href="/smssetup" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMS Setups</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CBT Setups</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-learning Setups</p>
                </a>
              </li> --}}
            </ul>
          </li>
        @endif

        @if(auth()->user()->level == 7 )
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                CBT Operation
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('createtype')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Examtype</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('createexam')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Exam</p>
                </a>
              </li>
            </ul>
          </li>
        @endif

       

        
        <li class="nav-item has-treeview">
            <x-jet-responsive-nav-link class="btn btn-block btn-danger" data-toggle="modal" data-target="#logout">
               <i class="fa fa-power-off"></i> Logout
            </x-jet-responsive-nav-link>
        </li>

      </ul>

      
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>



<div class="modal fade" id="logout">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-bold">Logout Session?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
            <h6>Are you sure you want to logout?</h6>
            <br>
            <form method="post"  action="{{ route('logout') }}">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary">No, Cancel</button>
                @csrf
                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); this.closest('form').submit();">
                   Yes Logout
                </a>
            </form>
        </center>
    </div>
     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->





<div class="modal fade" id="changepassword">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-bold">Change Password</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
            <h6>Change Your Password</h6><br>
            <form action="/changepassword" method="post" class="row">
              @csrf
              <div class="col-md-4">
                <input type="password" class="form-control mb-2" name="oldpwd" placeholder="Old Password" required>
              </div>
              <div class="col-md-4">
                <input type="password" class="form-control mb-2" name="newpwd" placeholder="New Password" required>
              </div>
              <div class="col-md-4">
                <input type="password" class="form-control mb-2" name="confirmpwd" placeholder="Confrim Password" required>
              </div>

               <div class="col-md-12">
                <button type="submit" class="btn btn-primary float-right">save<button>
               </div>
            </form>
        </center>
    </div>
     
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
