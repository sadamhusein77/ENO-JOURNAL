<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">User</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/user' ?>">Home</a>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/user' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($user as $u){ ?>
                  <?php echo form_open('admin/user_update'); ?>
                  <div class="form-body">
                    <h4 class="form-section">
                      <i class="la la-user"></i> User Details</h4>
                      <input type="hidden" name="id_user" value="<?php echo $u->id_user; ?>">
                      <div class="form-group">
                        <label for="input_kode">Role</label>
                        <select class="form-control" name="id_role">
                        <option value="">- Choose Role</option>
                          <?php foreach($role as $r){ ?>
                            <option <?php if($u->id_role == $r->id_role){echo "selected='selected'";} ?> value="<?php echo $r->id_role ?>"><?php echo $r->role_name; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <?= form_error('id_role','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_nama">Fullname</label>
                        <input class="form-control border-primary" type="text" placeholder="Input fullname" id="input_nama" name="fullname" value="<?php echo set_value('fullname', $u->fullname); ?>" required>
                      </div>
                      <?= form_error('fullname','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_gender">Gender</label>
                        <select class="form-control" name="gender" id="input_gender">
                        <option value="">- Choose Gender -</option>
                          <option <?php if($u->gender == "1"){ echo "selected='selected'"; } ?> value="1">Male</option>
                          <option <?php if($u->gender == "2"){ echo "selected='selected'"; } ?> value="2">Female</option>
                        </select>
                        <?= form_error('gender','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label for="is_active">Status</label>
                        <select class="form-control" name="is_active" id="is_active">
                        <option value="">- Choose Status -</option>
                          <option <?php if($u->is_active == "1"){ echo "selected='selected'"; } ?> value="1">Active</option>
                          <option <?php if($u->is_active == "2"){ echo "selected='selected'"; } ?> value="2">Nonactive</option>
                        </select>
                        <?= form_error('is_active','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div> <!--  div form  -->

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
          <?php } ?>
        </section>
        <!--/ Zero configuration table -->
      </div>
    </div>
  </div>
