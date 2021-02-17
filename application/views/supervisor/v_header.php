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
            <?php
            if($this->session->userdata('id_role')=="2"){ ?>
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right"><a class="dropdown-item" href="#"><i class="la la-check-square"></i> Approval PR</a><a class="dropdown-item" href="#"><i class="ft-bookmark"></i> Approval PR</a></div>
                </div>
              </li>
            <?php } ?>
            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="<?php echo base_url('assets/theme-assets/images/portrait/small/'.$this->session->userdata('foto')); ?>" alt="avatar"><i></i></span></a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="user-name text-bold-700 text-sm ml-1"><?php echo $this->session->userdata('fullname') ?></span></span></a>
                  <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo base_url().'dashboard/profile' ?>"><i class="ft-user"></i> Profile</a><a class="dropdown-item" href="<?php echo base_url().'dashboard/inbox' ?>"><i class="ft-mail"></i> My Inbox</a><a class="dropdown-item" href="#">
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


    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow " data-scroll-to-active="true">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mr-auto"><a class="navbar-brand" href="<?php echo base_url().'dashboard/index' ?>"><img class="brand-logo" alt="Chameleon admin logo" src="<?php echo base_url(); ?>assets/theme-assets/images/logo/logo.png"/>
            <h3 class="brand-text">Eno Journal</h3></a></li>
            <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
          </ul>
        </div>
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
            <?php } ?>
            <!-- End Menu Admin !-->

            <!-- Menu Supervisor !-->
            <?php
            if($this->session->userdata('id_role')=="2"){ ?>
              <li <?=$this->uri->segment(2) == 'index' ? 'class="active"' : ''?> class="nav-item"><a href="<?php echo base_url().'supervisor/index' ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'apppr' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'supervisor/apppr' ?>"><i class="la la-check-square"></i><span class="menu-title" data-i18n="">Approval PR</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'apppo' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'supervisor/apppo' ?>"><i class="la la-check-circle"></i><span class="menu-title" data-i18n="">Approval PO</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'report' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'supervisor/report' ?>"><i class="la la-bar-chart"></i><span class="menu-title" data-i18n="">Report</span></a>
              </li>
            <?php } ?>
            <!-- End Menu Supervisor !-->

            <!-- Menu staff !-->
            <?php
            if($this->session->userdata('id_role')=="3"){ ?>
              <li <?=$this->uri->segment(2) == 'index' ? 'class="active"' : ''?> class="nav-item"><a href="<?php echo base_url().'staff/index' ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'cashin' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'staff/cashin' ?>"><i class="la la-money"></i><span class="menu-title" data-i18n="">Cash In</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'cashout' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'staff/cashout' ?>"><i class="la la-opencart"></i><span class="menu-title" data-i18n="">Cash Out</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'order' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'staff/order' ?>"><i class="la la-shopping-cart"></i><span class="menu-title" data-i18n="">Order</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'ordernote' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'staff/ordernote' ?>"><i class="la la-tag"></i><span class="menu-title" data-i18n="">Order Note</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'purchaserequest' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'staff/purchaserequest' ?>"><i class="la la-thumb-tack"></i><span class="menu-title" data-i18n="">Purchase Request</span></a>
              </li>
              <li <?=$this->uri->segment(2) == 'purchaseorder' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'staff/purchaseorder' ?>"><i class="la la-phone"></i><span class="menu-title" data-i18n="">Purchase Order</span></a>
              </li>
            <?php } ?>
            <!-- End Menu staff !-->

            <!-- Menu join supervisor and staff !-->
            <?php
            if($this->session->userdata('id_role')=="2" || $this->session->userdata('id_role')=="3"){ ?>
              <li <?=$this->uri->segment(2) == 'invoice' ? 'class="active"' : ''?> class=" nav-item"><a href="<?php echo base_url().'join/invoice' ?>"><i class="la la-file-text"></i><span class="menu-title" data-i18n="">Invoice</span></a>
              </li>
            <?php } ?>
            <!-- End Menu join supervisor and staff !-->
          </ul>
        </div>
      </div>
