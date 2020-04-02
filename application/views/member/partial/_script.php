    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/jquery/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/moment/moment-with-locales.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/dist/js/adminlte.min.js');?>"></script>
    <script src="<?=base_url('assets/toastr/toastr.min.js');?>"></script>
    <script src="<?=base_url('assets/video.js/dist/video.min.js');?>"></script>
    <script src="<?=base_url('assets/js/function.js');?>"></script>
    <script src="<?=base_url('assets/js/data.js');?>"></script>

    <script>
        $('#btnSimpanPassword').click(function() {
            $('#password_lama').removeClass('is-invalid');
            $('#password_baru').removeClass('is-invalid');
            $('#konfirmasi_password').removeClass('is-invalid');
            
            let lama = $('#password_lama').val();
            let baru = $('#password_baru').val();
            let konfirmasi = $('#konfirmasi_password').val();
            
            let flag = true;
            
            if(lama === '' || baru === '' || konfirmasi === '') {
                flag = false;
                if(lama === '') {
                    $('#password_lama').siblings('.invalid-feedback').text('Password lama harus diisi.');
                    $('#password_lama').addClass('is-invalid');
                }
                if(baru === '') {
                    $('#password_baru').siblings('.invalid-feedback').text('Password baru harus diisi.');
                    $('#password_baru').addClass('is-invalid');
                }
                if(konfirmasi === '') {
                    $('#konfirmasi_password').siblings('.invalid-feedback').text('Konfirmasi password baru harus diisi.');
                    $('#konfirmasi_password').addClass('is-invalid');
                }
            }
            
            if(baru.length < 8) {
                flag = false;
                $('#password_baru').siblings('.invalid-feedback').text('Password baru minimal terdiri dari 8 karakter.');
                $('#password_baru').addClass('is-invalid');
            }
            
            if(konfirmasi != baru) {
                flag = false;
                $('#konfirmasi_password').siblings('.invalid-feedback').text('Konfirmasi password baru tidak sesuai.');
                $('#konfirmasi_password').addClass('is-invalid');
            }
            
            if(flag) {
                $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('member/credential/gantiPassword');?>',
                    dataType: 'json',
                    data    : {
                        password_lama       : lama,
                        password_baru       : baru,
                        konfirmasi_password : konfirmasi,
                    },
                    beforeSend: function() {
                        loading('.modal-body');
                    },
                    success : function(response) {
                        if(response.type == 'success') {
                            $('#password_lama').val('');
                            $('#password_baru').val('');
                            $('#konfirmasi_password').val('');
                            $('#modalPassword').modal('hide');
                        }
                        showAlert(response);
                    },
                    error   : function(response) {
                        toastr.error('Gagal menyimpan data.', 'Error!');
                    },
                    complete: function() {
                        removeLoading('.modal-body');
                    }
                })
            }
        });
    </script>

    <script id="template" type="text/html">
        <div class="col-sm-6 col-md-4 pb-3">
            <div class="card h-100">
                <a href="" id="thumbnail">
                    <img src="" alt="Course Image" class="card-img-top img-fluid" id="thumbnail">
                </a>
                <div class="card-body">
                    <h4 class="card-title" id="title"><strong></strong></h4>
                    <p class="card-text" id="description"></p>
                </div>
                <div class="card-footer clearfix">
                    <span class="float-left" id="price"></span>
                    <a href="" class="btn btn-sm btn-primary float-right" id="action"></a>
                </div>
            </div>
        </div>
    </script>