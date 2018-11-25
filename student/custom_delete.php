<?php
    include ('connect.php');
    $subjectid = $_POST['id'];

    $query = "select corequisites from curricula2 where subjectid = '$subjectid'";
    $result = mysqli_query($conn, $query);
    $corequisites = mysqli_fetch_row($result);

    $corequisite = explode(', ', $corequisites[0]);

    for($i=0; $i<count($corequisite); $i++)
    {
        $query = "update studyplan_template set current_year = 0, current_sem = 0 where subjectid = '$corequisite[$i]'";
        $result = mysqli_query($conn, $query);
    }
    
    $query = "update studyplan_template set current_year = 0, current_sem = 0 where subjectid = '$subjectid'";
    $result = mysqli_query($conn, $query);
?>