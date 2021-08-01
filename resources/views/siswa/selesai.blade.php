@extends('siswa.layouts.header')
@section('content_siswa')
    <!-- {{-- sectionhero --}} -->
    <section id="" class="">
        <div class="container">
            <div class="mb-5 mt-5">
                <h3 class="text-center">Terima Kasih Sudah Memberikan Hak Suara Anda!</h3>
                <p class="text-center">Periode : {{ $periode_aktif->nama ?? 'Belum Set Periode'}}</p>
            </div>
            <div class="text-center">
                <img src="{{ asset('assets/users/images/selesai.png') }}" class="img-fluid" alt="" width="500">
            </div>
            <div class="row">
                <div class="col-md-4 mx-auto">
                    <a href="{{ route('logout_siswa') }}" class="btn btn-md btn-get-started btn-block"><i class="fa fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </section>
    <!-- {{-- end --}} -->
@endsection