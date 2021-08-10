<!-- Modal -->
<div class="modal fade" id="modalDetailKandidat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detail Kandidat : <span id="detailKandidat"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-5">
                <div class="text-center">
                    <img src="{{ Storage::url('admins/kandidat/default.png') }}" id="fotoKandidat" width="200" alt="">
                </div>
                <table class="mt-4 mb-4">
                    <tr>
                        <th>Nama :</th>
                        <td><span id="namaKandidat"></span></td>
                    </tr>
                    <tr>
                        <th>Kelas :</th>
                        <td><span id="kelasKandidat"></span></td>
                    </tr>
                    <tr>
                        <th>Periode :</th>
                        <td><span class="badge badge-primary"> <span id="periodeKandidat"></span></span></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-7">
                <table class="table table-bordered table-hovered">
                  <tr>
                    <th>No Urut :</th>
                    <td class="bg-success text-center text-white" style="font-weight: bold;"><span id="noUrutKandidat"></span></td>
                  </tr>
                  <tr>
                      <th>Visi : </th>
                      <td><span id="visiKandidat"></span></td>
                  </tr>
                  <tr>
                      <th>Misi :</th>
                      <td><span id="misiKandidat"></span></td>
                  </tr>
                  <tr>
                      <th>Keterangan :</th>
                      <td> <span id="keteranganKandidat"></span></td>
                  </tr>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> <i class="fa fa-times"></i> Tutup</button>
      </div>
    </div>
  </div>
</div>