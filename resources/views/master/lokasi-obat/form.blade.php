<div class="modal fade" id="addDataLokasi">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info pl-3 pr-3 pt-2 pb-2">
                <h6 class="modal-title text-bold m-0">Form Tambah Data Lokasi Obat</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group row mb-1">
                            <label for="nama" class="col-sm-4 col-form-label text-sm pr-0">Nama Lokasi Obat <span class="float-sm-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Lokasi Obat" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="status_aktif" class="col-sm-4 col-form-label text-sm pr-0">Status <span class="float-sm-right ml-sm-3">:</span></label>
                            <div class="col-sm-8">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success mt-1">
                                    <input type="checkbox" class="custom-control-input" id="cb_status" checked>
                                    <input type="hidden" id="status_aktif" name="status_aktif" value="0">
                                    <label class="custom-control-label" for="cb_status" id="statusLabel">NON AKTIF</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer pl-3 pr-3 pt-2 pb-2">
                <button class="btn btn-default btn-md text-bold mr-1" type="reset" id="resetLokasi"><i class="fas fa-retweet text-primary mr-2"></i>Reset</button>
                <button class="btn btn-default btn-md text-bold mr-1" type="submit" id="saveLokasi"><i class="fas fa-save text-success mr-2"></i>Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>