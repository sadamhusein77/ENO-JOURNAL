<div class="app-content content">
     <div class="content-wrapper">
       <div class="content-wrapper-before"></div>
       <div class="content-header row">
         <div class="content-header-left col-md-4 col-12 mb-2">
           <h3 class="content-header-title"><?= $card ?></h3>
         </div>
         <div class="content-header-right col-md-8 col-12">
           <div class="breadcrumbs-top float-md-right">
             <div class="breadcrumb-wrapper mr-1">
               <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/index' ?>">Home</a>
                 </li>
                 <li class="breadcrumb-item active"><?= $card ?>
                 </li>
               </ol>
             </div>
           </div>
         </div>
       </div>
       <div class="content-body">
          <!-- Dashboard Admin -->
         <?php
         if($this->session->userdata('id_role')=="1"){ ?>
         <!-- Minimal statistics with bg color section start -->
         <section id="minimal-statistics-bg">
    <div class="row">
        <div class="col-12 mt-3 mb-1">
            <h4 class="text-uppercase"><?= $card ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-x-purple-blue">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-top">
                                <i class="ft-slack icon-opacity text-white font-large-4 float-left"></i>
                            </div>
                            <div class="media-body text-white text-right align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Total Role</span>
                                <h1 class="text-white mb-0"><?php echo $total_role ?></h1>
                                <a class="text-white pull-left" href="<?php echo base_url().'admin/role' ?>"><i class="la la-chevron-right"> Details</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-x-purple-red">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-top">
                                <i class="ft-users icon-opacity text-white font-large-4 float-left"></i>
                            </div>
                            <div class="media-body text-white text-right align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Total Users</span>
                                <h1 class="text-white mb-0"><?php echo $total_user ?></h1>
                                <a class="text-white pull-left" href="<?php echo base_url().'admin/user' ?>"><i class="la la-chevron-right"> Details</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-x-blue-green">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-top">
                                <i class="ft-clipboard icon-opacity text-white font-large-4 float-left"></i>
                            </div>
                            <div class="media-body text-white text-right align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Total Customers</span>
                                <h1 class="text-white mb-0"><?php echo $total_customer ?></h1>
                                <a class="text-white pull-left" href="<?php echo base_url().'admin/customer' ?>"><i class="la la-chevron-right"> Details</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-x-orange-yellow">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-top">
                                <i class="la la-cubes icon-opacity text-white font-large-4 float-left"></i>
                            </div>
                            <div class="media-body text-white text-right align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Total Vendors</span>
                                <h1 class="text-white mb-0"><?php echo $total_vendor ?></h1>
                                <a class="text-white pull-left" href="<?php echo base_url().'admin/vendor' ?>"><i class="la la-chevron-right"> Details</i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-directional-warning">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Total Account</span>
                                <h1 class="text-white mb-0"><?php echo $total_account ?></h1>
                                <a class="text-white pull-right" href="<?php echo base_url().'admin/account' ?>"><i class="la la-chevron-right"> Details</i></a>
                            </div>
                            <div class="align-self-top">
                                <i class="la la-book icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card bg-gradient-directional-success">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Total Services</span>
                                <h1 class="text-white mb-0"><?php echo $total_services ?></h1>
                                <a class="text-white pull-right" href="<?php echo base_url().'admin/service' ?>"><i class="la la-chevron-right"> Details</i></a>
                            </div>
                            <div class="align-self-top">
                                <i class="la la-th-list icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- End Dashboard Admin -->
<!-- // Minimal statistics with bg color section end -->
        </div>
      </div>
    </div>
    <!-- END: Content-->
