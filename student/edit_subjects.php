<?php
    $studyplanid = $_SESSION['studyplanid'];
    $studentid = $_SESSION['studentid'];
    
    $query = "SELECT subjectid, year, sem FROM STUDYPLAN WHERE studyplanid = '$studyplanid' AND studentid = '$studentid'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0)
    {
        while($row = mysqli_fetch_row($result))
        {
            $query1 = "UPDATE studyplan_template SET enrolled = 0, current_year = '$row[1]', current_sem = '$row[2]' WHERE subjectid = '$row[0]'";
            $result1 = mysqli_query($conn, $query1);
        }
    }
?>