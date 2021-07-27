@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ !empty($kandidat) ? 'Edit' : 'Tambah' }} Data Kandidat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data Kandidat</li>
                <li class="breadcrumb-item active">{{ !empty($kandidat) ? 'Edit' : 'Tambah' }} Data Kandidat</li>
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
                        <a href="{{ route('kandidat.index') }}" class="btn btn-primary bg-purple btn-md"><i class="fa fa-chevron-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ !empty($kandidat) ? route('kandidat.update', @$kandidat->id) : route('kandidat.store') }}" method="POST">
                    @csrf
                    @if(!empty($kandidat))
                        @method('PATCH')
                    @endif
                    <div class="form-group">
                        <label for="">Pilih Siswa :</label>
                        <select name="siswa_id" id="siswa" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach($siswa as $key => $value)
                            <option value="{{ $value->id }}" {{ $value->id == @$pemilih->siswa_id ? 'selected' : '' }}>{{ $value->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Visi :</label>
                        <textarea type="text" id="visi" name="visi" class="form-control" value="{{ !empty($kandidat) ? $kandidat->nama : '' }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Misi :</label>
                        <textarea type="text" id="misi" name="misi" class="form-control" value="{{ !empty($kandidat) ? $kandidat->nama : '' }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Foto :</label>
                        <input type="file" name="foto" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Periode :</label>
                        <select name="periode_id" class="form-control" readonly>
                            <option value="{{ !empty(Session::get('periode')) ? Session::get('periode')->id : 'Belum Set Periode' }}">
                            {{ !empty(Session::get('periode')) ? Session::get('periode')->nama : 'Belum Set Periode' }}
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> {{ !empty($kandidat) ? 'Update' : 'Simpan' }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
