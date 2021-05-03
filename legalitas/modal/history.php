<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="modal-header">
    <h4 class="modal-title">Detail</h4>
</div>
<div id="modal_form" current="1">
    <div class="modal-body row">
<div class="table-responsive">
    <?php if($list): ?>
	<table class="table table-hover m-table m-table--head-bg-primary" id="populatedHistory" current-page="<?php echo $paging['page'] ?>">
		<thead>
			<tr>
				<th width="40">#</th>
                <th width="40">Created Date</th>
				<th width="250">Document Name</th>
				<th width="160">Type</th>
                <th width="250">No. Documnet</th>
                <th width="85">Date Document</th>
				<th width="85">Expired Date</th>
                <th width="85">Status</th>
				<th width="60" class="bg-action">Action</th>
			</tr>
		</thead>
		<tbody>
        	<?php
            $no = get_no($paging['limit'], $paging['page']);
            foreach ($list as $ls) {
			?>
			<tr>
				<th scope="row"><pre class="display-inline"><?php echo $no ?></pre></th>
				<td><?php echo $ls->d_created_date ?></td>
                <td><?php echo $ls->c_name ?></td>
				<td><?php echo $ls->c_type ?></td>  
                <td><a href="<?php echo base_url($ls->file) ?>" target="_blank"><i class="fa fa-file-image"></i></a> <code><?php echo $ls->c_no_document ?></code></td>
                <td><?php echo date('d M Y', strtotime($ls->d_document_date))?></td>
                <td><?php echo $ls->d_expired_date ?></td>
				<td><code><?php if($ls->n_status == 1){
					echo 'Active';
				} else {
					echo 'Archived';
				} ?></code></td>
                <td align="center">
                <a onclick="doDelete('<?php echo $ls->n_legalitas_id ?>', '<?php echo site_url('legalitas/delete') ?>')" title="Delete"><i class="fa fa-trash"></i></a>
                </td>
			</tr>
            <?php $no++; } ?>
		</tbody>
	</table>
    <?php
	echo pagination($paging['page'], 'showPage(', ceil($paging['total'] / $paging['limit']), $paging['total'], 'onclick', ')');
	else:
	echo '<div class="alert alert-brand text-center"><strong>Sorry</strong>, there is no data to display.</div>';
	echo '<script>showSearch()</script>';
	endif
	?>
</div>
</div>
    <div class="modal-footer display-block">
    	<button type="button" class="btn btn-secondary float-right mb-3" onclick="closeMultiModal(2)">Close</button>
</div>
</div>

<script type="text/javascript">
$(document).ready(function(e){
	sizeMultiModal(2, "full");
	centerMultiModal(2);
});
</script>