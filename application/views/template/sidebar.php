<?php 
    $where = array('status' => 0);
    $new_request = $this->models->jumlah_data_where('request', $where);
?>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/img/avatar5.png') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('name'); ?></p>

                <a ><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="<?php echo site_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class=" pull-right"></i>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Master</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('site') ?>"><i class="fa fa-circle-o"></i> Site</a></li>
                    <li><a href="<?php echo site_url('karyawan') ?>"><i class="fa fa-circle-o"></i> Employee</a></li>
                    <li><a href="<?php echo site_url('admin') ?>"><i class="fa fa-circle-o"></i> Admin</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-exclamation"></i>
                    <span>Request</span>
                    <span class="label label-danger pull-right"><?php echo $new_request ?></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('requestor') ?>"><i class="fa fa-circle-o"></i> New Request
                        <span class="label label-danger pull-right"><?php echo $new_request ?></span></a></li>
                    <li><a href="<?php echo site_url('requestor/done') ?>"><i class="fa fa-circle-o"></i> Done</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?php echo site_url('report') ?>">
                    <i class="fa fa-file"></i> <span>Report</span> <i class=" pull-right"></i>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">