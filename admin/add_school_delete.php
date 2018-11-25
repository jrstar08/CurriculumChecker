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
    else if($_POST['type'] == "DELETE_DATAS")
    {
        $query = "DELETE FROM schools WHERE school_id = '$schoolid'";
        if($result = mysqli_query($conn, $query))
            echo "SUCCESS!";
    }
?>