<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title"><?= $url ?></h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/profile' ?>">Home</a>
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
          <div class="col-12 col-md-6">
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/profile' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($edtprofile as $p){ ?>
                    <?php echo form_open_multipart('admin/profile_update'); ?>
                    <form class="form form-horizontal">
                      <div class="form-body">
                        <h4 class="form-section"><i class="ft-clipboard"></i> <?= $url?></h4>
                        <input type="hidden" name="id_user" value="<?php echo $p->id_user; ?>">
                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="input_fullname">Fullname</label>
                          <div class="col-md-9">
                            <input type="text" id="input_fullname" class="form-control" placeholder="Input Fullname" name="fullname" value="<?php echo set_value('fullname', $p->fullname); ?>" required>
                            <?= form_error('fullname','<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="input_email">Email</label>
                          <div class="col-md-9">
                            <input type="text" id="input_email" class="form-control" placeholder="Input Email" name="email" value="<?php echo set_value('email', $p->email); ?>" readonly>
                            <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="input_gender">Gender</label>
                          <div class="col-md-9">
                            <input type="text" id="input_email" class="form-control" placeholder="Input Gender" name="gender" value="<?php if (set_value('gender', $p->gender == 1)) {
                              echo "Male";
                            }else {
                              echo "Female";
                            } ?>" readonly>
                            <?= form_error('gender','<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-3 label-control" for="input_address">Address</label>
                          <div class="col-md-9">
                            <textarea id="input_address" rows="5" class="form-control" name="address" placeholder="Input Address" required><?php echo set_value('address', $p->address); ?></textarea>
                          </div>
                        </div>
                        <?= form_error('address','<small class="text-danger pl-3">', '</small>'); ?>

                        <div class="form-group row">
                          <label class="col-md-3 label-control"><img width="85%" class="img-responsive" src="<?php echo base_url('assets/theme-assets/images/portrait/small/').$p->foto; ?>" style="display: block; margin: auto;"></label>
                          <div class="col-md-9">
                            <label id="projectinput8" class="file center-block">
                              <input type="file" id="file" name="foto">
                              <span class="file-custom"></span>
                            </label>
                            <?= form_error('foto','<small class="text-danger pl-3">', '</small>'); ?>
                          </div>
                          <?php
                          if(isset($foto_error)){
                            echo $foto_error;
                          }
                          ?>
                        </div>
                      </div>

                      <div class="form-actions right">
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Save
                        </button>
                      </div>
                    </form>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </section>
      <!--/ Zero configuration table -->
    </div>
  </div>
</div>
