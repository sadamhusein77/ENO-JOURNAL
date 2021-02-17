<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Account Journal</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/account' ?>">Home</a>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/account' ?>"><i class="la la-arrow-left"> Back </i> </a>
                  <p class="card-text"></p>
                  <?php foreach($account as $a){ ?>
                  <?php echo form_open('admin/account_update'); ?>
                  <div class="form-body">
                    <h4 class="form-section">
                      <i class="ft-clipboard"></i> Account Details</h4>
                      <input type="hidden" name="id_account" value="<?php echo $a->id_account; ?>">
                      <div class="form-group">
                        <label for="input_code">Account Code</label>
                        <input class="form-control border-primary" type="text" placeholder="Input Account Code" id="input_code" name="account_code" value="<?php echo set_value('account_code', $a->account_code); ?>" required>
                      </div>
                      <?= form_error('account_code','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_kode">Classification</label> <a href="<?php echo base_url().'admin/classaccount' ?>" class="badge border-primary primary badge-border" data-toggle="popover" data-content="Add Classification" data-trigger="hover"><i class="font-medium-2 icon-line-height la la-plus"></i></a>
                        <select class="form-control" name="id_class">
                          <option value="">- Choose Class</option>
                          <?php foreach($class as $c){ ?>
                            <option <?php if($a->id_class == $c->id_class){echo "selected='selected'";} ?> value="<?php echo $c->id_class ?>"><?php echo $c->class_name; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <?= form_error('id_class','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group">
                        <label for="input_name">Account Name</label>
                        <input class="form-control border-primary" type="text" placeholder="Input Account Name" id="input_name" name="account_name" value="<?php echo set_value('account_name', $a->account_name); ?>" required>
                      </div>
                      <?= form_error('account_name','<small class="text-danger pl-3">', '</small>'); ?>
                      <div class="form-group row">
                        <div class="form-check ml-2">
                          <input class="form-check-input" type="radio" name="normal_balance" id="id_class1" value="1" <?php if($a->normal_balance == 1) echo 'checked';?>>
                          <label class="form-check-label" for="id_class1">
                            Debet
                          </label>
                        </div>
                        <div class="form-check ml-5">
                          <input class="form-check-input" type="radio" name="normal_balance" id="id_class2" value="2" <?php if($a->normal_balance == 2) echo 'checked';?>>
                          <label class="form-check-label" for="id_class2">
                            Credit
                          </label>
                        </div>
                        <?= form_error('normal_balance','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="form-group">
                        <label for="input_balance">Balance</label>
                        <input class="form-control border-primary" type="text" placeholder="Input Balance" id="input_balance" name="balance" value="<?php echo set_value('balance', $a->balance); ?>" required>
                      </div>
                      <?= form_error('balance','<small class="text-danger pl-3">', '</small>'); ?>
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
