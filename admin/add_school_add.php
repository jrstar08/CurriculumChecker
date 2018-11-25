<?php
    include ('connect.php');
    $school_name = $_POST['school_name'];
    $school_code = $_POST['school_code'];
    $school_address = $_POST['school_address'];

    $query = "INSERT INTO schools(school_name, school_code, address) VALUES ('$school_name', '$school_code', '$school_address')";
    if($result = mysqli_query($conn, $query))
        echo "SUCCESS!";
?>