<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="<?php echo base_url('assets/font-awesome-4.3.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/AdminLTE.min.css') ?>" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/square/blue.css') ?>" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <img width="100%" height="100%" src="<?php echo base_url('assets/images/cj.png') ?>">
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <?php echo validation_errors(); ?>
                <?php echo $this->session->flashdata('verify_msg'); ?>
                <p class="login-box-msg">Berikut ini merupakan Halaman User</p>
                <p>
                    USER     : user<br>
                    Password : user<br>
                </p>
                <p>
                    <a href="<?php echo base_url(). 'auth'; ?>">Untuk masuk ke Web ADMIN, please klik di sini</a>
                </p>
                <form action="<?php echo base_url(). 'user_auth/user_login'; ?>" method="post">
                    <div class="form-group has-feedback">
                        <input name="username" type="text" class="form-control" placeholder="Username"/>
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input name="password" type="password" class="form-control" placeholder="Password"/>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span><br>
                        <a href="#">Forget Password? (Ask IT Team, this feature still on development. Tq)</a><br>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                        	<button type="submit" class="btn btn-primary btn-block btn-flat">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row">
                    	<br>
                    	<div class="col-xs-12">
                        	<a href="<?php echo base_url(). 'regist'; ?>" class="btn btn-warning btn-block btn-flat">SIGN UP</a>
                        </div>
                    </div>
                </form>
                
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
        <!-- jQuery 2.1.3 -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>