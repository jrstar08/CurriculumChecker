<?php
    include ('connect.php');
    $subjects = $_POST['subjects'];
    $semester = $_POST['semester'];
    $semester_y = substr($semester,0,1);
    $semester_s = substr($semester,1,1);
    $output = '';

    if($semester == 11)
        $maxunits = 23;
    else if($semester == 12)
        $maxunits = 23;
    else if($semester == 21)
        $maxunits = 23;
    else if($semester == 22)
        $maxunits = 25;
    else if($semester == 31)
        $maxunits = 23;
    else if($semester == 32)
        $maxunits = 24;
    else if($semester == 33)
        $maxunits = 6;
    else if($semester == 41)
        $maxunits = 21;
    else if($semester == 42)
        $maxunits = 21;
    else if($semester == 51)
        $maxunits = 21;
    else if($semester == 52)
        $maxunits = 21;

    // OVERLOAD: 4_2 = 27
    
    // GET TOTAL UNITS OF SELECTED SUBJECTS
    $total = 0;
    for($i=0; $i<count($subjects); $i++)
    {
        $query = "select credits from studyplan_template where subjectid = '$subjects[$i]'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        $total += $row[0];
    }

    // GET CURRENT TOTAL UNITS OF SELECTED SEMESTER
    $query = "SELECT SUM(credits) FROM studyplan_template WHERE current_year = '$semester_y' AND current_sem = '$semester_s'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    $totall = $total + $row[0];


    if($totall > $maxunits)
        echo $maxunits;
    else
    {
        for($i=0; $i<count($subjects); $i++)
        {
            $query = "update studyplan_template set current_year = '$semester[0]', current_sem = '$semester[1]' where subjectid = '$subjects[$i]'";
            mysqli_query($conn, $query);
        }
        echo '';
    }

?>