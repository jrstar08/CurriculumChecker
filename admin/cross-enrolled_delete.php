<?php
    include ('connect.php');
    $id = $_POST['id'];

    if($_POST['type'] == "INITIAL_VALUE")
    {
        $query = "SELECT * FROM cross_enrolled_subjects WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_row($result);
        echo $row[1] . "|" . $row[2] . "|" . $row[7];
    }
    else if($_POST['type'] == "DELETE_DATAS")
    {
        $query = "DELETE FROM cross_enrolled_subjects WHERE id = '$id'";
        if($result = mysqli_query($conn, $query))
            echo "SUCCESS!";
    }
?>