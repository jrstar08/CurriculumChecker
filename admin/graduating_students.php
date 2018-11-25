<!-- DI PA TAPOS, NAKA FIX SI AYSEM DUN SA BANDANG QUERY -->
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
</head>
<body>
    <div class="ui container" id="nav" style="display: block">
        <div class="ui secondary  menu">
            <a class="item" href="cross-enrolled.php">
            Cross-Enrolled
            </a>
            <a class="item" href="accreditation.php">
            Accreditation
            </a>
            <a class="item" href="generate_graduating_students.php">
            Generate Graduating Students
            </a>
            <a class="active item" href="graduating_students.php">
            Graduating Students
            </a>
            <a class="item" href="students_curriculum.php">
            Student's Curriculum
            </a>
            <div class="right menu">
                <a class="ui item" href="logout.php">
                    Logout
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="ui container">
    <h3>  List of Graduating Students </h3>
    <table class="ui celled table">
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
                $query = "SELECT graduating_students.studentid, name, program, unit, graduating_students.aysem FROM graduating_students join students on graduating_students.studentid=students.studentid join studentterms on studentterms.studentid = graduating_students.studentid join programs on programs.programid = studentterms.programid join units on units.unitid = studentterms.unitid where studentterms.aysem = '20172'";
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
    <center>
        <button class="ui grey button" id="print">PRINT</button>
    </center>

    </div>
    
    <script src="lib/semantic/semantic.min.js"></script>
    <script src="lib/jquery-3.2.1.js"></script>
    <script>
        $('#print').click(function(){
            $('#nav').css('display', 'none');
            $(this).css('display', 'none');
            print();
            $('#nav').css('display', 'block');
            $(this).css('display', 'block');
        });
    </script>
</body>
</html>