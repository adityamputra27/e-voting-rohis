@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Quick Count</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item active">Quick Count</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <form action="#">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="">Pilih Periode : </label>
                        <select name="" id="" class="form-control">
                            <option value="">-- Pilih --</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <br>
                    <button class="btn btn-success btn-block mt-2"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">
                    <h5>Perolehan Suara - Kandidat Ketua</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="kandidatKetua1" width="200" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="kandidatKetua2" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">
                    <h5>Perolehan Suara - Kandidat Keputrian</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="kandidatKeputrian1" width="200" height="200"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="kandidatKeputrian2" width="200" height="200"></canvas>
                    </div>
                </div>   
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
