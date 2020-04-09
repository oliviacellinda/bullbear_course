<!DOCTYPE html>
<html>
<?php $this->load->view('admin/partial/_head');?>

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
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Paket Baru</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nama">Nama Paket Video</label>
                                <input type="text" class="form-control" id="nama" autocomplete="off">
                                <div class="invalid-feedback">Nama harus diisi</div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Paket</label>
                                <textarea class="form-control" id="deskripsi" cols="30" rows="5" autocomplete="off"></textarea>
                                <div class="invalid-feedback">Deskripsi harus diisi</div>
                            </div>
                            <div class="form-group">
                                <label for="singkat">Deskripsi Singkat</label>
                                <textarea class="form-control" id="singkat" cols="30" rows="5" autocomplete="off"></textarea>
                                <div class="invalid-feedback">Deskripsi singkat harus diisi</div>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Paket</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-secondary">Rp</button>
                                    </div>
                                    <input type="text" class="form-control input-currency" id="harga" autocomplete="off">
                                    <div class="invalid-feedback">Harga harus diisi</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input type="text" class="form-control" id="link" autocomplete="off">
                                <div class="invalid-feedback">Link harus diisi</div>
                            </div>
                            <div class="form-group">
                                <label for="thumbnail">Thumbnail</label>
                                <input type="file" accept="image/*" id="thumbnail">
                                <div class="invalid-feedback">Thumbnail harus diisi</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button id="btnSimpan" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </section>
        </div>

        <?php $this->load->view('admin/partial/_footer.php'); ?>
    </div>

    <?php $this->load->view('admin/partial/_modal_password'); ?>

    <?php $this->load->view('admin/partial/_script.php'); ?>

    <script>
        var table;

        $(document).ready(function() {
            $('#menuVideo a').addClass('active');

            $(':file').filestyle({
                text: 'Upload gambar',
                btnClass: 'btn-primary btn-file',
                buttonBefore: true,
            });

            $('#btnSimpan').click(function() {
                $('.is-invalid').removeClass('is-invalid');
                $('#thumbnail').parents('.form-group').find('.invalid-feedback').css('display', 'none');

                let nama = $('#nama').val().trim();
                let deskripsi = $('#deskripsi').val().trim();
                let singkat = $('#singkat').val().trim();
                let harga = $('#harga').val().replace(/\./g, '');
                let link = $('#link').val().trim();
                let thumbnail = $('#thumbnail')[0];

                if(nama == '' || deskripsi == '' || singkat == '' || harga == '' || link == '' || thumbnail.files.length == 0) {
                    toastr.error('Data tidak lengkap.', 'Error!');
                    scrollToTop();
                    if(nama == '') $('#nama').addClass('is-invalid');
                    if(deskripsi == '') $('#deskripsi').addClass('is-invalid');
                    if(singkat == '') $('#singkat').addClass('is-invalid');
                    if(harga == '') $('#harga').addClass('is-invalid');
                    if(link == '') $('#link').addClass('is-invalid');
                    if(thumbnail.files.length == 0) $('#thumbnail').parents('.form-group').find('.invalid-feedback').css('display', 'block');
                }
                else {
                    let formData = new FormData();
                    formData.append('nama', nama);
                    formData.append('deskripsi', deskripsi);
                    formData.append('singkat', singkat);
                    formData.append('harga', harga);
                    formData.append('link', link);
                    formData.append('thumbnail', thumbnail.files[0]);
                    
                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('admin/video/addPaket');?>',
                        dataType: 'json',
                        data    : formData,
                        contentType : false,
                        processData : false,
                        beforeSend  : function() {
                            loading('.card');
                        },
                        success : function(response) {
                            if(!jQuery.isPlainObject(response)) {
                                window.location = '<?=base_url('admin');?>';
                            }
                            else if(response.type == 'success') {
                                window.location = response.message;
                            }
                            else {
                                showAlert(response);
                            }
                        },
                        error   : function(e) { console.log(e.responseText);
                            scrollToTop();
                            toastr.error('Gagal menyimpan data.', 'Error!');
                        },
                        complete: function() {
                            removeLoading('.card');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>