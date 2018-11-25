<?php
   $connect = mysqli_connect("localhost", "root", "", "plmcrsdb");
   if(isset($_POST["id"]))
   {
    $value = mysqli_real_escape_string($connect, $_POST["value"]);
    $query = "UPDATE cross_enrolled_subjects SET ".$_POST["column_name"]."='".$value."' WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($connect, $query))
    {
     echo 'Data Updated';
    }
   }
?>