    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/jquery/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables-responsive/js/dataTables.responsive.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/datatables-responsive/js/responsive.bootstrap4.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/moment/moment-with-locales.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/select2/js/select2.full.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/dist/js/adminlte.min.js');?>"></script>
    <script src="<?=base_url('assets/bootstrap-filestyle-2.1.0/bootstrap-filestyle.min.js');?>"></script>
    <script src="<?=base_url('assets/toastr/toastr.min.js');?>"></script>
    <script src="<?=base_url('assets/js/function.js');?>"></script>

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
                    url     : '<?=base_url('admin/credential/gantiPassword');?>',
                    dataType: 'json',
                    data    : {
                        password_lama       : lama,
                        password_baru       : baru,
                        konfirmasi_password : konfirmasi,
                    },
                    beforeSend: function() {
                        loading('.modal-body');
                    },
                    success : function(response) { console.log(response);
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