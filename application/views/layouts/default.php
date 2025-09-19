<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="<?php echo $creator; ?>"/>
        <link href="<?php echo base_url() ?>resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="<?php echo base_url() ?>resources/default.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container" id="container">
            <div class="row">
                <div class="span2">
                    <img width="<?php echo $site_logo_size ?>" src="<?php echo base_url() ?>resources/img/<?php echo $site_logo ?>" class="img-polaroid" alt="logo">
                </div>
                <div class="span10">
                    <!-- Header goes here -->
                    <h2><?php echo $site_name; ?></h2>
                    <h5><?php echo $site_slogun; ?></h5>
                    <p class="text-right"><?php echo ($admin_btn != null) ? 'Logged in as ' . anchor('admin', 'Admin') . ' <i class="icon-user"></i>' : '' ?></p>
                </div> 
            </div>      
            <div class="row">
                <div class="span12">
                    <!-- Navigation goes here -->
                    <?php require_once 'widgets/navigation.php'; ?>

                    <!-- Breadcrumb goes here 
                    <?php require_once 'widgets/breadcrumb.php'; ?> --> 
                    <!-- Content goes here -->     

                    <?php
                    echo $content;
                    ?>

                    <!-- Footer goes here -->
                </div>
            </div>
            <div class="row">
                <div class="span12">
                    <hr>
                    <p class="text-center">
                        <?php echo $site_copyright; ?>                        
                    </p>                    
                </div>
            </div>
        </div> 
        <?php echo $note; ?>
        <script src="<?php echo base_url() ?>resources/bootstrap/js/jquery.js"></script>
        <script src="<?php echo base_url() ?>resources/bootstrap/js/holder.js"></script>
        <script src="<?php echo base_url() ?>resources/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>resources/default.js"></script>
    </body>
</html>
