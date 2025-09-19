<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Create a Page</legend>
<?php
echo form_open('admin/pages_menus/' . $edit_page);
echo flash_msg(3);
echo validation_errors();
?>
<label>Page name</label>
<input value="<?php
if ($edit_page != FALSE) {
    echo $edit_page_name;
} else {
    set_value('name');
}
?>" name="name" type="text" placeholder="Page name" class="input-block-level">
<label>Page title</label>
<input value="<?php
if ($edit_page != FALSE) {
    echo $edit_page_title;
} else {
    set_value('title');
}
?>" name="title" type="text" placeholder="Page title" class="input-block-level">
<div class="row">
    <div class="span3">

    </div>
</div>
<label>Page Content</label>
<textarea name="content" rows="7" cols="20" placeholder="Body" class="input-block-level"><?php
if ($edit_page != FALSE) {
    echo $edit_page_content;
} else {
    set_value('content');
}
?></textarea>
<button type="submit" class="btn btn-primary btn-block"><?php echo ($edit_page == FALSE) ? 'Create' : 'Update' ?></button>
<?php echo form_close(); ?>
<legend>Pages List</legend>
<?php echo $pages_list; ?>