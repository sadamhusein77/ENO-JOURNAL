<!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="col-lg-4 col-md-6 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0">
                    <div class="text-center mb-1">
                        <img src="<?php echo base_url(); ?>assets/theme-assets/images/logo/logo.png" alt="branding logo">
                    </div>
                    <div class="font-large-1  text-center">
                        <?= $judul; ?>
                    </div>
                </div>
                <div class="card-content">

                    <div class="card-body">
                        <form class="form-horizontal" method="post" action="<?= base_url('auth/registration') ?>">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control round" id="fullname" placeholder="Fullname" name="fullname" value="<?= set_value('fullname'); ?>">
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                                <?= form_error('fullname','<small class="text-danger pl-3">', '</small>'); ?>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="text" class="form-control round" id="email" placeholder="Your Email Address" name="email" value="<?= set_value('email'); ?>">
                                <div class="form-control-position">
                                    <i class="ft-mail"></i>
                                </div>
                                <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control round" id="password1" placeholder="Enter Password" name="password1">
                                <div class="form-control-position">
                                    <i class="ft-lock"></i>
                                </div>
                                <?= form_error('password1','<small class="text-danger pl-3">', '</small>'); ?>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control round" id="password2" placeholder="Repeat Password" name="password2">
                                <div class="form-control-position">
                                    <i class="ft-lock"></i>
                                </div>
                            </fieldset>
                            <div class="form-group text-center">
                                <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">Register</button>
                            </div>

                        </form>
                    </div>
                    <p class="card-subtitle text-muted text-right font-small-3 mx-2 my-1">
                        <span>Already a member ?
                            <a href="<?= base_url('auth'); ?>" class="card-link">Sign In</a>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
      </div>
    </div>
    <!-- END: Content-->
