<?php
    include ('connect.php');
    ini_set('max_execution_time', 0);
    $GOT_QUERY = $_GET['query'] . ' GROUP BY studentid';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
    <script src="lib/jquery-3.2.1.js"></script>
</head>
<body onload="print(); location='graduating_class.php'">
    <div class="ui container">
        <div style="float:left; width: 100%">
        <center> 
            <img src="lib/plmlogo.png" style="width: 70px; float: left; margin-left: 30px; margin-right: 20px; padding: 0; margin-top: 0px;">
            <div style="float: left; padding: 0px; margin-left: 0px; margin-top:">    
                <h3>PAMANTASAN NG LUNGSOD NG MAYNILA</h3>
                <h4>Gen. Luna, cor. Muralla St., Intramuros, Manila</h4>
            </div>
        </center>
        </div>
        <h3 class="text-center"> <b>List of Graduating Students</b> </h3>
        <table class="ui unstackable table">
            <thead>
                <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>College</th>
                <th>AYSEM</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // $query = "SELECT graduating_students.studentid, name, program, unit, graduating_students.aysem FROM graduating_students join students on graduating_students.studentid=students.studentid join studentterms on studentterms.studentid = graduating_students.studentid join programs on programs.programid = studentterms.programid join units on units.unitid = studentterms.unitid where studentterms.aysem = '20172'";
                    $query = $GOT_QUERY;
                    $result = mysqli_query($conn,$query);
                    if(mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_row($result))
                        {
                            echo '<tr>';
                            echo '<td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4];
                            echo '</tr>';
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
</body>
</html>