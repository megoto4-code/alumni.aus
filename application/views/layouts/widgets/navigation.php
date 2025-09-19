<div class="navbar">
    <div class="navbar-inner">
        <a class="brand" href="<?php echo base_url(); ?>"><i class="icon-home"></i></a>
        <ul class="nav">
            <?php echo $site_menu; ?>
            <li<?php echo ($title == 'Alumni search' ? ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>home/search"><i class="icon-search"></i> Alumni</a></li>
            <li<?php echo ($title == 'Registered alumni' ? ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>home/registered_alumni"><i class="icon-th-list"></i> Registered Alumni</a></li>
            <li<?php echo ($title == 'Contact us' ? ' class="active"' : ''); ?>><a href="<?php echo base_url(); ?>home/contact"><i class="icon-envelope"></i> Contact</a></li>
        </ul>
    </div>
</div>