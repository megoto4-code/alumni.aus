<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<?php echo form_open(); ?>
<legend>Alumni form (ADMIN)</legend>
<p class="text-error">Before registering any alumni, make sure that you have added all the required items of the "Misc" section.</p>
<?php echo validation_errors();
echo flash_msg(1)
?>
<div class="row">
    <div class="span4">
        First name:<i class="icon-star-empty"></i>
        <input type="text" name="fname" value="<?php echo set_value('fname'); ?>" class="input-block-level" /> 
    </div>
    <div class="span4">
        Middle name:
        <input type="text" name="mname" value="<?php echo set_value('mname'); ?>" class="input-block-level" />
    </div>
    <div class="span4">
        Last name:<i class="icon-star-empty"></i>
        <input type="text" name="lname" value="<?php echo set_value('lname'); ?>" class="input-block-level" />
    </div>
</div>
<div class="row">
    <div class="span2">
        Campus:<i class="icon-star-empty"></i><?php echo $campuses ?>
        School:<i class="icon-star-empty"></i><?php echo $schools ?>        
    </div>
    <div class="span4">
        Department:<i class="icon-star-empty"></i><?php echo $departments ?>   
        Course:<i class="icon-star-empty"></i><?php echo $courses ?>
    </div>
    <div class="span6">
        Current address:
        <textarea name="address" rows="4" cols="20" class="input-block-level"><?php echo set_value('address'); ?></textarea>
    </div>
</div>
<div class="row">
    <div class="span2">
        Sex:
        <select name="sex" class="input-block-level">
            <option value="">Select</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <div class="span4">
        Organization:
        <input type="text" name="organization" value="<?php echo set_value('organization'); ?>" class="input-block-level" /><br>        
    </div>
    <div class="span3">
        Session from:
        <input type="text" name="session_from" value="<?php echo set_value('session_from'); ?>" class="input-block-level" />
    </div>
    <div class="span3">
        Session to (passing year):<i class="icon-star-empty"></i>
        <input type="text" name="session_to" value="<?php echo set_value('session_to'); ?>" class="input-block-level" />
    </div>
</div>
<div class="row">
    <div class="span4">
        Designation:
        <input type="text" name="designation" value="<?php echo set_value('designation'); ?>" class="input-block-level" /> 
    </div>
    <div class="span4">
        Email:
        <input type="text" name="email" value="<?php echo set_value('email'); ?>" class="input-block-level" />
    </div>
    <div class="span4">
        Mobile:
        <input type="text" name="mobile" value="<?php echo set_value('mobile'); ?>" class="input-block-level" />
    </div>
</div>
<div class="row">
    <div class="span12">
        <input type="submit" value="Register" class="btn btn-primary btn-block"/>
        <input type="reset" value="Reset" class="btn btn-block"/>
    </div>        
</div>
<?php echo form_close(); ?>