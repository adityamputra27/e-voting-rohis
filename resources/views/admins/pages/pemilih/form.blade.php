@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ !empty($pemilih) ? 'Edit' : 'Tambah' }} Data Pemilih</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data Pemilih</li>
                <li class="breadcrumb-item active">{{ !empty($pemilih) ? 'Edit' : 'Tambah' }} Data Pemilih</li>
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
                        <a href="{{ route('pemilih.index') }}" class="btn btn-primary bg-purple btn-md"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($pemilih) ? route('pemilih.update', $pemilih->id) : route('pemilih.store') }}" method="POST">
                    @csrf
                    @if(!empty($pemilih))
                        @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="">Pilih Siswa :</label>
                        <select name="siswa_id" id="siswa" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($siswa as $key => $value)
                            <option value="{{ $value->id }}" {{ $value->id == @$pemilih->siswa_id ? 'selected' : '' }}>{{ $value->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Periode :</label>
                        <select name="periode_id" class="form-control" readonly>
                            <option value="{{ !empty($periode_aktif) ? $periode_aktif->id : 'Belum Set Periode' }}">
                            {{ !empty($periode_aktif) ? $periode_aktif->nama : 'Belum Set Periode' }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> 
                        {{ !empty($pemilih) ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
