<?php
    include ('connect.php');
    ini_set('max_execution_time', 0);
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
<body onload="print(); location='students_deficiency.php'">
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
    <h3 class="text-center"> <b> List of Non Graduating Students </b> </h3>
        <table class="ui unstackable table">
        <thead>
            <tr>
                <th width="5%">Student ID</th>
                <th width="20%">Name</th>
                <th width="10%">Course</th>
                <th width="5%">College</th>
                <th width="5%">Year</th>
                <th width="55%">Deficiencies</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT student_with_deficiency.studentid, name, program, unit, yearlevel
                            FROM student_with_deficiency
                            JOIN students ON student_with_deficiency.studentid = students.studentid
                            JOIN studentterms ON studentterms.studentid = student_with_deficiency.studentid
                            JOIN programs ON programs.programid = studentterms.programid
                            JOIN units ON units.unitid = studentterms.unitid
                            WHERE studentterms.aysem = 20172
                            GROUP BY student_with_deficiency.studentid
                            ORDER BY units.unit, programs.program, studentterms.aysem DESC, name ASC";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_row($result))
                {
                    echo '<tr>';
                        echo '<td>';
                            echo $row[0];
                        echo '</td>';
                        echo '<td>';
                            echo $row[1];
                        echo '</td>';
                        echo '<td>';
                            echo $row[2];
                        echo '</td>';
                        echo '<td>';
                            echo $row[3];
                        echo '</td>';
                        echo '<td>';
                            echo $row[4];
                        echo '</td>';
                            $query1 = "select subject from student_with_deficiency join subjects on subjects.subjectid = student_with_deficiency.deficiency where studentid = '$row[0]'";
                            $result1 = mysqli_query($conn, $query1);
                        echo '<td>';
                        $ctr_deficiency = 0;
                            if(mysqli_num_rows($result1) > 0)
                            {
                                while($row1 = mysqli_fetch_row($result1))
                                {
                                    $ctr_deficiency++;
                                    if($ctr_deficiency < 100)
                                        echo $row1[0] . ', ';
                                    else
                                        break;
                                }
                            }
                            else 
                                echo "PE/NSTP ";
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
    </div>
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
</body>
</html>