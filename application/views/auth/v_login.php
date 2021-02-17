<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
    </div>
    <div class="content-body"><section class="flexbox-container">
      <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
          <div class="card border-grey border-lighten-3 px-1 py-1 m-0 animated slideInDown" data-appear="appear" data-animation="slideInDown">
            <div class="card-header border-0">
              <div class="text-center mb-1">
                <img src="<?php echo base_url(); ?>assets/theme-assets/images/logo/logo.png" alt="branding logo">
              </div>
              <div class="font-large-1  text-center">
                Eno Journal <br> System Information Cash Flow
              </div>
            </div>
            <div class="card-content">
              <div class="card-body">
                <?php
                if(isset($_GET['alert'])){
                  if($_GET['alert']=="belum_login"){
                    echo "<div class='alert alert-danger font-weight-bold text-center'>Anda Harus Login Terlebih
                    Dulu!</div>";
                  }else if($_GET['alert']=="logout"){
                    echo "<div class='alert alert-success font-weight-bold text-center'>Anda Telah Logout!</div>";
                  }
                }
                ?>
                <form class="form-horizontal" method="post" action="<?= base_url('auth/index') ?>">
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="text" class="form-control round" id="user-name" placeholder="Your Email" name="email" value="<?= set_value('email'); ?>">
                    <div class="form-control-position">
                      <i class="ft-user"></i>
                    </div>
                    <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                  </fieldset>
                  <fieldset class="form-group position-relative has-icon-left">
                    <input type="password" class="form-control round" id="user-password" placeholder="Enter Password" name="password">
                    <div class="form-control-position">
                      <i class="ft-lock"></i>
                    </div>
                    <?= form_error('password','<small class="text-danger pl-3">', '</small>'); ?>
                  </fieldset>
                  <div class="form-group row">
                    <div class="col-md-6 col-12 text-center text-sm-left">

                    </div>
                    <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="<?= base_url('auth/forgotpassword'); ?>" class="card-link">Forgot Password?</a></div>
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Login</button>
                  </div>
                </form>
              </div>
              <hr>
              <p class="card-subtitle text-muted text-right font-small-3 mx-2 my-1"><span>Don't have an account ? <a href="<?= base_url('auth/registration'); ?>" class="card-link">Sign Up</a></span></p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
<!-- END: Content-->
