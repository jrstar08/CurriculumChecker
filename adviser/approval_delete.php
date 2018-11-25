<?php 
    include ('connect.php');
    $id = $_POST['id'];

    $query = "update studyplan_approval set active = 0 where studyplanid='$id'";
    $result = mysqli_query($conn, $query);
?>