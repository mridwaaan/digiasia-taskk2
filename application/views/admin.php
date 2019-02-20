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
        Admin
        <small>Master</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 ">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <a class="btn btn-info" href="<?php echo base_url();?>admin/add_admin"><i class="fa fa-plus"></i>&nbsp;New Admin</a><br><br>
              <table class="dtable table-bordered table-striped">
                <thead>
                <tr>
                  <th>Username</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=0; ?>
                <?php foreach ($admin as $a): ?>
                    <tr>
                      <td style="padding-left: 18px"><?php echo $a->username; ?></td>
                      <td style="padding-left: 18px"><?php echo $a->admin_name; ?></td>
                      <td style="padding-left: 18px"><?php echo $a->admin_email; ?></td>
                      <td style="padding-left: 18px"><a class="btn btn-round btn-info btn-xs" href="<?php echo base_url();?>admin/edit_admin/<?php echo $a->admin_id; ?>"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-round btn-danger btn-xs" href="#hapus_<?php echo $a->admin_id?>" data-toggle="modal"><span class="fa fa-trash-o"></span></a>
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

<!--Pop up Hapus Data-->
        <!--Modal Start here-->
        <?php foreach($admin as $a):?>  
          <div class="modal fade" id="hapus_<?php echo $a->admin_id;?>" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true" >   
            <form action="<?php echo base_url();?>admin/delete_admin" method="post" data-parsley-validate>
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myAddLabel" align="center">DELETE DATA</h4>
                  </div>
                  <div class="modal-body">                
                    <div class="box-body">
                      <div class="alert alert-danger">
                        <h4>Are you sure?</h4>
                        <h5>NIK : <?php echo $a->admin_id; ?></h5>
                        <h5>Name : <?php echo $a->name; ?></h5>
                      </div>
                    </div>
                    <div align="center">
                      <input type="hidden" name="admin_id" value="<?php echo $a->admin_id;?>">
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