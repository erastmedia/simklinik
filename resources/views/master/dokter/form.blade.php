<div class="modal fade" id="addDataSp">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info pl-3 pr-3 pt-2 pb-2">
                <h6 class="modal-title text-bold m-0">Form Tambah Data Spesialisasi Dokter</h6>
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
                        <div class="form-group row mb-2">
                            <label for="nama_spesialisasi" class="col-sm-4 col-form-label form-control-sm">Spesialisasi Dokter</label>
                            <div class="col-sm-8 form-input">
                                <input type="hidden" name="id_klinik" value="{{ auth()->user()->id_klinik }}">
                                <input type="text" name="nama_spesialisasi" id="nama_spesialisasi" class="form-control @error('nama_spesialisasi') is-invalid @enderror form-control-sm" placeholder="Spesialisasi Dokter" required>
                                @error('nama_spesialisasi')
                                    <div class="error invalid-feedback text-xs">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer pl-3 pr-3 pt-2 pb-2">
                <button class="btn btn-default btn-md text-bold mr-1" type="reset"><i class="fas fa-retweet text-primary mr-2"></i>Reset</button>
                <button class="btn btn-default btn-md text-bold mr-1" type="submit" id="saveBtn"><i class="fas fa-save text-success mr-2"></i>Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addDataDokter">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info pl-3 pr-3 pt-2 pb-2">
                <h6 class="modal-title text-bold m-0">Form Tambah Data Dokter</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5 ml-3 mr-3">
                        <div class="form-group row mb-1">
                            <label for="nik" class="col-sm-4 col-form-label text-sm pr-0">N I K <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nik" name="nik" placeholder="N I K" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="id_satu_sehat" class="col-sm-4 col-form-label text-sm pr-0">ID Satu Sehat <span class="float-right">:</span></label>
                            <div class="input-group mb-2 col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="id_satu_sehat" name="id_satu_sehat" placeholder="Belum Tersambung" tabindex="0">
                                <span class="input-group-append input-group-sm">
                                    <button type="button" class="btn btn-sm btn-danger" id="btn-get-loc">
                                        <i class="fas fa-compress text-xs text-center ml-1 mr-2"></i>Cek ID Satu Sehat &nbsp;
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="nama" class="col-sm-4 col-form-label text-sm pr-0">Nama Dokter <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nama" name="nama" placeholder="Nama Dokter" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="id_spesialis" class="col-sm-4 col-form-label text-sm pr-0" id="rl-label">Spesialis <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm select2 select2-hidden-accessible" style="width: 100%;" tabindex="1" aria-hidden="true" data-placeholder="Pilih Spesialisasi Dokter" id="id_spesialis" name="id_spesialis">
                                @foreach ($spesialisasidokter as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="alamat" class="col-sm-4 col-form-label text-sm pr-0">Alamat <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control form-control-sm" id="alamat" name="alamat" rows="3" placeholder="cth: Jl. Ketuhu No. 15, Kelurahan Wirasana, Kecamatan Purbalingga, Kabupaten Purbalingga" tabindex="8"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mt-2 mb-1">
                            <label for="kota" class="col-sm-4 col-form-label text-sm pr-0">Kota <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="kota" name="kota" placeholder="Kota" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="telepon" class="col-sm-4 col-form-label text-sm pr-0">No. Telepon <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="telepon" name="telepon" placeholder="Nomor Telepon / Handphone" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="no_str" class="col-sm-4 col-form-label text-sm pr-0">Nomor STRA <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="no_str" name="no_str" placeholder="Nomor STRA" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="username" class="col-sm-4 col-form-label text-sm pr-0">Username <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="username" name="username" placeholder="Username" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="email" class="col-sm-4 col-form-label text-sm pr-0">Email <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Email" tabindex="0">
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label for="tgl_masuk" class="col-sm-4 col-form-label text-sm pr-0">Tgl. Masuk <span class="float-right ml-3">:</span></label>
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm date" id="tgl_masuk" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" data-target="#tgl_masuk" name="tgl_masuk" tabindex="18">
                                    <div class="input-group-append" data-target="#tgl_masuk" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 mr-4">
                        <div class="form-group row mb-0">
                            <label class="col-sm-5 col-form-label form-control-sm">File Foto</label>
                            <div class="col-sm-7 form-input">
                                <input type="file" class="custom-file-input" id="path_foto" name="path_foto">
                                <input type="hidden" id="hidden_foto" name="hidden_foto">
                                <label class="form-control form-control-sm custom-file-label" for="path_foto">Choose file</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-input text-center foto">
                                <button id="btn_del_foto" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger hapus_gambar mt-1 mr-1" style="display:none;"><i class="fa fa-trash text-xs"></i></button>
                                <img id="preview_img_foto_add" name="preview_img_foto_add" src="{{ asset('img/no-photo.png') }}" style="max-height:160px">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-sm-5 col-form-label form-control-sm">Tanda Tangan</label>
                            <div class="col-sm-7 form-input">
                                <input type="file" class="custom-file-input" id="path_tdt" name="path_tdt">
                                <input type="hidden" id="hidden_tdt" name="hidden_tdt">
                                <label class="form-control form-control-sm custom-file-label" for="path_tdt">Choose file</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-input text-center foto">
                                <button id="btn_del_tdt" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger hapus_gambar mt-1 mr-1" style="display:none;"><i class="fa fa-trash text-xs"></i></button>
                                <img id="preview_img_tdt_add" name="preview_img_tdt_add" src="{{ asset('img/no-photo.png') }}" style="max-height:160px">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group row mb-0">
                            <label class="col-sm-5 col-form-label form-control-sm">File Stempel</label>
                            <div class="col-sm-7 form-input">
                                <input type="file" class="custom-file-input" id="path_stamp" name="path_stamp">
                                <input type="hidden" id="hidden_stamp" name="hidden_stamp">
                                <label class="form-control form-control-sm custom-file-label" for="path_stamp">Choose file</label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-12 form-input text-center foto">
                                <button id="btn_del_stamp" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger hapus_gambar mt-1 mr-1" style="display:none;"><i class="fa fa-trash text-xs"></i></button>
                                <img id="preview_img_stamp_add" name="preview_img_stamp_add" src="{{ asset('img/no-photo.png') }}" style="max-height:160px">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-sm-5 col-form-label form-control-sm">Status</label>
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" class="custom-control-input" id="cb_status" checked>
                                <input type="hidden" id="status_aktif" name="status_aktif" value="0">
                                <label class="custom-control-label" for="cb_status" id="statusLabel">NON AKTIF</label>
                            </div>
                        </div>
                    </div>
                                  
                </div>
            </div>
            <div class="modal-footer pl-3 pr-3 pt-2 pb-2">
                <button class="btn btn-default btn-md text-bold mr-1" type="reset" id="resetDokter"><i class="fas fa-retweet text-primary mr-2"></i>Reset</button>
                <button class="btn btn-default btn-md text-bold mr-1" type="submit" id="saveDokter"><i class="fas fa-save text-success mr-2"></i>Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>