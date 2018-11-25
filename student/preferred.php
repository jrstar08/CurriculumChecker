<?php
    include ('connect.php');
    include ('custom_reset.php');
    
    $studentid=$_SESSION['studentid']; $registrationcode = $_SESSION['registrationcode']; $firstname = $_SESSION['firstname']; $lastname = $_SESSION['lastname']; $entryaysem = $_SESSION['entryaysem']; $aysem = $_SESSION['aysem'];
    $query8 = "select aysem from studentterms where studentid='$studentid' order by aysem desc limit 1";
    $result8 = mysqli_query($conn, $query8);
    $aysem = mysqli_fetch_row($result8);
    $aysem = $aysem[0];

    $query8 = "SELECT count(*), studyplanid FROM studyplan_approval where studentid = '$studentid' and aysem = '$aysem' and active = 1";
    $result8 = mysqli_query($conn, $query8);
    $row8 = mysqli_fetch_row($result8);
    $is_there_a_studyplan = $row8[0];
    $_SESSION['studyplanid'] = $row8[1];
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
</head>

<body class="fixed-sn light-blue-skin" onload="notification(); preferred();">
    <div style="width:100%; height: 60px; background-color: rgb(138, 8, 8);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
        
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #B71C1C;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 20px;"><img src="lib/student.png" style="width: 50px; margin-right: 15px;"><?php echo 'Student';?></h2>                <!-- Side navigation links -->
                <li>
                    <ul class="collapsible collapsible-accordion">
                        <li><a href="home.php" class="collapsible-header waves-effect arrow-r">Home</a></li>
                        <li><a class="collapsible-header waves-effect arrow-r">Creation of Study Plan <img src="lib/down.png" style="margin-left: 20%" width="15px"></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="preferred.php" class="waves-effect">Preferred</a>
                                    </li>
                                    <li><a href="custom.php" class="waves-effect">Custom</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="curriculum.php" class="collapsible-header waves-effect arrow-r">Study Plan</a></li>
                        <li><a href="checklist.php" class="collapsible-header waves-effect arrow-r">Checklist</a></li>
                        <li><a href="prospectus.php" class="collapsible-header waves-effect arrow-r">Prospectus</a></li>      
                        <li><a href="logout.php" class="collapsible-header waves-effect arrow-r"><b>Logout</b></a></li>
                    </ul>
                </li>
                <!--/. Side navigation links -->
            </ul>
        </div>
        <!--/. Sidebar navigation -->
        <!-- Navbar -->
        <nav class="navbar navbar-toggleable-md navbar-expand-lg scrolling-navbar double-nav" style="background: rgb(172, 21, 21);">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse"><img src="lib/burger.png" width="25px" style="padding: 0; margin: 0;"></a>
            </div>
            <!-- Breadcrumb-->
            <div class="breadcrumb-dn mr-auto" style="float: left; padding: 0; margin: 0;">
                <p>PLM-CRS: Curriculum Checker</p>
            </div>
        </nav>
        <!-- /.Navbar -->
    </header>
    <!--/.Double navigation-->
    <!--Main Layout-->
    <main style="margin-top: 0; padding-top: 0; top: 0;">
        <div class="container-fluid mt-5" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
            <input type="text" value="<?php echo $registrationcode; ?>" id="regular" hidden>
            <?php if($registrationcode != 'REGULAR'){ ?>
                <center>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary active">
                            <input type="radio" name="options" id="option1" class="studyplan_option" value="1" autocomplete="off"> All
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="option2" class="studyplan_option" value="2" autocomplete="off"> Per Semester
                        </label>
                        <label class="btn btn-dark">
                            <input type="radio" name="options" id="option3" class="studyplan_option" value="3" autocomplete="off"> View in Document Format
                        </label>
                    </div>
                </center>
                <br>
                <div id="all" style="overflow: auto; width: 100%; display: block;">
                    <h3 class="aysem_11">First Year, First Semester</h3>
                    <table class="table table-hover table-inverse aysem_11">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 1 AND sem = 1
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 class="aysem_11" style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                    
                    <h3 class="aysem_12">First Year, Second Semester</h3>
                    <table class="table table-hover table-inverse aysem_12">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 1 AND sem = 2
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 class="aysem_12" style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>

                    <h3 class="aysem_21">Second Year, First Semester</h3>
                    <table class="table table-hover table-inverse aysem_21">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 2 AND sem = 1
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 class="aysem_21" style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                    
                    <h3 class="aysem_22">Second Year, Second Semester</h3>
                    <table class="table table-hover table-inverse aysem_22">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 2 AND sem = 2
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 class="aysem_22" style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>

                    <h3 class="aysem_31">Third Year, First Semester</h3>
                    <table class="table table-hover table-inverse aysem_31">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 3 AND sem = 1
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 style="text-align: center" class="aysem_31">Total Units:<?php echo ' ' . $totalunits; ?> </h4>

                    <h3 class="aysem_32">Third Year, Second Semester</h3>
                    <table class="table table-hover table-inverse aysem_32">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 3 AND sem = 2
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 style="text-align: center" class="aysem_32">Total Units:<?php echo ' ' . $totalunits; ?> </h4>

                    <h3 class="aysem_33">Third Year, Summer</h3>
                    <table class="table table-hover table-inverse aysem_33">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 3 AND sem = 3
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 style="text-align: center" class="aysem_33">Total Units:<?php echo ' ' . $totalunits; ?> </h4>

                    <h3 class="aysem_41">Fourth Year, First Semester</h3>
                    <table class="table table-hover table-inverse aysem_41">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 4 AND sem = 1
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 style="text-align: center" class="aysem_41">Total Units:<?php echo ' ' . $totalunits; ?> </h4>

                    <h3 class="aysem_42">Fourth Year, Second Semester</h3>
                    <table class="table table-hover table-inverse aysem_42">
                        <thead style="background: #D32F2F; color: #fff">
                            <tr>
                            <th width="15%">Course Code</th>
                            <th width="75%">Course Title</th>
                            <th width="10%">Units</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $output = '';
                            $totalunits = 0;
                            $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                            FROM curricula2
                            JOIN subjects ON subjects.subjectid = curricula2.subjectid
                            WHERE year = 4 AND sem = 2
                            ORDER BY year, sem, subject";
                            $result = mysqli_query($conn, $query);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_row($result))
                                {
                                    $output .= '<tr>';
                                    $output .= '<td>' . $row[1] . '</td>';
                                    $output .= '<td>' . $row[2] . '</td>';
                                    $output .= '<td>' . $row[3] . '</td>';
                                    $output .= '</tr>';
                                    $totalunits += $row[3];
                                }
                            }
                            echo $output;
                        ?>
                        </tbody>
                    </table>
                    <h4 style="text-align: center" class="aysem_42">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                </div>
                
                <center><input class="btn btn-primary" type="submit" id="submit1" value="Submit Study Plan" style="margin-top: 8vh;"></center>
                
                <div id="per_semester" style="overflow: auto; width: 100%; display: none;">
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="card" id="aysem_11">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                First Year, First Semester
                                </a>
                            </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 1 AND sem = 1
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_12">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                First Year, Second Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 1 AND sem = 2
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_21">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Second Year, First Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 2 AND sem = 1
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_22">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Second Year, Second Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 2 AND sem = 2
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_31">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Third Year, First Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 3 AND sem = 1
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_32">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Third Year, Second Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 3 AND sem = 2
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_33">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Third Year, Summer
                                </a>
                            </h5>
                            </div>
                            <div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 3 AND sem = 3
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_41">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Fourth Year, First Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseEight" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 4 AND sem = 1
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                        <div class="card" id="aysem_42">
                            <div class="card-header" role="tab" id="headingOne" style="background: #D32F2F;" class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseTwo">
                            <h5 class="mb-0">
                                <a style="color: #fff;">
                                Fourth Year, Second Semester
                                </a>
                            </h5>
                            </div>
                            <div id="collapseNine" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                            <div class="card-block" style="margin: 10px;">
                                <table class="table table-hover table-inverse">
                                    <thead style="background: #212121; color: #fff">
                                        <tr>
                                        <th width="15%">Course Code</th>
                                        <th width="75%">Course Title</th>
                                        <th width="10%">Units</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $output = '';
                                        $totalunits = 0;
                                        $query = "SELECT curricula2.subjectid, subject, subjecttitle, curricula2.credits
                                        FROM curricula2
                                        JOIN subjects ON subjects.subjectid = curricula2.subjectid
                                        WHERE year = 4 AND sem = 2
                                        ORDER BY year, sem, subject";
                                        $result = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($result)>0)
                                        {
                                            while($row = mysqli_fetch_row($result))
                                            {
                                                $output .= '<tr>';
                                                $output .= '<td>' . $row[1] . '</td>';
                                                $output .= '<td>' . $row[2] . '</td>';
                                                $output .= '<td>' . $row[3] . '</td>';
                                                $output .= '</tr>';
                                                $totalunits += $row[3];
                                            }
                                        }
                                        echo $output;
                                    ?>
                                    </tbody>
                                </table>
                                <h4 style="text-align: center">Total Units:<?php echo ' ' . $totalunits; ?> </h4>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <center><input class="btn btn-primary" type="submit" id="submit2" value="Submit Study Plan" style="margin-top: 5vh; display: none"></center>

            <?php
                }  
            ?>
            <!-- END -->
        </div> 
    </main>
    <!--Main Layout-->
    
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="lib/compiled.min.js"></script>
    <script src="lib/jquery.bootstrap-growl.js"></script>
    <script>
        function success(){
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2196F3',
                cancelButtonColor: '#F44336',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    swal(
                        'Submitted!',
                        'Please wait for the approval',
                        'success'
                    ).then((result) => {
                        setTimeout(function() {
                            location="home.php";
                        }, 300);
                    })

                    $.ajax({  
                        url:"preferred_insert.php",  
                        method:"POST",  
                        data: {},
                        success:function(data){}  
                    });
                }
            })
        }
    </script>
    <script>
        function regular(){
            swal({
                title: 'Oops ...',
                text: "Only irregular students have access to this page",
                type: 'warning'
            }).then((result) => {
                        setTimeout(function() {
                            location="home.php";
                        }, 300);
            })
        }
    </script>
    <script>
        function notification(){
            $.bootstrapGrowl("You chose preferred study plan", {
            ele: 'body', // which element to append to
            type: 'success', // (null, 'info', 'danger', 'success')
            offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 270, // (integer, or 'auto')
            delay: 6500, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        }
        function preferred(){
            setTimeout(function() {
                $.bootstrapGrowl("Preferred is an auto generated study plan", {
                ele: 'body', // which element to append to
                type: 'info', // (null, 'info', 'danger', 'success')
                offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 320, // (integer, or 'auto')
                delay: 7000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
                });
            }, 2000);
        }
    </script>
    <script>
        $(document).ready(function() { 
            var entryaysem = '<?php echo $entryaysem; ?>';
            var aysem = '<?php echo $aysem; ?>';
            var year = aysem.substr(0,4) - entryaysem.substr(0,4);
            var semester = aysem.substr(-1);
            year++;

            var yearsemester = year+semester;
            // alert(yearsemester);

            for(var i=11; i<=yearsemester; i++)
            {
                $('.aysem_'+i).css('display', 'none');
                $('#aysem_'+i).css('display', 'none');
            }

            $('input[type=radio][name=options]').change(function(){
                if(this.value == 1){
                    $('#per_semester').css("display", "none");
                    $('#submit2').css("display", "none");
                    $('#all').css("display", "block");
                    $('#submit1').css("display", "block");
                }
                else if(this.value == 2){
                    $('#all').css("display", "none");
                    $('#submit1').css("display", "none");
                    $('#submit2').css("display", "block");
                    $('#per_semester').css("display", "block");
                }
                else if(this.value == 3){
                    $('#all').css("display", "none");
                    $('#submit1').css("display", "none");
                    $('#submit2').css("display", "none");
                    $('#per_semester').css("display", "none");
                    window.open('preferred_view_document_format.php');
                }
            }); 
        });
    </script>
    <script>
        $(document).ready(function() { 
            $('#submit1').click(function(){
                success();
            });
            $('#submit2').click(function(){
                success();
            });
            if($("#regular").val() == 'REGULAR')
            {
                regular();
            }
        });
    </script>
    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();
        
    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>

<!-- ERROR TRAPPING -->
<script>
    function is_there_a_studyplan(){
        swal({
            title: "Already created a Study Plan",
            text: "Would you like to edit your study plan or return to home page?",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, edit my study plan!',
            cancelButtonText: 'Return to home!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            reverseButtons: false
            }).then((result) => {
            if (result.value) {
                swal(
                'Edit Study Plan',
                '',
                'success'
                ).then((result) => {
                    location = 'edit_page.php';
                });
            } else {
                swal(
                'Returning to Home Page',
                '',
                'success'
                ).then((result) => {
                    location = 'home.php';
                });
            }
        })
    }    
</script>

<script>
    var counter = <?php echo $is_there_a_studyplan; ?>;
    
    if(counter > 0)
        is_there_a_studyplan();
</script>