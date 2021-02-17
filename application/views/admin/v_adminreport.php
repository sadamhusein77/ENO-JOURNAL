<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Admin Report</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/index' ?>">Dashboard</a>
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
          <div class="col-12 col-md-12">
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
                  <p class="card-text"></p>
                  <?php echo form_open('admin/report_aksi'); ?>
                  <div class="form-body">
                    <h4 class="form-section">
                      <i class="la la-bar-chart"></i> Reports</h4>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <select class="form-control col-8 col-md-12" name="report">
                            <option value="">- Choose Reports</option>
                            <option value="role">Role</option>
                            <option value="user">User</option>
                            <option value="customer">Customer</option>
                            <option value="vendor">Vendor</option>
                            <option value="account">Account Journal</option>
                            <option value="service">Service</option>
                          </select>
                        </div>
                        <?= form_error('report','<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="form-group">
                          <button type="submit" name="button" class="btn btn-primary">Search</button>
                        </div>
                      </div>
                    </div> <!--  div form  -->
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
