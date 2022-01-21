



<!-- Sidebar -->
@php
$user= Auth::user();
@endphp
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <router-link class="sidebar-brand d-flex align-items-center justify-content-center" to="/">
      {{-- <div class="sidebar-brand-icon">
        <img src="/assets/img/logo/logo.png">
      </div> --}}
      <div class="sidebar-brand-text mx-3">S P A</div>
    </router-link>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active" href="">
      <router-link to="/" class="nav-link">

        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></router-link>
    </li>
    <hr class="sidebar-divider">

    <li class="nav-item active">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasters" aria-expanded="true"
        aria-controls="collapseForm">
        <i class="fab fa-fw fa-wpforms"></i>
        <span>Masters</span>
      </a>
      <div id="collapseMasters" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded" >
          <h6 class="collapse-header">Masters</h6>
          <router-link class="collapse-item" to="/customer">Customer</router-link>
          <router-link class="collapse-item" to="#1">Products</router-link>
          <router-link class="collapse-item" to="/service">Service</router-link>
          <router-link class="collapse-item" to="/employee">Employees</router-link>
          <router-link class="collapse-item" to="/category">Category</router-link>
          <router-link class="collapse-item" to="/designation">Designation</router-link>
          <router-link class="collapse-item" to="/images">Images</router-link>
          <!-- <a class="collapse-item" href="form_advanceds.html">Reward Settings</a> -->
        </div>
      </div>
    </li>

    <li class="nav-item active">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOperations" aria-expanded="true"
        aria-controls="collapseTable">
        <i class="fas fa-fw fa-table"></i>
        <span>Operations</span>
      </a>
      <div id="collapseOperations" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Operations</h6>
          <router-link class="collapse-item" to="#">Add Sales</router-link>
       <router-link class="collapse-item" to="/attendance">Attendance</router-link>
        </div>
      </div>
    </li>

    <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas fa-fw fa-table"></i>
          <span>Reports</span>
        </a>
        <div id="collapseReports" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reports</h6>

            <router-link class="collapse-item" to= "attendance-report" >Attendance Report</router-link>
         
          </div>
        </div>
      </li>

    <hr class="sidebar-divider">

  </ul>
  <!-- Sidebar -->
  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
      <!-- TopBar -->
      <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <ul class="navbar-nav ml-auto">

          <div class="topbar-divider d-none d-sm-block"></div>

          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-circle"></i>
              <span class="ml-2 d-none d-lg-inline text-white small">Admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#passwordChangeModal" data-toggle="modal" data-target="#passwordChangeModal">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </div>
          </li>
        </ul>

      </nav>

      <!-- Topbar -->







