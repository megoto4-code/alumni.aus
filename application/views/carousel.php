<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Add slideshow images</legend>
<?php
echo form_open();
echo flash_msg(3);
echo validation_errors();
?>
<label>Title</label>
<input name="title" type="text" class="input-block-level">
<label>Description</label>
<textarea name="desc" rows="4" cols="20" class="input-block-level">
</textarea>
<label>Path to the image with extention (Recommended 1024 X 380 px) (Upload images in <b>'\ resources \ img \'</b>)</label>
<input name="url" type="text" class="input-block-level">
<button type="submit" class="btn btn-primary btn-block">Add</button>
<?php echo form_close() ?>
<legend>Manage slideshow images</legend>
<?php echo $carousel_table; ?>