@extends('admins.layouts.header')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Data Pemilih</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item active">Data Pemilih</li>
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
                        <a href="{{ route('pemilih.create') }}" class="btn btn-primary btn-md"><i class="fa fa-plus-circle"></i> Tambah Data</a>
                    </div>
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
                                <th>Nama / Kelas / Jurusan</th>
                                <th>Token</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemilih as $key => $value)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $value->nama_siswa }} <br> {{ $value->kelas }}</td>
                                <td>
                                    <span class="badge badge-primary">{{ $value->token }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">{{ $value->periode }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $value->status == 'Belum Voting' ? 'danger' : 'success' }}">
                                    {{ $value->status }}
                                    </span>
                                </td>
                                <td>
                                    <div class="row">
                                        <a target="_blank"
                                        href="https://api.whatsapp.com/send?phone={{ $value->no_telp }}&text=Assalamualaikum%20Wr%20Wb.%0A%0A*Anda%20terdeteksi%20dan%20terdata%20sebagai%20anggota%20pemilih%20kandidat%20ketua%2Fkeputrian%20ROHIS%20SMK%20Negeri%201%20Cianjur%20periode%20aktif%20{{ Str::limit($value->periode, 4,'') }}%2F{{ substr($value->periode, 5, 4) }}.*%0A%0ABerikut%20detail%20data%20keanggotaan%20pemilihan%20anda%20%3A%0ANama%20%3A%20{{ $value->nama_siswa }}%0AKelas%20%3A%20{{ $value->kelas }}%0APeriode%20Aktif%20%3A%20{{ Str::limit($value->periode, 4,'') }}%2F{{ substr($value->periode, 5, 4) }}%0AAkses%20Token%20%3A%20*{{ Str::upper($value->token) }}*%0ALink%20E-Voting%20%3A%20{{ url('siswa') }}%0A%0AHasil%20voting%20ketua%2Fkeputrian%20ditayangkan%20secara%20realtime%2C%20masing%20-%20masing%20anggota%20hanya%20bisa%20menggunakan%201%20suara%20dan%20meminimalisir%20kecurangan%20jumlah%20suara%20pada%20masing%20-%20masing%20kandidat%20ketua%2Fkeputrian.%0A%0ASilahkan%20lakukan%20voting%20dengan%20benar%20-%20benar%20sesuai%20langkah%20yang%20ada%20pada%20link%20website%20tersebut.%20Kami%20ucapkan%20banyak%20terima%20kasih%20sudah%20berpartisipasi%20dan%20suara%20anda%20menentukan%20organisasi%20ROHIS%20untuk%20kedepannya%F0%9F%98%80.%0A%0A*Note%20%3A%20jangan%20beritahu%20akses%20token%20ini%20ke%20siapapun%2C%20sistem%20akan%20mendekteksi%20penggunaan%20token%20setiap%20keanggotaan%20E-Voting%20ROHIS*%0A%0A%40%20Copyright%20{{ date('Y') }}%20-%20Tim%20IT%20ROHIS%20SMK%20Negeri%201%20Cianjur"
                                         class="btn btn-success"><i class="fa fa-paper-plane"></i></a>
                                        <a href="{{ route('pemilih.edit', $value->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('pemilih.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
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
