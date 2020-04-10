<!DOCTYPE html>
<html>
<?php $this->load->view('member/partial/_head.php');?>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>BullBear Course</b>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Register a new account</p>
                <form autocomplete="off">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-at"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-id-card"></span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center mb-3">
                    <button id="btnSubmit" class="btn btn-block btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('member/partial/_script.php');?>

    <script>
        $(document).ready(function() {
            $('input[name="username"]').focus();

            $('#btnSubmit').click(function(event) {
                $('#username').removeClass('is-invalid');
                $('#password').removeClass('is-invalid');
                $('#email').removeClass('is-invalid');
                $('#name').removeClass('is-invalid');
                $('.help-block').remove();

                $('.btn').addClass('disabled');
                $('.btn').html('<i class="fas fa-spinner fa-pulse"></i>');

                let username = $('input[name="username"]').val();
                let password = $('input[name="password"]').val();
                let email = $('input[name="email"]').val();
                let name = $('input[name="name"]').val();

                if(username != '' && password != '' && email != '' && name != '') {
                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('member/credential/prosesRegister');?>',
                        dataType: 'json',
                        data    : {
                            username : username,
                            password : password,
                            email    : email,
                            name     : name,
                        },
                        success : function(response) {
                            if(response.type == 'error') {
                                $('.help-block').remove();
                                $('form').append('<span class="help-block" style="color:#a94442">'+response.message+'</span>');
                                $('#username').addClass('is-invalid');
                                $('#password').addClass('is-invalid');
                                $('#email').addClass('is-invalid');
                                $('#name').addClass('is-invalid');
                                $('input[name="username"]').focus();
                                $('.btn').removeClass('disabled');
                                $('.btn').text('Submit');
                            }
                            else if(response.type == 'success') {
                                window.location = '<?=base_url('member/home')?>';
                            }
                        },
                        error   : function(response) {
                            console.log(response.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>