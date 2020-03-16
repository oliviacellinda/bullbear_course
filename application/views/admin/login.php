<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE-3.0.1/plugins/fontawesome-free/css/all.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/AdminLTE-3.0.1/dist/css/adminlte.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('assets/Source_Sans_Pro/font.css');?>">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>BullBear</b>
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

    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/jquery/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?=base_url('assets/AdminLTE-3.0.1/dist/js/adminlte.min.js');?>"></script>
</body>
</html>