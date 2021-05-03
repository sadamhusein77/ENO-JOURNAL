<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="modal-header">
    <h4 class="modal-title">Edit</h4>
</div>

<div id="modal_form" current="1">
    <div class="modal-body">
    <?php if($data){ ?>
    <form action="<?php echo site_url('legalitas/edit') ?>" class="row" id="form-Edit">
    <input type="hidden" name="id" value="<?php echo $data->n_legalitas_id ?>" />
    <div class="col-md-12">
    <table class="table mb-0">
        <tbody>
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
    	<?php if($data) echo '<button type="button" id="btn-Edit" class="btn btn-primary" onclick="doSubmit(\'Edit\')">Save Changes</button>' ?>
    	<button type="button" class="btn btn-secondary" onclick="closeMultiModal(1)">Close</button>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	sizeMultiModal(1, "md");
	centerMultiModal(1);
});
</script>