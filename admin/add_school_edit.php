<?php
    include ('connect.php');
    $schoolid = $_POST['school_id'];

    if($_POST['type'] == "INITIAL_VALUE")
    {
        $query = "SELECT * FROM schools WHERE school_id = '$schoolid'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        echo $row[1] . "|" . $row[2] . "|" . $row[3];
    }
    else if($_POST['type'] == "UPDATE_DATAS")
    {
        $school_name = $_POST['school_name'];
        $school_code = $_POST['school_code'];
        $school_address = $_POST['school_address'];

        $query = "UPDATE schools SET school_name = '$school_name', school_code = '$school_code', address = '$school_address' WHERE school_id = '$schoolid'";
        if($result = mysqli_query($conn, $query))
            echo "SUCCESS!";
    }
?>