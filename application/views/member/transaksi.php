<!DOCTYPE html>
<html>
<?php $this->load->view('member/partial/_head');?>

<style>
    .detail-image {
        max-width: 100%;
        display: inline-block;
    }
    .detail-title {
        max-width: 100%;
        display: inline-block;
    }
    @media (min-width: 992px) {
        .detail-image {
            max-width: 33.333333%;
        }
        .detail-title {
            max-width: 66.666666%;
            padding-left: 10px;
            vertical-align: top;
        }
    }
</style>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php $this->load->view('member/partial/_header.php'); ?>

        <div class="content-wrapper">
            <?php $this->load->view('member/partial/_menu');?>

            <div class="content-header mt-4">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-12 text-center">
                            <h1 class="m-0 text-dark">Purchase History</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row pb-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="tablePurchase" class="table table-bordered"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('member/partial/_footer.php'); ?>
    </div>

    <?php $this->load->view('member/partial/_modal_password'); ?>

    <?php $this->load->view('member/partial/_script.php'); ?>

    <script>
        var table;

        $(document).ready(function() {
            table = $('#tablePurchase').DataTable({
                responsive: true,
                ordering: false,
                searching: false,
                processing: true,
                language: { processing : 'Loading...' },
                serverSide: true,
                ajax: {
                    type    : 'post',
                    url     : '<?=base_url('member/transaction/getList');?>',
                    dataSrc : function(datatable) {
                        return datatable.data;
                    },
                    error   : function(e) {
                        window.location = "<?=base_url('member');?>";
                    }
                },
                columns: [
                    { data: 'tanggal_transaksi', title: 'Date' },
                    { data: 'nama_paket', title: 'Detail' },
                    { data: 'total_pembelian', title: 'Price' },
                    { data: 'status_verifikasi', title: 'Status' },
                ],
                columnDefs: [
                    { targets: 0, width: '130px', render: function(data, type, row) {
                            if(moment(data).isValid()) {
                                let date = moment(data, 'YYYY-MM-DD HH:mm:ss', 'id').format('D MMMM YYYY, ');
                                let time = moment(data, 'YYYY-MM-DD HH:mm:ss', 'id').format('HH:mm');
                                return '<span style="white-space: nowrap;">' + date + '</span>\n' + time;
                            }
                            else
                                return "-";
                        } 
                    },
                    { targets: 1, render: function(data, type, row) {
                            let src = '<?=base_url('course/thumbnail/')?>' + row.thumbnail_paket;
                            return '' +
                            '<div class="detail-image">' +
                                '<img src="'+src+'" style="width: 100%;">' +
                            '</div>' +
                            '<div class="detail-title">' +
                                '<p style="margin: 0"><strong>' + row.nama_paket + '</strong></p>' +
                                row.deskripsi_singkat
                            '</div>';
                        } 
                    },
                    { targets: 2, render: function(data, type, row) {
                            return currency.format(data);
                        } 
                    },
                    { targets: 3, render: function(data, type, row) {
                            return data.charAt(0).toUpperCase() + data.slice(1);
                        } 
                    },
                ],
            });
        });
    </script>
</body>