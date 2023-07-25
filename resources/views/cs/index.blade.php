<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Service</title>
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
      <!-- Toastr -->
      <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/toastr/toastr.min.css') }}">
      {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quagga@1.0.0/dist/quagga.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quagga/dist/quagga.css"> --}}
</head>
<body class="text-sm sidebar-collapse sidebar-closed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        @include('queue.template.navbar')
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-default elevation-4">
        @include('queue.template.sidebar')
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row sm-1">
            <div class="col-sm-6">
                @if(session('success'))
                    <h1 class="text-sm">{{ session('success') }}</h1>
                @endif
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <section class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Antrian</h3>
                </div>
                <div class="card-body">
                    <table id="all" id="all" class="table table-bordered table-striped text-sm">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>phone</th>
                            <th>Nomor Antrian</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Tindakan</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($queues as $queue)
                          <tr>
                            <td>{{ $queue->id }}</td>
                            <td>{{ $queue->name }}</td>
                            <td>{{ $queue->phone_number }}</td>
                            <td>{{ $queue->queue_number }}</td>
                            <td>{{ $queue->status }}</td>
                            <td>{{ $queue->counter }}</td>
                            <td>
                            @if($queue->status == 'pending')
                                <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                </form>
                            @endif
                            @if($queue->status == 'processing')
                                <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-forward"></i> Lewati</button>
                                </form>
                            @endif
                            @if($queue->status == 'skipped')
                                <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                </form>
                            @endif
                            @if($queue->status == 'processing' || $queue->status == 'skipped')
                                <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    {{-- <button type="submit" class="btn btn-block btn-default btn-xs">
                                        <i class="fa-solid fa-square-check"></i> Selesai</button> --}}
                                        <button type="button" class="btn btn-block btn-default btn-xs" data-toggle="modal" data-target="#qrCodeScannerModal">
                                            <i class="fa-solid fa-square-check"></i> Selesai
                                        </button>

                                </form>
                            @endif
                            </td>
                          </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Daftar Skipped</h3>
                </div>
                <div class="card-body">
                    <table id="skip" id="skip" class="table table-bordered table-striped text-sm">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nomor Antrian</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Tindakan</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($queueskip as $queue)
                        <tr>
                            <td>{{ $queue->id }}</td>
                            <td>{{ $queue->name }}</td>
                            <td>{{ $queue->queue_number }}</td>
                            <td>{{ $queue->status }}</td>
                            <td>{{ $queue->counter }}</td>
                            <td>
                                @if($queue->status == 'skipped')
                                    <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                    </form>
                                @endif
                                @if($queue->status == 'processing' || $queue->status == 'skipped')
                                    <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <button type="submit" class="btn btn-block btn-default btn-xs" data-toggle="modal" data-target="#qrCodeScannerModal">
                                            <i class="fa-solid fa-square-check"></i> Selesai</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </section>
          {{-- </div>
        </div>
      </section>
      <section class="content">
        <div class="container-fluid">
          <!-- Main row -->
          <div class="row">
            <!-- Left col --> --}}
            <section class="col-md-6 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <section class="card">
                <div class="card-header">
                  <h3 class="card-title">Loket</h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                        <a class="nav-link active" href="#pembayaran" data-toggle="tab">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#pemesanan" data-toggle="tab">Pemesanan</a>
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
                    <div class="chart tab-pane active" id="pembayaran" style="position: relative; height: auto;">
                      {{-- <canvas id="pembayaran" height="300" style="height: auto;"></canvas> --}}
                      <table id="bayar" id="pembayaran" class="table table-bordered table-striped text-sm">
                        <thead>
                          <tr>
                              <th>ID</th>
                              <th>Nama</th>
                              <th>Nomor Antrian</th>
                              <th>Status</th>
                              <th>Tindakan</th>
                              <!-- Tambahkan kolom lain yang diperlukan -->
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($queues1 as $queue)
                          <tr >
                              <td>{{ $queue->id }}</td>
                              <td>{{ $queue->name }}</td>
                              <td>{{ $queue->queue_number }}</td>
                              <td>{{ $queue->status }}</td>
                              <td>
                                  @if($queue->status == 'pending' && $queue->counter == 'pembayaran')
                                      <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                          @csrf
                                          @method('PUT')

                                          <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                      </form>
                                  @endif
                                  @if($queue->status == 'processing' && $queue->counter == 'pembayaran')
                                      <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                                          @csrf
                                          @method('PUT')

                                          <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-forward"></i> Lewati</button>
                                      </form>
                                  @endif
                                  @if($queue->status == 'skipped' && $queue->counter == 'pembayaran')
                                      <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                          @csrf
                                          @method('PUT')

                                          <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                      </form>
                                  @endif
                                  @if($queue->status == 'processing' || $queue->status == 'skipped')
                                      <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                                          @csrf
                                          @method('PUT')

                                          {{-- <button type="submit" class="btn btn-block btn-default btn-xs">
                                            <i class="fa-solid fa-square-check"></i> Selesai</button> --}}
                                            <button type="button" class="btn btn-block btn-default btn-xs" data-toggle="modal" data-target="#qrCodeScannerModal">
                                                <i class="fa-solid fa-square-check"></i> Selesai
                                            </button>
                                      </form>
                                  @endif
                              </td>
                              <!-- Tambahkan kolom lain yang diperlukan -->
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="chart tab-pane" id="pemesanan" style="position: relative; height: auto;">
                      {{-- <canvas id="pemesanan" height="300" style="height: auto;"></canvas> --}}
                      <table id="pesan" id="pemesanan" class="table table-bordered table-striped text-sm">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nomor Antrian</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                            <!-- Tambahkan kolom lain yang diperlukan -->
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($queues2 as $queue)
                          <tr>
                            <td>{{ $queue->id }}</td>
                            <td>{{ $queue->name }}</td>
                            <td>{{ $queue->queue_number }}</td>
                            <td>{{ $queue->status }}</td>
                            <td>
                                @if($queue->status == 'pending' && $queue->counter == 'pemesanan')
                                    <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                    </form>
                                @endif
                                @if($queue->status == 'processing' && $queue->counter == 'pemesanan')
                                    <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-forward"></i> Lewati</button>
                                    </form>
                                @endif
                                @if($queue->status == 'skipped' && $queue->counter == 'pemesanan')
                                    <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                    </form>
                                @endif
                                @if($queue->status == 'processing' || $queue->status == 'skipped' && $queue->counter == 'pemesanan')
                                    <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs" data-toggle="modal" data-target="#qrCodeScannerModal">
                                            <i class="fa-solid fa-square-check"></i> Selesai</button>
                                    </form>
                                @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="chart tab-pane" id="tukar-barang" style="position: relative; height: auto;">
                      {{-- <canvas id="tukar-barang" height="300" style="height: auto;"></canvas> --}}
                      <table id="tukar" id="tukar-barang" class="table table-bordered table-striped text-sm">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Nomor Antrian</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                            <!-- Tambahkan kolom lain yang diperlukan -->
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($queues3 as $queue)
                          <tr>
                            <td>{{ $queue->id }}</td>
                            <td>{{ $queue->name }}</td>
                            <td>{{ $queue->queue_number }}</td>
                            <td>{{ $queue->status }}</td>
                            <td>
                                @if($queue->status == 'pending' && $queue->counter == 'tukar-barang')
                                    <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                    </form>
                                @endif
                                @if($queue->status == 'processing' && $queue->counter == 'tukar-barang')
                                    <form action="{{ route('cs.skip', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-forward"></i> Lewati</button>
                                    </form>
                                @endif
                                @if($queue->status == 'skipped' && $queue->counter == 'tukar-barang')
                                    <form action="{{ route('cs.call', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-block btn-default btn-xs "><i class="fa-solid fa-phone"></i> Panggil</button>
                                    </form>
                                @endif
                                @if($queue->status == 'processing' || $queue->status == 'skipped' && $queue->counter == 'tukar-barang')
                                    <form action="{{ route('cs.complete', ['id' => $queue->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-block btn-default btn-xs" data-toggle="modal" data-target="#qrCodeScannerModal">
                                            <i class="fa-solid fa-square-check"></i> Selesai
                                        </button>
                                    </form>
                                @endif
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div><!-- /.card-body -->
                <!-- Add the modal for QR code scanning -->
                <div class="modal fade" id="qrCodeScannerModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeScannerModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="qrCodeScannerModalLabel">QR Code Scanner</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div id="qrCodeScanner"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add a form to submit the scanned QR code data -->
                <form id="qrCodeSubmitForm" method="POST" action="{{ route('cs.complete-queue', ['id' => '']) }}">
                    @csrf
                    {{-- @method('PUT') <!-- Specify the method as PUT --> --}}
                    <input type="hidden" name="id" id="queueIdInput">
                    <input type="hidden" name="counter" id="queueCounterInput">
                </form>
            </section>
        </section>
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

  {{-- <!-- Add Quagga library script -->
  <script src="https://cdn.jsdelivr.net/npm/quagga@1.0.0/dist/quagga.min.js"></script> --}}
<!-- inconic icon -->
<script src="https://kit.fontawesome.com/6c604010ae.js" crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
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
<!-- Include the necessary JavaScript libraries -->
<script src="https://cdn.rawgit.com/sitepoint-editors/jsqrcode/master/src/qr_packed.js"></script>
<!-- Toastr -->
<script src="{{ asset('AdminLTE/plugins/toastr/toastr.min.js') }}"></script>
<script>
    $('.toastrDefaultSuccess').click(function() {
      toastr.success(
          'Berhasil')
    });
</script>
<script>
    $(function () {
        $('#all').DataTable({
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
        $('#skip').DataTable({
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
        $('#bayar').DataTable({
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
        $('#pesan').DataTable({
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
        $('#tukar').DataTable({
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
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<!-- JavaScript to handle QR code scanning -->
{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const qrCodeScanner = new Html5QrcodeScanner(
            "qrCodeScanner",
            { fps: 10, qrbox: 250 },
            /* verbose= */ false
        );

        qrCodeScanner.render(onScanSuccess);

        function onScanSuccess(qrCodeMessage) {
            // Parse the scanned data from the QR code
            const scannedData = JSON.parse(qrCodeMessage);

            // Fill the form with scanned data and submit
            document.getElementById("queueIdInput").value = scannedData.id;
            document.getElementById("queueCounterInput").value = scannedData.counter;
            document.getElementById("qrCodeSubmitForm").submit();
        }

        $('#qrCodeScannerModal').on('hidden.bs.modal', function () {
            // Stop the QR code scanner when the modal is closed
            qrCodeScanner.stop();
        });
    });
</script> --}}
<!-- JavaScript to handle QR code scanning -->
<!-- JavaScript to handle QR code scanning -->
<script>
    let qrCodeScanner; // Declare the scanner variable at a higher scope to make it accessible to other functions
    let isRequestInProgress = false; // Add this variable

    // Function to stop the QR code scanner
    function stopScanner() {
        if (qrCodeScanner) {
            qrCodeScanner.clear();
        }
    }

    html5QrCode.stop().then((ignore) => {
    // QR Code scanning is stopped.
    }).catch((err) => {
    // Stop failed, handle it.
    });

    document.addEventListener('DOMContentLoaded', function () {
        qrCodeScanner = new Html5QrcodeScanner(
            "qrCodeScanner",
            { fps: 10, qrbox: 250 },
            /* verbose= */ false
        );

        qrCodeScanner.render(onScanSuccess);

        function onScanSuccess(qrCodeMessage) {
            // Parse the scanned data from the QR code
            const scannedData = JSON.parse(qrCodeMessage);

            // Fill the form with scanned data and submit
            document.getElementById("queueIdInput").value = scannedData.id;
            document.getElementById("queueCounterInput").value = scannedData.counter;

            // Submit the form using AJAX
            $.ajax({
                url: "{{ route('cs.complete-queue') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: scannedData.id,
                    counter: scannedData.counter
                },
                success: function (response) {
                    // Handle the response from the server
                    if (response.success == true) {
                        if (response.status === 'completed') {
                            toastr.success('Data berhasil tervalidasi.');

                            // Reload the page after the success message is shown
                            window.location.reload();
                        } else {
                            // If the status is not "completed," show an error message
                            toastr.error('Terjadi kesalahan. Status tidak sesuai.');
                        }
                    } else {
                        // Validation failed, show error message
                        toastr.error('Data gagal tervalidasi. Coba lagi.');
                    }

                    // Reset the request in progress flag
                    isRequestInProgress = false;
                },
                error: function () {
                    toastr.error('Terjadi kesalahan. Coba lagi.');

                    // Reset the request in progress flag
                    isRequestInProgress = false;
                }
            });
        }

        $('#qrCodeScannerModal').on('hidden.bs.modal', function () {
            // Stop the QR code scanner when the modal is closed
            stopScanner();
        });

        // Listen to the form submit event
        $('#qrCodeSubmitForm').on('submit', function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Check if a request is already in progress
            if (isRequestInProgress) {
                return;
            }

            // Set the request in progress flag to true
            isRequestInProgress = true;

            // Start the QR code scanner
            qrCodeScanner.start().then(function () {
                // QR code scanner started successfully, proceed with scanning
                qrCodeScanner.scan();
            }).catch(function (error) {
                // Failed to start the QR code scanner, show an error message
                toastr.error('Terjadi kesalahan saat memulai pemindaian. Silakan coba lagi.');
                isRequestInProgress = false;
            });
        });
    });
</script>

{{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></>
<script>
    function onScanSuccess(decodedText, decodedResult) {
        // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);
        }

        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning.
        // for example:
        // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { fps: 10, qrbox: {width: 300, height: 300} },
        /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script> --}}
{{-- <script>
    // Fungsi untuk mengirimkan data pemindaian ke server
    function submitScanResult(decodedText) {
        // Kirim data pemindaian ke server untuk validasi
        $.ajax({
            type: 'POST',
            url: "{{ route('cs.updateQueueStatus', ['id' => 0]) }}", // Ganti "0" dengan ID antrian yang sesuai (diisi saat mengirim data dari server)
            data: {
                scannedData: decodedText
            },
            success: function(response) {
                // Tampilkan pesan sukses menggunakan Toastr
                toastr.success('Antrian telah selesai.');
                // Refresh halaman setelah validasi berhasil
                location.reload();
            },
            error: function(error) {
                // Tampilkan pesan error menggunakan Toastr
                toastr.error('QR Code tidak valid. Silakan coba lagi.');
            }
        });
    }

    $(document).ready(function() {
        // Inisialisasi pemindai QR code
        let html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: { width: 300, height: 300 } }, false);

        // Fungsi untuk menangani pemindaian berhasil
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the scanned code as you like
            console.log('Code matched = ', decodedText);
            submitScanResult(decodedText);
        }

        // Fungsi untuk menangani pemindaian gagal
        function onScanFailure(error) {
            console.warn('Code scan error = ', error);
        }

        // Fungsi untuk menampilkan modul pemindaian QR code
        $('#btnSelesai').on('click', function() {
            // Reset QR code scanner
            html5QrcodeScanner.clear();
            // Tampilkan modul
            $('#scanQRModal').modal('show');
            // Mulai pemindaian
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });

        // Fungsi untuk menangani klik tombol "Selesai" pada modul pemindaian QR code
        $('#btnSubmitScan').on('click', function() {
            // Stop pemindaian
            html5QrcodeScanner.clear();
            // Tutup modul
            $('#scanQRModal').modal('hide');
        });
    });
</script> --}}
{{-- <script>
    let scannerIsRunning = false;
    let qrCodeData = null;

  // Function to handle QR code scanning
  function startQrCodeScanner() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector("#scanArea"),
                constraints: {
                    facingMode: "environment" // or "user" for the front camera
                },
            },
            decoder: {
                readers: ["code_128_reader"]
            }
        }, function (err) {
            if (err) {
                console.error("Error initializing QR code scanner:", err);
                return;
            }
            Quagga.start();
            scannerIsRunning = true;
        });
    }

  // Function to stop QR code scanning
  function stopQrCodeScanner() {
        Quagga.stop();
        scannerIsRunning = false;
    }
  // Function to handle the validation of the scanned QR code
  function validateQrCode() {
        if (qrCodeData) {
            // Send the scanned data to the server for validation
            // Replace the 'csrf-token' value with the actual CSRF token value from Laravel
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch("{{ route('cs.validateQrCode') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ qrData: qrCodeData })
            })

      .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        const { id, counter, name, phone_number, created_at } = data.data;
                        document.getElementById("idResult").innerText = `ID: ${id}`;
                        document.getElementById("counterResult").innerText = `Counter: ${counter}`;
                        document.getElementById("nameResult").innerText = `Name: ${name}`;
                        document.getElementById("phoneNumberResult").innerText = `Phone Number: ${phone_number}`;
                        document.getElementById("createdAtResult").innerText = `Created At: ${created_at}`;

                        document.getElementById("scanArea").style.display = "none";
                        document.getElementById("resultContainer").style.display = "block";
                        document.getElementById("successMessage").style.display = "block";
                        document.getElementById("validateQrCodeBtn").style.display = "none";
                    } else {
                        document.getElementById("errorMessage").style.display = "block";
                    }
                })
                .catch(error => {
                    console.error("Error validating QR code:", error);
                    document.getElementById("errorMessage").style.display = "block";
                });
        }
    }
  // Event listener for the "Selesai" (Finish) button
  document.getElementById("btnSelesai").addEventListener("click", function () {
        if (!scannerIsRunning) {
            startQrCodeScanner();
        }
        qrCodeData = null;
        document.getElementById("scanArea").style.display = "block";
        document.getElementById("resultContainer").style.display = "none";
        document.getElementById("successMessage").style.display = "none";
        document.getElementById("errorMessage").style.display = "none";
        $("#scanQRModal").modal("show");
    });
  // Event listener for the "Validate QR Code" button in the modal
  document.getElementById("validateQrCodeBtn").addEventListener("click", function () {
        validateQrCode();
        stopQrCodeScanner();
    });
  // Event listener to hide the error message on modal close
  $("#scanQRModal").on("hidden.bs.modal", function () {
        document.getElementById("errorMessage").style.display = "none";
    });

    // Quagga event listener for successful scan
    Quagga.onDetected(function (result) {
        if (result && result.codeResult && result.codeResult.code) {
            qrCodeData = result.codeResult.code;
            validateQrCode();
        }
    });
