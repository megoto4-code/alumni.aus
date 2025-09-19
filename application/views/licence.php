<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="<?php echo base_url() ?>resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>

        <div class="row-fluid">
            <div class="span4"></div>
            <div class="span4">
                <?php echo form_open(); ?>
                    <fieldset>
                        <?php echo validation_errors(); ?>
                        <legend>User Licence
                            <a class="btn btn-small pull-right" href="<?php echo base_url() ?>licence">
                                Reload <i class="icon-refresh"></i>
                            </a>
                        </legend>
                        <label>Institute Name</label>
                        <input name="owner" class="input-block-level" type="text" placeholder="Type something…">                        
                        <label>Serial Code</label>
                        <input name="serial_key" class="input-block-level" type="password" placeholder="Type something…">
                        <button type="submit" class="btn btn-block btn-primary">Register</button>
                        <a class="btn btn-block pull-right" href="<?php echo base_url() ?>">Continue as trial   <i class="icon-arrow-right"></i></a>
                    </fieldset>                    
                <?php echo form_close(); ?>
                <p class="text-center">Please complete the registration process to  unlock the application</p>                
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
