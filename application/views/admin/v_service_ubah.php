<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Service</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/service' ?>">Home</a>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/service' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($service as $s){ ?>
                  <?php echo form_open('admin/service_update'); ?>
                  <div class="form-body">
                    <h4 class="form-section">
                      <i class="ft-clipboard"></i> Account Details</h4>
                      <input type="hidden" name="id_service" value="<?php echo $s->id_service; ?>">
                      <div class="form-group">
                        <label for="input_name">Service Name</label>
                        <input class="form-control border-primary" type="text" placeholder="Input Service Name" id="input_name" name="service_name" value="<?php echo set_value('service_name', $s->service_name); ?>" required>
                      </div>
                      <?= form_error('service_name','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_balance">Price</label>
                        <input class="form-control border-primary" type="text" placeholder="Input Price" id="input_balance" name="price" value="<?php echo set_value('price', $s->price); ?>" required>
                      </div>
                      <?= form_error('price','<small class="text-danger pl-3">', '</small>'); ?>
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
