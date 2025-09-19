<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Manage Departments</legend>
<?php
echo form_open();
echo flash_msg(3);
echo validation_errors();
?>
<label>Name</label>
<input name="name" type="text" class="input-block-level">
<label>Established</label>
<input name="established" type="text" class="input-block-level">
<label>School</label>
<?php echo $schools; ?>
<button type="submit" class="btn btn-primary btn-block">Add</button>
<?php echo form_close() ?>
<?php echo $warning1; ?>
<?php echo $departments_table ?>