<!DOCTYPE html>
<html>
<?php $this->load->view('admin/partial/_head');?>

<style>
    @media (max-width: 767px) {
        .duration {
            display: block;
        }
        .duration::before {
            content: "(";
        }
    }
    @media (min-width: 768px) {
        .duration::before {
            content: " (";
            white-space: pre;
        }
    }
    .duration::after {
        content: ')';
    }
</style>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view('admin/partial/_header.php'); ?>

        <?php $this->load->view('admin/partial/_sidebar.php'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manajemen Video</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="card card-success card-outline">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Informasi Paket</h3>
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalEdit">
                                            <i class="fas fa-fw fa-edit"></i>
                                            Edit Paket
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-top">
                                        <div class="mb-4">
                                            <h5 class="mb-2" style="font-weight: 600!important;">Nama Paket Video</h5>
                                            <div class="ml-4 mb-0">
                                                <?=$video['nama_paket'];?>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="mb-2" style="font-weight: 600!important;">Deskripsi Paket</h5>
                                            <div class="ml-4 mb-0">
                                                <?=$video['deskripsi_paket'];?>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="mb-2" style="font-weight: 600!important;">Deskripsi Singkat</h5>
                                            <div class="ml-4 mb-0">
                                                <?=$video['deskripsi_singkat'];?>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="mb-2" style="font-weight: 600!important;">Harga Paket</h5>
                                            <div class="ml-4 mb-0">
                                                <?='Rp ' . number_format($video['harga_paket'], 2, ',', '.');?>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="mb-2" style="font-weight: 600!important;">Link</h5>
                                            <div class="ml-4 mb-0">
                                                <?=$video['link_video'];?>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <h5 class="mb-2" style="font-weight: 600!important;">Thumbnail</h5>
                                            <div class="mb-0">
                                                <img src="<?=base_url('course/thumbnail/'.$video['thumbnail_paket']);?>" alt="Thumbnail" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card card-secondary card-outline">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <h3 class="card-title">Daftar Konten</h3>
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalVideo">
                                            <i class="fas fa-fw fa-plus"></i>
                                            Tambah Video
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group"></ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                
            </section>
        </div>

        <?php $this->load->view('admin/partial/_footer.php'); ?>
    </div>

    <div id="modalEdit" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Paket Video</label>
                        <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" value="<?=$video['nama_paket'];?>">
                        <div class="invalid-feedback">Nama paket harus diisi</div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Paket</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="5" autocomplete="off"><?=$video['deskripsi_paket'];?></textarea>
                        <div class="invalid-feedback">Deskripsi paket harus diisi</div>
                    </div>
                    <div class="form-group">
                        <label for="singkat">Deskripsi Singkat</label>
                        <textarea id="singkat" name="singkat" class="form-control" rows="5" autocomplete="off"><?=$video['deskripsi_singkat'];?></textarea>
                        <div class="invalid-feedback">Deskripsi singkat harus diisi</div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Paket</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Rp</span>
                            </div>
                            <input type="text" name="harga" id="harga" class="form-control input-currency" autocomplete="off" value="<?=number_format($video['harga_paket'], 0, ',', '.');?>">
                            <div class="invalid-feedback">Harga paket harus diisi</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control" autocomplete="off" value="<?=$video['link_video'];?>">
                        <div class="invalid-feedback">Link harus diisi</div>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" accept="image/*" name="thumbnail" id="thumbnail">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" id="btnSimpanEdit">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalVideo" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formVideo" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul Video</label>
                            <input type="text" id="judul" name="judul" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="upload">Upload Video</label>
                            <input type="file" accept="video/*" id="upload" name="upload">
                        </div>
                    </form>
                    <div id="progress" style="display: none;">
                        <p></p>
                        <div class="progress" style="height: 15px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btnSimpanVideo">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('admin/partial/_modal_password'); ?>

    <?php $this->load->view('admin/partial/_script.php'); ?>

    <script>
        var table;

        function getContent() {
            $.ajax({
                type    : 'post',
                url     : '<?=base_url('admin/video/getContent/'.$video['id_video_paket']);?>',
                dataType: 'json',
                beforeSend: function() {
                    showEllipsis('.list-group');
                },
                success : function(data) {
                    $('.ellipsis').remove();

                    if(data != null && data.length != 0) {
                        let li = '';
                        for(let i=0; i<data.length; i++) {
                            li += '<li class="list-group-item d-flex justify-content-between align-items-center">' +
                                '<div class="d-flex-row">' +
                                    data[i].nama_video +
                                    '<span class="duration">'+data[i].durasi_video+'</span>' +
                                '</div>' +
                                '<span type="button" class="btn-icon-only badge badge-danger badge-pill" data-id="'+data[i].id_video+'">' +
                                    '<i class="fa fa-times"></i>'
                                '</span>' +
                            '</li>';
                        }
                        $('.list-group').html(li);
                    }
                    else {
                        $('.list-group').html('<span>Tidak ada data.</span>');
                    }
                },
            });
        }

        $(document).ready(function() {
            $('#menuVideo a').addClass('active');

            $('#thumbnail').filestyle({
                dragdrop: false,
                text: 'Upload thumbnail',
                btnClass: 'btn-primary btn-file',
                buttonBefore: true,
            });
            $('#upload').filestyle({
                dragdrop: false,
                text: 'Upload video',
                btnClass: 'btn-primary btn-file',
                buttonBefore: true,
            });

            getContent();

            $('#btnSimpanEdit').click(function() {
                $('.is-invalid').removeClass('is-invalid');

                let id = window.location.href.split('/');
                id = id[id.length - 1];
                let nama = $('#nama').val().trim();
                let deskripsi = $('#deskripsi').val().trim();
                let singkat = $('#singkat').val().trim();
                let harga = $('#harga').val().replace(/\./g, '');
                let link = $('#link').val().trim();
                let thumbnail = $('#thumbnail')[0];

                if(nama == '' || deskripsi == '' || singkat == '' || harga == '' || link == '') {
                    toastr.error('Data tidak lengkap.', 'Error!');
                    scrollToTop();
                    if(nama == '') $('#nama').addClass('is-invalid');
                    if(deskripsi == '') $('#deskripsi').addClass('is-invalid');
                    if(singkat == '') $('#singkat').addClass('is-invalid');
                    if(harga == '') $('#harga').addClass('is-invalid');
                    if(link == '') $('#link').addClass('is-invalid');
                }
                else {
                    if(thumbnail.files.length == 0) thumbnail = '';
                    else thumbnail = thumbnail.files[0]

                    let formData = new FormData();
                    formData.append('id', id);
                    formData.append('nama', nama);
                    formData.append('deskripsi', deskripsi);
                    formData.append('singkat', singkat);
                    formData.append('harga', harga);
                    formData.append('link', link);
                    formData.append('thumbnail', thumbnail);
                    
                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('admin/video/editPaket');?>',
                        dataType: 'json',
                        data    : formData,
                        contentType : false,
                        processData : false,
                        beforeSend  : function() {
                            loading('.modal-body');
                        },
                        success : function(response) {
                            if(response.type == 'success') {
                                window.location = '<?=base_url('admin/video/detail/');?>' + id;
                            }
                            else {
                                showAlert(response);
                            }
                        },
                        error   : function(e) {
                            scrollToTop();
                            toastr.error('Gagal menyimpan data.', 'Error!');
                        },
                        complete: function() {
                            removeLoading('.modal-body');
                        }
                    });
                }
            });

            $('#btnSimpanVideo').click(function() {
                let id = window.location.href.split('/');
                id = id[id.length - 1];
                let formData = new FormData();
                formData.append('id', id);
                formData.append('judul', $('#judul').val().trim());
                formData.append('video', $('#upload')[0].files[0]);
                
                let promise = new Promise(function(resolve, reject) {
                    let video = document.createElement('video');
                    video.src = URL.createObjectURL($('#upload')[0].files[0]);
                    video.ondurationchange = function() {
                        hour = Math.floor(video.duration / 3600);
                        minute = Math.floor( (video.duration % 3600) / 60 );
                        second = Math.floor( (video.duration % 3600) % 60 );

                        hour = (hour < 10) ? '0'+hour : hour;
                        minute = (minute < 10) ? '0'+minute : minute;
                        second = (second < 10) ? '0'+second : second;
                        
                        resolve(hour + ':' + minute + ':' + second);
                    }
                });

                promise.then(function(result) {
                    // resolve callback
                    formData.append('durasi', result);
                    $.ajax({
                        xhr     : function() {
                            let xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener('progress', function(e) {
                                if(e.lengthComputable) {
                                    let percent = Math.round((e.loaded / e.total) * 100);
                                    $('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%');
                                    if(percent == 100) {
                                        $('#progress p').text('Processing file...');
                                    }
                                }
                            });
                            return xhr;
                        },
                        type    : 'post',
                        url     : '<?=base_url('admin/video/addKonten');?>',
                        dataType: 'json',
                        data    : formData,
                        contentType : false,
                        processData : false,
                        beforeSend: function() {
                            $('#progress').show();
                            $('#progress p').text('Uploading files...');
                            $('.modal-footer button').prop('disabled', true);
                        },
                        success : function(data) {
                            showAlert(data);
                        },
                        error   : function(e) { console.log(e.responseText);
                            toastr.error('Gagal menyimpan data.', 'Error!');
                        },
                        complete: function() {
                            $('#formVideo').trigger('reset');
                            $('#progress').hide();
                            $('#progress p').text('');
                            $('.progress-bar').attr('aria-valuenow', 0).css('width', '0%');
                            $('.modal-footer button').prop('disabled', false);
                            $('#modalVideo').modal('hide');
                            getContent();
                        }
                    });
                }, function(result) {
                    // reject callback
                    toastr.error('Gagal menyimpan data.', 'Error!');
                });
            });

            $(document).on('click', '.btn-icon-only', function() {
                let id = $(this).data('id');
                
                if( confirm('Apakah Anda yakin ingin menghapus data ini?') ) {
                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('admin/video/deleteKonten');?>',
                        dataType: 'json',
                        data    : { id : id },
                        beforeSend: function() {
                            loading('.card');
                        },
                        success : function(data) {
                            showAlert(data);
                        },
                        error   : function(e) {
                            toastr.error('Gagal menghapus data.', 'Error!');
                        },
                        complete: function() {
                            removeLoading('.card');
                            getContent();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>