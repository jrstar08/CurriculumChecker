<?php
    include ('connect.php');
    $subject = $_SESSION['ACCREDITATION_LASTHOLD_SUBJECT'];
    $subjectid = $_SESSION['accreditation_subjectid'];
    $curriculumid = $_SESSION['curriculumid'];
    
    $query = "SELECT clusterid1 FROM curricula1 WHERE subjectid = '$subjectid' AND curriculumid = '$curriculumid'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $cluster = explode(', ', $row[0]);

    $query = "SELECT subjectid FROM subjects WHERE subject = '$subject'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    array_push($cluster, $row[0]);
    $clusters = '';
    
    for($i=0; $i<count($cluster); $i++)
    {
        $clusters .= $cluster[$i];

        if($i == count($cluster) - 1)
            break;
        else
            $clusters .= ', ';      
    }  

    $query = "UPDATE curricula1 SET clusterid1 = '$clusters' WHERE subjectid = '$subjectid' AND curriculumid = '$curriculumid'";
    $result = mysqli_query($conn, $query);
?>