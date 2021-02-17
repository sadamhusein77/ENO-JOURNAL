<footer class="footer footer-static footer-light navbar-border navbar-shadow">
  <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2020  &copy; Copyright <a class="text-bold-800 grey darken-2" href="https://themeselection.com" target="_blank">EnoFotocopy</a></span>
  </div>
</footer>

<!-- BEGIN VENDOR JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/forms/switch.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/tables/datatable/datatable-basic.min.js" type="text/javascript"></script>
<!-- Chartist  JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/charts/chartist-plugin-tooltip.min.js" type="text/javascript"></script>
<!-- BEGIN CHAMELEON  JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/js/core/app-menu.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/core/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/customizer.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/jquery.sharrre.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/popover.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/sweetalert2.all.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/sweetalert2/dist/myscript.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/assets/js/rupiah.js" type="text/javascript"></script> -->
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/forms/form-select2.min.js" type="text/javascript"></script>
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/documentation.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/ui/affix.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/charts/chartist/line/line.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/forms/repeater/jquery.repeater.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/forms/form-repeater.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/theme-assets/vendors/js/extensions/jquery.steps.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/jquery.PrintArea.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url(); ?>assets/theme-assets/js/scripts/forms/wizard-steps.min.js" type="text/javascript"></script> -->
<!-- END PAGE LEVEL JS-->
<script type="text/javascript">
$(document).ready(function(){
  $('#id_customer').on('input',function(){

    var id_customer=$(this).val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('staff/get_customer')?>",
      dataType : "JSON",
      data : {id_customer: id_customer},
      cache:false,
      success: function(data){
        $.each(data,function(id_customer, customer_email, customer_telp, customer_address, customer_npwp){
          $('[name="customer_email"]').val(data.customer_email);
          $('[name="customer_telp"]').val(data.customer_telp);
          $('[name="customer_address"]').val(data.customer_address);
          $('[name="customer_npwp"]').val(data.customer_npwp);

        });

      }
    });
    return false;
  });

});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#id_service').on('input',function(){

    var id_service=$(this).val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('staff/get_service')?>",
      dataType : "JSON",
      data : {id_service: id_service},
      cache:false,
      success: function(data){
        $.each(data,function(id_service, price){
          $('[name="price"]').val(data.price);
        });

      }
    });
    return false;
  });

});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#no_order').on('input',function(){

    var no_order=$(this).val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('staff/get_noorder')?>",
      dataType : "JSON",
      data : {no_order: no_order},
      cache:false,
      success: function(data){
        $.each(data,function(customer_name, total_service){
          $('[name="customer_name"]').val(data.customer_name);
          $('[id="total_service"]').val(data.total_service);
        });

      }
    });
    return false;
  });

});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#id_vendor').on('input',function(){

    var id_vendor=$(this).val();
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('staff/get_vendor')?>",
      dataType : "JSON",
      data : {id_vendor: id_vendor},
      cache:false,
      success: function(data){
        $.each(data,function(id_vendor, vendor_email, vendor_telp, vendor_address, vendor_npwp){
          $('[name="vendor_email"]').val(data.vendor_email);
          $('[name="vendor_telp"]').val(data.vendor_telp);
          $('[name="vendor_address"]').val(data.vendor_address);
          $('[name="vendor_npwp"]').val(data.vendor_npwp);

        });

      }
    });
    return false;
  });

});
</script>

<script>
function sum() {
  var txtFirstNumberValue = document.getElementById('price').value;
  var txtSecondNumberValue = document.getElementById('quantity').value;
  var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
  if (!isNaN(result)) {
    document.getElementById('amount').value = result;
  }
}
</script>

<script>
function jumlah() {
  var txtFirstNumberValue = document.getElementById('price').value;
  var txtSecondNumberValue = document.getElementById('qty').value;
  var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
  if (!isNaN(result)) {
    document.getElementById('sub_total').value = result;
  }
}
</script>

<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;
	}
	</script>

<!-- <script type="text/javascript">
$(document).ready(function(){
var i=1;

$('#add').click(function(){
i++;
$('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select class="custom-select form-control" name="addmore[][id_service]" id="id_service" class="form-control name_list" required=""><option value="">- Choose Services</option><?php foreach($service as $s){ ?><option <?php if(set_value('id_service') == $s->id_service){echo "selected='selected'";} ?> value="<?php echo $s->id_service ?>"><?php echo $s->service_name; ?></option><?php } ?></select></td><td><input type="text" name="addmore[][price]" id="price" class="form-control name_list" required="" /></td><td><input type="number" name="addmore[][quantity]" placeholder="Input Quantity" class="form-control name_list" required="" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
});

$(document).on('click', '.btn_remove', function(){
var button_id = $(this).attr("id");
$('#row'+button_id+'').remove();
});

});
</script> -->
<!-- <script>
$(function () {
$('#example1').DataTable()
$('#example2').DataTable({
'paging'      : false,
'lengthChange': true,
'searching'   : true,
'ordering'    : true,
'info'        : true,
'autoWidth'   : true
})
$('#example3').DataTable({
'paging'      : false,
'lengthChange': true,
'searching'   : false,
'ordering'    : true,
'info'        : true,
'autoWidth'   : true
})
})
</script> -->
</body>
</html>
