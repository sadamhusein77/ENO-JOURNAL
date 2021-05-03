<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="m-subheader">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title"><?php echo $breadcrumb[0] ?></h3>
        </div>
    </div>
</div>

<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text"></h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a onclick="toggleSearch()" class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--icon m-btn--icon-only m-btn--pill m-dropdown__toggle" id="icoSearch" title="Search"><i class="fa fa-search m--font-primary"></i></a>
                    </li>
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                            <a class="m-portlet__nav-link btn btn-lg btn-secondary m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle"><i class="la la-ellipsis-h m--font-primary"></i></a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <?php if (role('MANAGE LEGALITAS')): ?>
                                                <li class="m-nav__item">
                                                    <a onclick="showMultiModal(1, 'add', 0, '<?php echo site_url('legalitas') ?>')" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-add"></i>
                                                        <span class="m-nav__link-text">Create New</span>
                                                    </a>
                                                </li>
                                                <?php endif ?>
                                                <li class="m-nav__item">
                                                    <a onclick="showMultiModal(1, 'report', 0, '<?php echo site_url('legalitas') ?>')" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-file-1"></i>
                                                        <span class="m-nav__link-text">Create Report</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="m-portlet__body border-bottom-ebedf2 panel-search" id="panel-search">
            <form action="<?php echo site_url('legalitas/populate') ?>" class="row" id="form-search">
            <div class="col-md-3">
                <div class="form-group">
                    <label>Document Type</label>
                    <div class="input-group mb-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="type" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Document Name</label>
                    <div class="input-group mb-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="name" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Document Number</label>
                    <div class="input-group mb-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-code"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="noDocument" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <label class="row d-none d-lg-block d-md-block">&nbsp;</label>
                <a onclick="doSearch()" class="btn btn-primary"><span><i class="fa fa-search"></i> Search</span></a>
                <a onclick="doReset()" class="btn btn-metal"><span><i class="fa fa-eraser"></i> Reset</span></a>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Document Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control datepicker_" name="dateDocument"/>
                    </div>
                </div>
            </div>
            </form>
        </div>
        
        <div class="m-portlet__body">
        	<div id="panel-data"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	setTimeout(function(){
		doSearch();
	}, 500);

    $(".datepicker_").datepicker({
    autoclose: true,
    format: 'dd M yyyy',
    todayHighlight: true,
    todayBtn: true,
    endDate: new Date() // batasi akhir periode tanggal yang dipilih
  });

});
</script>