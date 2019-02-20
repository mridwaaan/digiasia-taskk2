<?php
$this->load->view('template_u/head');
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
$this->load->view('template_u/topbar');
$this->load->view('template_u/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Request ID
        <small>Form</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Request ID</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="alert alert-warning">
  <p>
    Pemberitahuan:<br>
    Untuk setiap Request ID / Akun atau Permission ke System, mohon untuk download form berikut untuk diisi Client, Center, serta Permission apa saja yang ingin ditambahkan, serta di TTD oleh pihak terkait serta Dept Manager dan di upload kembali pada Web Support Request ini<br><br>
    <a class="btn btn-info" href="<?php echo base_url('assets/form/FM-IT-003-004.xlsx')?>" target="_blank"><i class="fa fa-download"></i>&nbsp;DOWNLOAD FORM</a>
  </p>
  </div>
    <?php echo validation_errors(); ?>
    <?php echo $this->session->flashdata('verify_msg'); ?>
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Support Request</h3>
            </div>
            <!-- /.box-header -->
            <form action="<?php echo base_url(). 'my_request/send_request'; ?>" enctype="multipart/form-data" method="post">
            <input type="text" name="requested_by" value="<?php echo $this->session->userdata('usrnik'); ?>" hidden>
            <div class="box-body">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" name="subject" type="text" class="form-control" placeholder="Subject" maxlength="100" required>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-desktop"></i></span>
                <select name="type" class="form-control" required >
                  <option value="" disabled selected hidden> Support Request Type</option>
                  <option value="AI">AilisXE</option>
                  <option value="GL">G-Link</option>
                  <option value="GC">GCC</option>
                  <!--<option value="MD">MDG S/4 HANA System</option>-->
                  <option value="NS">nSolution</option>
                  <!--<option value="SP">SAP S/4 HANA System</option>-->
                  <option value="EI">Email ID (@cjlogistics.co.id)</option>
                  <option value="VN">VPN</option>
                  <option value="WF">CJ-Guest ID</option>
                  <option value="IS">InfraStructure (PC/Notebook Issue)</option>
                </select>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                <textarea name="description" type="text" id="ckeditor" class="ckeditor" placeholder="Description" required></textarea>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                  <input name="request_attachment" type="file" class="form-control" placeholder="Upload Attachment">
              </div><br>
            </div>
            <br>
            <center>
                <input class="btn btn-info" type="submit" name="Send Request" value="Send Request" required>
            </center>
            <br>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section><!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
    </div><!-- /.row (main row) -->

</section><!-- /.content -->


<?php
$this->load->view('template_u/js');
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
$this->load->view('template_u/foot');
?>
