<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E - Voting | ROHIS SMK Negeri 1 Cianjur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/users/custom/css/style.css') }}">
    <style>
        .swal2-title{
            font-weight: 500 !important;
        }
        .hide {
            display: none;
        }
    </style>
</head>
<body>

    {{-- Menu --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><b>E-Voting ROHIS</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('siswa') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('siswa/voting') }}"><i class="fa fa-vote-yea"></i> Voting</a>
                    </li>
                    @if(!empty(Session::get('token')))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout_siswa') }}"><i class="fa fa-sign-out-alt"></i> Logout</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    {{-- End Menu --}}

    @yield('content_siswa')

    @include('siswa.layouts.footer')