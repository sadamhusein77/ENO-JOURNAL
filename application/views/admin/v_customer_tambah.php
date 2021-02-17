<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Customer</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/customer' ?>">Home</a>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/customer' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php echo form_open('admin/customer_aksi'); ?>
                  <div class="form-body">
                    <h4 class="form-section">
                      <i class="ft-clipboard"></i> Customer Details</h4>
                      <div class="form-group">
                        <label for="input_nama">Customer Name</label>
                        <input class="form-control border-primary" type="text" placeholder="Input Customer Name" id="input_nama" name="customer_name" value="<?php echo set_value('customer_name'); ?>" required>
                      </div>
                      <?= form_error('customer_name','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_address">Address</label>
                        <textarea class="form-control border-primary" name="customer_address" rows="8" cols="72" id="input_address" placeholder="Input Address" required > <?php echo set_value('customer_address'); ?> </textarea>
                        </div>
                      <?= form_error('customer_address','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_telp">Telephone / Handphone</label>
                        <input class="form-control border-primary" type="text" placeholder="Input number Telephone / Handphone" id="input_telp" name="customer_telp" value="<?php echo set_value('customer_telp'); ?>" required>
                      </div>
                      <?= form_error('customer_telp','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_email">Email</label>
                        <input class="form-control border-primary" type="email" placeholder="Input Email" id="input_email" name="customer_email" value="<?php echo set_value('customer_email'); ?>" required>
                      </div>
                      <?= form_error('customer_email','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_npwp">NPWP</label>
                        <input class="form-control border-primary" type="text" placeholder="Input NPWP" id="input_npwp" name="customer_npwp" value="<?php echo set_value('customer_npwp'); ?>" required>
                      </div>
                      <?= form_error('customer_npwp','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="hobby">Hobby</label>
                        <input class="form-control border-primary" type="text" placeholder="Input hobby" id="hobby" name="hobby" value="<?php echo set_value('hobby'); ?>" required>
                        </div>
                      <?= form_error('hobby','<small class="text-danger pl-3">', '</small>'); ?>
                    </div> <!--  div form  -->

                    <div class="form-actions right">
                      <button type="reset" class="btn btn-danger mr-1">
                        <i class="ft-x"></i> Reset
                      </button>
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
