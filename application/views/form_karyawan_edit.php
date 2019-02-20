<?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/flat/blue.css') ?>" rel="stylesheet" type="text/css" />
<!-- Morris chart -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.css') ?>" rel="stylesheet" type="text/css" />
<!-- jvectormap -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>" rel="stylesheet" type="text/css" />
<!-- Date Picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
<!-- Daterange picker -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker-bs3.css') ?>" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>" rel="stylesheet" type="text/css" />

<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Employee
        <small>Form</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee Form</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php echo validation_errors(); ?>
    <?php echo $this->session->flashdata('verify_msg'); ?>
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Employee Form</h3>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo base_url(). 'karyawan/update_karyawan'; ?>" method="post">
            <?php foreach ($karyawan as $k):?>
            <input type="text" name="nik" value="<?php echo $k->nik; ?>" hidden>
            <div class="box-body">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="name" type="text" class="form-control" placeholder="Username" maxlength="50" value="<?php echo $k->username; ?>" readonly>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="name" type="text" class="form-control" placeholder="Name" maxlength="50" value="<?php echo $k->name; ?>" required>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <select name="site_id" class="form-control" required >
                  <option value="" disabled selected hidden> Office Site</option>
                  <?php foreach ($site as $s): ?>
                    <option value="<?php echo $s->site_id; ?>"><?php echo $s->site_name; ?></option>
                  <?php endforeach; ?>
                </select>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="dept" type="text" class="form-control" placeholder="Department" maxlength="50" value="<?php echo $k->dept; ?>" required>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email" maxlength="50" value="<?php echo $k->email; ?>" required>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon">&nbsp;<i class="fa fa-lock"></i>&nbsp;</span>
                <input name="password" type="password" class="form-control" placeholder="Password (do not fill if you do not want to change the password)" maxlength="20">
              </div><br>
              <div class="input-group">
                <span class="input-group-addon">&nbsp;<i class="fa fa-lock"></i>&nbsp;</span>
                <input name="confirm_password" type="password" class="form-control" placeholder="Confirm Password (don't fill if you don't want to change the password)" maxlength="20">
              </div>
            </div>
            <br>
            <center>
                <input class="btn btn-info" type="submit" name="Update Employee" value="Update Employee" required>
            </center>
            <br>
            <?php endforeach; ?>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
    </div><!-- /.row (main row) -->

</section><!-- /.content -->


<?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard.js') ?>" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>

<?php
$this->load->view('template/foot');
?>