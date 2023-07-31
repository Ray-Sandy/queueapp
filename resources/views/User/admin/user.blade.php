<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    @include ('template.header')

</head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
                @include('admin.template.navbar')

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                <img src="{{asset('AdminLTE/image/AdminLTELogo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    {{-- <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div> --}}
                    <div class="info">
                    <a href="#" class="d-block">Ray Sandy</a>
                    </div>
                </div>

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
                            User List
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="channel" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Master - Channel</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                  <a href="office" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - Office</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="plant" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - Plant</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="mapping" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - Mapping P&SO</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="conversionax" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - Conversion AX</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="itemhir4" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - Item HIR 4</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="hirplantchannel" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - HirPlantChannel</p>
                                  </a>
                              </li>
                              <li class="nav-item">
                                  <a href="conversionsku" class="nav-link ">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Master - Conversion SKU</p>
                                  </a>
                              </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Transaksi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="demand" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Transaksi Demand</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="supply" class="nav-link active">
                                    <i class="nav-icon far fa-circle text-info"></i>
                                    <p>S&OP - Supply</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="exportsql" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Transaksi Download</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                            @if (Auth::user()->level == 'admin')
                                @include ('template.adminpage')
                            @endif
                    </li>
                        @include ('template.logout')
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
                                <h1 class="m-0">Welcome !</h1>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Sunpride | Master Channel</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->


                <!-- Main content -->
                <div class="content">
                    <div class="card card-info card-outline">
                        {{-- <div class="card-header">
                            <a href="#" class="btn btn-success">Export Data</a>
                            <br>
                            <div class="card-tools">
                                <a href="#" class="btn btn-success"> Tambah Data <i class="fas fa-plus-square-o"></i></a>
                            </div>
                            <br>
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="file" required="required">
                                <br>
                                <button type="submit" class="btn btn-primary" class="form-control">Upload</button>
                            </form>
                        </div> --}}

                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Nama</th>
                                    <th>level</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                </tr>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->level}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->password}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="card-footer">
                            {{$user->links() }}
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                    {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                test
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
                <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
                </div>
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <footer class="main-footer">
                @include('admin.template.footer')
            </footer>
        </div>
    </body>
</html>
<style>
    .w-5{
        display:none
    }
</style>
