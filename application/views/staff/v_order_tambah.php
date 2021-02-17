<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Order</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/order' ?>">Home</a>
              </li>
              <li class="breadcrumb-item active"><?= $url ?>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="justified-pills">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Order Detail</h4>
            </div>
            <div class="card-body">
              <div class="card-block">
                <p>Choose add order and make order note</p>
                <ul class="nav nav-pills nav-pill-with-active-bordered nav-justified">
                  <li class="nav-item">
                    <a class="nav-link active" id="active11-pill" data-toggle="pill" href="#active11" aria-expanded="true">Add Order</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="link11-pill" data-toggle="pill" href="#link11" aria-expanded="false">Order Note</a>
                  </li>
                </ul>
                <div class="tab-content px-1 pt-1">
                  <div role="tabpanel" class="tab-pane active" id="active11" aria-labelledby="active11-pill" aria-expanded="true">
                    <?php echo form_open('staff/order_aksi'); ?>
                    <form class="form form-horizontal">
                      <div class="form-body">
                        <h4 class="form-section"><i class="la la-shopping-cart"></i> Detail Transactions</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="id_customer">Customer Name</label>
                              <div class=" col-12 col-md-9">
                              <select class="custom-select form-control border-primary" name="id_customer" id="id_customer" required>
                                <option value="">- Choose Customer</option>
                                <?php foreach($customer as $c){ ?>
                                    <option <?php if(set_value('id_customer') == $c->id_customer){echo "selected='selected'";} ?> value="<?php echo $c->id_customer ?>"><?php echo $c->customer_name; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="id_service">Service</label>
                              <div class="col-12 col-md-9">
                                <select class="custom-select form-control border-primary" name="id_service" id="id_service" required>
                                  <option value="">- Choose Service</option>
                                  <?php foreach($service as $s){ ?>
                                      <option <?php if(set_value('id_service') == $s->id_service){echo "selected='selected'";} ?> value="<?php echo $s->id_service ?>"><?php echo $s->service_name; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="customer_telp">Contact Number</label>
                              <div class="col-md-9">
                                <input type="text" id="customer_telp" class="form-control border-primary" placeholder="customer telp" name="customer_telp" readonly>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="price">Price</label>
                              <div class="col-md-9">
                                <input type="number" id="price" class="form-control border-primary" placeholder="Input price" name="price" onkeyup="sum();" readonly>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="customer_email">Email</label>
                              <div class="col-md-9">
                                <input class="form-control border-primary" type="text" placeholder="Email" id="customer_email" name="customer_email" readonly>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="customer_npwp">NPWP</label>
                              <div class="col-md-9">
                                <input class="form-control border-primary" type="text" placeholder="NPWP" name="customer_npwp" id="customer_npwp" readonly>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="userinput8">Address</label>
                              <div class="col-md-9">
                                <textarea id="customer_address" rows="6" class="form-control border-primary" name="customer_address" placeholder="Address" readonly></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="quantity">Quantity</label>
                              <div class="col-md-9">
                                <input class="form-control border-primary" type="number" placeholder="Quantity" id="quantity" name="quantity" onkeyup="sum();" required>
                              </div>
                            </div>

                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="amount">Amount IDR </label>
                              <div class="col-md-9">
                                <input class="form-control border-primary" type="text" placeholder="Total" id="amount" name="amount" readonly>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="date">Date Order </label>
                              <div class="col-md-9">
                                <input class="form-control border-primary" type="date" id="date" name="date" required>
                              </div>
                            </div>
                        </div>
                        </div>
                      </div>

                      <div class="form-actions right">
                        <button type="button" class="btn btn-danger mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Save
                        </button>
                      </div>
                    </form>
                    <?php echo form_close(); ?>
                  </div>
                  <div class="tab-pane" id="link11" role="tabpanel" aria-labelledby="link11-pill" aria-expanded="false">
                    <?php echo form_open('staff/order_list'); ?>
                    <form class="form form-horizontal">
                      <div class="form-body">
                        <h4 class="form-section"><i class="la la-shopping-cart"></i> List Order</h4>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-md-3 label-control" for="id_customer">Customer Name</label>
                              <div class=" col-12 col-md-9">
                              <select class="custom-select form-control border-primary" name="id_customer" id="id_customer" required>
                                <option value="">- Choose Customer</option>
                                <?php foreach($customer as $c){ ?>
                                    <option <?php if(set_value('id_customer') == $c->id_customer){echo "selected='selected'";} ?> value="<?php echo $c->id_customer ?>"><?php echo $c->customer_name; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-actions right">
                        <button type="submit" class="btn btn-primary">
                          <i class="la la-check-square-o"></i> Process
                        </button>
                      </div>
                    </form>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
