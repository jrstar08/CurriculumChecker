<?php 
    include ('connect.php'); 
    $studyplanid=$_SESSION['studyplanid'];

    $query = "SELECT name, students.studentid FROM studyplan_approval join students on studyplan_approval.studentid = students.studentid where studyplanid = '$studyplanid' limit 1";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    $studentid = $row[1];
    $name = $row[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <style>
        th{
            text-align: left;
        }
    </style>
</head>
<!-- print(); location='curriculum.php' -->
<body onload="print(); location='curriculum.php'">
    <div style="width: 90%; margin: 5%;">
        <div style="float:left; width: 100%">
        <center> 
            <img src="lib/plmlogo.png" style="width: 70px; float: left; margin-left: 100px; padding: 0; margin-top: 25px;">
            <div style="float: left; padding: 10px; margin-left: 15px;">    
                <h3>PAMANTASAN NG LUNGSOD NG MAYNILA</h3>
                <h4>Gen. Luna, cor. Muralla St., Intramuros, Manila</h4>
            </div>
        </center>
        </div>
        
        <h3><br><br><br><br><br><br><?php echo $studentid . '<br>' . $name ?></h3>
        <div>
                <?php
                    // FIRST YEAR, FIRST SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 1 and sem = 1 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>First Year, First Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;

                    // FIRST YEAR, SECOND SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 1 and sem = 2 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>First Year, Second Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;

                    // SeECOND YEAR, FIRST SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 2 and sem = 1 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Second Year, First Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;

                    // SECOND YEAR, SECOND SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 2 and sem = 2 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Second Year, Second Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;

                    // THIRD YEAR, FIRST SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 3 and sem = 1 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Third Year, First Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;
                    
                    // THIRD YEAR, SECOND SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 3 and sem = 2 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Third Year, Second Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;

                    // THIRD YEAR, SUMMER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 3 and sem = 3 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Third Year, Summer</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;

                    // FOURTH YEAR, FIRST SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 4 and sem = 1 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Fourth Year, First Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;
                    
                    // FOURTH YEAR, SECOND SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 4 and sem = 2 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Fourth Year, Second Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;
                    
                    // FIFTH YEAR, FIRST SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 5 and sem = 1 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Fifth Year, First Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;
                    
                    // FIFTH YEAR, SECOND SEMESTER
                    $output = '';
                    $totalunits = 0;
                    $query = "select subjects.subject, subjects.subjecttitle, subjects.credits, year, sem from studyplan join subjects on subjects.subjectid = studyplan.subjectid where year = 5 and sem = 2 and studyplanid = '$studyplanid' order by year, sem, subjects.subject";
                    $result = mysqli_query($conn, $query);
                    if(mysqli_num_rows($result)>0)
                    {
                        $output .= '
                                <h4>Fifth Year, Second Semester</h4>
                                <table>
                                <thead>
                                    <tr>
                                    <th width="150px">Course Code</th>
                                    <th width="550px">Course Title</th>
                                    <th width="50px">Units</th>
                                    </tr>
                                </thead>
                                <tbody>';
                        while($row = mysqli_fetch_row($result))
                        {
                            $output .= '
                                    <tr>
                                    <td>'.$row[0].'</td>
                                    <td>'.$row[1].'</td>
                                    <td>'.$row[2].'</td>
                                    </tr>
                            ';
                            $totalunits += $row[2];
                        }
                        $output .= '
                                </tbody>
                                </table>
                                <h5>Total Units: '.$totalunits.'</h5>
                        ';
                    }
                    echo $output;
                ?>
        </div>
    </div>
    <script>

    </script>
</body>
</html>