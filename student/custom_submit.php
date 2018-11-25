<?php
    include ('connect.php');
    $studentid = $_SESSION['studentid'];
    $year = 20172;


    $query = "INSERT INTO studyplan_approval(studentid, approve, aysem) VALUES ('$studentid', '0', '$year')";
    $result = mysqli_query($conn, $query);

    $query = "SELECT studyplanid from studyplan_approval where studentid = '$studentid' and aysem = '$year' order by studyplanid desc limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $studyplanid = $row[0];
    
    // 

    $query = "SELECT * from studyplan_template";
    $result = mysqli_query($conn, $query);

    while($roww = mysqli_fetch_row($result))
    {
        $subjectid = $roww[1];
        $credits = $roww[2];
        $cyear = $roww[10];
        $csem = $roww[11];

        $query1 = "select subject, subjecttitle from subjects where subjectid = '$subjectid' limit 1";
        $result1 = mysqli_query($conn, $query1);
        $row1 = mysqli_fetch_row($result1);
        $subject = $row1[0];
        $subjecttitle = $row1[1];

        // 
        
        $query2 = "INSERT INTO studyplan(studyplanid, studentid, subjectid, subject, subjecttitle, credits, year, sem) values ('$studyplanid', '$studentid', '$subjectid', '$subject', '$subjecttitle', '$credits', '$cyear', '$csem')";
        $result2 = mysqli_query($conn, $query2);
        
    }

?>