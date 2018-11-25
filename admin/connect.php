<?php 
    ini_set('max_execution_time', 600000);
    session_start();
    //connect.php
    $server	    = 'localhost';
    $username	= 'root';
    $password	= '';
    $database	= 'plmcrsdb';
    $conn = mysqli_connect($server, $username, $password, $database);
?>