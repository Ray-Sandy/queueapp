<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Queue | Form</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/dist/css/adminlte.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.css') }}">

</head>
{{-- <body>
    <h2>Form Antrian</h2>
    <form action="{{ route('queue.store') }}" method="POST">
        @csrf
        <label for="name">Nama:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        {{-- <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone_number">Nomor Telepon:</label><br>
        <input type="tel" id="phone_number" name="phone_number" required><br><br>

        <div class="form-group">
            <label for="counter">Loket Tujuan:</label>
            <select name="counter" id="counter" class="form-control">
                <option value="pembayaran">Loket Pembayaran</option>
                <option value="pemesanan">Loket Pemesanan</option>
                <option value="tukar-barang">Loket Tukar Barang</option>
            </select>
        </div>

        <input type="submit" value="Ambil Nomor Antrian">
    </form>

</body>
</html> --}}
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

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="container-fluid">
                <div class=" row-cols-sm-1">
                  {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">General Form</li>
                    </ol>
                  </div> --}}
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="card card-warning">
                          <div class="card-header">
                            <h3 class="card-title">Syarat dan Ketentuan</h3>
                          </div>
                          <div class="card-body">
                            <p class="card-text text-md">
                              Setelah mengisi formulir antrian di bawah lalu submit formulir akan mendapatkan nomor antrian
                              dan akan di arahkan ke halaman tunggu.<br>
                                <br>
                              Selama di halaman tunggu dimohon untuk selalu memperhatikan status antrian anda karena akan di panggil
                              secara otomatis, dan dimohon juga untuk selalu mengecek notification pada handphone anda.<br>
                                <br>
                              Selama melakukan antrian dimohon untuk tidak keluar dari halaman tunggu atau membuka aplikasi lain.<br>
                                <br>
                              Jika tidak sengaja keluar dari halaman tunggu, mohon segera mengubungi wa nomor tlp
                              yang tertera pada contact di menu pojok kiri atas halaman.
                            </p>

                            {{-- <a href="#" class="card-link">Card link</a> --}}
                          </div>
                          <div class="card-footer">
                            <a href="{{ route('queue.index') }}">Lihat daftar antrian saat ini.</a>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <!-- left column -->
                  <div class="col-lg-6 text-sm">
                    <!-- general form elements -->
                    <div class="card card-info">
                      <div class="card-header">
                        <h3 class="card-title">Form Antrian</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form action="{{ route('queue.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                              <label for="ename">Nama Pengunjung</label>
                              <input type="text" class="form-control text-sm" id="name" name="name"
                              placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                              <label for="tel">Nomor telephone</label>
                              <input type="tel" class="form-control text-sm" id="phone_number" name="phone_number"
                              placeholder="Phone Number" required>
                            </div>
                            <div class="form-group">
                              <label for="counter">Loket Tujuan:</label>
                              <select class="form-control text-sm select2bs4" name="counter" id="counter" style="width: 100%">
                                <option value="pembayaran">Loket Pembayaran</option>
                                <option value="pemesanan">Loket Pemesanan</option>
                                <option value="tukar-barang">Loket Tukar Barang</option>
                              </select>
                            </div>
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">
                                Saya sudah membaca <a href="">Syarat dan ketentuan Antrian.</a>
                              </label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      <form>
                        {{-- <a href="{{ route('queue.index') }}">Lihat Daftar Antrian</a> --}}
                    </div>
                    <!-- /.card -->
                  </div>
                </div>
              </div>
            </section>
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
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('AdminLTE/dist/js/adminlte.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <!-- date-range-picker -->
    <script src="{{ asset('AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- bootstrap color picker -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{ asset('AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <!-- BS-Stepper -->
    <script src="{{ asset('AdminLTE/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <!-- dropzonejs -->
    <script src="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
    {{-- <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script> --}}
    <!-- Page specific script -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })
      })
    </script>
    <!-- Page specific script -->
    <script>
        $(function () {
          bsCustomFileInput.init();
        });
    </script>

</body>
</html>
