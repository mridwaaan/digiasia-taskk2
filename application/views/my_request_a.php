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
<!-- Datatables-->
<link href="<?php echo base_url();?>assets/DataTables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/DataTables/media/css/dataTables.css" rel="stylesheet" type="text/css">
<?php
$this->load->view('template_u/topbar');
$this->load->view('template_u/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        My Request
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Request</li>
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
<?php
  echo $this->session->flashdata('msg'); 
  echo validation_errors();
?>

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">

          <div class="box">
            <div class="box-body">
              <a class="btn btn-info" href="<?php echo base_url();?>my_request/request_form"><i class="fa fa-plus"></i>&nbsp;Make a New Request</a><br><br>
              <table class="dtable table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Request ID</th>
                  <th>Subject</th>
                  <th>Requested Date</th>
                  <th>Request Type</th>
                  <th>Closed By</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=0; ?>
                <?php foreach ($request as $r): ?>
                    <tr>
                      <?php $no++; ?>
                      <td style="padding-left: 18px"><?php echo $no;  ?></td>
                      <td style="padding-left: 18px"><?php echo $r->request_no;  ?></td>
                      <td style="padding-left: 18px"><?php echo $r->subject;  ?></td>
                      <td style="padding-left: 18px"><?php echo $r->date; ?></td>
                      <td style="padding-left: 18px"><?php echo $r->type; ?></td>
                      <td style="padding-left: 18px"><?php echo $r->closed_by; ?></td>
                      <td style="padding-left: 18px"><?php if($r->status==0) echo "<font color='red'>On Process</style>"; else echo "<style='color:blue'>Complete</style>";?></td>
                      <td style="padding-left: 18px">
                        <?php if($r->form_file=="") { ?>
                        <!--
                        <a class="btn btn-round btn-info btn-xs" href="#check_id_<?php echo $r->request_id?>" data-toggle="modal">Check Response</a>
                        -->
                        <a class="btn btn-round btn-info btn-xs" href="<?php echo base_url();?>my_request/print_form_request/<?php echo $r->request_id; ?>"><i class="fa fa-print"></i>Print</a>
                        <!--
                        <a class="btn btn-round btn-info btn-xs" href="#upload_file_<?php echo $r->request_id?>" data-toggle="modal">Upload File</a>
                        -->
                      <?php } else{ ?>
                        <a class="btn btn-round btn-warning btn-xs" href="<?php echo base_url('assets/images/form/'.$r->form_file) ?>" target="_blank"><i class="fa fa-arrow-down"></i></a>
                      <?php } ?>
                      </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
              
            </div>
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
        <!--Pop up Check ID-->
        <!--Modal Start here-->      
        <?php foreach($request as $r):?>
          <div class="modal fade" id="check_id_<?php echo $r->request_id;?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" >   
            <form action="<?php echo base_url();?>my_request/check" method="post" data-parsley-validate>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myAddLabel" align="center">Admin Response</h4>
                  </div>
                  <div class="modal-body">
                    <div class="box-body">
                      <div class="alert">
                        <h5><?php echo $r->response; ?></h5>
                      </div>
                    </div>
                    <div align="center">     
                      <input type="hidden" name="request_id" value="<?php echo $r->request_id;?>">
                      <!--<button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>&nbsp;&nbsp;-->
                      <button class="btn btn-danger"  data-dismiss="modal">&nbsp;<i class="fa fa-times">&nbsp;</i></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
           </div>
        <?php endforeach;?>
        <!--Pop up Check ID-->
        <!--Modal End here-->

        <!--Pop up Hapus Data-->
        <!--Modal Start here-->
        <?php foreach($request as $r):?>  
          <div class="modal fade" id="cancel_request_<?php echo $r->request_id;?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" >   
            <form action="<?php echo base_url();?>my_request/cancel_request" method="post" data-parsley-validate>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myAddLabel" align="center">CANCEL REQUEST</h4>
                  </div>
                  <div class="modal-body">                
                    <div class="box-body">
                      <div class="alert alert-danger">
                        <h4>Are you sure?</h4>
                        <h5>Subject : <?php echo $r->subject; ?></h5>
                        <h5>Description : <?php echo $r->description; ?></h5>
                      </div>
                    </div>
                    <div align="center">     
                      <input type="hidden" name="request_id" value="<?php echo $r->request_id;?>">
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>&nbsp;&nbsp;
                      <button class="btn btn-danger"  data-dismiss="modal">&nbsp;<i class="fa fa-times">&nbsp;</i></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
           </div>
        <?php endforeach;?>
        <!--Pop up Hapus Data-->
        <!--Modal End here-->

        <!--Pop up Hapus Data-->
        <!--Modal Start here-->
        <?php foreach($request as $r):?>  
          <div class="modal fade" id="upload_file_<?php echo $r->request_id;?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" >   
            <form action="<?php echo base_url();?>my_request/upload_form_process" enctype="multipart/form-data" method="post" data-parsley-validate>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myAddLabel" align="center">UPLOAD REQUEST FORM</h4>
                  </div>
                  <div class="modal-body">                
                    <div class="box-body">
                      <p>*file type = jpg/jpeg/png/pdf<br>*max size = 1 MB</p>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-file"></i></span>
                        <input name="form_file" type="file" class="form-control" placeholder="Upload Request Form" required>
                      </div><br>
                    </div>
                    <div align="center">     
                      <input type="hidden" name="request_id" value="<?php echo $r->request_id;?>">
                      <input type="hidden" name="request_no" value="<?php echo $r->request_no;?>">
                      <button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button>&nbsp;&nbsp;
                      <button class="btn btn-danger"  data-dismiss="modal">&nbsp;<i class="fa fa-times">&nbsp;</i></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
           </div>
        <?php endforeach;?>
        <!--Pop up Hapus Data-->
        <!--Modal End here-->