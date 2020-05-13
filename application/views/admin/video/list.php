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

            <section class="content mb-3">
                <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url('admin/video/tambah');?>" class="btn btn-primary">
                            <i class="fas fa-fw fa-plus"></i>
                            Tambah Paket
                        </a>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Video</h3>
                    </div>
                    <div class="card-body">
                        <table id="tableVideo" class="table table-bordered" width="100%"></table>
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

            tabel = $('#tableVideo').DataTable({
                scrollX: true,
                order: [ [1,'asc'] ],
                searching: false,
                responsive: true,
                processing: true,
                language: { processing : 'Loading...' },
                serverSide: true,
                ajax: {
                    type    : 'post',
                    url     : '<?=base_url('admin/video/getList');?>',
                    dataSrc : function(datatable) {
                        if(jQuery.isPlainObject(datatable)) {
                            let returnData = new Array();
                            for(let i=0; i<datatable.data.length; i++) {
                                returnData.push({
                                    'menu'          : datatable.data[i].id_video_paket,
                                    'nama_paket'    : datatable.data[i].nama_paket,
                                    'harga_paket'   : datatable.data[i].harga_paket,
                                    'tanggal_dibuat': datatable.data[i].tanggal_dibuat,
                                });
                            }
                            return returnData;
                        }
                        else {
                            window.location = "<?=base_url('admin');?>";
                        }
                    },
                    error : function() {
                        toastr.error('Error dalam mengambil data.', 'Error!');
                    }
                },
                columns: [
                    { data: 'menu', title: 'Menu', orderable: false, width: '90px' },
                    { data: 'nama_paket', title: 'Nama Paket' },
                    { data: 'harga_paket', title: 'Harga' },
                    { data: 'tanggal_dibuat', title: 'Tanggal Dibuat' },
                ],
                columnDefs: [
                    { targets : 0, render : function(data, type, row) {
                            return '<a href="<?=base_url('admin/video/detail/');?>'+data+'" id="btnDetail" class="btn btn-sm btn-info mr-2">'+
                                '<i class="fas fa-fw fa-info"></i>' +
                            '</a>' +
                            '<button id="btnHapus" class="btn btn-sm btn-danger">'+
                                '<i class="fas fa-fw fa-trash"></i>' +
                            '</button>'
                        } 
                    },
                    { targets : 2, render : $.fn.dataTable.render.number('.', ',', 2, 'Rp ') },
                    { targets : 3, render : function(data, type, row) {
                            if(moment(data).isValid())
                                return moment(data, 'YYYY-MM-DD HH:mm:ss', 'id').format('D MMMM YYYY, HH:mm');
                            else
                                return "-";
                        } 
                    },
                ],
            });

            $('#tableVideo').on('click', '#btnHapus', function() {
                if( confirm('Apakah Anda yakin ingin menghapus paket video ini?') ) {
                    let tr = $(this).parents('tr');
                    let row = tabel.row(tr).data();
                    let id = row.menu;

                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('admin/video/deletePaket');?>',
                        dataType: 'json',
                        data    : { id : id },
                        beforeSend: function() {
                            loading('.card');
                        },
                        success : function(response) {
                            if(!jQuery.isPlainObject(response)) {
                                window.location = '<?=base_url('admin');?>';
                            }
                            else {
                                showAlert(response);
                            }
                        },
                        error   : function(e) {
                            toastr.error('Gagal menghapus data.', 'Error!');
                        },
                        complete: function() {
                            tabel.ajax.reload(null, false);
                            removeLoading('.card');
                        }
                    });
                }
            });

        });
    </script>
</body>
</html>