<?php
   $connect = mysqli_connect("localhost", "root", "", "plmcrsdb");
   if(isset($_POST["studentid"], $_POST["subjectid"], $_POST["schoolid"], $_POST["aysem"], $_POST["finalgrade"], $_POST["status"], $_POST["completiongrade"], $_POST["subjectcode"]))
   {
    $completiongrade = '';
    $studentid = mysqli_real_escape_string($connect, $_POST["studentid"]);
    $subjectid = mysqli_real_escape_string($connect, $_POST["subjectid"]);
    $finalgrade = mysqli_real_escape_string($connect, $_POST["finalgrade"]);
    $status = mysqli_real_escape_string($connect, $_POST["status"]);
    $completiongrade = mysqli_real_escape_string($connect, $_POST["completiongrade"]);
    $subjectcode = mysqli_real_escape_string($connect, $_POST["subjectcode"]);
    $aysem = mysqli_real_escape_string($connect, $_POST["aysem"]);
    $schoolid = mysqli_real_escape_string($connect, $_POST["schoolid"]);
    $query = "INSERT INTO cross_enrolled_subjects(studentid, subjectid, finalgrade, status, completiongrade, subjectcode, aysem, schoolid) VALUES('$studentid', '$subjectid', '$finalgrade', '$status', '$completiongrade', '$subjectcode', '$aysem', '$schoolid')";
    if(mysqli_query($connect, $query))
    {
     echo 'Data Inserted';
    }
   }
?>