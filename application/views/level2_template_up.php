<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php  echo $title ; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="description" content="Developed By M Abdur Rokib Promy">
    <meta name="keywords" content="Admin, Bootstrap 3, Template, Theme, Responsive">
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Date Picker -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>asset/datepicker/jquery-ui.css" rel="stylesheet">
    <!-- fullCalendar -->
    <!-- <link href="tmp_css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- <link href="tmp_css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="<?php echo base_url() ; ?>asset/tmp_css/style.css" rel="stylesheet" type="text/css" />

    <!--<link href="<?php echo base_url() ; ?>asset/bs_css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ; ?>asset/bs_css/styles.css" rel="stylesheet">
    <link href="<?php echo base_url() ; ?>asset/bs_css/toastr.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>asset/bs_js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/bs_js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/bs_js/toastr.js"></script>-->




    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

          
      </head>
      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php
             $uname = $this->session->userdata('uname');
             $fname = $this->session->userdata('fname');
             $lname = $this->session->userdata('lname');
             
        ?>
        <header class="header" >
            <a href="#" class="logo">
                Q-LIP
                <!--<img src="<?php echo base_url(); ?>asset/images/qlogo.png"></img>-->
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                        <?php   
                                $pa_count = 0 ;
                                $rs=mysql_query("select count(*) from lasg_staff_info where l2_approved='no' and status = 'pending'");
                                while($row = mysql_fetch_array($rs))
                                {
                                    $pa_count = $row['count(*)'];
                                }

                        ?>

                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success"><?php echo $pa_count ; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" style="text-align:center">Notification</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Pending Authorization
                                                </h4>
                                                <p><a href="<?php echo site_url('qlip_controller/search_filter_dashboard/level2/pending_auth'); ?>">You have <?php echo $pending_authorized_count ; ?> loans pending authorization</a></p>
                                                <!--<small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small>-->
                                            </a>
                                        </li><!-- end message -->
                                        
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Copyright &copy; primera, 2015</a></li>
                            </ul>
                        </li>
                        
                        <?php   
                                $rejected_count = 0 ;
                                $rs=mysql_query("select count(*) from lasg_staff_info where status='rejected'");
                                while($row = mysql_fetch_array($rs))
                                {
                                    $rejected_count = $row['count(*)'];
                                }

                        ?>
                        <!--Rejected Notifications-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-spinner fa-spin"></i>
                                <span class="label label-warning"><?php echo $rejected_count ; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" style="text-align:center">Notification</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Rejected Loans
                                                </h4>
                                                <p><a href="<?php echo site_url('qlip_controller/search_filter_dashboard/level2/rejected'); ?>">You have <?php echo $rejected_count ; ?> rejected loans </a></p>
                                                <!--<small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small>-->
                                            </a>
                                        </li><!-- end message -->
                                    </ul>

                                    
                                </li>
                                <li class="footer"><a href="#">Copyright &copy; primera, 2015</a></li>
                            </ul>
                        </li>

                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger"><?php echo $authorized_count ; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" style="text-align:center">Total Loan Authorized </li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <a href="<?php echo site_url('qlip_controller/search_filter_dashboard/level2/authorized'); ?>"><h3>
                                                    Current count is = 
                                                    <small class="pull-right"><?php echo $authorized_count ; ?></small>
                                                </h3></a>
                                                <div class="progress progress-striped xs">
                                                    <div class="progress-bar progress-bar-success" style="width: <?php echo $authorized_count ; ?>%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <!--<li>
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress progress-striped xs">
                                                    <div class="progress-bar progress-bar-danger" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress progress-striped xs">
                                                    <div class="progress-bar progress-bar-info" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress progress-striped xs">
                                                    <div class="progress-bar progress-bar-warning" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>-->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">Copyright &copy; primera, 2015</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?php echo ucfirst($lname)." ".ucfirst($fname) ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                                <li class="dropdown-header text-center">Account</li>

                                <!--<li>
                                    <a href="#">
                                    <i class="fa fa-clock-o fa-fw pull-right"></i>
                                        <span class="badge badge-success pull-right">10</span> Updates</a>
                                    <a href="#">
                                    <i class="fa fa-envelope-o fa-fw pull-right"></i>
                                        <span class="badge badge-danger pull-right">5</span> Messages</a>
                                    <a href="#"><i class="fa fa-magnet fa-fw pull-right"></i>
                                        <span class="badge badge-info pull-right">3</span> Subscriptions</a>
                                    <a href="#"><i class="fa fa-question fa-fw pull-right"></i> <span class=
                                        "badge pull-right">11</span> FAQ</a>
                                </li>-->
                                <li class="divider"></li>

                                    <!--<li>
                                        <a href="#">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                            Profile
                                        </a>
                                        <a data-toggle="modal" href="#modal-user-settings">
                                        <i class="fa fa-cog fa-fw pull-right"></i>
                                            Settings
                                        </a>
                                        </li>-->

                                        <li class="divider"></li>

                                        <li>
                                            <a href="<?php echo site_url(); ?>/qlip_controller/logout"><i class="fa fa-ban fa-fw pull-right"></i> Logout</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas"><!--style="position:fixed;"-->
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <p>Hello, <?php echo ucfirst($uname) ; ?></p>

                                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                </div>
                            </div>
                            <!-- search form -->
                             <!--<?php echo site_url('qlip_controller/view_loan_level2/1/'); ?>-->
                            <?php 
                            if(isset($indicator)){
                            ?>
                            <form class="sidebar-form" action="<?php echo site_url('qlip_controller/view_uploaded_files/1/'); ?>" method="post" accept-charset="utf-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <?php } else if(isset($breakdown)){ ?>
                            <form class="sidebar-form" action="<?php echo site_url('qlip_controller/open_level2_section/1/'); ?>" method="post" accept-charset="utf-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <?php } else { ?>
                            <form class="sidebar-form" action="<?php echo site_url('qlip_controller/view_loan_level2/1/'); ?>" method="post" accept-charset="utf-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <?php } ?>
                            <!-- /.search form -->
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <ul class="sidebar-menu" >
                                <li class="active">
                                    <a href="<?php echo site_url(); ?>/qlip_controller/open_level2_section">
                                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="#">
                                        <i class="fa fa-gavel"></i> <span>New Loan</span>
                                    </a>
                                </li>-->

                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_loan_level2">
                                        <i class="fa fa-users"></i> <span>Posted Loan(All users)</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/upload_files_view">
                                        <i class="fa fa-globe"></i> <span>Upload Deduction Report</span>
                                    </a>
                                </li>
                                <!--<li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_uploaded_files">
                                        <i class="fa fa-globe"></i> <span>Uploaded Reports</span>
                                    </a>
                                </li>-->
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_qlip_uploads/l2">
                                        <i class="fa fa-globe"></i> <span>File Upload Status</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_due_payments_l2">
                                        <i class="fa fa-globe"></i> <span>Due Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_reconciliation_l2">
                                        <i class="fa fa-users"></i> <span>Reconciliation</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/change_password/l2/<?php echo $uname; ?>">
                                        <i class="fa fa-globe"></i> <span>Change Password</span>
                                    </a>
                                </li>

                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                <aside class="right-side">

                <!-- Main content -->
                <section class="content">

                    <div class="row" style="margin-bottom:5px;">

                        <!--<div style="margin-bottom:5px; height:117px; background:white; margin-left:15px; margin-right:15px; ">-->                       
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-thumbs-up"></i></span><!--fa-check-square-o-->
                                <div class="sm-st-info" >
                                    <span><?php echo $approved_count ; ?></span>
                                    <a href="<?php echo site_url('qlip_controller/search_filter_dashboard/level2/approved'); ?>">Total Approved</a>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-2">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-purple"><i class="fa fa-thumbs-up"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $authorized_count ; ?></span>
                                    Total Authorized
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-envelope-o"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $pending_count ; ?></span>
                                    <a href="<?php echo site_url('qlip_controller/search_filter_dashboard/level2/pending'); ?>">Pending Approval</a>
                                </div>
                            </div>
                        </div>
                        <!--<div class="col-md-2">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-black"><i class="fa fa-envelope-o"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $pending_authorized_count ; ?></span>
                                    Pending Authorization
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-times"></i></span><!--st-blue-->
                                <div class="sm-st-info">
                                    <span><?php echo $declined_count ; ?></span>
                                    <a href="<?php echo site_url('qlip_controller/search_filter_dashboard/level2/declined'); ?>">Loan Declined</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-check-square-o"></i></span><!--fa-paperclip-->
                                <div class="sm-st-info">
                                    <span><?php echo ($authorized_count+$pending_authorized_count) ; ?></span>
                                    Total Application
                                </div>
                            </div>
                        </div>
                      <!--</div>-->
                    </div>