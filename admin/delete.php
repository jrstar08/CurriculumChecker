<?php
   $connect = mysqli_connect("localhost", "root", "", "plmcrsdb");
   if(isset($_POST["id"]))
   {
    $query = "UPDATE cross_enrolled_subjects SET active = 0 WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($connect, $query))
    {
     echo 'Data Deleted';
    }
   }
?>