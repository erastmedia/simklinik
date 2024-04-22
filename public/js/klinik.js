(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "AIzaSyDyXWQY6i-BIPSKo5WcL3I5ZQqZEQV0I1c", v: "weekly"});

let map;


// Dropzone.autoDiscover = false
$(document).ready(function() {
    bsCustomFileInput.init();
    
    $("#prov_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Provinsi",
        allowClear: true
    })

    $("#city_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kota",
        allowClear: true
    })

    $("#dis_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kecamatan",
        allowClear: true
    })
    
    $("#subdis_id").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kelurahan/Desa",
        allowClear: true
    })

    $("#id_tipe").select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Tipe Klinik",
        allowClear: false
    })

    var default_id_tipe = '{{ $klinik->id_tipe ?? '' }}';
    if (default_id_tipe) {
        $("#id_tipe").val(default_id_tipe).trigger('change');
    }

    $("#prov_id").val('{{ $klinik->prov_id ?? '' }}').trigger('change');
    $("#city_id").val('').trigger('change');
    $("#dis_id").val('').trigger('change');
    $("#subdis_id").val('').trigger('change');

    $('#tgl_berlaku_register').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#tgl_berlaku_stra').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#tgl_berlaku_sipa').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    async function initMap() {
        const { Map } = await google.maps.importLibrary("maps");
        const { Place } = await google.maps.importLibrary("places");
        const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

        const map = new Map(document.getElementById("map"), {
            mapTypeControl: false,
            streetViewControl: false,
            center: { lat: {{ $klinik->latitude }}, lng: {{ $klinik->longitude }} },
            zoom: 18,
            mapId: "4db8f1c7a10e025c",
        });

        const draggableMarker = new AdvancedMarkerElement({
            map,
            position: { lat: {{ $klinik->latitude }}, lng: {{ $klinik->longitude }} },
            gmpDraggable: true,
            title: "This marker is draggable.",
        });

        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        map.addListener("click", (mapsMouseEvent) => {
            draggableMarker.position = mapsMouseEvent.latLng;
            geocode({ location: mapsMouseEvent.latLng });
        });

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            const bounds = new google.maps.LatLngBounds();
            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                draggableMarker.position = place.geometry.location;
                geocode({ location: place.geometry.location });
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        var geocoder = new google.maps.Geocoder();
        if(draggableMarker.position.lat===0 && draggableMarker.position.lng===0 && draggableMarker.position.altitude===0) {
            geocode({ location: { lat: -7.389474, lng: 109.363278 } });
            draggableMarker.position = { lat: -7.389474, lng: 109.363278 };
        } else {
            geocode({ location: draggableMarker.position });
        }

        draggableMarker.addListener("dragend", (event) => {
            const position = draggableMarker.position;
            console.log( 'i am dragged' );
            if(position.lat===0 && position.lng===0){
                lat = -7.389474;
                long = 109.363278;
            } else {
                lat = position.lat;
                long = position.lng;
            }
            console.log( 'lat: ' + lat );
            console.log( 'long: ' + long );
            $('#latitude').val(lat);
            $('#longitude').val(long);
            
            geocode({ location: position });
        });

        function geocode(request) {
        geocoder
            .geocode(request)
            .then((result) => {
            const { results } = result;
            address = results[0].formatted_address;
            map.setCenter(results[0].geometry.location);
            $('#alamat').text(address);
            return results;
            })
            .catch((e) => {
            // alert("Geocode was not successful for the following reason: " + e);
            toastr["error"]("Geocode was not successful for the following reason: " + e, "Terjadi Kesalahan");
            });
        }
    }

    initMap();

});

$(document).on('select2:open', () => {
    document.querySelector('.select2-search__field').focus();
});

$('#prov_id').change(function () {
    var id = $(this).val();
    // console.log(id);
    

    if(!id) {
        id = 0;
        $("#prov_id").val('');
        $("#city_id").val('').trigger('change');
        $("#dis_id").val('').trigger('change');
        $("#subdis_id").val('').trigger('change');
        // $("#city_id").empty();
        // $("#dis_id").empty();
        // $("#subdis_id").empty();
    }

    $.get('/kota/' + id, function (data) {
        $("#city_id").empty();
        $.each(data, function (index, kota) {
            $('#city_id').append('<option value="' + kota.city_id + '">' + kota.city_name + '</option>');
        });
        if (id) {
            var default_city_id = '{{ $klinik->city_id ?? '' }}';
            if (default_city_id) {
                $("#city_id").val(default_city_id).trigger('change');
            }
        }
    });
    
});

