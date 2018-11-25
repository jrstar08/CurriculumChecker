<?php
    include ('connect.php');
    $query = "TRUNCATE TABLE studyplan";
    $result = mysqli_query($conn, $query);
    $query = "TRUNCATE TABLE studyplan_approval";
    $result = mysqli_query($conn, $query);
    $query = "TRUNCATE TABLE notification";
    $result = mysqli_query($conn, $query);
?>