</script> --}}
{{-- <script>
    function completeQueue() {
    const queueId = document.getElementById("queueId").value;
    // Send the queue ID to the server to mark the queue as completed
    // Replace the 'csrf-token' value with the actual CSRF token value from Laravel
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch("{{ route('cs.complete-queue') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": csrfToken
      },
      body: JSON.stringify({ queue_id: queueId })
    })
    .then(response => response.json())
    .then(data => {
      // Hide the result container and success message
      document.getElementById("resultContainer").style.display = "none";
      document.getElementById("successMessage").style.display = "none";

      // If the completion is successful, refresh the page to update the queue list
      location.reload();
    })
    .catch(error => {
      console.error("Error completing the queue:", error);
      // Show an error message if there's an issue completing the queue
      alert("An error occurred while completing the queue.");
    });
  }

  // Event listener for the "Selesai" (Finish) button
  // Event listener for the "Selesai" (Finish) button
  document.getElementById("btnSelesai").addEventListener("click", function () {
        // Show the QR code scanning modal
        startQrCodeScanner();
        $("#scanQRModal").modal("show");
        // Hide the result container and messages on modal show
        document.getElementById("resultContainer").style.display = "none";
        document.getElementById("successMessage").style.display = "none";
        document.getElementById("errorMessage").style.display = "none";
    });

 // Event listener for the "Validate QR Code" button in the modal
 document.getElementById("validateQrCodeBtn").addEventListener("click", function () {
        validateQrCode();
        // Stop the QR code scanner
        stopQrCodeScanner();
    });

  // Event listener for the "Complete Queue" button in the modal
  document.getElementById("completeQueueBtn").addEventListener("click", function () {
    completeQueue();
    // Hide the modal
    $("#qrScanModal").modal("hide");
  });

  // Event listener to hide the error message on modal close
  $("#scanQRModal").on("hidden.bs.modal", function () {
        document.getElementById("errorMessage").style.display = "none";
    });
</script> --}}
</body>
</html>
