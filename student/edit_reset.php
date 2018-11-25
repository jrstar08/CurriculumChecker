<?php
    $query = "update studyplan_template set current_year = 0, current_sem = 0, enrolled = 1 where curriculumid = 200933";
    $result = mysqli_query($conn, $query);
?>