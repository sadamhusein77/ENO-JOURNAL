<!-- BEGIN: Content-->
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Invoice</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'staff/invoice' ?>">Home</a>
              </li>
              <li class="breadcrumb-item active">Invoice
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <section class="card">
        <div id="div1">
          <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-12 text-left text-md-left">
                <img src="<?php echo base_url().'assets/theme-assets/images/logo/logo-80x80.png'?>" alt="company logo" class="mb-2" width="70">
                <ul class="px-0 list-unstyled">
                  <li class="text-bold-700">Eno Foto Copy</li>
                  <li>Jl. Menteng Raya No.52, RT.2/RW.7</li>
                  <li>Kb. Sirih, Kec. Menteng,</li>
                  <li>Jakarta Pusat 10340</li>
                </ul>

              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-right">
                <h2>Invoice</h2>
                <p># INV - <?= $pesanan->no_invoice; ?></p>
                <p><?= date('l, d F Y', strtotime($pesanan->date_invoice));?> </p>
              </div>
            </div>
            <!--/ Invoice Company Details -->

            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
              <div class="col-md-7 col-sm-12">
                <p class="text-muted">(021) 3901528</p>
                <p class="text-muted">enocopy23@gmail.com</p>
              </div>
              <div class="col-md-5 col-sm-12 text-center text-md-right">
                <p class="text-muted">Bill To</p>
                <div class="table-responsive-sm">
                  <tr>
                    <td width="5%"><?= $customer->customer_name ?></td>
                  </tr> <br>
                  <tr>
                    <td width="5%"><?= $customer->customer_address ?></td>
                  </tr>
                </div>
              </div>
            </div>
            <!--/ Invoice Customer Details -->

            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Item Service</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Quantity Pcs</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      if( ! empty($item)){ // Jika data siswa tidak sama dengan kosong, artinya jika data siswa ada
                        foreach($item as $n){
                          ?>
                          <tr>
                            <td><?= $no++;?></td>
                            <td><?= $n->service_name;?></td>
                            <td class="text-right">Rp <?= number_format($n->price, 0, '', '.');?></td>
                            <td class="text-right"><?= $n->quantity;?></td>
                            <td class="text-right">Rp <?= number_format($n->total, 0, '', '.');?></td>
                          </tr>
                        <?php } ?>
                      <?php } else{ // Jika data siswa kosong
                        echo "<tr><td align='center' colspan='7'>Nothing record!</td></tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 col-sm-12 text-center text-md-left">
                  <p class="lead">Payment Methods:</p>
                  <div class="row">
                    <div class="col-md-8">
                      <table class="table table-borderless table-sm">
                        <tbody>
                          <tr>
                            <td>Bank name:</td>
                            <td class="text-right">BCA</td>
                          </tr>
                          <tr>
                            <td>Account Name:</td>
                            <td class="text-right">Ade Sukaeni</td>
                          </tr>
                          <tr>
                            <td>Bank Account:</td>
                            <td class="text-right">554-0525-759</td>
                          </tr>
                          <tr>
                            <td>SWIFT code:</td>
                            <td class="text-right">CENAIDJA</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-sm-12">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                        <tr>
                          <td>Total</td>
                          <td class="text-right">Rp. <?= number_format($jumlah, 0, '', '.');?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm12 mt-3">
                  <h4>Due Date : <?= date('d F Y', strtotime($pesanan->due_date)); ?> From <?= date('d F Y', strtotime($pesanan->date_invoice));?>.</h4>
                </div>
              </div>
              <div class="row mt-5">
                <div class="col-md-7 col-sm-12 text-center text-md-left mt-5">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="text-center">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-sm-12 mt-5">
                  <div class="text-center">
                    <p>Authorized person</p>
                    <br><br><br><br><br>
                    <h6><?= $user->fullname;?></h6>
                    <p class="text-muted">Staff</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- IPrint-->
        <!-- Invoice Footer -->
        <div id="invoice-footer">
          <div class="row">
            <div class="col-md-12 col-sm-12 text-center">
              <button onclick="printContent('div1')" class="btn btn-info btn-lg my-1 float-right mr-3"><i class="la la-paper-plane-o"></i> Print</button>
            </div>
          </div>
        </div>
        <!--/ Invoice Footer -->
      </section>
    </div><!-- body Content-->
  </div>
</div>
<!-- END: Content-->
