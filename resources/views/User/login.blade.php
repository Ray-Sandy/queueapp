
<!DOCTYPE html>
<html lang="en">
<head>

  @include ('User.template.header')

</head>
<body class="hold-transition login-page">
<div class="login-box">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        {{ session('success')}}
    </div>
    @endif

    @if(session()->has('failed'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        {{ session('failed')}}
    </div>
    @endif
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ Route('queue.create') }}" class="h1"><b>Sun</b>pride</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{ Route('postlogin') }}" method="post">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="input-group mb-3">
          <input type="name" name="name" class="form-control" placeholder="name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="/Ask To Your Supervisor">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{Route('register')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
  @include ('User.template.jquery')
</body>
</body>
