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
                            <h1>Manajemen Member</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Member</h3>
                    </div>
                    <div class="card-body">
                        <table id="tableMember" class="table table-bordered" width="100%"></table>
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
            $('#menuMember a').addClass('active');

            tabel = $('#tableMember').DataTable({
                scrollX: true,
                order: [ [1,'asc'] ],
                searching: false,
                responsive: true,
                processing: true,
                language: { processing : 'Loading...' },
                serverSide: true,
                ajax: {
                    type    : 'post',
                    url     : '<?=base_url('admin/member/getList');?>',
                    dataSrc : function(datatable) {
                        if(jQuery.isPlainObject(datatable)) {
                            let returnData = new Array();
                            for(let i=0; i<datatable.data.length; i++) {
                                returnData.push({
                                    'menu'             : datatable.data[i].username_member,
                                    'username_member'  : datatable.data[i].username_member,
                                    'nama_member'      : datatable.data[i].nama_member,
                                    'email_member'     : datatable.data[i].email_member,
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
                    { data: 'username_member', title: 'Username' },
                    { data: 'nama_member', title: 'Nama' },
                    { data: 'email_member', title: 'Email' },
                ],
                columnDefs: [
                    { targets: 0, render: function(data, type, row) {
                            return '<button id="btnReset" class="btn btn-sm btn-dark" data-username="'+data+'">'+
                                '<i class="fas fa-fw fa-lock-open"></i>' +
                            '</button>';
                        } 
                    },
                ],
            });

            $('#tableMember').on('click', '#btnReset', function() {
                let username = $(this).data('username');
                let element = $('.card');
                $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('admin/member/resetPassword');?>',
                    dataType: 'json',
                    data    : { username : username },
                    beforeSend: function() {
                        loading(element);
                    },
                    success : function(response) {
                        if(response.type == 'forbidden') {
                            window.location = '<?=base_url('admin');?>';
                        }
                        else { 
                            showAlert(response);
                        }
                    },
                    error   : function() {
                        toastr.error('Gagal mereset password.', 'Error!');
                    },
                    complete: function() {
                        tabel.ajax.reload(null, false);
                        removeLoading(element);
                    }
                });
            });
        });
    </script>
</body>
</html>