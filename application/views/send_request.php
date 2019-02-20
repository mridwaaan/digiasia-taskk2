<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Send Request</title>
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
                <a href="#"><b>Request</b>ID</a>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <?php echo validation_errors(); ?>
                <?php echo $this->session->flashdata('msg'); ?>
                <form action="<?php echo base_url(). 'request/send_request'; ?>" method="post">
                    <div class="form-group has-feedback">
                        <input name="nik" type="text" class="form-control" placeholder="NIK" required />
                        <span class="form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <select name="system" class="form-control" required >
                          <option  value="" disabled selected hidden> Select System</option>
                              <option value="System 1">System 1</option>
                              <option value="System 2">System 2</option>
                              <option value="System 3">System 3</option>
                              <option value="System 4">System 4</option>
                          </select>
                    </div>
                    <div class="form-group has-feedback">
                        <textarea name="description" type="text" class="form-control" placeholder="Description"></textarea>
                        <span class="form-control-feedback"></span>
                    </div>
                    <center>
                        <input type="submit" class="btn btn-primary" name="Send Request" value="Send Request"></input>
                    </center>

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