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
        Reply
        <small>Form</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Reply</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php echo validation_errors(); ?>
    <?php echo $this->session->flashdata('msg'); ?>
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Reply</h3>
            </div>
            <!-- /.box-header -->
            <?php foreach ($request as $r):?>
            <form action="<?php echo base_url(). 'requestor/send_id'; ?>" enctype="multipart/form-data" method="post">
            <input type="text" name="request_id" value="<?php echo $r->request_id; ?>" hidden>
            <input type="text" name="request_no" value="<?php echo $r->request_no; ?>" hidden>
            <input type="text" name="requested_by" value="<?php echo $r->requested_by; ?>" hidden>
            <input type="text" name="subject" value="<?php echo $r->subject; ?>" hidden>
            <textarea name="description" style="display:none;"><?php echo $r->description; ?></textarea>
            <div class="box-body">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Request ID" maxlength="100" value="<?php echo $r->request_no; ?>" disabled>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Requestor Name" maxlength="100" value="<?php echo $r->requested_by_name; ?>" disabled>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Subject" maxlength="100" value="<?php echo $r->subject; ?>" disabled>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Type" maxlength="100" value="<?php echo $r->type; ?>" disabled>
              </div><br>

              <div class="box box" style="background-color: #eee ">
                Description :<br>
              <?php echo $r->description;?><br>
              </div>
              <?php if($r->request_attachment!=""){?>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
               <a class="form-control" href="<?php echo base_url('assets/images/request/'.$r->request_attachment) ?>" target="_blank"> <?php echo $r->request_attachment; ?> </a>
              </div><br>
              <?php } ?>
              <?php if($r->form_file!=""){?>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>
               <a class="form-control" href="<?php echo base_url('assets/images/form/'.$r->form_file) ?>" target="_blank"> <?php echo $r->form_file; ?> </a>
              </div><br>
              <?php } ?>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                <textarea name="response" class="form-control ckeditor" id="ckeditor" placeholder="Description" required></textarea>
              </div><br>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file"></i></span>
                  <input name="form_file" type="file" class="form-control" placeholder="Upload Attachment">
              </div><br>
            </div>
            <br>
            <center>
                <input class="btn btn-info" type="submit" name="Send Reply" value="Reply & Close Request">
                <a class="btn btn-round btn-warning" href="<?php echo base_url();?>requestor/close/<?php echo $r->request_id; ?>">Close Request</a>
            </center>
            </form>
            <?php endforeach; ?>
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