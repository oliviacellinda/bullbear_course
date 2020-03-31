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

            <section class="content mb-3">
                <div class="row">
                    <div class="col-12">
                        <a href="<?=base_url('admin/transaksi/tambah');?>" class="btn btn-primary">
                            <i class="fas fa-fw fa-plus"></i>
                            Tambah Transaksi
                        </a>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <table id="tableTransaksi" class="table table-bordered" width="100%"></table>
                    </div>
                </div>
            </section>
        </div>

        <?php $this->load->view('admin/partial/_footer.php'); ?>
    </div>

    <div id="modalDetail" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    	<span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="nav-transaksi-tab" data-toggle="pill" href="#nav-transaksi" role="tab" aria-controls="nav-transaksi" aria-selected="true">Transaksi</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-member-tab" data-toggle="pill" href="#nav-member" role="tab" aria-controls="nav-member" aria-selected="false">Member</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="nav-paket-tab" data-toggle="pill" href="#nav-paket" role="tab" aria-controls="nav-paket" aria-selected="false">Paket</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-transaksi" role="tabpanel" aria-labelledby="nav-transaksi-tab">
                                    <dl>
                                        <dt>Invoice</dt>
                                        <dd id="invoice"></dd>

                                        <dt>Tanggal Transaksi</dt>
                                        <dd id="tglTransaksi"></dd>

                                        <dt>Tanggal Verifikasi</dt>
                                        <dd id="tglVerifikasi"></dd>

                                        <dt>Total Pembelian</dt>
                                        <dd id="totalPembelian"></dd>

                                        <dt>Status Verifikasi</dt>
                                        <dd id="statusVerifikasi"></dd>

                                        <dt>Sumber Pembayaran</dt>
                                        <dd id="sumberPembayaran"></dd>
                                    </dl>
                                </div>
                                <div class="tab-pane fade" id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
                                    <dl>
                                        <dt>Nama Member</dt>
                                        <dd id="namaMember"></dd>

                                        <dt>Username Member</dt>
                                        <dd id="usernameMember"></dd>

                                        <dt>Email Member</dt>
                                        <dd id="emailMember"></dd>
                                    </dl>
                                </div>
                                <div class="tab-pane fade" id="nav-paket" role="tabpanel" aria-labelledby="nav-paket-tab">
                                    <dl>
                                        <dt>Nama Paket</dt>
                                        <dd id="namaPaket"></dd>

                                        <dt>Deskripsi Paket</dt>
                                        <dd id="deskripsiPaket"></dd>

                                        <dt>Harga Paket</dt>
                                        <dd id="hargaPaket"></dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('admin/partial/_modal_password'); ?>

    <?php $this->load->view('admin/partial/_script.php'); ?>

    <script>
        var table;

        $(document).ready(function() {
            $('#menuTransaksi a').addClass('active');

            tabel = $('#tableTransaksi').DataTable({
                scrollX: true,
                order: [ [1,'asc'] ],
                searching: false,
                responsive: true,
                processing: true,
                language: { processing : 'Loading...' },
                serverSide: true,
                ajax: {
                    type    : 'post',
                    url     : '<?=base_url('admin/transaksi/getList');?>',
                    dataSrc : function(datatable) {
                        if(jQuery.isPlainObject(datatable)) {
                            let returnData = new Array();
                            for(let i=0; i<datatable.data.length; i++) {
                                returnData.push({
                                    'menu'              : datatable.data[i].invoice,
                                    'tanggal_transaksi' : datatable.data[i].tanggal_transaksi,
                                    'invoice'           : datatable.data[i].invoice,
                                    'username_member'   : datatable.data[i].username_member,
                                    'total_pembelian'   : datatable.data[i].total_pembelian,
                                    'status_verifikasi' : datatable.data[i].status_verifikasi,
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
                    { data: 'menu', title: 'Menu', orderable: false, width: '30px' },
                    { data : 'tanggal_transaksi', title: 'Tanggal Transaksi' },
                    { data : 'invoice', title: 'No. Invoice' },
                    { data : 'username_member', title: 'Username' },
                    { data : 'total_pembelian', title: 'Total Pembelian' },
                    { data : 'status_verifikasi', title: 'Status' },
                ],
                columnDefs: [
                    { targets : 0, render : function(data, type, row) {
                            let button = '<button id="btnDetail" class="btn btn-sm btn-info">' +
                                '<i class="fas fa-fw fa-info"></i>' +
                            '</button>';
                            return button;
                        } 
                    },
                    { targets : 1, render : function(data, type, row) {
                            if(moment(data).isValid())
                                return moment(data, 'YYYY-MM-DD HH:mm:ss', 'id').format('D MMMM YYYY, HH:mm');
                            else
                                return "-";
                        } 
                    },
                    { targets : 4, render : $.fn.dataTable.render.number('.', ',', 2, 'Rp ') },
                    { targets : 5, render : function(data, type, row) {
                            return data.charAt(0).toUpperCase() + data.slice(1);
                        } 
                    },
                ],
            });

            $('#tableTransaksi').on('click', '#btnDetail', function() {
                let tr = $(this).parents('tr');
                let row = tabel.row(tr).data();

                $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('admin/transaksi/getDetail');?>',
                    dataType: 'json',
                    data    : { invoice : row.menu },
                    beforeSend: function() {
                        loading('.card');
                    },
                    success : function(data) {
                        if(!jQuery.isPlainObject(data)) {
                            window.location = '<?=base_url('admin');?>';
                        }
                        else if(data.type == 'error') {
                            showAlert(data);
                        }
                        else if(data.type == 'success') {
                            $('#invoice').text(data.transaksi.invoice);
                            $('#tglTransaksi').text(moment(data.transaksi.tanggal_transaksi).isValid() ? moment(data.transaksi.tanggal_transaksi, 'YYYY-MM-DD HH:mm:ss', 'id').format('D MMMM YYYY, HH:mm') : '-');
                            $('#tglVerifikasi').text(moment(data.transaksi.tanggal_verifikasi).isValid() ? moment(data.transaksi.tanggal_verifikasi, 'YYYY-MM-DD HH:mm:ss', 'id').format('D MMMM YYYY, HH:mm') : '-');
                            $('#totalPembelian').text(currency.format(data.transaksi.total_pembelian));
                            $('#statusVerifikasi').text(data.transaksi.status_verifikasi.charAt(0).toUpperCase() + data.transaksi.status_verifikasi.slice(1));
                            $('#sumberPembayaran').text(data.transaksi.sumber_pembayaran.charAt(0).toUpperCase() + data.transaksi.sumber_pembayaran.slice(1));
                        
                            $('#namaMember').text(data.member.nama_member);
                            $('#usernameMember').text(data.member.username_member);
                            $('#emailMember').text(data.member.email_member);

                            if(data.paket == null) {
                                $('#namaPaket,#deskripsiPaket,#hargaPaket').text('Data tidak ditemukan.');
                            }
                            else {
                                $('#namaPaket').text(data.paket.nama_paket);
                                $('#deskripsiPaket').text(data.paket.deskripsi_paket);
                                $('#hargaPaket').text(currency.format(data.paket.harga_paket));
                            }
                            
                            $('#nav-transaksi').tab('show');
                            $('#modalDetail').modal('show');
                        }
                    },
                    error   : function(e) {
                        toastr.error('Gagal memuat data.', 'Error!');
                    },
                    complete: function() {
                        removeLoading('.card');
                    }
                });
            });
        });
    </script>
</body>
</html>