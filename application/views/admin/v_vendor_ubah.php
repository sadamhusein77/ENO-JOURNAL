<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Vendor</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/vendor' ?>">Home</a>
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
          <div class="col-12">
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/vendor' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($vendor as $v){ ?>
                  <?php echo form_open('admin/vendor_update'); ?>
                  <form class="form form-horizontal">
                    <div class="form-body">
                      <h4 class="form-section"><i class="la la-cubes"></i> Vendor Details</h4>
                      <input type="hidden" name="id_vendor" value="<?php echo $v->id_vendor; ?>">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput1">Vendor Name</label>
                            <div class="col-md-9">
                              <input type="text" id="userinput1" class="form-control border-primary" placeholder="Input vendor name" name="vendor_name"  value="<?php echo set_value('customer_name', $v->vendor_name); ?>" required>
                            </div>
                          </div>
                          <?= form_error('vendor_name','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput2">Telephone / Handphone</label>
                            <div class="col-md-9">
                              <input type="text" id="userinput2" class="form-control border-primary" placeholder="Input Telephone / Handphone" name="vendor_telp" value="<?php echo set_value('vendor_telp', $v->vendor_telp); ?>" required>
                            </div>
                          </div>
                          <?= form_error('vendor_telp','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput8">Address</label>
                            <div class="col-md-9">
                              <textarea id="userinput8" rows="6" class="form-control border-primary" name="vendor_address" placeholder="Input verdor address" required><?php echo set_value('vendor_address', $v->vendor_address); ?></textarea>
                            </div>
                          </div>
                          <?= form_error('vendor_address','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput4">NPWP</label>
                            <div class="col-md-9">
                              <input type="text" id="userinput4" class="form-control border-primary" placeholder="Input NPWP" name="vendor_npwp" value="<?php echo set_value('vendor_npwp', $v->vendor_npwp); ?>" required>
                            </div>
                          </div>
                          <?= form_error('vendor_npwp','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput3">Email</label>
                            <div class="col-md-9">
                              <input type="email" id="userinput3" class="form-control border-primary" placeholder="Input Email" name="vendor_email" value="<?php echo set_value('vendor_email', $v->vendor_email); ?>" required>
                            </div>
                          </div>
                          <?= form_error('vendor_email','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
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
        </section>
        <!--/ Zero configuration table -->


      </div>
    </div>
  </div>
