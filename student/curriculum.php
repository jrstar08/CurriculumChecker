<?php 
    include ('connect.php'); 
    include ('custom_reset.php');
    $studentid = $_SESSION['studentid'];
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags always come first -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>PLM-CRS: Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
    <link rel="stylesheet" href="lib/material.indigo-red.min.css">
    <link rel="stylesheet" href="material-icons.css">
    <script defer src="lib/material.min.js"></script>
    <link rel="stylesheet" href="lib/semantic/semantic.min.css">
    <!-- Bootstrap core CSS -->
    <link href="lib/compiled.min.css" rel="stylesheet">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
</head>

<body class="fixed-sn light-blue-skin">
<select id="thedropdown">
    <option value="1">one</option>
    <option value="2">two</option>
  </select>
    <div style="width:100%; height: 60px; background-color: rgb(138, 8, 8);"><center><img src="lib/plmlogo.png" width="50px" style="margin: 5px;"></center></div>
        
    <!--Double navigation-->
    <header>
        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed mdb-sidenav" style="transform: translateX(-100%); background: none; background-color: #B71C1C;">
            <ul class="custom-scrollbar list-unstyled" style="max-height:100vh;">
                <!-- NAVIGATION -->
                <h2 style="margin: 15% 20px;"><img src="lib/student.png" style="width: 50px; margin-right: 15px;"><?php echo 'Student';?></h2>
                <!-- Side navigation links -->
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
        <div class="container-fluid mt-5" id="container" style="margin-top: 0; padding-top: 0; top: 0; width: 100%; margin-left: 0; visibility: hidden;">
            <!-- START -->
            <?php
                $query = "SELECT * FROM studyplan_approval where studentid = '$studentid' and (approve = 1 or advice = 1) and active = 1 order by studyplanid desc limit 1";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($result);
                $studyplanid = $row[0];
                $_SESSION['studyplanid'] = $studyplanid;
                
                // ADVICE PART
                $query = "SELECT id, count(*), submitted_to, submitted_by, text, name FROM studyplan_approval join notification on notification.submitted_to = studyplan_approval.studentid join employees on employees.employeeid = notification.submitted_by where submitted_to = '$studentid' and advice = 1 and studyplan_approval.active = 1 order by studyplanid desc limit 1";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($result);
                $advice = $row[1];
                $submitted_to = $row[2];
                $submitted_by = $row[3];
                $text = $row[4];
                $adviser = $row[5];
                // echo $text.$adviser;
            ?>
            <input type="text" id="studyplanid" value="<?php echo $studyplanid; ?>" hidden>
            <input type="text" id="adviser" value="<?php echo $adviser; ?>" hidden>
            <input type="text" id="text_message" value="<?php echo $text; ?>" hidden>


            <h3 style="text-align: center;">STUDY PLAN</h3>
            <!-- FIX BOX -->
            <div style="overflow: auto; width: 100%; height: 400px;">
            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 1 and sem = 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>First Year, First Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>
            
            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 1 and sem = 2";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>First Year, Second Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>
            
            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 2 and sem = 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Second Year, First Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 2 and sem = 2";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Second Year, Second Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 3 and sem = 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Third Year, First Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 3 and sem = 2";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Third Year, Second Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 3 and sem = 3";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Third Year, Summer</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 4 and sem = 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Fourth Year, First Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 4 and sem = 2";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Fourth Year, Second Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 5 and sem = 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Fifth Year, First Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 5 and sem = 2";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Fifth Year, Second Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 6 and sem = 1";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Sixth Year, First Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            <!-- START -->
            <?php
                $totalunits = 0;
                $output = '';
                $query = "SELECT * FROM studyplan where studyplanid = '$studyplanid' and year = 6 and sem = 2";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result))
                {
                    $output .= '
                    <h5>Sixth Year, Second Semester</h5>
                    <table class="table table-hover table-inverse">
                    <thead style="background: #D32F2F; color: #fff">
                        <tr>
                        <th width="15%">Course Code</th>
                        <th width="75%">Course Title</th>
                        <th width="10%">Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    while($row = mysqli_fetch_row($result))
                    {
                        $subject = $row[4];
                        $subjecttitle = $row[5];
                        $credits = $row[6];
                        $totalunits += $credits;

                        $output .= '
                            <tr>
                                <td>'.$subject.'</td>
                                <td>'.$subjecttitle.'</td>
                                <td>'.$credits.'</td>
                            </tr>';
                    }
                    $output .= '</tbody></table>';
                    $output .= '<h6 style="color: #B71C1C; text-align: center;">Total Units: ' . $totalunits . '</h6>';
                }
                echo $output;
            ?>     
            </tbody>
            </table>

            </div> <!-- END OF FIX BOX -->
            <br><br>
            <center><button onclick="location='print.php'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="submit_studyplanbutton"> PRINT </button></center>


            <!-- END -->
        </div> 
    </main>
    <!--Main Layout-->
    
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="lib/compiled.min.js"></script>
    <script src="lib/jquery.bootstrap-growl.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script>
        function no_studyplan(){
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Sorry, approved study plan not found',
                footer: '<a href>Create study plan?</a><a href="preferred.php">&nbsp;Preferred?</a><a href>&nbsp; or &nbsp;</a><a href="custom.php">Custom?</a>',
            }).then((result) => {
                setTimeout(function() {
                    location="home.php";
                }, 50);
            })
        }
    </script>

    <script>
        function go_to_edit_page(){
            var text = $('#text_message').val();
            var adviser = $('#adviser').val();
            swal({
                type: 'info',
                title: adviser,
                text: text
            }).then((result) => {
                setTimeout(function() {
                    location="edit_page.php";
                }, 50);
            })
        }
    </script>

    <script>
        function check_studyplan(){
            var id = $('#studyplanid').val();
            if(id == '')
                no_studyplan();
            else
                $('#container').css('visibility', 'visible');
        }
    </script>

    <script>
        function check_advice(){
            var advice = <?php echo $advice; ?>;
            if(advice>0)
                go_to_edit_page();
        }
    </script>

    <script>
        check_studyplan();
    </script>

    <script>
        check_advice();
    </script>
    
    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();

    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>