@extends('siswa.layouts.header')
@section('content_siswa')
    <!-- {{-- sectionhero --}} -->
    <section id="hero" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="card-title">Masukkan Token</h4>
                        </div>
                        <div class="card-body">
                            @if($message = Session::get('success'))
                            <div class="alert alert-success" role="alert" id="pesan">
                                <strong><i class="fa fa-check-circle"></i> {{ $message }}</strong>
                            </div>
                            @elseif($message = Session::get('error'))
                            <div class="alert alert-danger" role="alert" id="pesan">
                                <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
                            </div>
                            @endif
                            <form action="{{ route('cektoken') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Token :</label>
                                    <input type="text" name="token" class="form-control" placeholder="6 digit." autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-md btn-get-started">Masuk.</button>
                                    <a href="{{ url('siswa') }}" class="btn btn-md btn-warning btn-pengumuman ml-2">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- {{-- end --}} -->
@endsection