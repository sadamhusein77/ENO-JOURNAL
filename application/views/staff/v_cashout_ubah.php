<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Cash out</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/cashout' ?>">Home</a>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'staff/cashout' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($cashout as $c){ ?>
                  <?php echo form_open('staff/cashout_update'); ?>
                  <form class="form form-horizontal">
                    <div class="form-body">
                      <h4 class="form-section"><i class="la la la-money"></i> <?= $judul?></h4>
                      <input type="hidden" name="no_cashout" value="<?= $c->no_cashout;?>">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput2">Date</label>
                            <div class="col-md-6">
                              <input type="date" id="userinput2" class="form-control border-primary" placeholder="Input date" name="post_date" value="<?php echo set_value('post_date', $c->post_date); ?>" required>
                            </div>
                          </div>
                          <?= form_error('post_date','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput3">Debet</label>
                            <div class="col-md-9">
                              <select class="select2 form-control" name="id_accountd" id="id_h5_single" required>
                                <option value="">- Choose Account</option>
                                <?php foreach($cashoutd as $cd){ ?>
                                <?php foreach($account as $a){ ?>
                                    <option <?php if($cd->id_account == $a->id_account){echo "selected='selected'";} ?> value="<?php echo $a->id_account ?>"><?php echo $a->account_name; ?></option>
                                <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <?= form_error('id_accountd','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput8">Description</label>
                            <div class="col-md-8">
                              <textarea id="userinput8" rows="6" class="form-control border-primary" name="description" placeholder="Input description" required><?php echo set_value('description', $c->description); ?></textarea>
                            </div>
                          </div>
                          <?= form_error('description','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="userinput3">Credit</label>
                            <div class="col-md-9">
                              <select class="select2 form-control" name="id_accountc" id="id_h5_single" required>
                                <option value="">- Choose Account</option>
                                <?php foreach($cashoutc as $cc){ ?>
                                <?php foreach($account as $a){ ?>
                                    <option <?php if($cc->id_account == $a->id_account){echo "selected='selected'";} ?> value="<?php echo $a->id_account ?>"><?php echo $a->account_name; ?></option>
                                <?php } ?>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <?= form_error('id_accountc','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-3 label-control" for="no_document">For</label>
                            <div class="col-md-6">
                              <select class="select2 form-control" name="no_document" id="no_document" required>
                                <option value="">- Choose Account</option>
                                <option <?php if($c->no_document == "Vendor"){ echo "selected='selected'"; } ?> value="Vendor">Vendor</option>
                                <option <?php if($c->no_document == "Prive"){ echo "selected='selected'"; } ?> value="Prive">Prive</option>
                                <option <?php if($c->no_document == "Operational"){ echo "selected='selected'"; } ?> value="Operational">Operational</option>
                                <option <?php if($c->no_document == "Other"){ echo "selected='selected'"; } ?> value="Other">Other</option>
                              </select>
                            </div>
                          </div>
                          <?= form_error('no_document','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-md-2 label-control" for="userinput3">Total IDR</label>
                            <div class="col-md-6">
                              <input type="text" id="userinput3" class="form-control border-primary" placeholder="Input Total Income" name="total" value="<?php echo set_value('total', $c->total_cashout); ?>" required>
                            </div>
                          </div>
                          <?= form_error('total','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>
                      <div class="form-actions right">
                        <button type="reset" class="btn btn-danger mr-1">
                          <i class="ft-x"></i> Reset
                        </button>
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
