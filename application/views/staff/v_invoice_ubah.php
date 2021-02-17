<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Cash In</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/invoice' ?>">Home</a>
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
                <h4 class="card-title"><?php echo $url ?></h4>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'staff/invoice' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($invoice as $inv){ ?>
                  <?php echo form_open('staff/invoice_update'); ?>
                  <form class="form form-horizontal">
                    <div class="form-body">
                      <h4 class="form-section"><i class="la la la-money"></i> <?= $judul?></h4>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="date_invoice">Date Invoice</label>
                            <div class="col-md-6">
                              <input type="date" id="date_invoice" class="form-control border-primary" placeholder="Input date" name="date_invoice" value="<?php echo set_value('date_invoice', $inv->date_invoice); ?>" required>
                            </div>
                          </div>
                          <?= form_error('date_invoice','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="due_date">Due Date</label>
                            <div class="col-md-9">
                              <input type="date" id="due_date" class="form-control border-primary" placeholder="due date" name="due_date" value="<?php echo set_value('due_date', $inv->due_date); ?>" required>
                            </div>
                          </div>
                          <?= form_error('due_date','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="no_order">Nomor Order</label>
                            <div class="col-md-6">
                              <input type="text" id="no_order" class="form-control border-primary" placeholder="Number Order" name="no_order" value="<?php echo set_value('no_order', $inv->no_order); ?>" readonly required>
                            </div>
                          </div>
                          <?= form_error('no_order','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-2 label-control" for="total_service">Total IDR</label>
                            <div class="col-md-6">
                              <input type="text" id="total_service" class="form-control border-primary" placeholder="Total" name="total_invoice" value="<?php echo set_value('total_invoice', $inv->total_invoice); ?>" required>
                            </div>
                          </div>
                          <?= form_error('total_invoice','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="status_invoice">Status Invoice</label>
                            <div class="col-md-6">
                              <select class="custom-select form-control" name="status_invoice" id="status_invoice" required>
                                <option value="">- Choose status</option>
                                <option <?php if($inv->status_invoice == "1"){ echo "selected='selected'"; } ?> value="1">Not paid yet</option>
                                <option <?php if($inv->status_invoice == "2"){ echo "selected='selected'"; } ?> value="2">Cancel</option>
                                <option <?php if($inv->status_invoice == "3"){ echo "selected='selected'"; } ?> value="3">Paid</option>
                              </select>
                            </div>
                          </div>
                          <?= form_error('status_invoice','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-actions right">
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Save
                        </button>
                      </div>
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