$('#city_id').change(function () {
    var id = $(this).val();
    // console.log(id);
    

    if(!id) {
        id = 0;
    }

    // $("#dis_id").val('').trigger('change')

    $.get('/kecamatan/' + id, function (data) {
        $("#dis_id").empty();
        $.each(data, function (index, kecamatan) {
            $('#dis_id').append('<option value="' + kecamatan.dis_id + '">' + kecamatan.dis_name + '</option>');
        });
        if (id) {
            var default_dis_id = '{{ $klinik->dis_id ?? '' }}';
            if (default_dis_id) {
                $("#dis_id").val(default_dis_id).trigger('change');
            }
        }
    });
    
});

$('#dis_id').change(function () {
    var id = $(this).val();
    // console.log(id);
    

    if(!id) {
        id = 0;
    }

    // $("#subdis_id").val('').trigger('change')

    $.get('/kelurahan/' + id, function (data) {
        $("#subdis_id").empty();
        $.each(data, function (index, kelurahan) {
            $('#subdis_id').append('<option value="' + kelurahan.subdis_id + '">' + kelurahan.subdis_name + '</option>');
        });
        if (id) {
            var default_subdis_id = '{{ $klinik->subdis_id ?? '' }}';
            if (default_subdis_id) {
                $("#subdis_id").val(default_subdis_id).trigger('change');
            }
        }
    });

});

$('#saveBtn').click(function (e) {
    e.preventDefault();
    $(this).prop('disabled', true).html('<span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></span>Sending...');

    var formData = new FormData($('#klinikForm')[0]);

    $.ajax({
        data: formData,
        url: "{{ route('klinik.update') }}",
        type: "POST",
        processData: false, 
        contentType: false, 
        success: function (data) {
            if($.isEmptyObject(data.error)){
                $('#saveBtn').prop('disabled', false).html('Simpan Data');
                toastr["success"]("Data Klinik berhasil diperbaharui.", "Updated!");
            }else{
                // printErrorMsg(data.error);
                toastr["error"](data.error, "Terjadi Kesalahan");
            }
        },
        error: function (data) {
            $('#saveBtn').prop('disabled', false).html('Simpan Data');
            toastr["error"](data.error, "Terjadi Kesalahan");
        }
    });
});

// DROPZONE'S CODES ===================================================================================================

var uploadedRegisterMap = {};
var minFilesReg = 0;
var maxFilesReg = 10;

var uploadedSTRAMap = {};
var minFilesSTRA = 0;
var maxFilesSTRA = 10;

var uploadedSIPAMap = {};
var minFilesSIPA = 0;
var maxFilesSIPA = 10;

var myDZRegister = Dropzone.options.dropAreaRegister = {
    url: "{{ route('upload-reg') }}",
    minFiles: minFilesReg,
    maxFiles: maxFilesReg,
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
        return time+file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_register[]" value="' + response.name + '">')
        uploadedRegisterMap[file.name] = response.name
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = ''
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        }else{
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-reg') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,                        
            },
            sucess: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedRegisterMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_register[]"][value="' + filename + '"]').remove()
    },
    maxfilesexceeded: function(file) {
    },
    init: function() {
        myDZRegister = this;
        $.ajax({
            url: "{{ url('readRegFiles') }}/{{ $klinik->id }}",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZRegister.emit("addedfile", mockFile);
                    myDZRegister.files.push(mockFile);
                    myDZRegister.emit("thumbnail", mockFile, value.path);
                    myDZRegister.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_register[]" value="' + value.name + '">');
                    uploadedRegisterMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                })
            }
        })

        this.on("maxfilesexceeded", function(file) { 
            toastr["error"]("Maximum " + maxFilesReg + " files are allowed to upload...!", "Max Files Exceeded")
            return false;
        });
        var submitButton = document.querySelector("#saveBtn");
        myDZRegister = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedRegisterMap).length;
            if(imagelength < minFilesReg ){
                toastr["error"]("Minimum "+minFilesReg+" file needs to upload...!")
                return false;
            }else{
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
}

