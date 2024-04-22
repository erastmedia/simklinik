<div class="form-group row mb-1">
    <label for="foto" class="col-sm-12 col-form-label text-sm pr-0">Foto Dokter :</label>
    <div class="col-sm-12">
        <div id="drop-area-foto" class="drop-zone-foto needsclick dropzone">
            <input type="file" name="attachments_foto[]" id="attachments_foto" class="drop-zone-foto__input" multiple>
            <div id="file-list-foto" class="mb-0"></div>
        </div>
    </div>
</div>

@section('css')

<link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
    <style>
        .drop-zone-foto--over {
            background-color: #f0f0f0; 
        }

        .drop-zone-tdt--over {
            background-color: #f0f0f0; 
        }

        .drop-zone-stamp--over {
            background-color: #f0f0f0; 
        }

        .drop-zone-foto {
            position: relative;
            border: 2px dashed #ccc; 
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }

        .drop-zone-tdt {
            position: relative;
            border: 2px dashed #ccc; 
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }

        .drop-zone-stamp {
            position: relative;
            border: 2px dashed #ccc; 
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }

        .drop-zone-foto__input {
            display: none;
        }

        .drop-zone-tdt__input {
            display: none;
        }

        .drop-zone-stamp__input {
            display: none;
        }

        .drop-zone-foto__prompt {
            font-size: 16px;
        }

        .drop-zone-tdt__prompt {
            font-size: 16px;
        }

        .drop-zone-stamp__prompt {
            font-size: 16px;
        }

        #file-list-foto {
            display: flex;
            flex-wrap: wrap;
            padding: 5px; 
        }

        #file-list-tdt {
            display: flex;
            flex-wrap: wrap;
            padding: 5px; 
        }

        #file-list-stamp {
            display: flex;
            flex-wrap: wrap;
            padding: 5px; 
        }

        .file-preview {
            margin-right: 15px;
            margin-bottom: 15px;
            position: relative; /* membuat posisi relatif untuk thumbnail agar bisa diatur ulang */
        }

        .thumbnail-container {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .thumbnail {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }

        .delete-button {
            position: absolute;
            top: 80%;
            left: 80%;
            transform: translate(-50%, -50%);
        }

        .file-size {
            position: absolute;
            top: 5px;
            left: 5px;
            background-color: rgba(20, 150, 0, 0.6);
            color: #fff;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .centered-image {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .modal-body .img-preview {
            text-align: center; 
        }

        /* .modal-body img {
            max-width: 100%; 
            max-height: 100%; 
            margin: auto; 
        } */
    </style>

    @stop

@section('js')
<script type='text/javascript' src="{{ asset('js/dropzone.min.js') }}"></script>
<script>

var idDokter = "";
    var uploadedFotoMap = {};
var minFilesFoto = 0;
var maxFilesFoto = 1;

var myDZFoto = Dropzone.options.dropAreaFoto = {
    url: "{{ route('upload-foto') }}",
    minFiles: minFilesFoto,
    maxFiles: maxFilesFoto,
    autoProcessQueue: true,
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    acceptedFiles: ".jpeg,.jpg,.png",
    timeout: 5000,
    createImageThumbnails: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time + file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_foto[]" value="' + response.name + '">');
        uploadedFotoMap[file.name] = response.name;
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = '';
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        } else {
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-foto') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,
            },
            success: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedFotoMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_foto[]"][value="' + filename + '"]').remove();
    },
    maxfilesexceeded: function(file) {},
    init: function() {
        myDZFoto = this;
        $.ajax({
            url: "{{ url('readFotoFiles') }}/" + idDokter,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $.each(response, function(key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZFoto.emit("addedfile", mockFile);
                    myDZFoto.files.push(mockFile);
                    myDZFoto.emit("thumbnail", mockFile, value.path);
                    myDZFoto.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_foto[]" value="' + value.name + '">');
                    uploadedFotoMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                });
            }
        });

        this.on("maxfilesexceeded", function(file) {
            toastr["error"]("Maximum " + maxFilesFoto + " files are allowed to upload...!", "Max Files Exceeded");
            return false;
        });

        var submitButton = document.querySelector("#saveBtn");
        myDZFoto = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedFotoMap).length;
            if (imagelength < minFilesFoto) {
                toastr["error"]("Minimum " + minFilesFoto + " file needs to upload...!");
                return false;
            } else {
                $('#form-create').submit();
            }
        });
    },
    error: function(file, response) {
        if (file.size > this.options.maxFilesize * 1024 * 1024) {
            toastr["error"]("Ukuran file " + file.name + " terlalu besar (" + file.size + "MiB). Ukuran maksimum yang diperbolehkan: 5 MiB", "Max File Size Exceeded");
        } else {
            toastr["error"](response, "Terjadi Kesalahan");
        }
        $(file.previewElement).remove(); // removed files if validation fails
        return false;
    }
};
</script>
@stop