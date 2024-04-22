<div class="modal fade" id="addDataGudang">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info pl-3 pr-3 pt-2 pb-2">
                <h6 class="modal-title text-bold m-0">Form Tambah Data Gudang</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row mb-1">
                            <label for="kode" class="col-sm-4 col-form-label text-sm pr-0">Kode Gudang <span class="float-sm-right">:</span></label>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-5">
                                <input type="text" class="form-control form-control-sm" id="kode" name="kode" placeholder="Auto" tabindex="0" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="nama" class="col-sm-4 col-form-label text-sm pr-0">Nama Gudang <span class="float-sm-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Gudang" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="telepon" class="col-sm-4 col-form-label text-sm pr-0">No. Telepon <span class="float-sm-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="No. Telepon" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="no_hp" class="col-sm-4 col-form-label text-sm pr-0">No. Handphone <span class="float-sm-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="no_hp" name="no_hp" placeholder="No. Handphone" tabindex="0">
                            </div>
                        </div>
                        {{-- <div class="form-group row mb-1">
                            <label for="as_default" class="col-sm-4 col-form-label text-sm pr-0">Jadikan Gudang Default <span class="float-sm-right ml-sm-3">:</span></label>
                            <div class="col-sm-8">
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success mt-1">
                                    <input type="checkbox" class="custom-control-input" id="cb_default" checked>
                                    <input type="hidden" id="as_default" name="as_default" value="0">
                                    <label class="custom-control-label" for="cb_default" id="defaultLabel">NOT DEFAULT</label>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group row mb-1">
                            <label for="alamat" class="col-sm-4 col-form-label text-sm-right text-left pr-0">Alamat <span class="float-sm-right ml-sm-3">:</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control form-control-sm" id="alamat" name="alamat" rows="3" placeholder="cth: Jl. Ketuhu No. 15, Kelurahan Wirasana, Kecamatan Purbalingga, Kabupaten Purbalingga" tabindex="8"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="kota" class="col-sm-4 col-form-label text-sm-right text-left pr-0">Kota <span class="float-sm-right ml-sm-3">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="kota" name="kota" placeholder="Kota" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="email" class="col-sm-4 col-form-label text-sm-right text-left pr-0">Email <span class="float-sm-right ml-sm-3">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="email" name="email" placeholder="Email" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="status_aktif" class="col-sm-4 col-form-label text-sm-right text-left pr-0">Status <span class="float-sm-right ml-sm-3">:</span></label>
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
                <button class="btn btn-default btn-md text-bold mr-1" type="reset" id="resetGudang"><i class="fas fa-retweet text-primary mr-2"></i>Reset</button>
                <button class="btn btn-default btn-md text-bold mr-1" type="submit" id="saveGudang"><i class="fas fa-save text-success mr-2"></i>Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>