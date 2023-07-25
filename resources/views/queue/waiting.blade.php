<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Queue | Waiting</title>

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
  <!-- JQVMap -->
  {{-- <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/jqvmap/jqvmap.min.css') }}"> --}}
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
            <div class="content-header-center">
            <div class="container-fluid-center">
                <div class="row-center">
                    <p><span id="current-time"></span></p>
                </div>
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row text-md ">
                <div class="col-sm-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalQueues }}</h3>

                            <p>Total Antrian</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @if ($currentQueue)
                                <h3>{{ $currentQueue->queue_number }}</h3>
                            @else
                                <h3>-</h3>
                            @endif

                            <p>Antrian Saat Ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $nextQueue->queue_number ?? '-' }}</h3>

                            <p>Antrian Berikutnya</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-sm-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $remainingQueues }}</h3>

                            <p>Sisa Antrian</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                    {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                        {{-- <i class="fas fa-chart-pie mr-1"></i> --}}
                        loket   {{ $data['counter'] }}
                        </h3>
                        <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">List</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Detail</a>
                            </li>
                        </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                        <!-- Morris chart - Sales -->
                        <div class="chart tab-pane active container-fluid" id="revenue-chart"
                            style="position: relative; height: auto;">
                            {{-- <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas> --}}
                            <table id="example1" id="revenue-chart-canvas" class="table table-bordered table-striped text-md">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($queues as $queue)
                                        <tr data-queue-id="{{ $queue->id }}">
                                            <td>{{ $queue->queue_number }}</td>
                                            <td>{{ $queue->name }}</td>
                                            <td class="status">{{ $queue->status }}</td>
                                            <td>{{date('Y-m-d H:i', strtotime($queue->created_at))}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="chart tab-pane container-fluid" id="sales-chart" style="position: relative; height: auto;">
                            {{-- <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas> --}}
                            <div id="sales-chart-canvas" class="" style="height: auto;">
                                <div class="row row-cols-md-auto text-md">
                                <div class="col col-md-6 col-6 ">Atas Nama       </div>:<div class="col col-md-auto col-auto">{{  $data['name'] }}</div>
                                </div>
                                <div class="row text-md">
                                <div class="col col-md-6 col-6 ">Nomor telephone </div>:<div class="col col-md-auto col-auto">{{ $data['phone'] }}</div>
                                </div>
                                <hr>
                                <div class="row text-md">
                                <div class="col col-md-6 col-6 ">ID Antrian      </div>:<div class="col col-md-auto col-auto">{{ $id }}</div>
                                </div>
                                <div class="row text-md">
                                <div class="col col-md-6 col-6 ">Nomor Antrian   </div>:<div class="col col-md-auto col-auto">{{ $data['number'] }}</div>
                                </div>
                                <div class="row text-md">
                                <div class="col col-md-6 col-6 ">Status Antrian  </div>:<div class="col col-md-auto col-auto"><span id="current-status">{{ $data['status'] }}</span></div>
                                </div>
                                <div class="row text-md">
                                <div class="col col-md-6 col-6 ">Loket Tujuan    </div>:<div class="col col-md-auto col-auto">{{ $data['counter'] }}</div>
                                </div>
                                <div class="row text-md">
                                <div class="col col-md-6 col-6 ">Tanggal datang  </div>:<div class="col col-md-auto col-auto">{{ $data['start'] }}</div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-info float-right">Edit</button>
                            </div>
                        </div>
                        </div>
                    </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>

                <section class="col-lg-6 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">
                        {{-- <i class="fas fa-chart-pie mr-1"></i> --}}
                        Qr Code
                        </h3>
                      </div><!-- /.card-header -->
                    <div class="card-body" >
                        <div id="qr-code-container" class="tab-content">
                        <!-- Morris chart - Sales -->
                        @if ($data['status'] === 'processing' || $data['status'] === 'complated')
                            <!-- QR Code Section -->
                            <div id="qrcode">{!! $qrCode !!}</div>
                        @endif
                        </div>
                    </div><!-- /.card-body -->
                    <div class="card-footer">
                        <p>Qr code akan muncul hanya ketika status menjadi Complated atau keetika antrian sudah selesai.<br>
                            silahkan screenshot qr code tersebut dan serahkan ke pada customer service loket sebagai bukti
                            antrian sudah selesai.
                        </p>
                    </div>
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
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
    {{-- <script src="{{ asset('AdminLTE/plugins/chart.js/Ch art.min.js') }}"></script> --}}
    <!-- Sparkline -->
    <script src="{{ asset('AdminLTE/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    {{-- <script src="{{ asset('AdminLTE/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
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
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('AdminLTE/dist/js/pages/dashboard.js') }}"></script> --}}

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
        //update seluruh status pada tablex
        $(document).ready(function() {

            function updateStatus() {
                $.ajax({
                    url: '{{ route('queue.getStatus') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $.each(response, function(queueId, queueData) {
                            var statusCell = $('[data-queue-id="' + queueId + '"] .status');
                            statusCell.text(queueData.status);
                            if (queueData.status === "Processing" || queueData.status === "Skipped" || queueData/status === "Completed") {
                            showNotification("Status Antrian " + queueData.queue_number + ": " + queueData.status + ". Silahkan datang ke loket" + queueData.counter);
                            playNotificationSound();
                            }

                        });
                    }
                });
            }
            setInterval(updateStatus, 15000);

            // Update status berdasarkan id
            function updateStatusByIdTable() { //status pada table
                // Lakukan permintaan AJAX ke server
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route('queue.getStatusid', ['id' => $id ]) }}', true); // Ganti dengan URL endpoint yang sesuai
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Tangkap response dari server
                        var response = JSON.parse(xhr.responseText);
                        // Perbarui status pada halaman
                        var currentStatusElement = document.getElementById('current-status');
                        currentStatusElement.textContent = response.status;
                        // Periksa apakah status berubah
                        if (response.status !== previousStatus) {
                            // Status berubah, tampilkan notifikasi dan mainkan audio
                            if (response.status === 'processing') {
                                // Mengambil QR code dari server setelah status completed
                                getQRCode();
                                // Tambahkan tindakan lain yang ingin dilakukan ketika status menjadi completed
                            }
                            // Simpan status baru sebagai status sebelumnya
                            previousStatus = response.status;
                        }
                    }
                };
                xhr.send();
            }
            // Fungsi untuk mengambil QR code dari server berdasarkan ID dan counter
            function getQRCode() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route('queue.getQueueData', ['id' => $id, 'counter' => $data['counter']]) }}', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        // Tampilkan QR code di halaman
                        if (response.qrCode) {
                            var qrCodeContainer = document.getElementById('qr-code-container');
                            qrCodeContainer.innerHTML = response.qrCode;
                        }
                    }
                };
                xhr.send();
            }
        });
    </script>
    <script>
        // Move the function outside the document.ready to make it accessible in the global scope
        function updateQRCode() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '{{ route('queue.getQueueData', ['id' => $id, 'counter' => $data['counter']]) }}', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    // Tampilkan QR code di halaman
                    var qrCodeContainer = document.getElementById('qr-code-container');
                    qrCodeContainer.innerHTML = response.qrCode;
                }
            };
            xhr.send();
        }


        //notifikasi
        // var previousStatus = '{{ $queue["status"] }}'; // Status awal


        function showNotification(title, body) {
                // Periksa apakah notifikasi didukung oleh browser
                if (!("Notification" in window)) {
                    console.log("Browser tidak mendukung Web Notification");
                    return;
                }
                // Periksa apakah pengguna telah memberikan izin untuk menampilkan notifikasi
                if (Notification.permission === "granted") {
                    // Tampilkan notifikasi
                    var notification = new Notification(title, { body });
                } else if (Notification.permission !== "denied") {
                    // Jika belum ada izin, minta izin kepada pengguna
                    Notification.requestPermission().then(function (permission) {
                        if (permission === "granted") {
                            // Jika izin diberikan, tampilkan notifikasi
                            var notification = new Notification(title, { body });
                        }
                    });
                }
            }
            function playAudio(src) {
                var audio = new Audio(src);
                audio.play();
            }
            var previousStatus = '{{ $queue["id"] }}'; // Status awal
            // Update status berdasarkan id
            function updateStatusById() {
                // Lakukan permintaan AJAX ke server
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '{{ route('queue.getStatusid', ['id' => $id ]) }}', true); // Ganti dengan URL endpoint yang sesuai
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        // Tangkap response dari server
                        var response = JSON.parse(xhr.responseText);
                        // Perbarui status pada halaman
                        var currentStatusElement = document.getElementById('current-status');
                        currentStatusElement.textContent = response.status;
                        // Periksa apakah status berubah
                        if (response.status !== previousStatus) {
                            // Status berubah, tampilkan notifikasi dan mainkan audio
                            if (response.status === 'processing') {
                                $("#qrcode").load(" #qrcode");
                                //update the notification massage to include the couter value
                                if (response.counter === 'pembayaran'){
                                    showNotification('Antrian Diproses', 'Silahkan datang pada Loket '+response.counter+' Loket 1');
                                }else if (response.counter ==='pemesanan'){
                                    showNotification('Antrian Diproses', 'Silahkan datang pada Loket '+response.counter+' Loket 2');
                                }else if (response.counter ==='tukar-barang'){
                                    showNotification('Antrian Diproses', 'Silahkan datang pada Loket '+response.counter+' Loket 3');
                                }
                                //ganti jadi bisa tau loket mana dari counternya
                                // playAudio('path/to/audio/file.mp3');
                            } else if (response.status === 'skipped') {
                                showNotification('Antrian Dilewati', 'Silahkan tunggu giliran berikutnya, dan pastikan untuk melihat status antriann anda.');
                                // playAudio('path/to/audio/file.mp3');
                            } else if (response.status === 'completed') {
                                showNotification('Antrian Selesai', 'Antrian anda sudah selesai. Terimakasih sudah mengantri, di tinggu kedatangannya kembali ya. ');
                            }
                            // Simpan status baru sebagai status sebelumnya
                            previousStatus = response.status;
                        }
                    }
                };
                xhr.send();
            }
            setInterval(updateStatusById, 15000);
    </script>
    <script>
        //jam secara live
        function updateTime() {
            var date = new Date();
            var options = {
                timeZone: 'Asia/Jakarta',
                hour12: false,
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
            };
            var timeString = date.toLocaleString('id-ID', options);
            document.getElementById('current-time').textContent = timeString;
        }
        setInterval(updateTime, 1000); // Perbarui waktu setiap detik
    </script>
    <script>
        //settingan pada interactive table
        $(function () {
            $('#example1').DataTable({
                "aLengthMenu": [[5, 10], [5, 10]],
                "iDisplayLength": 5,
                "responsive": true,
                "lengthChange": false,
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
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');    });
    </script>
</body>
</html>



{{--
// // update status berdasarkan id
// function updateStatusid() {
//     // Lakukan permintaan AJAX ke server
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '{{ route('queue.getStatusid', ['id' => $queue->id]) }}', true); // Ganti dengan URL endpoint yang sesuai
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
//             // Tangkap response dari server
//             var response = JSON.parse(xhr.responseText);

//             // Perbarui status pada halaman
//             document.getElementById('current-status').textContent = response.status;
//         }
//     };
//     xhr.send();
// }
// setInterval(updateStatusid, 15000); --}}
