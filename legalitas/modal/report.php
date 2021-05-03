<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="modal-header">
    <h4 class="modal-title">Report</h4>
</div>

<div id="modal_form" current="1">
    <div class="modal-body">
    <form action="<?php echo site_url('deposito/report') ?>" class="row" id="form-Report">
    <div class="col-md-6">
        <div class="form-group">
            <label>Bank / Koperasi</label>
            <select class="form-control select2s_" name="bank">
                <option></option>
                <?php foreach($bank as $ls) echo set_options($ls->n_bank_id, $ls->c_name) ?>
            </select>
        </div>

        <div class="form-group">
            <label>Start Date</label>
            <span class="clear-ico" id="clear_dateStart" onclick="clearVal('dateStart')" style="display:block;z-index:5">×</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <input type="text" class="form-control datepicker_" id="dateStart" name="start" readonly="readonly" />
            </div>
        </div>

        <div class="form-group">
            <label>Dep. Name</label>
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
    <div class="col-md-6">
        <div class="form-group">
            <label>Account Officer</label>
            <select class="form-control select2s_" name="ao">
                <option></option>
                <?php foreach($ao as $ls) echo set_options($ls->n_ao_id, $ls->c_name) ?>
            </select>
        </div>

        <div class="form-group">
            <label>End Date</label>
            <span class="clear-ico" id="clear_dateEnd" onclick="clearVal('dateEnd')" style="display:block;z-index:5">×</span>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <input type="text" class="form-control datepicker_" id="dateEnd" name="end" readonly="readonly" />
            </div>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select class="form-control select2s_" name="status">
                <option></option>
                <?php foreach(status('deposito', 0) as $key => $val) echo set_options($key, $val) ?>
            </select>
        </div>
    </div>
    </form>
    </div>
    <div class="modal-footer">
        <button type="button" id="btn-Report" class="btn btn-primary" onclick="doSubmit('Report')">Submit</button>
    	<button type="button" class="btn btn-secondary" onclick="closeMultiModal(1)">Close</button>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	sizeMultiModal(1, "md");
	centerMultiModal(1);

    $(".select2s_").select2({
        placeholder: "Please select",
        allowClear: true
    });

    $(".datepicker_").datepicker({
        rtl: mUtil.isRTL(),
        format: "dd M yyyy",
        todayHighlight: true,
        autoclose: true,
        orientation: "bottom"
    });
});
</script>