<?php
$warning1 = '<p class="text-error">Warning: before deleting any following row, please be sure that any other data is not dependant on this particular row.</p>';
?>
<ul class="nav nav-tabs">
    <li class="<?php echo $title == 'administrator home' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin">Admin Home</a>
    </li>
    <li class="<?php echo $title == 'alumni' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin/alumni">Alumni</a>
    </li>
    <li class="<?php echo $title == 'site settings' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin/site_settings">Site settings</a>
    </li>
    <li class="<?php echo $title == 'carousel' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin/carousel">Slideshow</a>
    </li>
    <li class="<?php echo $title == 'pages and menus' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin/pages_menus">Pages and menus</a>
    </li>
    <li class="<?php echo $title == 'feedbacks' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin/feedbacks">Feedbacks</a>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle"
           data-toggle="dropdown"
           href="#">
            Misc
            <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <!--
            <li>
                <a href="<?php echo base_url() ?>admin/alumni_all">View Alumni</a>
            </li>
            <li class="divider"></li>
            -->
            <li>
                <a href="<?php echo base_url() ?>admin/campuses">Manage Campuses</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>admin/schools">Manage Schools</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>admin/departments">Manage Departments</a>
            </li>
            <li>
                <a href="<?php echo base_url() ?>admin/courses">Manage Courses</a>
            </li>
        </ul>
    </li>
    <li class="<?php echo $title == 'account settings' ? 'active' : '' ?>">
        <a href="<?php echo base_url() ?>admin/account_settings">Account settings</a>
    </li>
    <li class="pull-right"><a href="<?php echo base_url() ?>admin/logout">Logout</a></li>
</ul>