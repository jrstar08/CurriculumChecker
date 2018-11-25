<?php
    include('connect.php');
    $submitted_to = $_POST['studentid'];
    $text = $_POST['text'];
    $submitted_by = $_POST['submitted_by'];
    $studyplanid = $_POST['studyplanid'];

    $query = "INSERT INTO notification(text, submitted_to, submitted_by) VALUES ('$text', '$submitted_to', '$submitted_by')";
    $result = mysqli_query($conn, $query);

    $query = "UPDATE studyplan_approval SET advice = 1 WHERE '$studyplanid'";
    $result = mysqli_query($conn, $query);
?>