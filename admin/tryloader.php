<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
</head>
<body>

    <img src="lib/loader.svg">

    <?php 
        session_start();
        for($i=0; $i<count($_SESSION['not_okay_subjects']); $i++)
        {
            echo $_SESSION['not_okay_subjects'][$i] . '<br>';
        }
    ?>

<script src="lib/semantic/semantic.min.js"></script>
</body>
</html>