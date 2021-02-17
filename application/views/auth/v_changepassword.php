<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                <div class="card-header border-0">
                    <div class="text-center mb-1">
                        <img src="<?php echo base_url(); ?>assets/theme-assets/images/logo/logo.png" alt="branding logo">
                    </div>
                    <div class="font-large-1  text-center">
                        Change your password for
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                        <span><?= $this->session->userdata('reset_email'); ?></span>
                    </h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="<?= base_url('auth/changepassword') ?>">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control round" id="password1" name="password1" placeholder="Enter new password">
                                <div class="form-control-position">
                                  <i class="ft-lock"></i>
                                </div>
                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control round" id="password2" name="password2" placeholder="Repeat new password">
                                <div class="form-control-position">
                                  <i class="ft-lock"></i>
                                </div>
                                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                            </fieldset>
                            <div class="form-group text-center">
                                    <button type="submit"class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Change Password</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
      </div>
    </div>
    <!-- END: Content-->
