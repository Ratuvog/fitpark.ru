<?$this->load->view('admin/head');?>
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
	<script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<div class="output">
   <?php echo $output; ?>
</div>
    
<input type="hidden" id="tbl" name="table" value="<?php echo $currentTable;?>" />