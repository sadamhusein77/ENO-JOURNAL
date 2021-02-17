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
              <li class="breadcrumb-item"><a href="index.html">Home</a>
              </li>
              <li class="breadcrumb-item"><a href="#">Apps</a>
              </li>
              <li class="breadcrumb-item active">Invoice
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body"><section class="card">
      <div id="invoice-template" class="card-body">
        <!-- Invoice Company Details -->
        <div id="invoice-company-details" class="row">
          <div class="col-md-6 col-sm-12 text-left text-md-left">
            <img src="<?php echo base_url().'assets/theme-assets/images/logo/logo-80x80.png'?>" alt="company logo" class="mb-2" width="70">
            <ul class="px-0 list-unstyled">
              <li class="text-bold-700">Chameleon Studio</li>
              <li>102 Trade Centre,</li>
              <li>Portland 12345,</li>
              <li>USA</li>
            </ul>

          </div>
          <div class="col-md-6 col-sm-12 text-center text-md-right">
            <h2>Order Note</h2>
            <p># INV-001001</p>
            <p> 26th May, 2018</p>
          </div>
        </div>
        <!--/ Invoice Company Details -->

        <!-- Invoice Customer Details -->
        <div id="invoice-customer-details" class="row pt-2">
          <div class="col-md-6 col-sm-12">
            <p class="text-muted">(123) 456 789</p>
            <p class="text-muted">email@yourcompany.com</p>
          </div>
          <div class="col-md-6 col-sm-12 text-center text-md-right">
            <p class="text-muted">Bill To</p>
            <ul class="px-0 list-unstyled">
              <li class="text-bold-700">Mr. John Doe</li>
              <li>102 Park Avenue,</li>
              <li>New York,</li>
              <li>New York-25896.</li>
            </ul>

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
                    <th>#</th>
                    <th>Item & Description</th>
                    <th class="text-right">Rate</th>
                    <th class="text-right">Hours</th>
                    <th class="text-right">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>
                      <p>Create Mobile Dashboard</p>
                      <p class="text-muted">Vestibulum euismod est eu elit convallis.</p>
                    </td>
                    <td class="text-right">$ 18.00/hr</td>
                    <td class="text-right">100</td>
                    <td class="text-right">$ 1800.00</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>
                      <p>Android App Development</p>
                      <p class="text-muted">Pellentesque maximus feugiat lorem at cursus.</p>
                    </td>
                    <td class="text-right">$ 14.00/hr</td>
                    <td class="text-right">300</td>
                    <td class="text-right">$ 4200.00</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>
                      <p>Laravel Template Development</p>
                      <p class="text-muted">Vestibulum euismod est eu elit convallis.</p>
                    </td>
                    <td class="text-right">$ 10.00/hr</td>
                    <td class="text-right">500</td>
                    <td class="text-right">$ 5000.00</td>
                  </tr>
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
                        <td class="text-right">US Bank, USA</td>
                      </tr>
                      <tr>
                        <td>Acc name:</td>
                        <td class="text-right">Carla Prop</td>
                      </tr>
                      <tr>
                        <td>IBAN:</td>
                        <td class="text-right">ABC123546655</td>
                      </tr>
                      <tr>
                        <td>SWIFT code:</td>
                        <td class="text-right">US12345</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-sm-12">
              <p class="lead">Total due</p>
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Sub Total</td>
                      <td class="text-right">$ 12,000.00</td>
                    </tr>
                    <tr>
                      <td>TAX (12%)</td>
                      <td class="text-right">$ 1,440.00</td>
                    </tr>
                    <tr>
                      <td class="text-bold-800">Total</td>
                      <td class="text-bold-800 text-right"> $ 15,440.00</td>
                    </tr>
                    <tr>
                      <td>Payment Made</td>
                      <td class="pink text-right">(-) $ 2,440.00</td>
                    </tr>
                    <tr class="bg-grey bg-lighten-4">
                      <td class="text-bold-800">Balance Due</td>
                      <td class="text-bold-800 text-right">$ 13,000.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="text-center">
                <p>Authorized person</p>
                <img src="../../../app-assets/images/pages/signature-scan.png" alt="signature" class="height-100"/>
                <h6>Carla Prop</h6>
                <p class="text-muted">Managing Director</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Invoice Footer -->
        <div id="invoice-footer">
          <div class="row">
            <div class="col-md-7 col-sm-12">
              <h6>Terms & Condition</h6>
              <p>You know, being a test pilot isn't always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
            </div>
            <div class="col-md-5 col-sm-12 text-center">
              <button type="button" class="btn btn-info btn-lg my-1"><i class="la la-paper-plane-o"></i> Send Invoice</button>
            </div>
          </div>
        </div>
        <!--/ Invoice Footer -->

      </div>
    </section>
  </div>
</div>
</div>
<!-- END: Content-->
