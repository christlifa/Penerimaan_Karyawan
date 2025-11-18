<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin-<?php echo $content_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- sweet alert -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/sweetalert/dist/sweetalert.css'); ?>">
  <!--datatables -->
  <link rel="stylesheet" href="<?php echo base_url('bower_components/datatables/media/css/dataTables.bootstrap.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/AdminLTE.min.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/dist/css/skins/_all-skins.min.css'); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/datepicker/datepicker3.css'); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/daterangepicker/daterangepicker.css'); ?>">
  <!-- bootstrap wysihtml5 - text editor -->

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.new.css'); ?>">
  <!-- jQuery 3.1.1 -->
  <script src="<?php echo base_url('bower_components/jquery/dist/jquery.min.js'); ?>"></script>
  <!-- jquery form -->
  <script src="<?php echo base_url('bower_components/jquery-form/dist/jquery.form.min.js'); ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
  <!-- vue js -->
  <script src="<?php echo base_url('bower_components/vue/dist/vue.min.js'); ?>"></script>
  <!-- sweetalert -->
  <script src="<?php echo base_url('bower_components/sweetalert/dist/sweetalert.min.js'); ?>" type="text/javascript"></script>
  <!-- validate.js -->
  <script src="<?php echo base_url('bower_components/jquery-validation/dist/jquery.validate.min.js'); ?>"></script>

  <!-- url -->
  <script type="text/javascript">
      window.APP = {
         siteUrl: "<?php echo site_url(); ?>/",
         baseUrl: "<?php echo base_url(); ?>",
      }
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
</head>
<body class="skin-blue-light sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('adm/dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
      <b>
        <?php echo $this->config->item('app_name_short'); ?>
      </b>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      <b>
      <?php echo $this->config->item('app_name'); ?>
      </b>
      </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <span style="color: #FFF; font-size: 14px;margin-top: 15px;position: absolute;">
      Senin, 24 Juli 2017  14:31:05
      </span>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav"> 
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url('assets/adminlte/img/user.png'); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo logged_user('NickName'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url('assets/adminlte/img/user.png'); ?>" class="img-circle" alt="User Image">
                <p>
                  <?php echo logged_user('NickName'); ?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  -->
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('adm/dashboard/logout'); ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/adminlte/img/user.png'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo logged_user('nama'); ?></p>
            <i class="fa fa-circle text-success"></i> Online
        </div>
      </div>
      <?php $this->load->view('adm/menu'); ?>
  </aside>

