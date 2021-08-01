@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ !empty($waktu) ? 'Edit' : 'Tambah' }} Data Periode</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data Periode</li>
                <li class="breadcrumb-item active">{{ !empty($waktu) ? 'Edit' : 'Tambah' }} Data Periode</li>
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
                        <a href="{{ route('waktu-voting.index') }}" class="btn btn-primary bg-purple btn-md"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($waktu) ? route('waktu-voting.update', $waktu->id) : route('waktu-voting.store') }}" method="POST">
                    @csrf
                    @if(!empty($waktu))
                        @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="">Pilih Periode :</label>
                        <select name="periode_id" class="form-control" readonly>
                            <option value="{{ !empty($periode_aktif) ? $periode_aktif->id : 'Belum Set Periode' }}">
                            {{ !empty($periode_aktif) ? $periode_aktif->nama : 'Belum Set Periode' }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Mulai :</label>
                        <input type="date" required name="tanggal_mulai" required class="form-control" value="{{ !empty($waktu) ? $waktu->tanggal_mulai : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Mulai :</label>
                        <input type="time" required name="jam_mulai" required class="form-control" value="{{ !empty($waktu) ? $waktu->jam_mulai : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Selesai :</label>
                        <input type="date" required name="tanggal_selesai" required class="form-control" value="{{ !empty($waktu) ? $waktu->tanggal_selesai : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="">Jam Selesai :</label>
                        <input type="time" required name="jam_selesai" required class="form-control" value="{{ !empty($waktu) ? $waktu->jam_selesai : '' }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> {{ !empty($waktu) ? 'Update' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
