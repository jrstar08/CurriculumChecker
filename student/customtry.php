<?php
    include ('connect.php');
    include ('custom_reset.php');
    include ('custom_shared_functions.php');
    
    $studentid=$_SESSION['studentid']; $registrationcode = $_SESSION['registrationcode']; $firstname = $_SESSION['firstname']; $lastname = $_SESSION['lastname']; $entryaysem = $_SESSION['entryaysem']; $aysem = $_SESSION['aysem'];
    $query8 = "select aysem, yearlevel from studentterms where studentid='$studentid' order by aysem desc limit 1";
    $result8 = mysqli_query($conn, $query8);
    $row8 = mysqli_fetch_row($result8);
    $aysem = $row8[0];
    $yearlevel = $row8[1];
    $year_sem = $yearlevel.substr($aysem,-1);

    $curriculum_subjects = $_SESSION['curriculum_subjects'];
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
    <main style="margin: 0 !important; padding-top: 0; top: 0;">
        <div class="container-fluid mt-5" style="margin: 0 !important; padding-top: 0; top: 0; width: 100%; margin-left: 0;">
            <!-- START -->
            <div class="row">
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_11" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">First Year, First Semester</div>
                    <div id="body_11" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(1,1,$curriculum_subjects,$conn, $studentid);
                                    // print_r($subjects_first_first);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_11" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(1,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_11" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">First Year, Second Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(1,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(1,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_12" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">First Year, Summer</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(1,3,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(1,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_13" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Second Year, First Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(2,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(2,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_21" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Second Year, Second Semester</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(2,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(2,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_22" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Second Year, Summer</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(2,3,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(2,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_23" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Third Year, First Semester</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(3,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_31" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(3,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_11" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Third Year, Second Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(3,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(3,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_32" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Third Year, Summer</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(3,3,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(3,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_33" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Fourth Year, First Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(4,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(4,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_41" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Fourth Year, Second Semester</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(4,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(4,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_42" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Fourth Year, Summer</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(4,3,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(4,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_43" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Fifth Year, First Semester</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(5,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(5,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_51" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Fifth Year, Second Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(5,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(5,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_52" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Fifth Year, Summer</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(5,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(5,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_53" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Sixth Year, First Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(6,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(6,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_61" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Sixth Year, Second Semester</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(6,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(6,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_62" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Sixth, Summer</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(6,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(6,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_63" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important; margin-bottom: 60px;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Seventh Year, First Year</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(7,1,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(7,1,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_71" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ccc; width: 100%; height: 50vh; padding: 0 !important; margin-bottom: 60px;">
                    <div id="header_12" class="col-12 text-center" style="background: #333; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Seventh Year, Second Semester</div>
                    <div id="body_12" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(7,2,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_12" style="background: rgb(172, 21, 21); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(7,2,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_72" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4 col-lg-4" style="background: #ddd; width: 100%; height: 50vh; padding: 0 !important; margin-bottom: 60px;">
                    <div id="header_13" class="col-12 text-center" style="background: #222; color: #fff; font-size: 110%; font-weight: 500; height: 5vh; padding: 5px;">Seventh Year, Summer</div>
                    <div id="body_13" style="height: 40vh; overflow: auto;">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subjects_first_first = get_taken_subjects(7,3,$curriculum_subjects,$conn, $studentid);
                                    for($i=0; $i<count($subjects_first_first); $i++)
                                    {
                                        $var_id = $subjects_first_first[$i]['id'];
                                        $var_title = $subjects_first_first[$i]['title'];
                                        $var_units = $subjects_first_first[$i]['units'];
                                        $disabled = "";
                                        
                                        if($subjects_first_first[$i]['subject_taken'] == 1)
                                            $disabled = "disabled";

                                        echo '<tr>';
                                            echo '<td><button id="delete_'.$var_id.'" class="btn btn-primary" style="margin-top: 0; padding: 5px 10px; width: 100%; border-radius: 100px 100px 100px 100px;" '.$disabled.'>X</button></td>';
                                            echo '<td style="padding-top: 20px;">'.$var_title.'</td>';
                                            echo '<td style="padding-top: 20px;">'.$var_units.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="footer_13" style="background: rgb(138, 8, 8); height: 5vh;">
                        <div class="row">
                            <div class="col-6 col-md-6 col-lg-6">
                                <h5 id="sub_total_units_11" style="color: #fff; text-align: center; padding-top: 7px;">Total Units: <?php echo get_sub_total_units(7,3,$conn,$studentid); ?></h5>
                            </div>
                            <div class="col-6 col-md-6 col-lg-6" style="padding: 0px;">
                                <button id="add_subject_73" class="add_subject" style="width: 94%; text-align: center; background: none; height: 5vh; color: #fff; border: 5px solid #fff; cursor: pointer; ">ADD SUBJECT (+)</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FOR HIDDEN PURPOSES -->
            <input type="text" id="semester_checker_modal" name="semester_checker_modal" style="margin-bottom: 120px;" hidden>

            <div class="fixed-bottom" style="background: #222; height: 60px;">
                <div class="row" style="padding: 0;">
                    <div class="col-2 col-md-2 col-lg-4">
                        <h5 style="color: #fff; text-align: center; font-weight: 500; padding-top: 20px; text-align: center !important;"><?php echo $lastname.', '.$firstname; ?></h5>
                    </div>
                    <div class="col-4 col-md-4 col-lg-3">
                        <h5 style="color: #fff; text-align: left; font-weight: 500; padding-top: 20px;">Remaining Subjects: <?php echo get_remaining_subjects(); ?></h5>
                    </div>
                    <div class="col-4 col-md-4 col-lg-3">
                        <h5 style="color: #fff; text-align: left; font-weight: 500; padding-top: 20px;" >Total Units Enrolled: <?php echo get_total_units_enrolled($conn,$studentid); ?></h5>
                    </div>
                    <div class="col-2 col-md-2 col-lg-2">
                        <button style="width: 92%; height: 50px; background: none; border: 5px solid #fff; color: #fff; font-size: 115%; margin: 5px 4%;cursor: pointer; ">Submit</button>
                    </div>
                </div>
            </div>


            <!-- END -->

        </div> 
    </main>
    <!--Main Layout-->
    
    <!-- MODAL HERE -->
    <!-- Modal -->
    <div class="modal fade" id="modal_subject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="add_subject_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Add subject(s)..</h5>
                    <?php 
                        $remaining_subjects = get_all_remaining_subjects($conn, $studentid); 
                        echo '<select class="mdb-select colorful-select dropdown-danger" id="selected_subjects" multiple>';
                        echo "<option disabled>Select subject(s)..";
                        for($i=0; $i<count($remaining_subjects); $i++)
                            echo "<option value='".$remaining_subjects[$i]["subject_id"]."'>".$remaining_subjects[$i]["subject_title"]."</option>";
                        echo '</select>';
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script src="lib/jquery-3.2.1.js"></script>
    <script src="lib/sweetalert2/sweetalert2.all.js"></script>
    <script src="lib/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="lib/compiled.min.js"></script>
    <script src="lib/jquery.bootstrap-growl.js"></script>
    <script>
        $(document).ready(function() {
            $('select').material_select();
        });
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
        $('.add_subject').click(function(){
            var aysem = {
                11: "First Year, First Semester", 
                12: "First Year, Second Semester",
                13: "First Year, Summer",
                21: "Second Year, First Semester", 
                22: "Second Year, Second Semester",
                23: "Second Year, Summer",
                31: "Third Year, First Semester", 
                32: "Third Year, Second Semester",
                33: "Third Year, Summer",
                41: "Fourth Year, First Semester", 
                42: "Fourth Year, Second Semester",
                43: "Fourth Year, Summer",
                51: "Fifth Year, First Semester", 
                52: "Fifth Year, Second Semester",
                53: "Fifth Year, Summer",
                61: "Sixth Year, First Semester", 
                62: "Sixth Year, Second Semester",
                63: "Sixth Year, Summer",
                71: "Seventh Year, First Semester", 
                72: "Seventh Year, Second Semester",
                73: "Seventh Year, Summer"
            };
            
            var id = this.id;
            id = id.split('_');
            id = id[2];
            // $('#selected_subjects').html('');
            $('#semester_checker_modal').val(id);
            $('#add_subject_title').html(aysem[id]);
            $('#modal_subject').modal("show");
        });

        $('.available_subject').click(function(){
            $.ajax({  
                url:"custom_ajax.php",  
                method:"POST",  
                data: {id:this.id, function: "modal_get_subject_information"},
                success:function(data){  
                    // $("#output").html(data);
                    alert(data);
                }  
            });  
            $('#modal_subject').modal("show");

            $('#modal_subject_title').html(this.id);
        });
    </script>
    <script>
        var year_sem = <?php echo $year_sem; ?>;
        var y_s = [11,12,13,21,22,23,31,32,33,41,42,43,51,52,53,61,62,63,71,72,73];
        for(var i=0; i<y_s.length; i++)
        {
            $("#add_subject").attr("disabled", true);
        }

    </script>
    <script>
        
        // SideNav Initialization
        $(".button-collapse").sideNav();
        
    </script><div class="drag-target" style="left: 0px; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>

<div class="hiddendiv common"></div></body></html>