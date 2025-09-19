<div class="row">
    <div class="span12">
        <legend><?php echo ucfirst($title) ?></legend>        
        <?php
        echo flash_msg(3);
        echo $paginator;
        echo $alumni_table;
        echo $paginator;
        ?>
    </div>
</div>