<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Password</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/profile' ?>">Home</a>
              </li>
              <li class="breadcrumb-item active"><?= $url ?>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <!-- Zero configuration table -->
      <section>
        <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><?php echo $judul ?></h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body card-dashboard">
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'staff/profile' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>

                  <?php echo form_open('staff/password_aksi'); ?>
                  <div class="form-body">
                    <?php
                    if(isset($_GET['alert'])){
                      if($_GET['alert'] == "gagal"){
                        echo "<div class='alert alert-danger'>
                        The old password is wrong!!</div>";
                      }
                    }
                    ?>
                    <h4 class="form-section">
                      <i class="la la-lock"></i>Password</h4>
                      <div class="form-group">
                        <label for="input_old">Old Password</label>
                        <input class="form-control border-primary" type="password" placeholder="Input Old Password" id="input_old" name="old_password" value="<?php echo set_value('old_password'); ?>" required>
                        <?= form_error('old_password','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label for="input_new">New Password</label>
                        <input class="form-control border-primary" type="password" placeholder="Input New Password" id="input_new" name="new_password" value="<?php echo set_value('new_password'); ?>" required>
                        <?= form_error('new_password','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>

                      <div class="form-group">
                        <label for="input_repeat">Confirmation Password</label>
                        <input class="form-control border-primary" type="password" placeholder="Repeat New Password" id="input_repeat" name="repeat_password" value="<?php echo set_value('repeat_password'); ?>" required>
                        <?= form_error('repeat_password','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>

                    <div class="form-actions right">
                      <button type="submit" name="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Save
                      </button>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Zero configuration table -->


      </div>
    </div>
  </div>
