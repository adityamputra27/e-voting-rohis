@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ !empty($siswa) ? 'Edit' : 'Tambah' }} Data Siswa</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data Siswa</li>
                <li class="breadcrumb-item active">{{ !empty($siswa) ? 'Edit' : 'Tambah' }} Data Siswa</li>
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
                        <a href="{{ route('siswa.index') }}" class="btn btn-primary bg-purple btn-md"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($siswa) ? route('siswa.update', $siswa->id) : route('siswa.store') }}" method="POST">
                    @csrf
                    @if(!empty($siswa))
                    @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="">Nama :</label>
                        <input type="text" required class="form-control" name="nama" value="{{ !empty($siswa) ? $siswa->nama : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin :</label>
                        <select name="jenis_kelamin" id="" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki - laki" {{ @$siswa->jenis_kelamin == 'Laki - laki' ? 'selected' : '' }}>Laki - laki</option>
                            <option value="Perempuan" {{ @$siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Kelas :</label>
                        <select name="kelas_id" id="kelas" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            @foreach($kelas as $key => $value)
                            <option value="{{ $value->id }}" {{ $value->id == @$siswa->kelas_id ? 'selected' : '' }}>{{ $value->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">No Whatsapp :</label>
                        <input type="number" name="no_telp" id="" required class="form-control" value="{{ !empty($siswa) ? $siswa->no_telp : '' }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
