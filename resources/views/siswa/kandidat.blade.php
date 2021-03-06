@extends('siswa.layouts.header')
@section('content_siswa')
    <!-- {{-- sectionhero --}} -->
    <section id="" class="">
        <div class="container">
            <div class="mb-5 mt-5">
                <h3 class="text-center">Data Kandidat</h3>
                <p class="text-center">Periode : {{ $periode_aktif->nama ?? 'Belum Set Periode' }}</p>
            </div>
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert" id="pesan">
                <strong><i class="fa fa-check-circle"></i> {{ $message }}</strong>
            </div>
            @elseif($message = Session::get('error'))
            <div class="alert alert-danger" role="alert" id="pesan">
                <strong><i class="fa fa-exclamation-triangle"></i> {{ $message }}</strong>
            </div>
            @endif
            <div class="row">
                @foreach($kandidat as $key => $value)
                <div class="col-md-4 hide kandidat">
                    <div class="card mb-3 shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ Storage::url($value->foto) }}" width="150" alt="" class="img-fluid img-circle mb-3" style="border-radius: 50%;">
                                <h5 class="card-title">{{ $value->no_urut }} - {{ $value->nama_siswa }}</h5>
                                <p>{{ $value->nama_kelas }}</p>
                                <div class="btn-group">
                                <a href="#" data-visi="{{ $value->visi }}" data-misi="{{ $value->misi }}" data-foto="{{ Storage::url($value->foto) }}"
                                    data-nama="{{ $value->nama_siswa }}" data-kelas="{{ $value->nama_kelas }}"
                                    data-periode="{{ $value->nama_periode }}" data-keterangan="{{ $value->kategori == 'ketua' ? 'Kandidat Calon Ketua ROHIS' : 'Kandidat Calon Ketua Keputrian' }}"
                                    class="btn btn-primary bg-purple" data-toggle="modal" data-target="#modalDetailKandidat"
                                    data-urut="{{ $value->no_urut }}"
                                    ><i class="fa fa-eye"></i>
                                    Detail
                                </a>
                                    <a href="#" class="btn btn-warning pilih_kandidat" data-url="{{ route('simpan_suara', $value->id) }}"
                                    data-nama="{{ $value->nama_siswa }}" data-id="{{ $value->id }}"><i class="fa fa-check-circle"></i> Pilih</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-md-8 mx-auto text-center waktu_voting">
                    <div class="card mb-3 shadow">
                        <div class="card-header">
                            <h5 class="pt-1">Hitung Mundur Mulai E-Voting</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="voting_information"><span class="text-primary" id="hari"></span> &nbsp; <span class="text-primary" id="jam"></span> &nbsp; <span class="text-primary" id="menit"></span> &nbsp; <span class="text-primary" id="detik"></span></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- {{-- end --}} -->
@endsection
@push('scripts')
<script>

    function waktuVoting()
    {
        let countDownDate = "{{ strtotime($waktu_voting->tanggal_mulai.' '.$waktu_voting->jam_mulai) }}" * 1000
        let now = "{{ $timeNow ?? '' }}" * 1000
        // update tiap detik
        let x = setInterval(() => {
            now = now + 1000
            // cari perbedaan antara sekrang dan jam mundur
            let distance = countDownDate - now
            // Convert ke waktu dan lakukan pembulatan
            let days = Math.floor(distance / (1000 * 60 * 60 * 24))
            let hours = Math.floor((distance %  (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))
            let seconds = Math.floor((distance % (1000 * 60)) / 1000)
            // Output
            $('#hari').text(`${days} hari`)
            $('#jam').text(`${hours} jam`)
            $('#menit').text(`${minutes} menit`)
            $('#detik').text(`${seconds} detik`)

            // Kondisi jika countdown habis
            if (distance < 0) {
                clearInterval(x)
                let dateNow = "{{ date('Y-m-d') }}"
                let timeNow = "{{ date('H:i:s') }}"
                let dateEnd = "{{ $waktu_voting->tanggal_selesai }}"
                let timeEnd = "{{ $waktu_voting->jam_selesai }}"
                // console.log(dateNow +' - '+ dateEnd +' | '+ timeNow +' - '+timeEnd)
                if (dateNow >= dateEnd && timeNow >= timeEnd) {
                    // $(this).parent().parent().parent().remove()
                    // location.reload();
                    $('.waktu_voting').fadeIn().show()
                    $('.kandidat').addClass('hide');
                    $('.voting_information').html('<span class="text-danger">Waktu Voting Sudah Selesai! Silahkan logout kembali!</span>')
                } else {
                    $('.waktu_voting').fadeOut().remove()
                    $('.kandidat').removeClass('hide');
                }
            } else {
                $('.waktu_voting').fadeIn().show()
                $('.kandidat').addClass('hide');
            }

        }, 1000);
    }

    waktuVoting()

    $('#modalDetailKandidat').on('show.bs.modal', function (e) {
        let modal = $(this)
        let button = $(e.relatedTarget)
        let visi = button.data('visi')
        let misi = button.data('misi')
        let nama = button.data('nama')
        let kelas = button.data('kelas')
        let foto = button.data('foto')
        let periode = button.data('periode')
        let keterangan = button.data('keterangan')
        let noUrut = button.data('urut')

        modal.find('#detailKandidat').text(nama)
        modal.find('#namaKandidat').text(nama)
        modal.find('#kelasKandidat').text(kelas)
        modal.find('#noUrutKandidat').text(noUrut)
        modal.find('#visiKandidat').html(visi)
        modal.find('#misiKandidat').html(misi)
        modal.find('#periodeKandidat').text(periode)
        modal.find('#keteranganKandidat').text(' '+keterangan)
        modal.find('#fotoKandidat').attr('src', foto)
    })

    $(document).on('click', '.pilih_kandidat', function (e) {

        let nama = $(this).data('nama')
        let url = $(this).data('url')
        let id = $(this).data('id')
        let token = "{{ csrf_token() }}";

        Swal.fire({
            title: 'Anda yakin memilih kandidat '+nama+'?',
            icon: 'question',
            showDenyButton: true,
            confirmButtonText: `Yakin`,
            denyButtonText: `Batal`,
            }).then((result) => {
            if (result.isConfirmed) {
                // console.log(id)
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id: id,
                        _token: token
                    },
                    success:function(data) {
                        if (data.status == true) {
                            window.location.href = data.url
                        } else {
                            Swal.fire({
                                'icon': 'error',
                                'title': data.message,
                                'showConfirmButton': true,
                            }).then(function () {
                                window.location.href = data.url
                            })
                        }
                    }
                })
            }
        })
    })
</script>
@endpush