@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Kandidat</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item active">Data Kandidat</li>
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
                        <a href="{{ route('kandidat.create') }}" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($message = Session::get('success'))
                    <div class="alert alert-success"><strong><i class="fa fa-check-circle"></i> {{ $message }}</strong></div>
                @elseif($message = Session::get('error'))
                    <div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong></div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Periode :</label>
                            <select name="" id="periode" class="form-control">
                                <option value="">-- PIlih --</option>
                                @foreach($periode as $key => $value)
                                <option value="{{ $value->id }}"
                                    {{ $value->id == ($periode_aktif->id ?? []) ? 'selected' : '' }}>
                                    {{ $value->nama }} {{ $value->id == ($periode_aktif->id ?? []) ? ' - Sedang Aktif' : '' }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <br>
                            <button class="btn btn-success btn-block mt-2" id="filterByPeriode"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Cari Nama :</label>
                            <input type="text" id="namaKandidat" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <br>
                            <button class="btn btn-success btn-block mt-2" id="filterByNama"><i class="fa fa-search"></i> Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="kandidat_data"></div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
