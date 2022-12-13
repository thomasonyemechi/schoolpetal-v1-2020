<?php
$sta = new App\Http\Controllers\Profilecontroller;
//$id = session()-
?>



<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  {{-- <a href="{{route('mydashboard')}}" class="brand-link">
    <img src="{{asset('favicon.ico')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">SCHOOLDRIVE</span>
  </a> --}}
  <?php $sinfo = session()->get('sinfo'); 
  $img = ($sta->simg('photo') != '')?$sta->simg('photo'):'favivon.png';
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
            {{$sta->cname2($sta->uid())}}
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="{{route('mydashboard')}}" class="nav-link active">
            <i class="fa fa-home"></i>
            <p>
              Dashboard 
            </p>
          </a>
        </li>


        <li class="nav-item">
          <a href="/myprofile" class="nav-link">
            <i class="fa fa-user nav-icon"></i>
            <p>My Profile</p>
          </a>
        </li>


        <li class="nav-item">
          <a href="resultchecker" class="nav-link">
            <i class="fa fa-target nav-icon"></i>
            <p>Results </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="/activeexam" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Start Exam
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/activeexam" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Take Exam</p>
              </a>
            </li>
          </ul>
        </li>  
        
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>School ClassRoom
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
  
              <li class="nav-item">
                <a href="/course" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Take A Course</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recent Activity</p>
                </a>
              </li> --}}
            </ul>
          </li>   


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-book nav-icon"></i>
              <p>Visit Libary</p>
            </a>
          </li>


          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-dollar-sign nav-icon"></i>
              <p>See Payment History</p>
            </a>
          </li>
        
         --}}
        
        
        <li class="nav-item has-treeview">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <x-jet-responsive-nav-link href="{{ route('logout') }}" class="btn btn-block btn-danger" onclick="event.preventDefault(); this.closest('form').submit();">
               <i class="fa fa-power-off"></i> Logout
            </x-jet-responsive-nav-link>
          </form>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
