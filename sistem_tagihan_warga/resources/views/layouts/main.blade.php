<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UrPay</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
    <!-- Link CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Modal -->
  <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="GET" action="{{ route('export_excel') }}">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="searchModalLabel">Unduh Ke Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <div class="modal-body">
          <div class="form-group row align-items-center">
            <label for="name" class="col-sm-3 col-form-label">Bulan</label>
            <div class="col-sm-9">
              <select id="periode_bulan" name="periode_bulan" class="form-control select2" style="width: 50%;">
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>
          </div>
          <div class="form-group row align-items-center">
            <label for="name" class="col-sm-3 col-form-label">Tahun</label>
            <div class="col-sm-9">
              <select id="periode_tahun" name="periode_tahun" class="form-control select2" style="width: 50%;">
                    <option value="2025">2025</option>
                </select>
            </div>
          </div>

          <div class="form-group row align-items-center">
            <label for="name" class="col-sm-3 col-form-label">Tahun</label>
            <div class="col-sm-9">
              <select id="status_pembayaran" name="status_pembayaran" class="form-control select2" style="width: 50%;">
                  <option value="Lunas">Lunas</option>
                  <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>
          </div>
        </div>
          <div class="modal-footer">

            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-info">Unduh</button>
          </div>
        </div>
      </form>
    </div>
  </div>
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.components.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    @yield('header')
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- /.content -->

            {{-- <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a> --}}
        </div>
        <!-- /.content-wrapper -->

        {{-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('templates/dist/js/demo.js') }}"></script>

    {{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        const qtyInputs = document.querySelectorAll(".qty");

        qtyInputs.forEach(input => {
            input.addEventListener("input", function () {
                const id = this.id.replace("qty", ""); // Ambil ID unik data_tagihan

                const hargaTagihan = parseFloat(document.getElementById(`harga_tagihan[${id}]`).value) || 0;
                const qty = parseFloat(this.value) || 0;

                const totalBayar = hargaTagihan * qty;

                document.getElementById(`total_bayar[${id}]`).value = totalBayar;

                hitungTotalPembayaran();
            });
        });

        function hitungTotalPembayaran() {
            let total = 0;
            const totalBayarInputs = document.querySelectorAll(".total_bayar");

            totalBayarInputs.forEach(input => {
                total += parseFloat(input.value) || 0;
            });

            document.getElementById("total_pembayaran").value = total;
        }
    });
</script> --}}

{{-- @yield('scripts') --}}

<script>
    document.addEventListener("DOMContentLoaded", function () {
        hitungTotalPembayaran(); // Jalankan pertama kali saat halaman dimuat

        // Kalau qty bisa diubah user, tambahkan event listener:
        document.querySelectorAll('.qty').forEach(function (inputQty) {
            inputQty.addEventListener('input', function () {
                const row = this.closest('tr');
                const harga = parseFloat(row.querySelector('.harga_tagihan').value) || 0;
                const qty = parseFloat(this.value) || 0;
                const subTotal = harga * qty;
                row.querySelector('.total_bayar').value = subTotal;
                hitungTotalPembayaran();
            });
        });

        function hitungTotalPembayaran() {
            let total = 0;
            document.querySelectorAll('.total_bayar').forEach(function (input) {
                if (input.id !== 'total_pembayaran') {
                    total += parseFloat(input.value) || 0;
                }
            });
            document.getElementById('total_pembayaran').value = total;
        }
    });
</script>
</body>

</html>
