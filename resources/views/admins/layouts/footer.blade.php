<footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="#">Tim IT ROHIS</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Modal -->
@include('modal_kandidat_admin')

<!-- jQuery -->
<script src="{{ asset('assets/admins/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('assets/admins/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/admins/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('assets/admins/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('assets/admins/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('assets/admins/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('assets/admins/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('assets/admins/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('assets/admins/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('assets/admins/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/admins/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admins/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admins/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('assets/admins/dist/js/pages/dashboard.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/admins/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/admins/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
<script src="{{ asset('assets/all/sweetalert/js/sweetalert2.all.min.js') }}"></script>
<script>

  $(function () {
    $('#example1').DataTable()
    $('#siswa').select2()
    $('#periode').select2()
    $('#kelas').select2()
    ClassicEditor
      .create( document.querySelector( '#visi' ) )
      .catch( error => {
          console.error( error );
    });
    ClassicEditor
      .create( document.querySelector( '#misi' ) )
      .catch( error => {
          console.error( error );
    });
    setTimeout(function (){
        $('.alert-success').fadeTo(300, 0).slideUp(300, function(){
            $(this).remove();
        });
    }, 3000);

    function escapeHtml(str) {
        return str
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function loadKandidat() {
      let row = ''
      $.get("{{ route('getkandidat') }}", function (data) {
        console.log(data)
        if (data.status == true) {
          
          data.data.forEach((element, index) => {
            row += `
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ Storage::url('${element.foto}') }}" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center">${element.nama_siswa}</h3>
                        <p class="text-muted text-center">${element.nama_kelas}</p>
                        <div class="text-center">
                          <div class="btn-group">
                                <a href="{{ url('admin/kandidat/${element.id}/edit') }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a href="#" data-visi="${element.visi}" data-misi="${element.misi}" data-foto="{{ Storage::url('${element.foto}') }}"
                                data-suara="${element.jumlah_suara}" data-nama="${element.nama_siswa}" data-kelas="${element.nama_kelas}"
                                data-periode="${element.nama_periode}"
                                 class="btn btn-primary bg-purple" data-toggle="modal" data-target="#modalDetailKandidat"
                                 ><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-danger hapus_kandidat"
                                data-route="{{ url('admin/kandidat/${element.id}/') }}" data-id="${element.id}" data-nama="${element.nama_siswa}"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            ` 
          })

        } else {
          row += `
            <div class="col-md-12">
              <div class="alert alert-warning text-center">${data.message}</div>
            </div>
          `
        }
        $('#kandidat_data').append(row)
      })
    }

    loadKandidat()

    $(document).on('click', '.hapus_kandidat', function (e) {
      e.preventDefault()

      let id = $(this).attr('data-id')
      let nama_siswa = $(this).attr('data-nama')
      let token = "{{ csrf_token() }}";
      let $element = $(this).parent().parent().parent().parent().parent()

      Swal.fire({
        title: 'Yakin hapus kandidat? <br> '+nama_siswa+'?',
        showDenyButton: true,
        confirmButtonText: `Hapus`,
        denyButtonText: `Batal`,
      }).then((result) => {
        if (result.isConfirmed) {
          // console.log($(this).attr('data-id'))
          $.ajax({
            url: $(this).attr('data-route'),
            type: 'DELETE',
            data: {
              _token: token,
              id: id
            },
            success:function(data) {
              // console.log(data)
              if (data.status == true) {
                Swal.fire({
                  title: data.message,
                  confirmButtonText: `OK`,
                  icon: 'success',
                }).then(function () {
                  $element.fadeOut().remove()    
                  loadKandidat()            
                })
              }
            },
          })
        } else if (result.isDenied) {
          Swal.fire('Data kandidat '+nama_siswa+' batal dihapus!', '', 'info')
        }
      })
    })

    $('#modalDetailKandidat').on('show.bs.modal', function (e) {
      let modal = $(this)
      let button = $(e.relatedTarget)
      let visi = button.data('visi')
      let misi = button.data('misi')
      let nama = button.data('nama')
      let kelas = button.data('kelas')
      let foto = button.data('foto')
      let suara = button.data('suara')
      let periode = button.data('periode')

      modal.find('#detailKandidat').text(nama)
      modal.find('#namaKandidat').text(nama)
      modal.find('#kelasKandidat').text(kelas)
      modal.find('#visiKandidat').html(visi)
      modal.find('#misiKandidat').html(misi)
      modal.find('#periodeKandidat').text(periode)
      modal.find('#suaraKandidat').text(suara)
      modal.find('#fotoKandidat').attr('src', foto)
    })

  })

</script>
</body>
</html>