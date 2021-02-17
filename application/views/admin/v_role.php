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
              <li class="breadcrumb-item"><a href="<?php echo base_url().'admin/index' ?>">Dashboard</a>
              </li>
              <li class="breadcrumb-item active">Role
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
          <div class="col-12 col-md-8">
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
                  <a class="btn btn-primary btn-sm text-white" href="<?php echo base_url().'admin/tambah_role' ?>"><i class="la la-plus"> Add data</i> </a>
                  <p class="card-text"></p>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered zero-configuration">
                      <thead class="text-center">
                        <tr>
                          <th width="3%">No</th>
                          <th width="20%">Code Role</th>
                          <th width="30%">Role Name</th>
                          <th width="1%">Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        if( ! empty($role)){ // Jika data siswa tidak sama dengan kosong, artinya jika data siswa ada
                          foreach($role as $r){
                            ?>
                            <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $r->role_code; ?></td>
                              <td><?php echo $r->role_name; ?></td>
                              <td>
                                <div class="dropdown dropleft">
                                  <a class="btn btn-info btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-cogs"></i>
                                  </a>

                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="<?php echo base_url().'admin/ubah_role/'.$r->id_role; ?>" class="btn btn-sm btn-warning ml-1" data-toggle="popover" data-content="Edit Data" data-trigger="hover"><i class="la la-edit"></i></a>
                                    <a href="<?php echo base_url().'admin/hapus_role/'.$r->id_role; ?>" class="btn btn-sm btn-danger remove" data-toggle="popover" data-content="Hapus Data" data-trigger="hover"><i class="la la-trash"></i></a>
                                    <!-- <a class="dropdown-item" href="#">#</a> -->
                                  </div>
                                </div>
                                </td>
                              </tr>
                            <?php } ?>
                          <?php } else{ // Jika data siswa kosong
                            echo "<tr><td align='center' colspan='7'>Data Tidak Ada</td></tr>";
                          }
                          ?>
                        </tbody>
                        <tfoot class="text-center">
                          <tr>
                            <th width="3%">No</th>
                            <th width="20%">Code Role</th>
                            <th width="30%">Role Name</th>
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
