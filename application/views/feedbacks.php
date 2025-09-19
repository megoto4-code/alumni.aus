<?php require_once 'layouts/widgets/admin_nav.php'; ?>
<legend>All feedbacks</legend>
<?php
echo flash_msg(2);
echo $feedbacks;
echo $paginator;
?>
