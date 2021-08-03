
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-Voting ROHIS SMK Negeri 1 Cianjur</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('assets/admins/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admins/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admins/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="{{ url('admin/login') }}" class="h1"><b>E-Voting ROHIS - Admin</b></a>
    </div>
    <div class="card-body">
    @if(count($errors) > 0)
    <div class="alert alert-danger" role="alert" style="text-align: left !important;">
        <p><i class="fa fa-exclamation-triangle"></i> Terjadi Kesalahan!</p>
        @foreach ($errors->all() as $item)
        <li>{{ $item }}</li>
        @endforeach
    </div>
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert" style="text-align: left !important;">
        <i class="fa fa-exclamation-triangle"></i> {{ $message }}
    </div>
    @endif
      <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{ asset('assets/admins/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admins/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
