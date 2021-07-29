@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Periode</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item active">Data Periode</li>
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
                    <!-- <div class="btn-group">
                        <a href="{{ route('pemilih.create') }}" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                    </div> -->
                    <h3 class="card-title">Periode Aktif Saat Ini : <span class="badge badge-primary">
                        {{  !empty($periode_aktif) ? $periode_aktif->nama : 'Belum Set Periode' }}
                    </span></h3>
                </div>
            </div>
            <div class="card-body">
                @if($message = Session::get('success'))
                <div class="alert alert-success"><strong><i class="fa fa-check-circle"></i> {{ $message }}</strong></div>
                @elseif($message = Session::get('error'))
                <div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong></div>
                @endif
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Periode</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periode as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->nama }}</td>
                                <td>
                                    @if($value->status == 'inactive')
                                    <a href="{{ route('periode.apply', $value->id) }}" class="btn btn-success"><i class="fa fa-toggle-on"></i> Aktifkan</a>
                                    @else
                                    <a href="{{ route('periode.apply', $value->id) }}" class="btn btn-danger"><i class="fa fa-toggle-off"></i> Nonaktifkan</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
