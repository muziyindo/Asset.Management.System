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
    <link href="<?php echo base_url(); ?>asset/datepicker/jquery-ui.css" rel="stylesheet">

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
      <body class="skin-black" >
        <!-- header logo: style can be found in header.less -->
        <?php
             $uname = $this->session->userdata('uname');
             $fname = $this->session->userdata('fname');
             $lname = $this->session->userdata('lname');

             error_reporting(E_ERROR|E_WARNING);
        ?>
        <header class="header">
            <a href="#" class="logo">
                <img src="<?php echo base_url(); ?>asset/images/qlogo.png"></img>
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
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>-->
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                                <small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Director Design Team

                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                                <small class="pull-right"><i class="fa fa-clock-o"></i> 2 hours</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers

                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                                <small class="pull-right"><i class="fa fa-clock-o"></i> Today</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department

                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                                <small class="pull-right"><i class="fa fa-clock-o"></i> Yesterday</small>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers

                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                                <small class="pull-right"><i class="fa fa-clock-o"></i> 2 days</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <li class="dropdown tasks-menu">
                            <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-tasks"></i>
                                <span class="label label-danger">9</span>
                            </a>-->
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress progress-striped xs">
                                                    <div class="progress-bar progress-bar-success" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
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
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
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
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
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
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
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
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="<?php echo base_url() ; ?>asset/tmp_img/26115.jpg" class="img-circle" alt="User Image" />
                                </div>
                                <div class="pull-left info">
                                    <!--<p>Hello, <?php echo ucfirst($uname) ; ?></p>-->

                                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                                </div>
                            </div>
                            <!-- search form -->
                            <form class="sidebar-form" action="<?php echo site_url('qlip_controller/view_loan_primera/1/'); ?>" method="post" accept-charset="utf-8">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                            <!-- /.search form -->
                            <!-- sidebar menu: : style can be found in sidebar.less -->
                            <ul class="sidebar-menu">
                                <?php
                                //$user_viewing = 0; $view_mode=0 ;
                                $uname_session = $this->session->userdata('uname');
                                //get id to determine if someone is currently viewing this particular record
                                $sql = "select view_mode,user_viewing from lasg_staff_info where view_mode='on' and user_viewing = '$uname'";
                                $query = $this->db->query($sql);
                                foreach ($query->result() as $mode_val)
                                {
                                    $view_mode = $mode_val->view_mode ;
                                    $user_viewing = $mode_val->user_viewing ;
                                    //$uname_session = $this->session->userdata('uname');
                                }

                                ?>

                                <?php
                                    if($uname_session == $user_viewing && $view_mode == "on")
                                    {
                            
                                ?>
                                    
                                <li class="active">
                                    <a href="<?php echo site_url(); ?>/qlip_controller/unlock_view_mode" style="color:white" data-toggle="tooltip" title="You have locked a loan-record, Click on this to unlock view-mode">
                                        <i class="fa fa-lock"></i> <span>Unlock View-Mode</span>
                                    </a>
                                </li>

                                <?php 
                                   
                                    } 
                                    else
                                    {
                                ?>

                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/open_primera_section">
                                        <i class="fa fa-globe"></i> <span>Dashbaord</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_loan_primera">
                                        <i class="fa fa-users"></i> <span>Posted Loan(All users)</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_t24push_status">
                                        <i class="fa fa-users"></i> <span>T-24 Push Status</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_qlip_uploads">
                                        <i class="fa fa-users"></i> <span>Qlip Uploads</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_due_payments_primera">
                                        <i class="fa fa-globe"></i> <span>Due Payments</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/view_reconciliation">
                                        <i class="fa fa-users"></i> <span>Reconciliation</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo site_url(); ?>/qlip_controller/change_password/l3/<?php echo $uname; ?>">
                                        <i class="fa fa-globe"></i> <span>Change Password</span>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>

                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                <aside class="right-side">

                <!-- Main content -->
                <section class="content"> <!--style="background:url(<?php echo base_url(); ?>asset/images/1.jpg) center top; background-size: cover;">-->

                    <div class="row" style="margin-bottom:5px;">


                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-green"><i class="fa fa-thumbs-up"></i></span><!--fa-check-square-o-->
                                <div class="sm-st-info">
                                    <span><?php echo $approved_count ; ?></span>
                                    <a href="<?php echo site_url('qlip_controller/search_filter_dashboard_primera/level2/approved'); ?>">Total Approved</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-violet"><i class="fa fa-envelope-o"></i></span>
                                <div class="sm-st-info">
                                    <span><?php echo $pending_count ; ?></span>
                                    <a href="<?php echo site_url('qlip_controller/search_filter_dashboard_primera/level2/pending'); ?>">Pending Approval</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-red"><i class="fa fa-times"></i></span><!--st-blue-->
                                <div class="sm-st-info">
                                    <span><?php echo $declined_count ; ?></span>
                                    <a href="<?php echo site_url('qlip_controller/search_filter_dashboard_primera/level2/declined'); ?>">Loan Declined</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="sm-st clearfix">
                                <span class="sm-st-icon st-blue"><i class="fa fa-check-square-o"></i></span><!--fa-paperclip-->
                                <div class="sm-st-info">
                                    <span><?php echo ($approved_count+$pending_count+$declined_count) ; ?></span>
                                    Total Application
                                </div>
                            </div>
                        </div>
                    </div>