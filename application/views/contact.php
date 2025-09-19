<legend>Give your feedback</legend>
<?php
echo form_open('home/contact');
echo flash_msg(3);
echo validation_errors();
?>
<label>Your name</label>
<input value="<?php set_value('name') ?>" name="name" type="text" placeholder="Your name" class="input-block-level">
<label>Your email</label>
<input value="<?php set_value('email') ?>" name="email" type="text" placeholder="Your email" class="input-block-level">
<label>Subject</label>
<input value="<?php set_value('subject') ?>" name="subject" type="text" placeholder="Subject" class="input-block-level">
<label>Description</label>
<textarea name="description" rows="4" cols="20" placeholder="Body" class="input-block-level"><?php set_value('description') ?></textarea>
<button type="submit" class="btn btn-primary">Submit</button>
<button type="reset" class="btn">Reset</button>
<?php echo form_close(); ?>
<legend>Contact us</legend>
<p><?php echo $site_contact; ?></p>