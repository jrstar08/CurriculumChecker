<?php
    // INCLUDE PA SI GETTING NOT OKAY SUBJECTS PHP
    if(isset($_SESSION['not_okay_subjects']) == NULL)
        include('getting_not_okay_subjects.php');
    $not_okay_subjects = $_SESSION['not_okay_subjects'];

    for($i=0; $i<count($not_okay_subjects); $i++)
    {
        $query = "UPDATE studyplan_template set enrolled = 0 where subjectid = '$not_okay_subjects[$i]'";
        $result = mysqli_query($conn,$query);
    }
?>