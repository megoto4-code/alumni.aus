<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Administrator account settings</legend>
<?php
echo form_open('admin/account_settings');
echo flash_msg(2);
echo validation_errors();
?>
<label>Previous username</label>
<input type="text" name="previous_username" value="<?php echo set_value('previous_username');?>" class="input input-block-level" />
<label>Previous password</label>
<input type="password" name="previous_password" value="<?php echo set_value('previous_password');?>" class="input input-block-level" />
<label>Current username</label>
<input type="text" name="current_username" value="<?php echo set_value('current_username');?>" class="input input-block-level" />
<label>Current password</label>
<input type="password" name="current_password" value="<?php echo set_value('current_password');?>" class="input input-block-level" />
<input type="submit" value="Change" class="btn btn-primary btn-block"/>
<?php echo form_close(); ?>