var myDZSTRA = Dropzone.options.dropAreaStra = {
    url: "{{ route('upload-stra') }}",
    minFiles: minFilesSTRA,
    maxFiles: maxFilesSTRA,
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
        return time+file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_stra[]" value="' + response.name + '">')
        uploadedSTRAMap[file.name] = response.name
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = ''
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        }else{
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-stra') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,                        
            },
            sucess: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedSTRAMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_stra[]"][value="' + filename + '"]').remove()
    },
    maxfilesexceeded: function(file) {
    },
    init: function() {
        myDZSTRA = this;
        $.ajax({
            url: "{{ url('readStraFiles') }}/{{ $klinik->id }}",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZSTRA.emit("addedfile", mockFile);
                    myDZSTRA.files.push(mockFile);
                    myDZSTRA.emit("thumbnail", mockFile, value.path);
                    myDZSTRA.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_stra[]" value="' + value.name + '">');
                    uploadedSTRAMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                })
            }
        })

        this.on("maxfilesexceeded", function(file) { 
            toastr["error"]("Maximum " + maxFilesSTRA + " files are allowed to upload...!", "Max Files Exceeded")
            return false;
        });
        var submitButton = document.querySelector("#saveBtn");
        myDZSTRA = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedSTRAMap).length;
            if(imagelength < minFilesSTRA ){
                toastr["error"]("Minimum "+minFilesSTRA+" file needs to upload...!")
                return false;
            }else{
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
}

var myDZSIPA = Dropzone.options.dropAreaSipa = {
    url: "{{ route('upload-sipa') }}",
    minFiles: minFilesSIPA,
    maxFiles: maxFilesSIPA,
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
        return time+file.name;
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="attachments_sipa[]" value="' + response.name + '">')
        uploadedSIPAMap[file.name] = response.name
        var thumbnail = $(file.previewElement).find('.dz-image img');
        thumbnail.addClass('centered-image');
    },
    removedfile: function(file) {
        var filename = ''
        if (file.hasOwnProperty('upload')) {
            filename = file.upload.filename;
        }else{
            filename = file.name;
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('image/delete-sipa') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                filename: filename,                        
            },
            sucess: function(data) {
                console.log('removed success: ' + data);
            }
        });
        Reflect.deleteProperty(uploadedSIPAMap, file.name);
        file.previewElement.remove();
        $('form').find('input[name="attachments_sipa[]"][value="' + filename + '"]').remove()
    },
    maxfilesexceeded: function(file) {
    },
    init: function() {
        myDZSIPA = this;
        $.ajax({
            url: "{{ url('readSipaFiles') }}/{{ $klinik->id }}",
            type: 'get',
            dataType: 'json',
            success: function (response) {
                $.each(response, function (key, value) {
                    var mockFile = {
                        name: value.name,
                        size: value.size,
                        accepted: true,
                        kind: 'image'
                    };
                    myDZSIPA.emit("addedfile", mockFile);
                    myDZSIPA.files.push(mockFile);
                    myDZSIPA.emit("thumbnail", mockFile, value.path);
                    myDZSIPA.emit("complete", mockFile);
                    $('form').append('<input type="hidden" name="attachments_sipa[]" value="' + value.name + '">');
                    uploadedSIPAMap[value.name] = value.name;
                    var thumbnail = $(mockFile.previewElement).find('.dz-image img');
                    thumbnail.addClass('centered-image');
                })
            }
        })

        this.on("maxfilesexceeded", function(file) { 
            toastr["error"]("Maximum " + maxFilesSIPA + " files are allowed to upload...!", "Max Files Exceeded")
            return false;
        });
        var submitButton = document.querySelector("#saveBtn");
        myDZSIPA = this;
        submitButton.addEventListener("click", function(e) {
            e.preventDefault();
            var imagelength = Object.keys(uploadedSIPAMap).length;
            if(imagelength < minFilesSIPA ){
                toastr["error"]("Minimum "+minFilesSIPA+" file needs to upload...!")
                return false;
            }else{
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
}

$('#drop-area-register').on('click', '.dz-preview', function() {
    var imageUrl = $(this).find('img').attr('src');
    // console.log(imageUrl);
    $('#previewImage').modal('show');
    $('#modalImage').attr('src', imageUrl);
});

$('#drop-area-stra').on('click', '.dz-preview', function() {
    var imageUrl = $(this).find('img').attr('src');
    // console.log(imageUrl);
    $('#previewImage').modal('show');
    $('#modalImage').attr('src', imageUrl);
});

$('#drop-area-sipa').on('click', '.dz-preview', function() {
    var imageUrl = $(this).find('img').attr('src');
    // console.log(imageUrl);
    $('#previewImage').modal('show');
    $('#modalImage').attr('src', imageUrl);
});

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": false,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}