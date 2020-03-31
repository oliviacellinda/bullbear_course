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
                            <h1>Manajemen Transaksi</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Transaksi Baru</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="member">Member</label>
                                <select class="form-control" name="member" id="member">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback">Member harus diisi</div>
                            </div>
                            <div class="form-group">
                                <label for="paket">Nama Paket</label>
                                <select class="form-control" name="paket" id="paket">
                                    <option value=""></option>
                                </select>
                                <div class="invalid-feedback">Nama paket harus diisi</div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Paket</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" autocomplete="off" readonly></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Paket</label>
                                <div class="input-group">
                                    <input type="text" name="harga" id="harga" class="form-control input-currency" autocomplete="off" readonly>
                                </div>
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
            $('#menuTransaksi a').addClass('active');

            $('#member').select2({
                ajax : {
                    type    : 'post',
                    url     : '<?=base_url('admin/member/searchMember');?>',
                    dataType: 'json',
                    delay   : 250, // in miliseconds
                    data    : function(params) {
                        return { search : params.term };
                    },
                    processResults: function(data, params) {
                        if(jQuery.isPlainObject(data)) {
                            if(data.results.length > 0) {
                                data.results.forEach(function(element) {
                                    element.id = element.username_member;
                                    element.text = element.nama_member;
                                });
                            }
                            return { results : data.results };
                        }
                        else {
                            window.location = '<?=base_url('admin');?>';
                        }
                    },
                },
                placeholder : 'Cari member berdasarkan username atau nama.',
                minimumInputLength : 2,
                templateResult : function formatSelect(data) {
                    if(data.loading) {
                        return data.text;
                    }
                    var template = $('<span><strong>'+data.username_member+'</strong> &mdash; '+data.nama_member+'</span>');
                    return template;
                },
                templateSelection : function formatSelection(data) {
                    return data.nama_member || data.text;
                },
            });

            $.ajax('<?=base_url('admin/video/getList');?>').then(function(data) {
                data = JSON.parse(data);
                data.forEach(function(element) {
                    let value = JSON.stringify({
                        id          : element.id_video_paket,
                        deskripsi   : element.deskripsi_paket,
                        harga       : element.harga_paket,
                    });
                    let option = $(document.createElement('option')).val(value).text(element.nama_paket);
                    $('#paket').append(option);
                });
                $('#paket').select2({placeholder: 'Cari paket video.'});
            });

             $(document).on('change', '#paket', function() {
                let value = this.value;
                value = JSON.parse(value);
                $('#deskripsi').val(value.deskripsi);
                $('#harga').val(currency.format(value.harga));
            });

            $('#btnSimpan').click(function() {
                $('.is-invalid').removeClass('is-invalid');
                
                let username = $('#member').val();
                let paket = $('#paket').val();
                paket = JSON.parse(paket);
                paket = paket.id;

                if(username == '' || paket == '') {
                    toastr.error('Data tidak lengkap.', 'Error!');
                    scrollToTop();
                    if(username == '') $('#username').addClass('is-invalid');
                    if(paket == '') $('#paket').addClass('is-invalid');
                }
                else {
                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('admin/transaksi/addTransaksi');?>',
                        dataType: 'json',
                        data    : {
                            username    : username,
                            paket       : paket,
                        },
                        beforeSend: function() {
                            loading('.card');
                        },
                        success : function(response) {
                            if(!jQuery.isPlainObject(response)) {
                                window.location = '<?=base_url('admin');?>';
                            }
                            else if(response.type == 'success') {
                                window.location = '<?=base_url('admin/transaksi');?>';
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