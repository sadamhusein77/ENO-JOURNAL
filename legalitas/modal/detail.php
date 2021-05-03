<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="modal-header">
    <h4 class="modal-title">Detail</h4>
</div>

<div id="modal_form" current="1">
    <div class="modal-body row">
        <div class="col-md-12">
            <table class="table mb-0 center">
                <tbody class="align-centered">
                <tr>
                    <th width="145" class="border-top-0">Document Name</th>
                    <td class="border-top-0"><?php echo $data->c_name ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?php echo $data->c_type ?></td>
                </tr>
                <tr>
                    <th>Document Number</th>
                    <td><a href="<?php echo base_url($data->document) ?>" target="_blank"><i class="fa fa-file-image"></i></a> <code><?php echo $data->c_no_document ?></code></td>
                </tr>
                <tr>
                    <th>Document Date</th>
                    <td><?php echo date('d M Y', strtotime($data->d_document_date))?></td>
                </tr>
                <tr>
                    <th>Expired Date</th>
                    <td><?php echo date('d M Y', strtotime($data->d_document_date))?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?php if ($data->n_status == 1){
                        echo '<code>Active</code>'; 
                    } else {
                        echo '<code>Archived</code>'; 
                    } ?> </td>
                </tr>
                <tr>
                    <th>Created Date</th>
                    <td><?php echo date('d M Y', strtotime($data->d_created_date))?></td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td><?php echo $data->c_note ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer display-block">
    	<button type="button" class="btn btn-info" onclick="showMultiModal(2, 'history', <?php echo $data->n_legalitas_id ?>, '<?php echo site_url('legalitas') ?>')">History</button>
    	<button type="button" class="btn btn-secondary float-right" onclick="closeMultiModal(1)">Close</button>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	sizeMultiModal(1, "md");
	centerMultiModal(1);
});
</script>