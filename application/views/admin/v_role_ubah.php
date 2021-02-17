<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Role</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/role' ?>">Home</a>
              </li>
              <li class="breadcrumb-item active"><?php echo $url ?>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/role' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($role as $r){ ?>
                  <?php echo form_open('admin/role_update'); ?>
                    <div class="form-body">
                      <h4 class="form-section">
                        <i class="la la-slack"></i> Role Details</h4>
                        <input type="hidden" name="id_role" value="<?php echo $r->id_role; ?>">
                        <div class="form-group">
                          <label for="input_kode">Role Code</label>
                          <input class="form-control border-primary" type="text" placeholder="Kode Role" id="input_kode" name="role_code" value="<?php echo set_value('role_code', $r->role_code); ?>" required>
                          <?= form_error('kode_role','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-group">
                          <label for="input_nama">Role Name</label>
                          <input class="form-control border-primary" type="text" placeholder="Nama Role" id="input_nama" name="role_name" value="<?php echo set_value('role_name', $r->role_name); ?>" required>
                          <?= form_error('nama_role','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="form-actions right">
                          <button type="submit" name="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Save
                          </button>
                        </div>
                  </div>
                <?php echo form_close(); ?>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!--/ Zero configuration table -->


      </div>
    </div>
  </div>
