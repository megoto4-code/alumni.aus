<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Add alumni</legend>
<?php
echo form_open();
echo flash_msg(3);
echo validation_errors();
?>
<label>Name<i class="icon-star-empty"></i></label>
<input name="name" value="<?php echo set_value('name'); ?>" type="text" class="input-block-level">
<label>Course<i class="icon-star-empty"></i></label>
<?php echo $courses; ?>
<label>Year<i class="icon-star-empty"></i></label>
<?php years(1994, date("Y"), 'input-block-level') ?>
<label>Address;</label>
<textarea name="address" rows="4" cols="20" class="input-block-level"><?php echo set_value('address'); ?></textarea>
<label>Organization:</label>
<input type="text" name="organization" value="<?php echo set_value('organization'); ?>" class="input-block-level" />
<label>Designation:</label>
<input type="text" name="designation" value="<?php echo set_value('designation'); ?>" class="input-block-level" /> 
<label>Email:</label>
<input type="text" name="email" value="<?php echo set_value('email'); ?>" class="input-block-level" />
<button type="submit" class="btn btn-primary btn-block">Add</button>
<?php echo form_close() ?>