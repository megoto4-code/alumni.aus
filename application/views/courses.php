<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Manage Courses</legend>
<?php
echo form_open();
echo flash_msg(3);
echo validation_errors();
?>
<label>Name</label>
<input name="name" type="text" class="input-block-level">
<label>Duration (in months)</label>
<input name="duration" type="text" class="input-block-level">
<button type="submit" class="btn btn-primary btn-block">Add</button>
<?php echo form_close() ?>
<?php echo $warning1; ?>
<?php echo $departments_table ?>