<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title"><?= $title ?></h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/index' ?>">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">invoice
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <!-- Zero configuration table -->
      <section id="configuration">
        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><?= $card ?></h4>
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'staff/tambah_invoice' ?>"><i class="la la-plus"> Add data</i> </a>
                  <p class="card-text"></p>
                  <div class="table-responsive-sm">
                    <table class="table table-striped table-sm table-binvoiceed zero-configuration">
                      <thead class="text-center">
                        <tr>
                          <th width="">Date</th>
                          <th width="">Due Date</th>
                          <th width="">Reference</th>
                          <th width="%">Customer</th>
                          <th width="">Status</th>
                          <th width="">Total</th>
                          <th width="1%">Opsi</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        <?php
                        $no = 1;
                        if( ! empty($invoice)){ // Jika data siswa tidak sama dengan kosong, artinya jika data siswa ada
                          foreach($invoice as $inv){
                            ?>
                            <tr class="text-sm">
                              <td><?php echo date('d/m/Y', strtotime($inv->date_invoice)); ?></td>
                              <td><?= date('d/m/Y', strtotime($inv->due_date));?></td>
                              <td>INV - <?php echo $inv->no_invoice; ?></td>
                              <td><?= $inv->customer_name;?></td>
                              <td><?php if ($inv->status_invoice == 1) {
                                echo "Not yet paid";
                              } elseif ($inv->status_invoice == 2) {
                                echo "Cancel";
                              } else {
                                echo "Already Paid";
                              }?></td>
                              <td>Rp <?php echo number_format($inv->total_invoice, 0, '', '.'); ?></td>
                              <td width="1%">
                                <span class="dropdown">
                                  <button id="btnSearchDrop12" type="button" class="btn btn-sm btn-icon btn-pure font-medium-2" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false">
                                  <i class="ft-more-vertical"></i>
                                </button>
                                <span aria-labelledby="btnSearchDrop12" class="dropdown-menu mt-1 dropdown-menu-right">
                                  <a href="<?php echo base_url().'staff/ubah_invoice/'.$inv->no_order; ?>" class="dropdown-item">
                                    <i class="ft-edit-2"></i> Edit</a>
                                    <a href="<?php echo base_url().'staff/hapus_invoice/'.$inv->no_order; ?>" class="dropdown-item remove">
                                      <i class="ft-trash-2"></i> Delete</a>
                                      <a href="<?php echo base_url().'staff/previewInvoice/'.$inv->no_order; ?>" class="dropdown-item">
                                        <i class="la la-file-text"></i> Invoice</a>
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
                                <th width="">Date</th>
                                <th width="">Due Date</th>
                                <th width="">Reference</th>
                                <th width="%">Customer</th>
                                <th width="">Status</th>
                                <th width="">Total</th>
                                <th width="1%">Opsi</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
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
