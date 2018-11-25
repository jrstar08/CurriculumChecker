<?php
    include ('connect.php');
    $subject_code = $_POST['subject_code'];
    $_SESSION['ACCREDITATION_LASTHOLD_SUBJECT'] = $subject_code;
    $subjectid = $_SESSION['accreditation_subjectid'];
    $curriculumid = $_SESSION['curriculumid'];

    $query = "SELECT clusterid1 FROM curricula1 WHERE subjectid = '$subjectid' AND curriculumid = '$curriculumid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);

    $query = "SELECT subjectid, subject, subjecttitle, credits FROM subjects where subject = '".$subject_code."' AND subjectid NOT IN (".$row[0].")";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_row($result);
        print json_encode($row);
    }
    else
        print json_encode('error');
?>