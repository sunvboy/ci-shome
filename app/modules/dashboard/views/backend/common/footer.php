<div class="footer">
	<div class="pull-right">
		Thời gian tải trang <?php echo $this->benchmark->elapsed_time(); ?>
	</div>
	<div>
		Copyright  <strong>OVN CRM SOFTWARE</strong> <?php echo date("Y"); ?>-<?php echo date("Y") + 1; ?>
	</div>
</div>
<script>
    var lang =  '<?php echo $this->fclang?>';
    $('#title').attr('data-lang',lang)
</script>