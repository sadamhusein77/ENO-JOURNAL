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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/tambah_order' ?>">Home</a>
              </li>
              <li class="breadcrumb-item active"><?= $url ?>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section id="configuration">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card">
              <div class="card-header">
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
                  <?php echo form_open('staff/order_proses'); ?>
                  <form class="form">
                  <p class="card-text">Customer Name :</p>
                  <input type="hidden" name="id_customer" value="<?= $customer->id_customer ?>">
                  <p><strong><?= $customer->customer_name ?></strong></p>
                  <div class="table-responsive-sm">
                    <table class="table table-striped table-sm table-bordered zero-configuration">
                      <thead class="text-center">
                        <tr>
                          <th>No.</th>
                          <th width="">Service</th>
                          <th width="">Price</th>
                          <th width="%">Quantity</th>
                          <th>Total</th>
                          <th width="1%">Opsi</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <?php
                        $no = 1;
                        if( ! empty($list_order)){ // Jika data siswa tidak sama dengan kosong, artinya jika data siswa ada
                          foreach($list_order as $l){
                            ?>
                            <tr class="text-sm">
                              <td><?= $no++; ?></td>
                              <td><?= $l->service_name; ?></td>
                              <td>Rp. <?= number_format($l->price, 0, '', '.');?></td>
                              <td><?=  $l->quantity;?> Pcs</td>
                              <td>Rp. <?=  number_format($l->total, 0, '', '.');?></td>
                              <td width="1%">
                                <span class="dropdown">
                                  <button id="btnSearchDrop12" type="button" class="btn btn-sm btn-icon btn-pure font-medium-2" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  <i class="ft-more-vertical"></i>
                                </button>
                                <span aria-labelledby="btnSearchDrop12" class="dropdown-menu mt-1 dropdown-menu-right">
                                    <a href="<?php echo base_url().'staff/hapus_list/'.$l->id_od; ?>" class="dropdown-item remove">
                                      <i class="ft-trash-2"></i> Delete</a>
                                    </span>
                                  </td>
                                </tr>
                              <?php } ?>
                            <?php } else{ // Jika data siswa kosong
                              echo "<tr><td align='center' colspan='7'>Nothing record!</td></tr>";
                            }
                            ?>
                          </tbody>
                          <tfoot class="text-center">
                            <tr>
                              <th>No.</th>
                              <th width="">Service</th>
                              <th width="">Price</th>
                              <th width="%">Quantity</th>
                              <th>Total</th>
                              <th width="1%">Opsi</th>
                            </tr>
                            <tr class="text-center borderless">
                              <td colspan="4">Total</td>
                              <td>Rp. <?= number_format($jumlah, 0, '', '.'); ?></td>
                              <input type="hidden" name="total_service" value="<?= $jumlah; ?>" required>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <div class="form-actions right">
                        <?php if (!empty($list_order)) { ?>
                          <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Save
                          </button>
                      <?php  } ?>
                      </div>
                      </form>
                      <?php echo form_close(); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
