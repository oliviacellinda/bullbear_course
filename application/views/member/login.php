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
                <p class="login-box-msg">Sign in to continue</p>
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
                </form>
                <div class="text-center mb-3">
                    <button id="btnLogin" class="btn btn-block btn-primary">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->view('member/partial/_script.php');?>

    <script>
        $(document).ready(function() {
            $('input[name="username"]').focus();

            $('input[name="username"]').keypress(function(event) {
                $('#username').removeClass('has-error');
                if(event.keyCode === 13) {
                    event.preventDefault();
                    $('input[name="password"]').focus();
                }
            });

            $('input[name="password"]').keypress(function(event) {
                $('#password').removeClass('has-error');
            });

            $('#btnLogin').click(function(event) {
                $('#username').removeClass('is-invalid');
                $('#password').removeClass('is-invalid');
                $('.help-block').remove();

                $('.btn').addClass('disabled');
                $('.btn').html('<i class="fas fa-spinner fa-pulse"></i>');

                let username = $('input[name="username"]').val();
                let password = $('input[name="password"]').val();

                if(username != '' && password != '') {
                    $.ajax({
                        type    : 'post',
                        url     : '<?=base_url('member/credential/prosesLogin');?>',
                        dataType: 'json',
                        data    : {
                            username : username,
                            password : password
                        },
                        success : function(response) {
                            if(response == 'username tidak ada' || response == 'password salah') {
                                $('.help-block').remove();
                                $('form').append('<span class="help-block" style="color:#a94442">Username atau password Anda salah!</span>');
                                $('#username').addClass('is-invalid');
                                $('#password').addClass('is-invalid');
                                $('input[name="username"]').focus();
                                $('.btn').removeClass('disabled');
                                $('.btn').text('Sign In');
                            }
                            else if(response == 'berhasil') {
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