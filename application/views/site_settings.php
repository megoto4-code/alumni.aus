<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<div class="row">
    <div class="span12">
        <legend>Site settings</legend>
        <?php echo form_open('admin/site_settings');
        echo flash_msg(3);
        echo validation_errors(); ?>
        <label>Site name</label>
        <input type="text" name="name" value="<?php echo $site_name; ?>" class="input input-block-level" />
        <label>Site slogun</label>
        <input type="text" name="slogun" value="<?php echo $site_slogun; ?>" class="input input-block-level" />
        <label>Site logo</label>
        <input type="text" name="logo" value="<?php echo $site_logo; ?>" class="input input-block-level" />
        <label>Site logo size (in pixel)</label>
        <input type="text" name="logo_size" value="<?php echo $site_logo_size; ?>" class="input input-block-level" />
        <label>Site contact address</label>
        <textarea name="contact" rows="8" cols="20" class="input input-block-level"><?php echo $site_contact; ?></textarea>
        <label>Site copyright text</label>
        <input type="text" name="copyright" value="<?php echo $site_copyright; ?>" class="input input-block-level" />
        <label>Site owner name</label>
        <input type="text" name="owner" value="<?php echo $site_owner; ?>" class="input input-block-level" />
        <input type="submit" value="Update" class="btn btn-primary btn-block" />
<?php echo form_close() ?>
    </div>
</div>