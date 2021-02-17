<div class="app-content content">
  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <?php if ($this->session->flashdata('msg')) : ?>
    <?php $this->session->flashdata('msg');  ?>
  <?php endif; ?>
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">All Report</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/report' ?>">All Report</a>
              </li>
              <li class="breadcrumb-item active">Report Cash In
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
                  <?php echo form_open('staff/reportCIView'); ?>
                  <div class="form-body">
                    <h4 class="form-section">
                      <i class="la la-bar-chart"></i> Reports</h4>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <div class="dropdown">
                            <a class="btn btn-bg-gradient-x-purple-blue dropdown-toggle col-8 col-md-12" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              - Choose Reports
                            </a>
                            <div class="dropdown-menu col-8 col-md-12" aria-labelledby="dropdownMenuLink">
                              <a class="dropdown-item" href="<?php echo base_url().'staff/reportCashIn' ?>">Cash In</a>
                              <a class="dropdown-item" href="<?php echo base_url().'staff/reportCashOut' ?>">Cash Out</a>
                              <!-- <a class="dropdown-item" href="<?php echo base_url().'staff/reportOrder' ?>">Order</a>
                              <a class="dropdown-item" href="<?php echo base_url().'staff/reportInvoice' ?>">Invoice</a>
                              <a class="dropdown-item" href="<?php echo base_url().'staff/reportPO' ?>">Purchase Order</a> -->
                              <a class="dropdown-item" href="<?php echo base_url().'staff/reportLR' ?>">Income Statement</a>
                              <a class="dropdown-item" href="<?php echo base_url().'staff/reportCF' ?>">Cash Flow</a>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-md-2">
                          <input type="date" name="date1" class="form-control col-8 col-md-12">
                        </div>
                        <?= form_error('date1','<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="form-group">
                          <p>-</p>
                        </div>
                        <div class="form-group col-md-2">
                          <input type="date" name="date2" class="form-control col-8 col-md-12">
                        </div>
                        <?= form_error('date2','<small class="text-danger pl-3">', '</small>'); ?>
                        <div class="form-group">
                          <button type="submit" name="button" class="btn btn-primary">Search</button>
                        </div>
                        <div class="form-group">
                          <button onclick="printContent('div1')" class="btn btn-info btn-md ml-1"> Print</button>
                        </div>
                      </div>
                    </div> <!--  div form  -->
                    <?php echo form_close(); ?>
                    <div id="div1">
                      <div class="row">
                        <div class="col-sm-12 col-sm-12">
                          <div class="text-center">
                            <h1>Eno Journal</h1>
                            <h2>Cash In Report</h2>
                            <h3>Periode : <?= date('d/m/Y', strtotime($date1)); ?> s/d <?= date('d/m/Y', strtotime($date2)); ?></h3>
                          </div>
                        <div class="table-responsive-sm mt-5">
                          <table class="table table-striped table-sm table-bordered">
                            <thead class="text-center">
                              <tr>
                                <th width="">Date</th>
                                <th width="">Reference</th>
                                <th width="%">Description</th>
                                <th width="">Type</th>
                                <th width="">Total</th>
                                <th width="1%">Staff</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if( ! empty($report)){ // Jika data siswa tidak sama dengan kosong, artinya jika data siswa ada
                                foreach($report as $r){
                                  ?>
                                  <tr class="text-sm">
                                    <td><?php echo date('d/m/Y', strtotime($r->post_date)); ?></td>
                                    <td><?= $r->no_cashin;?></td>
                                    <td><?php echo $r->description; ?></td>
                                    <td><?php if($r->id_invoice != 0){
                                      echo $r->no_invoice;
                                    } else {
                                      echo $r->receipt;
                                    }?></td>
                                    <td>Rp <?php echo number_format($r->total_cashin, 0, '', '.'); ?></td>
                                    <td width=""><?= $r->fullname;?></td>
                                  </tr>
                                <?php } ?>
                              <?php } else{ // Jika data siswa kosong
                                echo "<tr><td align='center' colspan='7'>Data Tidak Ada</td></tr>";
                              }
                              ?>
                            </tbody>
                            <tfoot class="text-center">
                              <tr>
                                <th width="">Date</th>
                                <th width="">Reference</th>
                                <th width="%">Description</th>
                                <th width="">Type</th>
                                <th width="">Total</th>
                                <th width="">Staff</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div> <!-- row tabble !-->
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
