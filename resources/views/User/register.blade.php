
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sunpride | Registration Page</title>

    @include('User.template.header')
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="https://www.sunpride.co.id/" class="h1"><b>Sun</b>pride</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new member</p>

      <form action="{{Route('saveregister')}}" method="post">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group mb-3">
          <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="username"
          required value="{{ old ('name')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
              <div class="invalid-feedback">
                {{ $message}}
              </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email"
          required value="{{ old ('email')}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
              <div class="invalid-feedback">
                {{ $message}}
              </div>
          @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
              <div class="invalid-feedback">
                {{$message}}
              </div>
          @enderror
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
        </div>
      </form>
      <div class="mb-0">
        <a href="{{Route('login')}}" class="text-center">I already have a membership</a>
      </div>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

    @include('User.template.jquery')

</body>
</html>
