<!-- Brand Logo -->
<!-- <a href="" class="brand-link">
  <img src="{{ asset('AdminLTE\image\AdminLTELogo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
  <span class="brand-text font-weight-light">Queue SSN</span>
</a> -->
<!-- Sidebar -->
<div class="sidebar">
  <!-- SidebarSearch Form -->
  <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
      <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-sidebar">
          <i class="fas fa-search fa-fw"></i>
        </button>
      </div>
    </div>
  </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item menu-open">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Customer Service
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="cs.index" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Queue Manager</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cs.index" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Admin</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item menu-open">
        <form action="{{Route('postlogout')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-link">
                <i class="nav-icon far fa-circle text-danger"></i>
            Logout</button>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
