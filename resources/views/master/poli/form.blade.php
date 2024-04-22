<div class="modal fade" id="addDataTipe">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info pl-3 pr-3 pt-2 pb-2">
                <h6 class="modal-title text-bold m-0">Form Tambah Data Tipe Poli</h6>
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
                            <label for="nama_tipe" class="col-sm-4 col-form-label form-control-sm">Tipe Lokasi Poli</label>
                            <div class="col-sm-8 form-input">
                                <input type="text" name="nama_tipe" id="nama_tipe" class="form-control @error('nama_tipe') is-invalid @enderror form-control-sm" placeholder="Tipe Lokasi Poli" required>
                                @error('nama_tipe')
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

<div class="modal fade" id="addDataPoli">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info pl-3 pr-3 pt-2 pb-2">
                <h6 class="modal-title text-bold m-0">Form Tambah Data Poli</h6>
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
                            <label for="nama_poli" class="col-sm-4 col-form-label form-control-sm">Nama Poli</label>
                            <div class="col-sm-8 form-input">
                                <input type="text" name="nama_poli" id="nama_poli" class="form-control @error('nama_poli') is-invalid @enderror form-control-sm" placeholder="Nama Poli" tabindex="0" required>
                                @error('nama_poli')
                                    <div class="error invalid-feedback text-xs">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-2">
                            <label for="deskripsi" class="col-sm-4 col-form-label form-control-sm">Keterangan</label>
                            <div class="col-sm-8 form-input">
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror form-control-sm" id="deskripsi" name="deskripsi" rows="5" placeholder="Keterangan" tabindex="1" required></textarea>
                                @error('deskripsi')
                                    <div class="error invalid-feedback text-xs">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group row mb-1">
                            <label for="id_tipe_lokasi_poli" class="col-sm-4 col-form-label text-sm pr-0">Tipe Lokasi Poli <span class="float-right">:</span></label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-sm select2 select2-hidden-accessible" style="width: 100%;" tabindex="1" aria-hidden="true" id="id_tipe_lokasi_poli" name="id_tipe_lokasi_poli">
                                {{-- @foreach ($tipelokasipoli as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer pl-3 pr-3 pt-2 pb-2">
                <button class="btn btn-default btn-md text-bold mr-1" type="reset"><i class="fas fa-retweet text-primary mr-2"></i>Reset</button>
                <button class="btn btn-default btn-md text-bold mr-1" type="submit" id="savePoli"><i class="fas fa-save text-success mr-2"></i>Simpan Data</button>
            </div>
            </form>
        </div>
    </div>
</div>