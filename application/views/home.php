<!-- Carousel goes here -->
<?php
echo flash_msg(2);
echo validation_errors();
//require_once 'layouts/widgets/carousel.php';
echo $site_carousel;
?>
<div class="row">
    <div class="span3 sticky">
        <?php echo $admin_btn; ?>
        <fieldset>            
            <legend>New Member?</legend>
            <a href="<?php echo base_url() ?>home/register" class="btn btn-primary btn-block btn-large">Register alumni</a>
            <a href="<?php echo base_url() ?>home/search" class="btn btn-block btn-large">Search Alumni</a>
        </fieldset>
        <a name="admin_login"></a>
        <?php
        if ($admin_btn == null) {
            echo form_open('home');
            ?>
            <fieldset>
                <legend>Administrator's Login</legend>
                <label>Username</label>
                <input value="<?php set_value('username') ?>" name="username" type="text" placeholder="Type registered email here" class="input-block-level">
                <label>Password</label>
                <input value="<?php set_value('password') ?>" name="password" type="password" placeholder="Type your password here" class="input-block-level">
                <button type="submit" class="btn btn-success">Login</button>
                <button type="reset" class="btn">Reset</button>
            </fieldset>
            <?php
            echo form_close();
        }
        ?>
    </div>
    <div class="span9 pull-right">
        <?php
        echo $news;
        echo $paginator;
        ?>
    </div>
</div>
