<?php
echo form_open('home/alumni');
?>
<legend>Search Alumni</legend>
<div class="row">
    <div class="span4">
        School: 
        <?php echo $schools ?>
    </div>    
    <div class="span4">
        Department: 
        <?php echo $departments ?>
    </div>
    <div class="span4">
        Course: 
        <?php echo $courses ?>
    </div>
</div>
<div class="row">
    <div class="span4">
        First name: 
        <input type="text" name="fname" value="" class="input-block-level" /> 
    </div>
    <div class="span4">
        Middle name:
        <input type="text" name="mname" value="" class="input-block-level" />
    </div>
    <div class="span4">
        Last name: 
        <input type="text" name="lname" value="" class="input-block-level" />
    </div>
</div>
<div class="row">
    <div class="span4">
        Organization:  
        <input type="text" name="organization" value="" class="input-block-level" /><br>
    </div>    
    <div class="span4">
        Passing Year: 
        <input type="text" name="session_to" value="" class="input-block-level" /> <br>
    </div>
    <div class="span4">
        Email: 
        <input type="text" name="email" value="" class="input-block-level" /> <br>
    </div>
</div>
<button type="submit" class="btn btn-primary btn-block">Search</button>
<a href="<?php echo base_url() ?>home/alumni" class="btn btn-large btn-block btn-success" target="_blank">View all</a>
<button type="reset" class="btn btn-block">Reset</button>
<?php
echo form_hidden('search', 'alumni');
echo form_close();
?>