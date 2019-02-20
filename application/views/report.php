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
<!-- Datatables-->
<link href="<?php echo base_url();?>assets/DataTables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/DataTables/media/css/dataTables.css" rel="stylesheet" type="text/css">
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Report
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Report</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">


    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">
            <?php echo $this->session->flashdata('msg'); ?>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
              <!-- FILTER FORM -->
              <form action="<?php echo base_url(). 'report/excel_export'; ?>" method="post">
                <div class="col-lg-1">
                  Date<br><br><br>
                  Type
                </div>
                <div class="col-lg-2">
                  <input style="width:150px;" value="<?php echo date('Y-m-d'); ?>" name="start_date" type="date" class="form-control" placeholder="Start Date">
                  <br>
                  <select style="width:150px;" name="type" class="form-control" required >
                  <option value="*" selected> All</option>
                  <option value="AI">AilisXE</option>
                  <option value="GL">G-Link</option>
                  <option value="GC">GCC</option>
                  <option value="MD">MDG S/4 HANA System</option>
                  <option value="NS">nSolution</option>
                  <option value="SP">SAP S/4 HANA System</option>
                  <option value="EI">Email ID (@cjlogistics.co.id)</option>
                  <option value="VN">VPN</option>
                  <option value="WF">CJ-Guest ID</option>
                  <option value="IS">InfraStructure (PC/Notebook Issue)</option>
                </select>
                </div>
                <div class="col-lg-2">
                  <input style="width:150px;" value="<?php echo date('Y-m-d'); ?>" name="end_date" type="date" class="form-control" placeholder="End Date"><br>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-1">
                  Site
                </div>
                <div class="col-lg-2">
                  <select style="width:150px;" name="site_id" class="form-control" required >
                  <option value="*" selected> All</option>
                  <?php foreach ($site as $s): ?>
                    <option value="<?php echo $s->site_id; ?>"><?php echo $s->site_name; ?></option>
                  <?php endforeach; ?>
                </select>
                </div>
                <div class="col-lg-2">
                </div>
                <div class="col-lg-12">
                  <center>
                    <input type="submit" name="Export to Excel" value="Export to Excel" class="btn btn-round btn-primary">
                  </center>
                  <br><br>
                </div>
              </form>
              <!-- /.FILTER FORM -->
              <div class="row">
              </div>
            </div>
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

        <!--Pop up Check ID-->
        <!--Modal Start here-->      
        <?php foreach($request as $r):?>  

          <div class="modal fade" id="check_id_<?php echo $r->request_id;?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" >   
            <form action="<?php echo base_url();?>my_request/check" method="post" data-parsley-validate>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myAddLabel" align="center">Response</h4>
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