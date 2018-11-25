<?php
    include ('connect.php');
    $studentid = 201402046;
    $aysem = 20172;
    $curriculumid = 20099;


    $query = "select * from curricula1 where curriculumid = '$curriculumid' and curricula1.subjectid not in (select subjectid from grades where studentid = '$studentid' and gradestatus = 'P')";


?>