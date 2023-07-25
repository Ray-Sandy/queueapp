<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Queue | List</title>

  <style>
    .dataTables_filter {
       width: auto;
       float: right;
       text-align: left;
       margin-right: 0%
    }
    .pagination {
        float: right;
    }
    .dataTables_length {
        float: left;
        text-align: left;
        margin-right: 0%;
    }
    .row-center{
        margin-bottom: -10px;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>
<body class="text-sm sidebar-collapse sidebar-closed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        @include('queue.template.navbar')
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        @include('queue.template.sidebar')
        <!-- /.sidebar -->
    </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      {{-- <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">List Antrian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> --}}
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  List
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#pembayaran" data-toggle="tab">Pembayaran</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#pemesanan" data-toggle="tab">pemesanan</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#tukar-barang" data-toggle="tab">Tukar Barang</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="pembayaran"
                       style="position: relative; height: auto;">
                      {{-- <canvas id="pembayaran" height="300" style="height: auto;"></canvas> --}}
                      <table id="example1" id="pembayaran" class="table table-bordered table-striped text-sm">
                        <thead>
                          <tr>
                            <th>No. Antrian</th>
                            <th>Status</th>
                            <th>Counter</th>
                            <!-- Tambahkan kolom lain yang diperlukan -->
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($queues1 as $queue)
                          <tr data-queue-id="{{ $queue->id }}">
                            <td>{{ $queue->queue_number }}</td>
                            <td id="status-{{ $queue->id }}">{{ $queue->status }}</td>
                            <td>{{ $queue->counter }}</td>
                            <!-- Tambahkan kolom lain yang diperlukan -->
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                   </div>
                  <div class="chart tab-pane" id="pemesanan" style="position: relative; height: auto;">
                    {{-- <canvas id="pemesanan" height="300" style="height: auto;"></canvas> --}}
                    <table id="example2" id="pemesanan" class="table table-bordered table-striped text-sm">
                        <thead>
                            <tr>
                                <th>No. Antrian</th>
                                <th>Status</th>
                                <th>Counter</th>
                                <!-- Tambahkan kolom lain yang diperlukan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queues2 as $queue)
                                <tr data-queue-id="{{ $queue->id }}">
                                    <td>{{ $queue->queue_number }}</td>
                                    <td id="status-{{ $queue->id }}">{{ $queue->status }}</td>
                                    <td>{{ $queue->counter }}</td>
                                    <!-- Tambahkan kolom lain yang diperlukan -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                  <div class="chart tab-pane" id="tukar-barang" style="position: relative; height: auto;">
                    {{-- <canvas id="tukar-barang" height="300" style="height: auto;"></canvas> --}}
                    <table id="example3" id="tukar-barang" class="table table-bordered table-striped text-sm">
                        <thead>
                            <tr>
                                <th>No. Antrian</th>
                                <th>Status</th>
                                <th>Counter</th>
                                <!-- Tambahkan kolom lain yang diperlukan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($queues3 as $queue)
                                <tr data-queue-id="{{ $queue->id }}">
                                    <td>{{ $queue->queue_number }}</td>
                                    <td class="status">{{ $queue->status }}</td>
                                    <td>{{ $queue->counter }}</td>
                                    <!-- Tambahkan kolom lain yang diperlukan -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- /.card-body -->
              <div class="card-footer">
                <a href="{{ route('queue.create') }}">Kembali ke halaman formulir.</a>
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          {{-- <section class="col-lg-5 connectedSortable">

          </section> --}}
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>&copy; 2023 ITSSN</a>.</strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('AdminLTE/plugins/sparklines/sparkline.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            "aLengthMenu": [[5, 10], [5, 10]],
            "iDisplayLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": false,
            "info": false,
            "buttons": false,
            // ["copy", "csv","print", "colvis"]
            "language": {
              'searchPlaceholder': 'Search',
              'search': "",
            }
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "aLengthMenu": [[5, 10], [5, 10]],
            "iDisplayLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": false,
            "info": false,
            "buttons": false,
            // ["copy", "csv","print", "colvis"]
            "language": {
              'searchPlaceholder': 'Search',
              'search': "",
            }
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
        $('#example3').DataTable({
            "aLengthMenu": [[5, 10], [5, 10]],
            "iDisplayLength": 5,
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": true,
            "searching": true,
            "ordering": false,
            "info": false,
            "buttons": false,
            // ["copy", "csv","print", "colvis"]
            "language": {
              'searchPlaceholder': 'Search',
              'search': "",
            }
        }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    });
</script>
{{-- <script>
  // Function to update the status in the table
  function updateStatus(queues) {
    $.each(queues, function(id, data) {
      $('#status-' + id).text(data.status);
    });
  }

  // Function to fetch the latest status from the server
  function getStatus() {
    $.ajax({
      url: '/queue/get-status', // URL to the getStatus function in the QueueController
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        updateStatus(data);
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }

  // Fetch status every 15 seconds
  setInterval(getStatus, 15000);

  // Call getStatus initially to update the table on page load
  getStatus();
</script> --}}
<!-- Include jQuery library -->
<script>
  // Function to update the status in the table
  function updateStatus(queues, tableId) {
    $.each(queues, function(id, data) {
      $('#' + tableId + ' #status-' + id).text(data.status);
    });
  }

  // Function to fetch the latest status from the server
  function getStatus(tableId) {
    $.ajax({
      url: '/queue/get-status', // URL to the getStatus function in the QueueController
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        updateStatus(data, tableId);
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }

  // Fetch status for each table every 15 seconds
  setInterval(function() {
    getStatus('example1');
    getStatus('example2');
    getStatus('example3');
  }, 15000);

  // Call getStatus initially to update each table on page load
  getStatus('example1');
  getStatus('example2');
  getStatus('example3');
</script>

<script>
  // Function to update the status in the table
  function updateTable(tableId, data) {
    var $tableBody = $('#' + tableId + ' tbody');
    $tableBody.empty(); // Clear the table body
    $.each(data, function(index, queue) {
      var row = '<tr data-queue-id="' + queue.id + '">' +
                  '<td>' + queue.queue_number + '</td>' +
                  '<td id="status-' + queue.id + '">' + queue.status + '</td>' +
                  '<td>' + queue.counter + '</td>' +
                  '</tr>';
      $tableBody.append(row); // Append new rows to the table body
    });
  }

  // Function to fetch the latest queue data from the server for each counter
  function getQueueData(tableId, counter) {
    $.ajax({
      url: '/queue/get-queue-data/' + counter,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        updateTable(tableId, data);
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  }

  // Fetch queue data for each table every 15 seconds
  setInterval(function() {
    getQueueData('example1', 'pembayaran');
    getQueueData('example2', 'pemesanan');
    getQueueData('example3', 'tukar-barang');
  }, 15000);

  // Call getQueueData initially to populate the tables on page load
  getQueueData('example1', 'pembayaran');
  getQueueData('example2', 'pemesanan');
  getQueueData('example3', 'tukar-barang');
</script>



</body>
</html>
