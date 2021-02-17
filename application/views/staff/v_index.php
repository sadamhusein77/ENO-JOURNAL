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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/index' ?>">Home</a>
              </li>
              <li class="breadcrumb-item active"><?= $card ?>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Start Content -->
    <div class="content-body">
      <!-- chartist line charts section start -->

      <!-- Line Chart With Area -->
      <div class="row">
        <div class="col-xl-6 col-lg-12">
          <div class="card pull-up">
            <div class="card-header">
              <h4 class="card-title">Recent Buyer</h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="reload">
                      <i class="ft-rotate-cw"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-content">
              <div id="recent-buyers" class="media-list">
                <a href="#" class="media border-0">
                  <div class="media-left pr-1">
                    <span class="avatar avatar-md">
                      <img class="media-object rounded-circle" src="<?php echo base_url(); ?>assets/theme-assets/images/portrait/small/avatar-s-7.png" alt="avatar">
                      <i></i>
                    </span>
                  </div>
                  <div class="media-body w-100">
                    <span class="list-group-item-heading">Kristopher Candy

                    </span>
                    <ul class="list-unstyled users-list m-0 float-right">
                      <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Product 1" class="avatar avatar-sm pull-up">

                      </li>
                    </ul>
                    <p class="list-group-item-text mb-0">
                      <span class="blue-grey lighten-2 font-small-3"> #INV-12332 </span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-lg-12">
          <div class="card pull-up">
            <div class="card-header">
              <h4 class="card-title">User Last Login</h4>
              <a class="heading-elements-toggle">
                <i class="fa fa-ellipsis-v font-medium-3"></i>
              </a>
              <div class="heading-elements">
                <ul class="list-inline mb-0">
                  <li>
                    <a data-action="reload">
                      <i class="ft-rotate-cw"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <?php
            $no = 1;
            if( ! empty($user)){ // Jika data siswa tidak sama dengan kosong, artinya jika data siswa ada
              foreach($user as $u){
                ?>
            <div class="card-content">
              <div id="recent-buyers" class="media-list">
                <a href="#" class="media border-0">
                  <div class="media-left pr-1">
                    <span class="avatar avatar-md">
                      <img class="media-object rounded-circle" src="<?php echo base_url('assets/theme-assets/images/portrait/small/'.$u->foto); ?>" alt="avatar">
                    </span>
                  </div>
                  <div class="media-body w-100">
                    <span class="list-group-item-heading">
                      <?= $u->fullname?>
                    </span>
                    <ul class="list-unstyled float-right">
                      <li>
                        <?= date('d F Y H:i:s', $u->last_login);?>
                      </li>
                    </ul>
                    <p class="list-group-item-text mb-0">
                      <span class="blue-grey lighten-2 font-small-3"> <?= $u->email?> </span>
                    </p>
                  </div>
                </a>
              </div>
            </div>
          <?php } ?>
        <?php } else{ // Jika data siswa kosong
          echo "<tr><td align='center' colspan='7'>Data Tidak Ada</td></tr>";
        }
        ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END: Content-->
