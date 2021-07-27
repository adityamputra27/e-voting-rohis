@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ !empty($kelas) ? 'Edit' : 'Tambah' }} Data Kelas</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data Kelas</li>
                <li class="breadcrumb-item active">{{ !empty($kelas) ? 'Edit' : 'Tambah' }} Data Kelas</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">
                    <div class="btn-group">
                        <a href="{{ route('kelas.index') }}" class="btn btn-primary bg-purple btn-md"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($kelas) ? route('kelas.update', $kelas->id) : route('kelas.store') }}" method="POST">
                    @csrf
                    @if(!empty($kelas))
                        @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="">Nama :</label>
                        <input type="text" name="nama" class="form-control" value="{{ !empty($kelas) ? $kelas->nama : '' }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> {{ !empty($kelas) ? 'Update' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
