@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Edit Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        <div class="btn-group">
                            <a href="{{ url('/') }}" class="btn btn-primary bg-purple btn-md"><i class="fa fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($success = Session::get('success'))
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i> {{ $success }}
                    </div>
                    @endif
                    <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="">Username :</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email :</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Password Baru :</label>
                            <input type="text" name="password" class="form-control">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Konfirmasi Password Baru :</label>
                            <input type="text" name="password_confirmation" class="form-control">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
