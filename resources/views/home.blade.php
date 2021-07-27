@extends('siswa.layouts.header')
@section('content_siswa')
    <!-- {{-- sectionhero --}} -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>E-Voting ROHIS</h1>
                    <h2>Sistem pemilihan ketua dan keputrian secara online untuk ekstrakulikuler ROHIS SMK Negeri 1 Cianjur.</h2>
                    <div class="d-flex">
                        <a href="{{ route('mulaivoting') }}" class="btn btn-lg btn-get-started">Mulai Voting!</a>
                        <a href="#" class="btn btn-lg btn-warning btn-pengumuman ml-3">Lihat Hasil (Quick Count).</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 pt-5">
                    <img src="https://bootstrapmade.com/demo/templates/eNno/assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- {{-- end --}} -->
@endsection