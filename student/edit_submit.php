<?php
    include ('connect.php');
    $studentid = $_SESSION['studentid'];
    $studyplanid = $_SESSION['studyplanid'];
    $year = 20172;

    // UPDATE
    $query = "UPDATE studyplan_approval SET advice = 0 WHERE studyplanid = '$studyplanid'";
    $result = mysqli_query($conn, $query);

    // DELETE
    $query = "DELETE FROM studyplan WHERE studyplanid = '$studyplanid'";
    $result = mysqli_query($conn, $query);
    
    // START
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

        // INSERT
        $query2 = "INSERT INTO studyplan(studyplanid, studentid, subjectid, subject, subjecttitle, credits, year, sem) values ('$studyplanid', '$studentid', '$subjectid', '$subject', '$subjecttitle', '$credits', '$cyear', '$csem')";
        $result2 = mysqli_query($conn, $query2);
    }
?>