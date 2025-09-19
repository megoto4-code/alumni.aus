<?php require_once 'alumni_breadcrumb.php'; ?>
<legend>Select a year</legend>
<ul class="nav nav-tabs nav-stacked">
    <?php for ($i = date("Y"); $i >= 1994; $i--) { ?>
        <li>
            <a href="<?php echo base_url() ?>home/alumni_records/<?php echo /*$campus_id . '/' . $school_id . '/' . $department_id . '/' .*/ $course_id . '/' . $i; ?>">
                Year : <?php echo $i ?>
            </a>
        </li>
    <?php } ?>
</ul>