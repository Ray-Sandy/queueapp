
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sunpride | Master Data Manager</title>

    @include ('template.header')

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="sidebar-mini layout-fixed sidebar-collapse text-sm">
<div class="wrapper">

  @include ('template.navbar')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    @include ('template.sidebar')

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        @if (Auth::user()->level == 'admin' || Auth::user()->level == 'dev'|| Auth::user()->level == 'user' )
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                CS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="cs" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Customer Service</p>
                  </a>
                </li>
            </ul>
          </li>
          @if (Auth::user()->level == 'admin')
                @include ('User.admin.template.adminpage')
            @endif
        @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Welcome to Sunpride Data Manager !!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index">Master Home</a></li>
              <!--li class="breadcrumb-item active">Home</li-->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  @include ('template.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

    @include ('template.jquery')

</body>
</html>
          {{-- <li class="nav-item">
            <a href="{{Route('postlogout')}}" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p>Log Out</p>
            </a>
          </li> --}}
