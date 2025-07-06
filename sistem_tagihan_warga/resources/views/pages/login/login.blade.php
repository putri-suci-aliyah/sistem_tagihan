<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Tagihan Warga | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('templates/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="">UrPay</a>
    </div>
    @if (count($errors))
    <div class="pt.3">
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    </div>
    @endif
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Silahkan Anda Login</p>

        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="email" id="email"  name="email" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password"  name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Log In</button>
            </div>
          </div>

        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
<script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('templates/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
