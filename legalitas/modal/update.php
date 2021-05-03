<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="modal-header">
    <h4 class="modal-title">Update</h4>
</div>

<div id="modal_form" current="1">
    <div class="modal-body">
    <?php if($data){ ?>
    <form action="<?php echo site_url('legalitas/update') ?>" class="row" id="form-Update">
    <input type="hidden" name="idOld" value="<?php echo $data->n_legalitas_id ?>">
    <div class="col-md-4">
    <table class="table mb-0">
        <tbody>
        <tr>
            <th width="145" class="padding-top-20 border-top-0">Document Type</th>
            <td class="border-top-0">
                <div class="form-group">
                    <select class="form-control select2s_" name="type">
                        <option></option>
                        <?php
                        if($data->c_type){
                            $typ = explode(',', $data->c_type);
                            foreach($typeList as $ls){
                                if(in_array($ls, $typ, true)){
                                    echo set_option($ls, $ls);
                                }
                                else echo set_option($ls);
                            }
                        }
                        else foreach($typeList as $ls) echo set_option($ls);
                        ?>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th class="padding-top-20">Document Name</th>
            <td>
                <div class="input-group mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding:0 17px"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="name" maxlength="50" value="<?php echo $data->c_name ?>" />
                </div>
            </td>
        </tr>
        <tr>
            <th class="padding-top-20">Document Number</th>
            <td>
                <div class="input-group mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="padding:0 17px"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="noDocument" maxlength="50" value="<?php echo $data->c_no_document ?>" />
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    <div class="col-md-4">
    <table class="table mb-0">
        <tbody>
        <tr>
            <th class="padding-top-20">Date of Document</th>
            <td>
                <div class="form-group mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control datepicker_" name="dateDocument" value="<?php if($data->d_document_date) echo date('d M Y', strtotime($data->d_document_date))?>" />
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th class="padding-top-15">Status <br> <small>Uncheck for archived</small></th>
            <td>
                <div class="form-group mb-0">
                    <span class="m-switch m-switch--icon-check">
                        <label>
                            <input type="checkbox" name="active" value="1" checked="<?php if ($data->n_status == 1) echo 'checked'?>">
                            <span></span>
                        </label>
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <th class="padding-top-20">Document File <br> <small>Format must be PDF / JPEG and Max 5mb</small></th>
            <td>
                <div class="form-group mb-0">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Browse file.." readonly="readonly" aria-describedby="browseFiles" onclick="$('#browseFile').click()">
                        <input type="file" class="display-none" name="file" id="browseFile" accept=".jpeg,.pdf" onchange="setAttach($(this))" />
                        <div class="input-group-append">
                        <span class="input-group-text" id="browseFiles" onclick="$('#browseFile').click()">
                            <i class="fa fa-paperclip"></i>
                        </span>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    <div class="col-md-4">
    <table class="table mb-0">
        <tbody>
        <tr>
            <th class="padding-top-20">Date Expired <small>Fill if expired</small></th>
            <td>
                <div class="form-group mb-0">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control datepicker2_" name="expiredDocument"  value="<?php if($data->d_expired_date) echo date('d M Y', strtotime($data->d_expired_date))?>" />
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th class="padding-top-20">Note</th>
            <td>
                <div class="form mb-0">
                    <textarea name="note" cols="50" class="form-control" rows="8" maxlength="50" placeholder="Add some note if require"><?php echo $data->c_note ?></textarea>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    </div>
    </form>
    <?php } else echo '<div class="alert alert-primary text-center"><strong>Sorry</strong>, there is no data to display.</div>' ?>
    </div>
    <div class="modal-footer">
    	<button type="button" id="btn-Update" class="btn btn-primary" onclick="doSubmit('Update')">Submit</button>
    	<button type="button" class="btn btn-secondary" onclick="closeMultiModal(1)">Close</button>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	sizeMultiModal(1, "full");
	centerMultiModal(1);

    $(".select2s_").select2({
      placeholder: "Please select",
      allowClear: true
  });

    $(".datepicker_").datepicker({
    autoclose: true,
    format: 'dd M yyyy',
    todayHighlight: true,
    todayBtn: true,
    endDate: new Date() // batasi akhir periode tanggal yang dipilih
  });

  $(".datepicker2_").datepicker({
    autoclose: true,
    format: 'dd M yyyy',
    todayHighlight: true,
    todayBtn: true,
  });
});
</script>