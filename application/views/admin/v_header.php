<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
  <meta name="keywords" content="cash flow, eno fotocopy, eno journal, cash, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
  <meta name="author" content="ThemeSelect">
  <title><?= $title ?></title>
  <link rel="apple-touch-icon" href="<?php echo base_url(); ?>assets/theme-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/theme-assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/vendors/css/vendors.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/vendors/css/forms/toggle/switchery.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/plugins/forms/switch.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/core/colors/palette-switch.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/vendors/css/tables/datatable/datatables.min.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN CHAMELEON  CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/bootstrap-extended.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/colors.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/components.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/fonts/simple-line-icons/style.min.css"> -->
  <!-- END CHAMELEON  CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/core/menu/menu-types/vertical-menu.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/css/core/colors/palette-gradient.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme-assets/vendors/css/documentation.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
    <div class="navbar-wrapper">
      <div class="navbar-container content">
        <div class="collapse navbar-collapse show" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="ft-menu"></i></a></li>
            <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
            <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
              <ul class="dropdown-menu">
                <li class="arrow_box">
                  <form>
                    <div class="input-group search-box">
                      <div class="position-relative has-icon-right full-width">
                        <input class="form-control" id="search" type="text" placeholder="Search here...">
                        <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                      </div>
                    </div>
                  </form>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="<?php echo base_url('assets/theme-assets/images/portrait/small/'.$profile->foto); ?>" alt="avatar"><i></i></span></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="user-name text-bold-700 text-sm ml-1"><?php echo $profile->fullname ?></span></span></a>
                  <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo base_url().'admin/profile' ?>"><i class="ft-user"></i> Profile</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo base_url().'auth/logout' ?>"><i class="ft-power"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true" data-img="<?php echo base_url(); ?>assets/theme-assets/images/backgrounds/02.jpg">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url().'admin/index' ?>"><img class="brand-logo" alt="Chameleon admin logo" src="<?php echo base_url(); ?>assets/theme-assets/images/logo/logo.png"/>
            <h3 class="brand-text">Eno Journal</h3></a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
          </ul>
        </div>
        <div class="navigation-background"></div>
        <div class="main-menu-content">
          <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <!-- Menu Admin !-->
            <?php
            if($this->session->userdata('id_role')=="1"){ ?>
              <li <?=$this->uri->segment(2) == 'index' ? 'class="active"' : ''?> class="nav-item"><a href="<?php echo base_url().'admin/index' ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'role' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/role' ?>"><i class="ft-slack"></i><span class="menu-title" data-i18n="">Role</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'user' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/user' ?>"><i class="ft-users"></i><span class="menu-title" data-i18n="">User</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'customer' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/customer' ?>"><i class="ft-clipboard"></i><span class="menu-title" data-i18n="">Customer</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'vendor' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/vendor' ?>"><i class="la la-cubes"></i><span class="menu-title" data-i18n="">Vendor</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'account' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/account' ?>"><i class="la la-book"></i><span class="menu-title" data-i18n="">Account Journal</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'services' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/service' ?>"><i class="la la-th-list"></i><span class="menu-title" data-i18n="">Service</span></a>
              </li>
              <!-- <li <?=$this->uri->segment(2) == 'report' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'admin/report' ?>"><i class="la la-bar-chart"></i><span class="menu-title" data-i18n="">Report</span></a>
              </li> -->
            <?php } ?>
            <!-- End Menu Admin !-->
          </ul>
        </div>
      </div>
