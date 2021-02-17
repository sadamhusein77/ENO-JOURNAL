<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/index' ?>">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">Admin Profile
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  <div class="sidebar-detached sidebar-left">
    <div class="sidebar"><div class="bug-list-sidebar-content">
      <!-- Predefined Views -->
      <div class="card">
        <div class="card-head">
          <div class="align-self-center halfway-fab text-center p-1">
            <span class="avatar avatar-lg avatar-online rounded-circle"><img src="<?php echo base_url('assets/theme-assets/images/portrait/small/'.$profile->foto); ?>" alt="avatar"></span>
          </div>
          <div class="text-center">
            <span class="font-medium-2 text-uppercase"><?= $profile->fullname?></span>
            <p class="blue-grey font-small-2"><?= $profile->role_name?></p>
          </div>
        </div>

        <div class="card-body border-top-blue-grey border-top-lighten-5">
          <!-- contacts view -->
          <div class="card-content">
          <div class="card-body card-body p-0 pt-0 pb-">
              <div class="table-responsive-sm">
              <table class="table table-borderless">
                <tr>
                  <th>Date Join : </th>
                </tr>
                <tr>
                  <td><?= date('d F Y', $profile->date_created);?></td>
                </tr>
                <tr>
                  <th>Last Login : </th>
                </tr>
                <tr>
                  <td><?= date('d F Y H:i:s', $profile->last_login);?></td>
                </tr>
              </table>
              </div>
          </div>
          </div>
        </div>

      </div>
      <!--/ Predefined Views -->

    </div>
  </div>
</div>
<div class="content-detached content-right">
  <div class="content-body">
    <section class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-head">
          <div class="card-header">
            <h4 class="card-title"><?= $card ?></h4>
          </div>
        </div>
        <div class="card-content">
          <div class="card-body">
            <hr>
            <div class="table-responsive">
              <table class="table table-borderless">
                <tbody>
                  <tr>
                    <th width="15px">Fullname</th>
                    <td width="5px">:</td>
                    <td><?= $profile->fullname?></td>
                  </tr>
                  <tr>
                    <th width="15px">Email</th>
                    <td width="5px">:</td>
                    <td><?= $profile->email?></td>
                  </tr>
                  <tr>
                    <th width="15px">Address</th>
                    <td width="5px">:</td>
                    <td><?= $profile->address?></td>
                  </tr>
                  <tr>
                    <th width="15px">Gender</th>
                    <td width="5px">:</td>
                    <td><?php
                    if ($profile->gender == 1) {
                      echo "Male";
                    } elseif ($profile->gender == 2) {
                      echo "Female";
                    } else {
                      echo "Not set";
                    }
                    ?></td>
                  </tr>
                  <tr>
                    <th width="15px">Role</th>
                    <td width="5px">:</td>
                    <td><?= $profile->role_name?></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <div class="dropdown dropleft">
              <a class="btn btn-info btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="float: right">
              <i class="la la-cogs"></i>
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a href="<?php echo base_url().'admin/ubah_profile/'.$profile->id_user; ?>" class="btn btn-sm btn-warning ml-1" data-toggle="popover" data-content="Edit Profile" data-trigger="hover"><i class="la la-edit"></i></a>
                <a href="<?php echo base_url().'admin/password/'?>" class="btn btn-sm btn-info" data-toggle="popover" data-content="Edit Password" data-trigger="hover"><i class="la la-lock"></i></a>
                <!-- <a class="dropdown-item" href="#">#</a> -->
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>
</div>
</div>
<!-- END: Content-->
