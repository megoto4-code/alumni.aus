<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>Publish a news</legend>
<?php
echo form_open('admin/index/'.$news_id);
echo flash_msg(3);
echo validation_errors();
?>
<label>Title</label>
<input type="text" name="news_title" value="<?php if (isset($news_title)) {
    echo $news_title;
} else {
    set_value('news_title');
} ?>" class="input input-block-level" />

<label>Content</label>
<textarea name="news_content" rows="6" cols="20" class="input input-block-level"><?php if (isset($news_content)) {
    echo $news_content;
} else {
    set_value('news_content');
} ?></textarea>
<div class="row">
    <div class="span8">
        <input type="submit" value="Save and publish" class="btn btn-primary btn-block"/>
    </div>
    <div class="span4">
        <input type="reset" value="Reset" class="btn btn-block"/>
    </div>
</div>
<?php echo form_close(); ?>
